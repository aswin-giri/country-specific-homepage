<?php
/*
Plugin Name: Country Specific Homepage
Plugin URI: http://aswin.com.np/
Description: This plugin lets you set seperate homepage based on visitor's country
Version: 1.1
Author: Aswin Giri
Author URI: http://resume.aswin.com.np/
Text Domain: country-specific-homepage
Domain Path: /languages
*/


defined( 'ABSPATH' ) || exit;

define( 'country_specific_homepage_url', plugin_dir_url( __FILE__ ) );
define( 'country_specific_homepage_path', plugin_dir_path( __FILE__ ) );

class Country_Specific_Homepage {
  
  protected static $instance = null;
  public $admin;
  public $ajax;
  public $common;
  
  function __construct() {
    
    $this->includes();
    $this->init();
    
  }
  
  
  static public function instance() {
    
      if ( is_null( self::$instance ) ) {
			self::$instance = new self();
       }

		return self::$instance;
  }
  
  
  
  
  function includes(){
    
    include country_specific_homepage_path.'includes/class-csh-admin.php';
    include country_specific_homepage_path.'includes/class-csh-ajax.php';
    include country_specific_homepage_path.'includes/class-csh-common.php';
    
  }
  
  
  function init(){
    $this->admin = new CSH_Admin;
    $this->ajax = new CSH_Ajax;
    $this->common = new CSH_Common;
  }
  
  
  function get_template( $file , $data = [] ){
    
    if( is_array($data) && ! empty($data) ){
      extract($data);
    }
    
    include country_specific_homepage_path.'public/templates/'.$file.'.php';
  }
  
  
}

if( ! function_exists('csh_exe')){
  function csh_exe(){
    return Country_Specific_Homepage::instance();
  }
}

csh_exe();