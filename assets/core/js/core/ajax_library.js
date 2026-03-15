function ajax_get_request(url, title) {
  // alert('hihih');
  //$('.onclick_ajaxloader_js').show();
  $.ajax({
    type : 'GET',
    url : url,
    dataType:'JSON',
    success: function(response) { 
      if (response.open_modal == '1') {
        $('#ajax-modal .modal-body').html(response.data);
        if(response.title != 'undefined' && response.title != 'null'){
          $('.modal-title').text('');
          $('.modal-title').text(response.title);
        }
        if(title != null && title !=''){
          $('.modal-title').text(title);
        }
        modal_js("show");
      }
        
      if (response.js_function != null && response.js_function != '') {
        eval(response.js_function); 
      }
      $('.onclick_ajaxloader_js').hide();
    }
  });
};

function ajax_post_request(url,formData, reqOff) {
  if (reqOff!='autocomplete') {
    $('.onclick_ajaxloader_js').show();
  }
  toastr.remove(); 
  $.ajax({
    type : 'POST',
    url: url,
    data: formData,
    cache: false,
    processData: false,
    contentType: false,
    dataType:'Json',
    success: function(response) {
      //if (response.status == 'success') {
      if(response.hide_modal != 0) {
        modal_js("hide");
      } else {
        $('#ajax-modal .modal-body').html(response.data); 
      }
      
      if (response.message != null && response.message != '') {
        toastr[response.status](response.message);
      } 

      if (response.js_function != null && response.js_function != '') {
        eval(response.js_function); 
      }

      if (response.get_request_url != null) {
        title = '';
        if (response.data.current_process.field_name != null) title = response.data.current_process.field_name;
        ajax_get_request(response.get_request_url, 'ADD ' + title);
      }


      
      $('.onclick_ajaxloader_js').hide();
    }

  });
};

function ajax_on_a_tag() {
  $('body').on('click', 'a.ajax', function(e) {
    $('.onclick_ajaxloader_js').show();
    e.preventDefault();
    var url = $(this).attr('href');
    var title = $(this).attr('data-title');
    ajax_get_request(url, title);
  });
}

function ajax_post_on_tag(){
  $('body').on('click', 'a.ajax_post', function(e) {
    e.preventDefault();
    var success_function = $(this).attr('success_function');
    var url = $(this).attr('href');
    var formData = JSON.parse($(this).attr('data-ajax'));
    var form = new FormData();
    $.each(formData, function(key, value) {
      form.append(key,value);
    });
    ajax_post_request(url, form);
    eval(success_function);
  });
}

function ajax_post_onclick_submit(){
  $('body').on('click', 'button.ajax_post', function(e) {
    e.preventDefault();
    var url = $(this).closest('form').attr('action');
    var formData = new FormData($(this).closest('form')[0]);
    ajax_post_request(url, formData);
  });
}
