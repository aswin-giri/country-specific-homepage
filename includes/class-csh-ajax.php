<?php defined( 'ABSPATH' ) || exit;

if( ! class_exists('CSH_Ajax')){
  
  class CSH_Ajax {
  
    function __construct(){
      add_action('wp_ajax_csh_get_edit_modal', array($this,'get_edit_modal_content'));
      add_action('wp_ajax_csh_delete_homepage',array($this,'delete_homepage'));
      add_action('wp_ajax_csh_get_add_modal',array($this,'get_add_modal_content'));
    }
    
    
    function get_edit_modal_content(){
        $country_code = sanitize_text_field($_REQUEST['country']);
        $country_code = strtolower( $country_code );
        
        if( ! wp_verify_nonce($_POST['wpnonce'],'csh_edit_link_'.$country_code)){
            echo __('Invalid request','country-specific-homepage');
            die;
        }
        
        if(current_user_can('administrator') && is_admin()  &&  strlen($country_code) == 2) {
            
            csh_exe()->get_template('admin/form',['country' => $country_code]);
            die;
            
        }else {
            
          echo __('Unauthorized action.','country-specific-homepage');
          die;
            
        }
    }
    
    
    function get_add_modal_content(){
        
        if( ! wp_verify_nonce($_POST['wpnonce'],'csh_add_btn')){
            echo __('Invalid request','country-specific-homepage');
            die;
        }
        
        
        if(current_user_can('administrator') && is_admin()){
            
            csh_exe()->get_template('admin/form');
            die;
            
        }else{
            
          echo __('Unauthorized action.','country-specific-homepage');
          die;
            
        }
    }
    
    
    function delete_homepage(){
        
        if(current_user_can('administrator')){
            
            $country_code = sanitize_text_field( $_REQUEST['country'] );
            $array_key = strtoupper( $country_code );
            
            if( strlen($country_code) == 2 && is_string( csh_exe()->common->get_countries( $array_key ) )){
                
               delete_option('page_on_front_'.strtolower($country_code)); 
                
            }
            
            exit(wp_redirect(admin_url('options-general.php?page=country-specific-homepage')));
            
        }
        
        echo __('Unauthorized action.','country-specific-homepage');
        die;
    }

      
  }
  
}