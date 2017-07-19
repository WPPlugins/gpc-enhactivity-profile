<?php
if (!class_exists('GpcEnhactivityProfile_Settings'))
{
	class GpcEnhactivityProfile_Settings 
	{
	   /**
	    * The name for plugin options in the DB
	    *
	    * @var string
	    */
        static $db_option = 'GpcEnhactivityProfile_Options';
        
		/**
		 * Get value of max amount of comments
		 * 
		 * @static
		 * @return string
		 * @access public
		 */
		static public function get_max() {
		   	$options = self::get_options();
		   	return $options['max'];
		}
		
		/**
		 * Get value of size of stars
		 * 
		 * @static
		 * @return string
		 * @access public
		 */
		static public function get_star_size() {
		   	$options = self::get_options();
		   	return $options['star_size'];
		}
		
		/**
		 * Get url of default_thumb
		 * 
		 * @static
		 * @return string
		 * @access public
		 */
		static public function get_default_thumb() {
		   	$options = self::get_options();
		   	return $options['default_thumb'];
		}
		
		/**
		 * Updates the General Settings of Plugin
		 * 
		 * @return void
		 * @access public
		 */
        static function update_options($options) {
	    	update_option(self::$db_option, $options);	
	    }
        
	    
    	/**
		 * Return the General Settings of Plugin, and set them to default values if they are empty
		 * 
		 * @return array general options of plugin
		 * @access public
		 */
        static function get_options() {
        	// default values
		    $options = array 
		    (
		        'star_size' => '20',
		        'max' => '5',
		        'default_thumb' => ''
		    );
		    
	        // get saved options
			$saved = get_option(self::$db_option);
		    
			// assign them
		    if (!empty($saved))  
		    {
		        foreach ($saved as $key => $option)
		        {
		        	$options[$key] = $option;
		        }
		    }
		    
		    // update the options if necessary
	        if ($saved != $options)
	          update_option(self::$db_option, $options);
	        //return the options
	        return $options;
        }
	}
}
?>