<?php
/*
Plugin Name: Gpc Enhance Activity Profile 
Description: Enhance the current activity stream on users profile (with BuddyPress)
Version: 0.1
Author: gpc
*/

/**
 * Version of WordPress
 * @global	string	$wp_version
 */

// Avoid name collisions.
if (!class_exists('GpcEnhactivityProfile')) {
	class GpcEnhactivityProfile
    {
       /**
	    * The path to the plugin
	    *
	    * @static 
	    * @var string
	    */
        static $plugin_dir;
        
       /**
	    * The suffix for images thumbnails
	    *
	    * @var string
	    */
        static $thumb_suffix = 'gpc_default';
        
         
       /**
         * Executes all initialization code for the plugin.
         * 
         * @return void
         * @access public
		 */
        function GpcEnhactivityProfile() {
        	// Define static values
        	self::$plugin_dir = pathinfo(__FILE__,PATHINFO_DIRNAME);
        	
        	// Add options Page
           	add_action('admin_menu', array(&$this, 'admin_menu'));
			
        	// Include all classes
        	include( self::$plugin_dir . '/includes/all_classes.php');
        }
        
        /** 
		 * Hooks the add the main menu
		 * 
		 * @return void
		 * @access public
		 */
        function admin_menu() {
        	add_menu_page(__('Enhance Profile'), __('Enhance Profile'), 8, basename(__FILE__), array(&$this, 'handle_admin'));
			
            add_submenu_page(basename(__FILE__), __('General Settings'), __('General Settings'), 8, basename(__FILE__), array(&$this, 'handle_admin'));
        }
        
        /**
		 * Handles the main menu options page for General Settings
		 * 
		 * @return void
		 * @access public
		 */
        function handle_admin() {
           	include('includes/admin/general_settings.php');
        }
        
		/**
         * Get all data to show about comments and display html of each item
         * 
         * @global object	$activities_template	data of the current activity
         * @return void
         * @access public
		 */
        static function custom_bp_activity_content() {
        	global $activities_template;
       	   	/*
        	 * Get general data
        	 */
        	$blog_id = $activities_template->activity->secondary_item_id;
        	// Call WPMU function: http://codex.wordpress.org/WPMU_Functions/get_blog_details
        	$blog_details = get_blog_details($blog_id);
        	/**
        	 * Switches the active blog until the user calls the restore_current_blog() function
        	 * @link http://codex.wordpress.org/WPMU_Functions/switch_to_blog
        	 */
        	switch_to_blog($blog_id);
        	// Comment data
        	$comment_id = $activities_template->activity->item_id;
        	$comment_obj = get_comment($comment_id);
        	// Post data
        	$post_id = $comment_obj->comment_post_ID;
        	$post_obj = get_blog_post($blog_id,$post_id);
	        	
	        
        	/*
        	 * Get: One Thumbnail Image
        	 */
        	$one_thumbnail_image = '';
        	
        	// Get thumbnail from post
			if (class_exists('GpcAttachImagePost'))
        		$one_thumbnail_image = GpcAttachImagePost::new_image_tag_for_post($post_id,FALSE);
        		
        	// If post hasn't thumbnails, get default image
        	if ($one_thumbnail_image=='') {
        		$default_thumb = GpcEnhactivityProfile_Settings::get_default_thumb();
        		if ($default_thumb!='')
        			$one_thumbnail_image = '<img alt="' . __('Post Thumbnail') . '" src="' . $default_thumb . '">';
        	}
        	
        	// If there isn't thumbnail for post or default image, put empty image
        	if ($one_thumbnail_image=='') 
        		$one_thumbnail_image = '<img alt="' . __('Post Thumbnail') . '" src="">';
        	
       		/*
        	 * Get: Title of the Post
        	 */
        	$title_of_the_post = $post_obj->post_title;
        	
        	/*
        	 * Get: Title of the blog
        	 */
        	$title_of_the_blog = $blog_details->blogname;
				
			/*
        	 * Get: Comment Rating
        	 */
        	global $comment;
        	$comment = $comment_obj;
        	global $post;
        	$post = $post_obj;
        	
        	$comment_rating = wp_gdsr_render_comment(0,TRUE,"oxygen", GpcEnhactivityProfile_Settings::get_star_size(), "oxygen_gif",FALSE);

        	/*
        	 * Get: link to the comment with html-anchor
        	 */
        	$link_to_comment = $activities_template->activity->primary_link . '#comment-' . $comment_id;
        	
			/*
        	 * Get: Comment Text
        	 */
        	$comment_text = $comment_obj->comment_content;
        	
			/*
        	 * Get: Comment Date
        	 */
        	$comment_date = strtotime($activities_template->activity->date_recorded );
        	
        	// Include the HTML content
        	include( GpcEnhactivityProfile::$plugin_dir . '/templates/includes/latests_comments.php'); 
        }
                
        /**
         * Template tag to show the latest comments on user profile
         * 
         * @return void
         * @access public
		 */
        static function show_activity_comments() {
        	$number_of_items = GpcEnhactivityProfile_Settings::get_max();
        	
        	// Include the HTML content
        	include( GpcEnhactivityProfile::$plugin_dir . '/templates/includes/section.php');
        }
	}
}

// create new instance of the class
$GpcEnhactivityProfile = new GpcEnhactivityProfile();

?>