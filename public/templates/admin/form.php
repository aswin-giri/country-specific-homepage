<?php
$selected_country = '';
$page_id = '';
$code = '';
if(isset($country)){
  $selected_country = $country;
  $code = strtoupper($selected_country);
  $page_id = get_option('page_on_front_'.$selected_country);
}
?>
<form method="post" action="">
  
  <?php
  $countries = csh_exe()->common->get_countries();
  $pages = get_pages(['post_status' => 'publish']);
  ?>
  
  <?php if($selected_country==''): ?>
    <h2><?php _e('Set Homepage','country-specific-homepage'); ?></h2>
  
    <div class="form-group">
      <label><strong><?php _e('Country','country-specific-homepage'); ?> :</strong></label><br/>
      <select style="height:40px;width:300px;" name="csh_country">
        <?php 
        foreach($countries as $code => $name): 
        $name = strtolower($name);
        $name = ucfirst($name);
        $code = strtolower($code);
        $selected = '';
        if($code == strtolower($selected_country)) { $selected = 'selected'; }
        ?>
        <option <?php echo $selected; ?> value="<?php echo esc_html($code); ?>"><?php echo esc_html($name); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <br/>
  
    <?php else: ?>
  
    <h3><?php _e('Homepage for','country-specific-homepage'); ?> <?php if($selected_country !=''){ echo csh_exe()->common->get_countries($code); } ?></h3>
    <input type="hidden" name="csh_country" value="<?php echo esc_html($selected_country); ?>"/>
    <br/>
  
    <?php endif; ?>
    <div class="form-group">
      <label><strong><?php _e('Page','country-specific-homepage'); ?>:</strong></label><br/>
      <select style="height:40px;width:300px;" name="csh_page">
        <?php foreach($pages as $page): 
          if($page->post_title==''){ continue; }
          $selected = '';
          if(intval($page_id) == $page->ID) { $selected = 'selected'; }
        ?>
        <option <?php echo $selected; ?> value="<?php echo $page->ID; ?>"><?php echo esc_html($page->post_title); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <br/>
  
    <div class="form-group">
      <button class="button button-primary"><?php _e('Save','country-specific-homepage'); ?></button>
    </div>
  
  <input type="hidden" name="csh_data" value="1"/>
  <?php wp_nonce_field('csh_data_submit'); ?>
</form>