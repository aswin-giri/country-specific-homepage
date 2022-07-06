<thead>
      <tr style="background:#fff;">
        <th style="padding:10px;">
          
          <input type="text" style="display:block;width:100%;padding:10px;" placeholder="<?php _e('Filter list','country-specific-homepage'); ?>" id="csh-filter-input"/>
          
        </th>
        
        <th style="text-align:center;"></th>
        
        <th style="text-align:right;">
          
          <button id="csh-add-btn" 
                  data-url="<?php echo admin_url('admin-ajax.php?action=csh_get_add_modal'); ?>" 
                  type="button" 
                  class="button button-primary"
                  data-nonce="<?php echo wp_create_nonce('csh_add_btn'); ?>">
                  <?php _e('Add new','country-specific-homepage'); ?>
          </button>
          
        </th>
      </tr>
</thead>