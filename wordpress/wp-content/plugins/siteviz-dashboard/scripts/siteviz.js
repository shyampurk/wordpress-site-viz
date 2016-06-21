/*
 * VizElement Object for Managing the SiteViz SceneGraph. Based on D3js Force Layout
 * @param parent_elem  - ID of container element
 * @param inputJson    - JSON dump of the existing site strucure for initialization
 * @param resourcePath - Internal path of the image resources within wordpress 
*/
var VizElement = function(parent_elem,inputJson,resourcePath) {
    
    // load in arguments from config object
    var that = this;
    this.data = inputJson;
    this.pelement = parent_elem;
    this.resPath = resourcePath + '/images/';

    this.nodes = new Array();
    this.links = new Array();
    
    this.categoryCheck = new Array();

    this.postSVG = null;
    this.commentSVG = null;

    d3.xml(this.resPath + "post.svg", "image/svg+xml", function(error, xml) {
	  if (error) throw error;
	  that.postSVG = document.importNode(xml.documentElement, true);

	  d3.xml(that.resPath + "comment.svg", "image/svg+xml", function(error, xml) {
		  if (error) throw error;
		  that.commentSVG = document.importNode(xml.documentElement, true);

		  // create the chart
	      that.derive();
    	  that.draw();
 	  

	  });

	});

	
}

/*
 * Derives the D3 Fource Layout data structure from the inputJSON
 *
 */

VizElement.prototype.derive = function(){

	console.log(this.data);

	var that = this;

	var currentCategories = null;

	var nodeIndex = 0;


	this.data.records.forEach(function(d,i){

		addCategory(that,d);

		addPost(that,d);
		
	})

	console.log(this.nodes);
	console.log(this.links);

}

/*
 * Draw the force layout visualization on plugin display container
 *
 */
VizElement.prototype.draw = function(){

	var that = this;

	//Setup Dimensions
	this.width = this.pelement.offsetWidth - 100;
	this.height = 600;

	this.linearScale = d3.scale.linear().domain([0,10000]).range([15,50]);


	//Initialize SVG
	this.pelement.innerHTML = '';
    this.svg = d3.select(this.pelement).append('svg');
    this.svg.attr('width',  this.width);
    this.svg.attr('height', this.height);

    this.linkg = this.svg.append('g').attr('class','link-group');
    this.nodeg = this.svg.append('g').attr('class','node-group');

	calculateCategorySpacing(this);    

    //Set up tooltip
    
	this.tip = d3.tip()
	    .attr('class', 'd3-tip')
	    .offset([-10, 0])
	    .html(function (d) {
	    
	    	var author = d.type == "post" ? d.data.post_author_name : d.data.comment_author;
	    	var date   = d.type == "post" ? d.data.post_date : d.data.comment_date;
	    	var content = d.type == "post" ? d.data.post_title : d.data.comment_content;


	    	if(d.type == "post"){
	    		var htmlString ='<div style="padding:5px;">';

	    		htmlString +=  "<div>" +  "Post Author : " + author + '</div>';
	    		htmlString +=  "<div>" +  "Post Date: " + date + '</div>';
	    		htmlString +=  '<div>' + "Post Title : " + content + '</div>';
	    		htmlString +=  "</div>";
	    		return  htmlString;
	    	}

	    	if(d.type == "comment"){
	    		
	    		var htmlString = '<div style="padding:5px;">';

	    		htmlString +=  "<div>" + "Comment Author : " + author + '</div>';
	    		htmlString +=  "<div>" +  "Comment Date: " + date + '</div>';
	    		htmlString +=  '<div class="comment-wrap">' + "Comment : " + content + '</div>';
	    		htmlString +=  "</div>";
	    		return  htmlString;

	    		
	    	}

	    	if(d.type == "category"){
	    		return  '<div style="padding:5px;">'  + "Category Name : " + d.data + '</div>';
	    	}
	})
	
	this.svg.call(this.tip);

	//Initialize Force Layout
    this.force = d3.layout.force()
    	.nodes(this.nodes)
    	.links(this.links)
    	.gravity(0.5)
    	.charge(-240)
    	.linkDistance(function(d){
    		return d.type == 0 ? 50 : 5;
    	})
    	.size([this.width, this.height]);

    this.fnode = this.force.nodes();
    this.flink = this.force.links();

    //Start force layout display
    update(this);
     
	
  	
}

/*
 * Handles realtime updates on the visualization based on site activity
 * @param msgObj - Message object containing the activity details.
 *                 The Activity can be
 *                 1. Adding a new post
 *                 2. Modifying a post
 *                 3. Deleting a post
 *                 4. Adding a comment
 *                 5. Updating comment
 *                 
 *                 NOTE :- Delete comment is not supported.         
 */
VizElement.prototype.refresh = function(msgObj){

	var that = this;

	var refreshObj = JSON.parse(msgObj); 



	if('action' in refreshObj)
	{

		//Checking for an existing post in draft state.
		//In draft state it will be always reported as New , even if there is a modificaition to an existing post
		//Hence an existing draft post with action "New" should be marked as "Modify" 
		if((refreshObj.action == "New") && this.doesPostExist(refreshObj.records[0])){
			refreshObj.action = "Modify";
		}


		//Post Handling
		if(refreshObj.action == "New"){
			//New Post added to the wordpress site
			addCategory(this,refreshObj.records[0]);
			addPost(this,refreshObj.records[0]);
		
		} else if(refreshObj.action == "Modify") {
			//existing post modified in the wordpress site
			modifyPost(this,refreshObj.records[0]);
		} else if (refreshObj.action == "Delete") {
			//Existing post deleted in wordpress site
			deletePost(this,refreshObj.records);
		}

	} else {

		//Comment update Handling
		handleComment(this,refreshObj.records[0]);
	}

	update(this);
	console.log(this.links);
}

/*
 * Check to see if the post already existins in the Force layout's data structure
 * @param postObj - Post object containing the post details
 */
VizElement.prototype.doesPostExist = function(postObj){

	for(var i = 0 ; i < this.nodes.length ; i++){

		if(this.nodes[i].type == "post") {

			if(this.nodes[i].data.pid == postObj.pid){
				return true;
				break;			
			}

		}

	}

	return false;

}

/*
 * This function is responsible for all dynamic updates to the force layout display
 * Called from draw() for the initial force layout display as well as from refresh() for
 * realtime updates
 * @param obj - Object containing the site activity 
 */
function update(obj) {

	//Setup Links
	var link = obj.linkg.selectAll(".link")
    			.data(obj.links,function(d){
    				return d.key ;
    			});

    link.enter().append("line")
      .attr("class", "link")
      .style("stroke-width", function(d) { 
      	return d.type == 0 ? "0.5" : "0.25" ; 
      })
      .style("stroke", function(d) { 
      	return d.type == 0 ? "blue" : "orange" ; 
      });

      link.exit().remove();

    //Setup Nodes
    var node = obj.nodeg.selectAll(".node")
      .data(obj.nodes,function(d){

      	if(d.type == "post"){
      		return "post-"+d.data.pid;
      	} else if (d.type == "comment"){
      		return "comment-"+d.data.comment_id;
      	} else if (d.type == "category"){
      		return "category-"+d.data;
      	}

      });

    var nodeEnter = node.enter().append("g")
      .attr("class", "node")
      .each(function(d,i){
		  // Clone and append xml node to each data binded element.
		  if(d.type == "post"){

		  	this.appendChild(obj.postSVG.cloneNode(true));	
		  	
		  	d3.select(this).select('svg').attr("x", -10)
		      .attr("y", -300)
		      .attr("width", function(d){
		      		return obj.linearScale(d.data.post_count + 1);
		      })


		  } else if(d.type == "comment"){
		  	
		  	this.appendChild(obj.commentSVG.cloneNode(true));	

		  	d3.select(this).select('svg').attr("x", -5)
		      .attr("y", -300)
		      .attr("width", function(d){
		      		return 10;
		    })

		  }
		  
		})
      .call(obj.force.drag)
      .on('mouseover', obj.tip.show) 
 	  .on('mouseout', obj.tip.hide); 

 	  node.exit().remove();

 	  colorize(node,-1);

 	  //Setup the tick function 
 	  obj.force.on("tick", function() {
	    
	    link.attr("x1", function(d) { return d.source.x; })
	        .attr("y1", function(d) { return d.source.y; })
	        .attr("x2", function(d) { return d.target.x; })
	        .attr("y2", function(d) { return d.target.y; });

	     
		node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });		
		
	  });

 	  
 	  //Start Force Layout simulation
 	  obj.force.start();

}

/*
 * Function for coloring the nodes based on categories, post and comment
 */
colorize = function(cont,index){

	var color = d3.scale.category20();

	cont.each(function(d,i){

    	if(d.type=="category"){
    	
    		d3.select(this).append("circle")
    		.attr("r","5")
    		.style("fill", function(d) { 
		      	return color(d.group);
		    });

    		d3.select(this).append("text")
		    .attr("dx", 5)
		    .attr("dy", "-0.65em")
		    .text(function(d) { return d.data })
		    .style("stroke", "gray");
		}

		if(d.type=="post"){

			if(d.data.post_status == "publish"){
				d3.select(this).selectAll("path").style("stroke","lightgreen");
			} else if(d.data.post_status == "draft"){
				d3.select(this).selectAll("path").style("stroke","lightgray");
			} else if(d.data.post_status == "pending"){
				d3.select(this).selectAll("path").style("stroke","cyan");
			}
		}

		if(d.type=="comment"){

			if(d.data.comment_approved == "1"){

				d3.select(this).selectAll("path").style("fill","orange");	

			} else if(d.data.comment_approved == "0"){
				d3.select(this).selectAll("path").style("fill","gray");
			}

		}

    });


}

/*
 * Function to set the x,y position of category nodes  
 */
calculateCategorySpacing = function(obj){

	var catCount = 0;

    obj.nodes.forEach(function(d,i){
    	if(d.type == "category"){
    		d.fixed = true;
    		d.y = 50;
    		d.py = d.y
    		++catCount;
    		
    	}
    })

    var catSpacing = obj.width/catCount;
    catCount = 0;

    obj.nodes.forEach(function(d,i){

    	if(d.type == "category"){
    		d.x = ++catCount * catSpacing - (catSpacing/2);
    		d.px = d.x;
    	}

    });

    

}

/*
 * Function for adding a new category in force layout's node data structure
 */
addCategory = function(obj,post){

	var currentCategories = post.categories.split(",");

	var currentCategoriesLength = currentCategories.length;
	var currentCategoriesBitMap = new Array();

	obj.categoryCheck.forEach(function(d,i){

		for(var i = 0 ; i < currentCategoriesLength ; i++){

			if(d == currentCategories[i]){
				currentCategoriesBitMap.push(i);
				break;			
			}
		}

	});

	currentCategoriesBitMap.sort().reverse().forEach(function(d,i){
		currentCategories.splice(d,1);
			
	});

	
	currentCategories.forEach(function(d,i){

		obj.categoryCheck.push(d);

		obj.nodes.push({"type" : "category" , "data" : d});

	});

	if(currentCategories.length > 0){
			calculateCategorySpacing(obj);
	}

}

/*
 * Function for adding a new post in force layout's node data structure and 
 * link from post to its categories in force layout's link data structure
 */
addPost = function(obj,post){

	obj.nodes.push({"type" : "post" , "data" : post});

	var lastPostIndex = obj.nodes.length - 1;

	post.categories.split(",").forEach(function(cat,i){

		for(var i = 0 ; i < obj.nodes.length ; i++){

			if(obj.nodes[i].type == "category") {

				if(obj.nodes[i].data == cat){
					obj.links.push({"source" : i , "target" : lastPostIndex , "type" : 0 , "ref_post_id" : post.pid , "key" : cat + '-' + post.pid});	
					break;			
				}

			}

		}

	});

	addComments(obj,lastPostIndex);

}

/*
 * Function for adding a new comment in force layout's node data structure and 
 * link from itself to its post in force layout's link data structure. This is called
 * when the comment is added as part of a post
 */
addComments = function(obj,postIdx){

	console.log(obj.nodes[postIdx].data);

	if('commentsAndMeta' in obj.nodes[postIdx].data){

		if('comment' in obj.nodes[postIdx].data.commentsAndMeta){

			var commentsArray = obj.nodes[postIdx].data.commentsAndMeta.comment;

			if(commentsArray){

				commentsArray.forEach(function(d,i){

					obj.nodes.push({"type" : "comment" , "data" : d });

				});

			}

		}

		var lastCommentIndex = obj.nodes.length - 1;		
			
		if(lastCommentIndex > postIdx){

			var commentStartIndex = postIdx + 1;
			var commentEndIndex   = commentStartIndex + (lastCommentIndex - postIdx);

			for(var i = commentStartIndex ; i < commentEndIndex ; i++ ){
				obj.links.push({"source" : postIdx , "target" : i , "type" : 1 , "ref_post_id" : obj.nodes[postIdx].data.pid, "key" : obj.nodes[postIdx].data.pid + '-' + obj.nodes[i].data.comment_id});				
			}

		}

	}

}

/*
 * Function for adding / updating a comment. 
 * This is different from addComment() as it is invoked only when a comment is added/modified
 *  
 */
handleComment = function(obj,commentObj){

	var comment = commentObj.commentsAndMeta.comment[0];

	var foundComment = false;
	var i = 0;
	while(i < obj.links.length){

		
		if((obj.links[i].type == 1) && (obj.links[i].target.data.comment_id == comment.comment_id) ){
			foundComment = true;
			break;
		}

		i++;

	}

	if(foundComment){
		obj.links[i].target.data = comment;
	} else {

		var j = 0;
		var foundPost = false;
		while(j < obj.nodes.length){

			if((obj.nodes[j].type == "post") && (obj.nodes[j].data.pid == comment.comment_post_id) ){
				foundPost  = true;
				break;
			}

			j++;

		}

		if(foundPost){

			obj.nodes.push({"type" : "comment" , "data" : comment })

			obj.links.push({"source" : j , "target" : obj.nodes.length - 1 , "type" : 1 , "ref_post_id" : comment.comment_post_id, "key" : obj.nodes[j].data.pid + '-' + comment.comment_id});
		}		

	}

}

/*
 * Function for modifying the post. This may involve, relinking with categories , comments
 * based on the modification performed by the user.
 */

modifyPost = function(obj,post){

	
	var existingNode = null
	var existingNodeIndex = -1;

	for(var i = 0 ; i < obj.nodes.length ; i++){

		if(obj.nodes[i].data.pid == post.pid){
			existingNode = obj.nodes[i];
			existingNodeIndex = i;
			break;
		}

	}
	

	if(existingNode){

		var existingCategoryList = existingNode.data.categories.split(",");

		var linkRemovalBitMap = new Array();

		//Remove the links with categories in existingCategoryList
		for(var i = 0 ; i < obj.links.length ; i++){

			if(obj.links[i].target == existingNode){
				linkRemovalBitMap.push(i);
				
			}

		}
		
		
		linkRemovalBitMap.sort().reverse().forEach(function(d,i){
			obj.links.splice(d,1);
		});

		
		addCategory(obj,post);
		
		existingNode.data = post;

		post.categories.split(",").forEach(function(cat,i){

			for(var i = 0 ; i < obj.nodes.length ; i++){

				if(obj.nodes[i].type == "category") {

					if(obj.nodes[i].data == cat){
						obj.links.push({"source" : i , "target" : existingNodeIndex , "type" : 0 , "ref_post_id" : post.pid , "key" : cat + '-' + post.pid});	
						break;			
					}

				}

			}

		});
		

	}

	
}

/*
 * Function for handling post deletion by removing node representing the deleted post
 * from the Force layout's node data structure and all its associated links with the comments
 * and categories. Also removes all comment notes associated with the post.  
 */
deletePost = function(obj,posts){

	posts.forEach(function(d,i){

		
		var j = 0;
		var linkDeletionBitMap = new Array();		
		
		while(j < obj.links.length){

			if(obj.links[j].ref_post_id == d.post_id){
			
				obj.nodes.splice(obj.nodes.indexOf( obj.links[j].target),1);
				linkDeletionBitMap.push(j);
			} 
			
			j++;
			
		}		

		linkDeletionBitMap.sort().reverse().forEach(function(link,i){
			obj.links.splice(link,1);	
		})
		

	});



}