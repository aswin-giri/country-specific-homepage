<?php
if(isset($_POST['csh_data'],$_POST['csh_country'],$_POST['csh_page']) && current_user_can('administrator')){
  
    $country_code = sanitize_text_field($_POST['csh_country']);
    $page_id = sanitize_text_field($_POST['csh_page']);
    $page_id = intval($page_id);
  
    if(! wp_verify_nonce($_POST['_wpnonce'],'csh_data_submit')){
      _e('Invalid request','country-specific-homepage');
    }
    elseif(strlen($country_code) != 2){
      _e('Invalid request','country-specific-homepage');
    }
    else{

      $country_code = strtolower($country_code);
      update_option('page_on_front_'.$country_code,$page_id);
    }
  
}