<table class="form-table" id="csh-filterable-table">
    
    <?php
      csh_exe()->get_template('admin/table/actions');
      csh_exe()->get_template('admin/table/head');
    ?>
    
     <tbody>
      <?php 
      $count = 0;
      foreach( $countries as $code => $name): 
       $code = strtolower($code);
       $page_id = get_option('page_on_front_'.$code);
       if(! $page_id) { continue; }
       $page_id = intval($page_id);
       if( 'publish' == get_post_status ( $page_id ) && 'page' == get_post_type($page_id)):
       $count++;
         csh_exe()->get_template('admin/table/data-row',[
          'name' => $name,
          'code' => $code,
          'page_id' => $page_id
         ]); 
       endif;
       endforeach; 
       if(! $count):
       csh_exe()->get_template('admin/table/empty');
       endif; 
       ?>
     </tbody>
 </table>