=== Relative Image URLs ===
Contributors: scottwerner, BlueLayerMedia
Donate link: http://scottwernerdesign.com/plugins
Tags: relative, image, images, url, link, absolute, path
Requires at least: 2.0.2
Tested up to: 4.0
Stable tag: 2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Creates relative URLs for images when inserting into posts.

== Description ==

When inserting an image into a post, Wordpress uses absolute URLs to the files. This plugin overrides that functionality and forces it to use relative URLs.

**For example:**

*Wordpress Default:*
http://www.example.com/wp-content/uploads/2013/04/example.jpg

*Plugin Override:*
/wp-content/uploads/2013/04/example.jpg

This is particularly useful if you plan on switching domains ever as well as reducing HTTP requests.

== Installation ==

1. Upload the 'No Image Link' folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Do I have to set any options? =

Nope. It's ready to go right out of the box.

= Why would I want relative image URLs? =

A few reasons:

* Makes it easier to move your site if you ever want to switch domains.
* If you have an install as a development/testing version of your site that you migrate frequently.
* Reduces HTTP requests, which will speed up page load time.

== Screenshots ==

1. Shows the difference between absolute and relative image URLs in the WordPress post editor.

== Changelog ==

= 2.0 =
* Fixed issue with an invalid header and directory issue which caused the plugin to fail install
* Updated WordPress version compatibility to 3.5.1
* Added a screenshot
* Added a FAQ
* Updated the short description to actually be short
* Added assets and plugin banner
* New contributor to update the plugin after it was abandoned 3 years ago

= 1.0 =
* This is the first version.

== Upgrade Notice ==

= 2.0 =
* Fixed issue that caused plugin installation to fail.
* Compatible up to WordPress version 3.5.1