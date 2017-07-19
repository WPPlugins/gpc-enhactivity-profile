<?php
/**
 * Include to show the administrator's setting
 *
 * @package admin
 * 
 */

if (isset($_GET['del_default_thumb'])) {
	$data['default_thumb'] = '';
	
	$data_previous = GpcEnhactivityProfile_Settings::get_options();
	$data['max'] = $data_previous['max'];
	
	GpcEnhactivityProfile_Settings::update_options($data);
	$msg_notify[] = __('The default thumbnail was deleted.');
}

if (isset($_POST['max'])) {	
	$data['max'] = $_POST['max'];
	$data['star_size'] = $_POST['star_size'];
	
	// Upload default image is any
	$data_previous = GpcEnhactivityProfile_Settings::get_options();
	$data['default_thumb'] = $data_previous['default_thumb'];
	
	if (isset($_FILES['image']) && $_FILES['image']['tmp_name']!='') {
		
		// Check for extension
		$image_extension = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
		
		if (strtolower($image_extension)=='jpg' || strtolower($image_extension)=='png') {
				// handle uploaded image and save it
				$file=GpcEnhactivityProfile_Images::handle_image_upload($_FILES['image']);
				
				if ($file) {
					
					// save thumbnail of image 
					// Use WordPress function to resize and image (no crop it) and save as thumbnail with a sufix
					$max_w = get_option('thumbnail_size_w');
					$max_h = get_option('thumbnail_size_h');
	                $thumb_path = image_resize($file['file'], $max_w, $max_h, false, GpcEnhactivityProfile::$thumb_suffix);
	                      
	                if (!$thumb_path) {
						$thumb_url = $file['url'];
					}
					else {
						$image_dirname = pathinfo($file['url'],PATHINFO_DIRNAME);
						$image_filename = pathinfo($file['url'],PATHINFO_FILENAME);
						$image_extension = pathinfo($file['url'],PATHINFO_EXTENSION);
						
						$thumb_url = $image_dirname . '/' . $image_filename . '-' . GpcEnhactivityProfile::$thumb_suffix . '.' . $image_extension;
					}
					
					$data['default_thumb'] = $thumb_url;
				}					
		}
		else {
			$msg_error[] = __("Only .jpg and .png are allowed.");
		}
	}
	
	GpcEnhactivityProfile_Settings::update_options($data);
	$msg_notify[] = __('The Settings was updated.');
}

// Get the data of the Plugin Options
$data = GpcEnhactivityProfile_Settings::get_options();

include( GpcEnhactivityProfile::$plugin_dir . '/templates/includes/admin/general_settings.php'); 
?>