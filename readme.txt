=== Gpc Enhactivity Profile Actvity ===
Contributors: leticia_larr,poolie
Tags: buddypress,profile,activity,comment,gd-star-rating
Requires at least: WordPress MU 2.8.6
Tested up to: WordPress MU 2.9
Stable tag: 1.0

This plugin enhance the current activity stream on a BuddyPress user profile

== Description ==
This plugin enhance the current activity stream on a users profile with an extra section "Latest Comments" on the profile main page where are shown the latest comments that user made on blogs.

Each comment activity has the follow data:
* Title of the Post, with a link to the comment
* Title of the Blog, with a link to the comment
* Comment Rating (The rating a user made with the gd star rating plugin to this comment)
* A Thumbnail Image associated with post using the gpc-attach-image-post plugin. If any image, appears in blank.
* Comment whole Text, with a link to the comment
* Comment Date, with a link to the comment

== Administration Page ==
In the administration page can be specified:
* The size of stars to show ratings.
* The numbers of activities to show in the "Latest Comments" section.
* The default thumbnail to use in post where haven't any associated image.

== Screenshots ==
1. This screen shot shows an example of the list of comment events.
2. This screen shot shows the administration page.

== Installation ==
1. Upload the whole plugin folder to your /wp-content/plugins/ folder.
2. Go to the 'Plugins' page in the menu and activate the plugin.
3. Install and active the plugin gpc-attach-image-post
4. Install and active the plugin gd-star-rating
5. To avoid a problem of the gd-star-rating plugin with comments of different blogs with the same ID (http://forum.gdragon.info/viewtopic.php?f=20&t=689) you do the follow:
	* open the file: 
		gd-star-rating/code/cache.php
	* search the function: 
		`function wp_gdget_comment($comment_id) {`
	* comment the follow line inside this function: 
		`$cmm = $gdsr_cache_posts_cmm_data->get($comment_id);`
6. Place `<?php if (class_exists('GpcEnhactivityProfile')) GpcEnhactivityProfile::show_activity_comments() ?>` in the template that shows the profile activities.

