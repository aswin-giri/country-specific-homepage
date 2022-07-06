<?php 
csh_exe()->get_template('admin/form-action');
$count = 0;
$countries = csh_exe()->common->get_countries();
?>
<div class="wrap">
 <h1><?php _e('Country Specific homepages','country-specific-homepage'); ?></h1>
  
  <?php csh_exe()->get_template('admin/table',[
      'countries' => $countries
   ]); ?>
 
</div>