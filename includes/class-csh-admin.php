<?php defined( 'ABSPATH' ) || exit;

if( ! class_exists('CSH_Admin')){
  
  class CSH_Admin {
    
    
    function __construct(){
        
      add_action( 'admin_menu', array( $this, 'add_csh_settings_page') );
      add_action('admin_enqueue_scripts', array( $this , 'include_css_in_head'));
    }
    
    
    
    function add_csh_settings_page(){
			add_submenu_page(
				'options-general.php',
				__('Country specific homepage','country-specific-homepage'),
				__('Country specific homepage','country-specific-homepage'),  
				'manage_options',
				'country-specific-homepage',
				array( $this,'csh_settings_page_html' )
			);
	}
		
		
	function csh_settings_page_html(){
			
		csh_exe()->get_template('admin/settings');
		csh_exe()->get_template('admin/modal');
			
	}
      
      
      
    function include_css_in_head(){
      
      $current_screen = get_current_screen();
        if($current_screen && isset($current_screen->id) && 'settings_page_country-specific-homepage' == $current_screen->id): 
          
          wp_enqueue_style( 'country-specific-homepage', country_specific_homepage_url.'public/assets/css/csh.css');
          
          wp_enqueue_script( 'country-specific-homepage', country_specific_homepage_url.'public/assets/js/csh.js');
      
        
        endif;
        
    }
      
  
  }
  
}