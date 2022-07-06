<tr style="background:#fff;border-bottom:1px solid #eee;" data-country="<?php echo $name; ?>" class="<?php echo esc_html($code); ?>">
       
       <td><span style="padding-left:15px;"><?php echo esc_html( $name ); ?></span></td>
       <td><span style="padding-left:15px;"><?php echo get_the_title( intval($page_id) ); ?></span></td>
       
       <td style="text-align:right;width:20%;">
          
        <a href="<?php echo admin_url('admin-ajax.php?action=csh_get_edit_modal&country='.esc_html($code)); ?>"              class="csh-edit-link"
           data-nonce="<?php echo wp_create_nonce('csh_edit_link_'.esc_html($code)); ?>">
            <?php _e('Edit','country-specific-homepage'); ?>
         </a> 
       | 
        <a href="<?php echo admin_url('admin-ajax.php?action=csh_delete_homepage&country='.esc_html($code)); ?>"    class="csh-delete-link" 
         onClick="return confirm('Sure to delete?')"
         data-nonce="<?php echo wp_create_nonce('csh_delete_link_'.esc_html($code)); ?>"
           >
              <?php _e('Delete','country-specific-homepage'); ?>
        </a>
          
       </td>
</tr>