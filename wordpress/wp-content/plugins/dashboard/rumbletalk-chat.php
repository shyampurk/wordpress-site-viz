<?php
/*
  Plugin Name: RumbleTalk Chat
  Plugin URI: http://www.rumbletalk.com/wordpress-chat-plugin.php
  Description: An advanced stylish community chat room that can be accessed from web and mobile. This is the only chatroom that let you design your own style. The chatroom is a hosted service, so you do not need to worry that your hosting company will block your account.
  Version: 3.5.4
  Author: Rumbletalk Ltd
  Author URI: http://www.rumbletalk.com
  License: GPL2

  Copyright 2012-2015 RumbleTalk Ltd (email : support@rumbletalk.com)

  This program is free trial software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class RumbleTalkChat {

    protected $options;

    public function __construct() {
        $this->options = array
            (
            "rumbletalk_chat_code",
            "rumbletalk_chat_width",
            "rumbletalk_chat_height",
            "rumbletalk_chat_floating"
        );

        register_activation_hook(__FILE__, array(&$this, "install"));
        register_deactivation_hook(__FILE__, array(&$this, "unInstall"));

        if (is_admin()) {
            add_action("admin_menu", array(&$this, "adminMenu"));
        } else {
            add_shortcode('rumbletalk-chat', array(&$this, "embed"));
        }
    }

    public function adminMenu() {
        add_options_page
                (
                "RumbleTalk Chat", "RumbleTalk Chat", "administrator", "rumbletalk-chat", array
            (
            &$this,
            "drawAdminPage"
                )
        );
    }

    public function drawAdminPage() {
        ?>
        <div style="width:820px;">

            <h2>RumbleTalk Chat Options</h2>

            <table>
                <tr>
                    <td width="500" valign="top">
                    	<script type="text/javascript">
                    	var create_form = document.getElementById("create_form"),
							wait_error;

						function submit_in_frame(data)
						{
							clearTimeout( wait_error );

							var response = data.crID;
							if (!isNaN(parseFloat(response)) && isFinite(response))
							{
								alert(error_message(response));
								document.getElementById( "create_chat_button" ).style.display = "inline";
								document.getElementById( "loading_gif" ).style.display = "none";
							}
							else
							{
								document.getElementById('rumbletalk_chat_code').value = response;
								document.getElementById('options_form').submit();
							}

							var jsonp = document.getElementById(data.id);
							jsonp.parentNode.removeChild(jsonp);
						}

						function error_message( id )
						{
							var message;

							switch ( parseInt( id ) )
							{
								case -1:
									message = "Please enter a valid email address";
									break;

								case -2:
									message = "The password must be at least 6 characters long (spaces are ignored!)";
									break;

								case -3:
									message = "The email address already exists";
									break;

								case -7:
									message = "Please retype the same password";
									break;

								case -11:
									message = "The automatic creation has failed. Please create the account manually. You can find more details in the 'Troubleshooting' section";
									break;

								default:
									message = "Ooops, could not complete the operation, please try again later";
							}

							return message;
						}

						function toggle_create_account( which ) {
							if ( which == 1 ) {
								document.getElementById( "create_form" ).style.display = 'none';
								document.getElementById( "options_form" ).style.display = 'inline';
								document.getElementById( "options_troubleshooting" ).style.display = 'inline';
							} else {
								document.getElementById( "create_form" ).style.display = 'inline';
								document.getElementById( "options_form" ).style.display = 'none';
								document.getElementById( "options_troubleshooting" ).style.display = 'none';
							}
						}

						function validate_account_creation( form ) {
							var email = form.elements[ "email" ],
								password = form.elements[ "password" ],
								password_c = form.elements[ "password_c" ];

							if ( !/^[-0-9A-Za-z!#$%&'*+/=?^_`{|}~.]+@[-0-9A-Za-z!#$%&'*+/=?^_`{|}~.]+/.test( email.value ) ) {
								alert( error_message( -1 ) );
								email.focus();
								return false;
							}

							if ( password.value.length < 6 ) {
								alert( error_message( -2 ) );
								password.focus();
								return false;
							}

							if ( password.value != password_c.value ) {
								alert( error_message( -7 ) );
								password_c.focus();
								return false;
							}

							document.getElementById( "create_chat_button" ).style.display = "none";
							document.getElementById( "loading_gif" ).style.display = "inline";

							wait_error = setTimeout( 'error_message(-11);', 30000 );

							var jsonp = document.createElement("SCRIPT"),
								d = new Date(),
								t = d.getTime();
							jsonp.id = 'rt-' + t;
							jsonp.src = 'http://www.rumbletalk.com/_ajax_reg_remote.php?return_code=1&email=' + email.value + '&password=' + password.value + '&id=' + jsonp.id;
							document.getElementsByTagName( 'head' )[ 0 ].appendChild( jsonp );

							return false;

						}

						function float_check_box( checkbox ) {
							var width_tr = document.getElementById( "chat_width" ),
								height_tr = document.getElementById( "chat_height" );

							if ( checkbox.checked ) {
								width_tr.getElementsByTagName( "input" )[ 0 ].disabled = true;
								height_tr.getElementsByTagName( "input" )[ 0 ].disabled = true;
							} else {
								width_tr.getElementsByTagName( "input" )[ 0 ].disabled = false;
								height_tr.getElementsByTagName( "input" )[ 0 ].disabled = false;
							}
						}
                    	</script>
                    	<style>
						.upgrade_button
						{
						display:inline-block;
						border-radius: 3px;
						-webkit-border-radius: 3px;

						background-image: -webkit-gradient(linear, left top, left bottom, from(#Da2424), to(#910909));
						background-image: -webkit-linear-gradient(top, #Da2424, #910909);
						background-image:         linear-gradient(to bottom, #Da2424, #910909);
						filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#Da2424', EndColorStr='#910909');
						color: #fff;
						font: bold 15px arial;
						font-weight: 700;
						margin-left: 0px;
						padding: 7px;

						}
						</style>
                        <div style="width:500px;position;relative;">
                        	<form method="post" action="http://www.rumbletalk.com/_ajax_reg_remote.php" onsubmit="return validate_account_creation( this );" id="create_form"<?php echo get_option("rumbletalk_chat_code") == '' ? '' : ' style="display:none;"' ?>>
	                        	<input type="hidden" name="return_code" value="1" />
	                        	<table valign="top">
									<tr>
										<td colspan="2" align="left"  style="padding-bottom:30px;"><img width="490" src="http://d1pfint8izqszg.cloudfront.net/emails/Mailxa-01.png" /></td>
									</tr>
									<tr>
										<td colspan="2" style="padding-bottom:15px;">
											<a href="#options_form" onclick="toggle_create_account(1);">I already have my RumbleTalk Chatroom Code</a>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding-bottom:15px;">
											Add RumbleTalk chat-room to your website, blog in one minute.<br/><br/>
											1 - Enter your email and preferred password.<br/>
											2 - Click on the create button. It takes up to 15 seconds and than your account is ready.<br/>
											3 - Now, add the exact text <b style="font:arial 8px none; color:#68A500"> [rumbletalk-chat] </b>to your visual editor where you want your chat to show.
										</td>
									</tr>
									<tr>
										<td width="20"><b>Email:</b></td>
										<td width="60"><input type="text" name="email" /></td>
									</tr>
									<tr>
										<td width="20"><b>Password:</b></td>
										<td width="60"><input type="password" name="password" /></td>
									</tr>
									<tr>
										<td width="20"><b>Confirm Password:</b></td>
										<td width="60"><input type="password" name="password_c" /></td>
									</tr>
									<tr>
										<td colspan="2">
											<input id="create_chat_button" type="submit" value="Create a Chatroom" />
											<img id="loading_gif" style="display:none;" src="http://d1pfint8izqszg.cloudfront.net/images/mainpage/loading.gif" alt="loading" />
										</td>
									</tr>
									<tr>
										<td colspan="2">
										<br/>
										<?php if ( get_option( "rumbletalk_chat_code" ) != '' ) { ?>
											<span style="color:red;font-weight:bold;">Note! your current chat will be deleted if you enter new email and password.</span>
										<?php } ?>
										</td>
									</tr>
                                    <tr>
                                        <td colspan="2" align="left"  style="padding-top:30px;"><img width="490" src="http://d1pfint8izqszg.cloudfront.net/emails/Mailxa-04.png" /></td>
                                    </tr>
								</table>
                        	</form>
                            <form method="post" action="options.php" id="options_form"<?php echo get_option("rumbletalk_chat_code") == '' ? ' style="display:none;"' : '' ?>>
                                <input type="hidden" name="action" value="update"/>
                                <input type="hidden" name="page_options" value="rumbletalk_chat_code,rumbletalk_chat_width,rumbletalk_chat_height,rumbletalk_chat_floating"/>
                                <?php wp_nonce_field("update-options"); ?>
                                <table valign="top">
									<tr>
										<td colspan="2" align="left"  style="padding-bottom:30px;"><img width="490" src="http://d1pfint8izqszg.cloudfront.net/emails/Mailxa-01.png" /></td>
									</tr>
									<tr>
										<td colspan="2" style="padding-bottom:20px;">
											<a href="#options_form" onclick="toggle_create_account();">I need to create a new Chatroom Account</a>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding-bottom:15px;">
											<span style="font-size:14px;"><b>What Type of RumbleTalk Chatroom do you need?<b></span>

										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding-bottom:15px;">
										   <table width="100%">
										     <tr>
										       <td align="left"  style="padding-left:10px;">
										           <img width="95px" src="http://d1pfint8izqszg.cloudfront.net/images/fe-access.png" />
										       </td>
										       <td align="left" style="padding-top:10px;padding-left:20px;">
										           <img width="95px" src="http://d1pfint8izqszg.cloudfront.net/images/toolbar/toolbar.png" />
										       </td>
										     <tr>
										     <tr>
										       <td align="left" style="padding-left:20px;">
										           Chat in a page
										       </td>
										       <td align="left" style="padding-left:10px;">
										           Floating chat (toolbar)
										       </td>
										     <tr>
										   </table>
										</td>
									</tr>
									<tr>
									  <td colspan="2" style="padding-bottom:15px;">
										  <table>
											  <tr>
												  <td  colspan="2" align="left" valign="top">
													  <b><u>How to set your chat:</u></b>
												  </td>
											  </tr>
											  <tr>
												  <td align="left" valign="top" style="padding-top:15px;">
													  <img  width="32px" src="http://d1pfint8izqszg.cloudfront.net/admin/images/SQ-about.png" />
												  </td>
												  <td style="padding-left:5px;">
													  Check that your chatroom code is filled (below).
													  <br/>If not, use the <b>create new chatroom account </b> <br/>or register at RumbleTalk website and get the code.
												  </td>
											  </tr>
											  <tr>
												  <td style="padding-top:15px;" align="left" valign="top">
													  <img width="32px" src="http://d1pfint8izqszg.cloudfront.net/admin/images/SQ-contact.png" />
												  </td>
												  <td style="padding-left:5px;">
													  Add the text <b style="font:arial 8px none; color:#68A500">&#91;rumbletalk-chat&#93; </b>
													  <br/>to your visual editor where you want your chat to show.....and your done.
												  </td>
											  </tr>
										 </table>
									  </td>
									</tr>
                                    <tr>
                                        <td width="120"><b>Chatroom code:</b></td>
                                        <td><input type="text" name="rumbletalk_chat_code" id="rumbletalk_chat_code" value="<?php echo htmlspecialchars(get_option("rumbletalk_chat_code")); ?>" maxlength="8"/></td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <span style="font:arial 8px none; color:#AAACAD">
                                                This is the 8 letters/signs chat room code you've received from RumbleTalk (after registration you see it in the <a href="http://d1pfint8izqszg.cloudfront.net/images/Instructions-getChat.png" target="_blank"> chat code </a>section in addition to an email send with the code).<br/><br/>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr id="chat_width">
                                        <td width="120" style="padding-top:30px;">Chatroom width:</td>
                                        <td   style="padding-top:30px;"><input type="text" name="rumbletalk_chat_width" id="rumbletalk_chat_width" value="<?php echo htmlspecialchars(get_option("rumbletalk_chat_width")); ?>" maxlength="4"/></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <span style="font:arial 8px none; color:#AAACAD">
                                                The width in pixels you wish the chat widget to be.<br/>
                                                You can use percentages (e.g. 40%) or leave blank.
                                            </span>
                                        </td>
                                    </tr>
                                    <tr id="chat_height">
                                        <td width="120">Chatroom height:</td>
                                        <td><input type="text" name="rumbletalk_chat_height" id="rumbletalk_chat_height" value="<?php echo htmlspecialchars(get_option("rumbletalk_chat_height")); ?>" maxlength="4"/></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <span style="font:arial 8px none; color:#AAACAD">
                                                The height in pixels you wish the chat widget to be.<br/>
                                                You can use percentages (e.g. 40%) or leave blank.
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="120">Floating chat:</td>
                                        <?php $rumbletalk_chat_floating = get_option("rumbletalk_chat_floating");?>
                                        <td><input type="checkbox" onchange="float_check_box( this );"  name="rumbletalk_chat_floating" id="rumbletalk_chat_floating" <?php echo (!empty($rumbletalk_chat_floating)) ? ('checked') : (''); ?> /></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <span style="font:arial 8px none; color:#AAACAD">
                                                Check it if you wish to add to your web page a floating chat
                                                which is a toolbar like chat (Facebook style) on your right bottom corner.
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding-top:20px;">
                                        <input type="submit" value="<?php _e("Save Changes") ?>"/>
                                        <span style="padding-left:25px;"> <a href="http://www.rumbletalk.com/admin/groups.php">Advanced Settings<a/></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding-top:20px;"><span style="font:arial 8px none; color:green">&#42; In some wordpress themes 2 known issues might occur, please <br/>see below the way to fix it.</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="left"  style="padding-top:30px;"><img width="490" src="http://d1pfint8izqszg.cloudfront.net/emails/Mailxa-04.png" /></td>
                                    </tr>
                                </table>
                            </form>
                        </div>

                    </td>
                    <td  valign="top">

                        <div style="float:right; width:290px; border:1px #DEDEDD dashed; background-color:#FEFAE7; padding:10px 10px 10px 10px">
                            <b>Description:</b> The <a href="http://www.rumbletalk.com/?utm_source=wordpress&utm_medium=plugin&utm_campaign=fromplugin" target="_blank">RumbleTalk</a> Plugin is a boutique chat room Platform for websites, facebook pages and real-time events. Perfect for Communities, radios and live stream. It is available for all Wordpress installed versions.<br />
                            <br />
                            <b>Like the plugin? "Like" RumbleTalk Chat!</b>
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id))
                                        return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=181184391902159";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-like" data-href="https://www.facebook.com/rumbletalk" data-send="true" data-width="280" data-show-faces="true" data-font="arial"></div>

                            <br />
                            <br />

                            <table style="padding-top:15px;">
                                <tr>
                                    <td align="center" valign="top" style="padding-top:15px;">
                                         Increase the number of chatters, use advanced features and much more.
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="padding-top:15px;">
                                         <a href="http://www.rumbletalk.com/admin/groups.php" class="upgrade_button">Upgrade your chat, Now!</a>
                                    </td>
                                </tr>
     						</table>



                        </div>
                        <div style="float:right; width:290px; border:1px #DEDEDD dashed; background-color:#FEFAE7; padding:10px 10px 10px 10px;">

                            <table align="center" style="padding-top:15px;">
                                <tr>
                                  <td style="padding-top:20px;padding-bottom:20px;">
                                    <span style="font-size:25px;"> Features </span>
                                  </td>
                                </tr>
                                <tr>
                                    <td>
										<ul type="circle">
										    <li>* New - Live video calls </li>
										    <li>* Send Audio Messages</li>
											<li>* Chat-room Theme Library</li>
											<li>* Talk from Mobile and Tablet</li>
											<li>* Login, Share Invite using Facebook and Twitter</li>
											<li>* Private chat</li>
											<li>* One chat for your WP and facebook page</li>
											<li>* SSL- talk in a secure channel</li>
											<li>* Design your own chat theme</li>
											<li>* Advance design with css </li>
											<li>* Manage as many chats as you like</li>
											<li>* Spam filter (create a black listed words)</li>
											<li>* Ban, Delete Trolls</li>
											<li>* Define moderators and rolls</li>
											<li>* Archive your chat, Save log of your chat history</li>
											<li>* Chat in 30 languages</li>
											<li>* Offline Mode (when you are not around)</li>
											<li>* Delete single messages</li>
											<li>* Flood control</li>
											<li>* Upload Docs, Excel, PowerPoint, PDF</li>
											<li>* Upload Images from your own PC</li>
											<li>* Take pictures from your PC camera</li>
											<li>* New set of smilies </li>
										</ul>
									</td>
								</td>
                                <tr>
                                    <td align="center" valign="top" style="padding-top:25px;">
										<b>Homepage:</b> <a href="http://www.rumbletalk.com/?utm_source=wordpress&utm_medium=plugin&utm_campaign=fromplugin" target="_blank">RumbleTalk Home</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="padding-top:5px;">
                                         <b>Facebook:</b> <a href="https://www.facebook.com/rumbletalk" target="_blank">Facebook Fan Page</a>
                                    </td>
                                </tr>
     						</table>



                        </div>

                    </td>
                </tr>
            </table>




            <table>
                <tr>
                    <td width="500" valign="top">
                    	<div id="options_troubleshooting"<?php echo get_option("rumbletalk_chat_code") == '' ? ' style="display:none;"' : '' ?>>
							<div style="width:500px;">
								<table>
									<tr>
										<td align="left" valign="top" width="20">
											<img  width="32px" src="http://d1pfint8izqszg.cloudfront.net/admin/images/SQ-faq.png" />
										</td>
										<td style="padding-left:5px;">
											<span style="font:arial; font-size:14px;color:#73AC00">Troubleshooting</span> <br/>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding-left:5px;padding-top:10px;">

											RumbleTalk chat room is elastic and can expand to any size. In some themes you might run into 2 possible issues.<br/>
											1 - The height cannot be changed.<br/>
											2 - Some elements in the page are missing (not shown).<br/><br/>

											The solution: remove RumbleTalk plugin. Than get the full code (see below) for websites via the admin panel. add the chatroom code below directly into the html of the page.<br/><br/>
											<span style="font:arial 8px none; color:green">&#42; Copy and paste the code below into your html, make sure you replaced the <b>chatcode</b> with your own chatroom code.</span><br/><br/>

											<div>
												<code>
													&lt;div style="width: 550px; height: 370px;"&gt;<br/>
													&lt;script language="JavaScript" type="text/javascript" src="http://www.rumbletalk.com/client/?<b>chatcode</b>"&gt;&lt;/script&gt;<br/>
													&lt;/div&gt;
												</code>
											</div>
										</td>
									</tr>
								</table>
							</div>
							<div style="width:500px;">
								<table style="padding-top:20px;">
									<tr>
										<td align="left" valign="top" width="20">
											<img  width="32px" src="http://d1pfint8izqszg.cloudfront.net/admin/images/SQ-faq.png" />
										</td>
										<td style="padding-left:5px;">
											<span style="font:arial; font-size:14px;color:#73AC00">Worpress Hosted</span> <br/>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="padding-left:5px;padding-top:10px;">

											If your website is hosted by wordpress, you are unable to use RumbleTalk.<br/>
											Wordpress prevent 3rd party widgets to be included in the hosted version.

										</td>
									</tr>
								</table>
							</div>
						</div>
                    </td>
                    <td  valign="top">

                        <div style="float:right; width:290px; border:1px #DEDEDD dashed; background-color:#FEFAE7; padding:10px 10px 10px 10px">
                            With RumbleTalk you may create your own chat design (theme), share images and videos, talk from your mobile and even add the same chat installed on your website to your facebook page.
                            <br />
                            <br />
                            <a  target="_blank" href="https://fbcdn-sphotos-c-a.akamaihd.net/hphotos-ak-prn1/555083_529814737068782_1413799779_n.png">
                                <img width="100" src="https://fbcdn-sphotos-c-a.akamaihd.net/hphotos-ak-prn1/555083_529814737068782_1413799779_n.png" />
                            </a>
                            <a  target="_blank" href="https://fbcdn-sphotos-a-a.akamaihd.net/hphotos-ak-ash3/554878_529815873735335_800794496_n.png">
                                <img width="100" src="https://fbcdn-sphotos-a-a.akamaihd.net/hphotos-ak-ash3/554878_529815873735335_800794496_n.png" />
                            </a>
                            <br />
                            <a  target="_blank" href="https://fbcdn-sphotos-c-a.akamaihd.net/hphotos-ak-ash3/564947_465273650189558_696427239_n.jpg">
                                <img width="100" src="https://fbcdn-sphotos-c-a.akamaihd.net/hphotos-ak-ash3/564947_465273650189558_696427239_n.jpg" />
                            </a>
                            <a  target="_blank" href="http://d1pfint8izqszg.cloudfront.net/images/donotuseyet.png">
                                <img width="100" src="http://d1pfint8izqszg.cloudfront.net/images/donotuseyet.png" />
                            </a>
                            <br />
                            <a  target="_blank" href="http://d1pfint8izqszg.cloudfront.net/images/blog/DeleteMessages.png">
                                <img width="100" src="http://d1pfint8izqszg.cloudfront.net/images/blog/DeleteMessages.png" />
                            </a>
                            <a  target="_blank" href="http://d1pfint8izqszg.cloudfront.net/images/blog/DeleteAllMessages2.png">
                                <img width="100" src="http://d1pfint8izqszg.cloudfront.net/images/blog/DeleteAllMessages2.png" />
                            </a>
                            <br />
                            <a  target="_blank" href="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-ash4/422387_340738479309743_255273953_n.jpg">
                                <img width="100" src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-ash4/422387_340738479309743_255273953_n.jpg" />
                            </a>
                            <br />
                            <br />
                            <b>Thanks:</b> Thanks for using RumbleTalk plugin. If you have any issues, suggestions or praises send us an email to support@rumbletalk.com
                        </div>

                    </td>
                </tr>
            </table>



        </div>
        <?php
    }

    public function embed($attr) {
        $floating = get_option('rumbletalk_chat_floating');
        $code = get_option('rumbletalk_chat_code');

        if (empty($code)) {
            return '';
        }

        $width = get_option('rumbletalk_chat_width');
        $height = get_option('rumbletalk_chat_height');
        $isw = ( preg_match('/^\d{1,4}%?$/', $width) == 1 );
        $ish = ( preg_match('/^\d{1,4}%?$/', $height) == 1 );
        $str = '';

        if ($isw || $ish) {
            $str = '<div style="' . ( $isw ? "width: {$width}px;" : '' ) . ( $ish ? "height: {$height}px;" : '' ) . '">';
        }

        if (!empty($floating))
            $code .= '&1';
        $str .= "<script type=\"text/javascript\" src=\"http://www.rumbletalk.com/client/?$code\"></script>";

        if ($isw || $ish) {
            $str .= '</div>';
        }

        return $str;
    }

    public function install() {
        foreach ($this->options as $opt) {
            add_option($opt);
        }
    }

    public function unInstall() {
        foreach ($this->options as $opt) {
            delete_option($opt);
        }
    }

}

new RumbleTalkChat();
?>