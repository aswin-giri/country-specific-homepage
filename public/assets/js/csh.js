jQuery(function($){
    
    $(document).on('click','#csh-add-btn',function(e){
      e.preventDefault();
      var btn = $(this);
      var url = btn.attr('data-url');
      $('#csh-modal').find('.csh-modal-body').html('Loading..');
      $('#csh-modal').show();
      $.post(url,{
       wpnonce:btn.attr('data-nonce')
      },function(data){
        $('#csh-modal').find('.csh-modal-body').html(data);
      });
      
    });
  
  $(document).on('click','.csh-edit-link',function(e){
      e.preventDefault();
      var btn = $(this);
      var url = btn.attr('href');
      $('#csh-modal').find('.csh-modal-body').html('Loading..');
      $('#csh-modal').show();
      $.post(url,{
       wpnonce:btn.attr('data-nonce')
      },function(data){
        $('#csh-modal').find('.csh-modal-body').html(data);
      });
      
    });
    
    
    $(document).on('click','#csh-modal-close',function(e){
      e.preventDefault();
      $('#csh-modal').find('.csh-modal-body').html('');
      $('#csh-modal').hide();
    });
    
    $(document).on('keyup','#csh-filter-input',function(){
      var table = $('#csh-filterable-table');
      var searchTerm = jQuery(this).val().toLowerCase();
      table.find('tbody tr').each(function(){
      var lineStr = jQuery(this).attr('data-country').toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                jQuery(this).hide();
            }else{
                jQuery(this).show();
            }
       });
    });
  
  });