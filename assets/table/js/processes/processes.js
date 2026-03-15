function set_process_rows(response) {
  set_current_process_row(response);
  //for(var field_name in response.errors) {
  //  toastr[response.status](response.errors[field_name]);
  // }
  toastr_errors(response);
  if (response.status=='success') {
    $("."+response.data.previous_process.row_id).html(response.data.previous_process.view_html);

    if (typeof(response.data.next_process) != 'undefined') {
      $("."+response.data.next_process.row_id).html(response.data.next_process.view_html);
    }
  }
  show_print_bar_code_tounch_in();
}

function toastr_errors(response) {
  for(var field_name in response.errors) {
    toastr[response.status](response.errors[field_name]);
  }
}

function set_current_process_row(response) {
  $("."+response.data.current_process.row_id).html(response.data.current_process.view_html);
}

function set_process_field_value(response) {
  if (isNaN(response.data.current_process.weight) || response.data.current_process.weight==null) {
    response.data.current_process.weight =0;
  }
  $("."+response.data.current_process.field_name+"_"+response.data.current_process.id).val(parseFloat(response.data.current_process.weight).toFixed(4));
  //$(".updated_at_"+response.data.current_process.id).val(Date.parse(response.data.current_process.updated_at) / 1000); 
  $(".updated_at_"+response.data.current_process.id).val(Date.parse(response.data.current_process.updated_at) / 1000);
  $(".balance_"+response.data.current_process.id).text(parseFloat(response.data.current_process.balance).toFixed(4)); 
  $(".balance_"+response.data.current_process.id).val(parseFloat(response.data.current_process.balance).toFixed(4));

  $(".balance_fine_"+response.data.current_process.id).text(parseFloat(response.data.current_process.balance_fine).toFixed(4));
  $(".balance_fine_"+response.data.current_process.id).val(parseFloat(response.data.current_process.balance_fine).toFixed(4));

  $(".balance_gross_"+response.data.current_process.id).text(parseFloat(response.data.current_process.balance_gross).toFixed(4));
  $(".balance_gross_"+response.data.current_process.id).val(parseFloat(response.data.current_process.balance_gross).toFixed(4));

  //$(".loss_"+response.data.current_process.id).val(parseFloat(response.data.current_process.loss).toFixed(4));
  if (response.data.current_process.product_name=='HCL' && response.data.current_process.process_name=='HCL Melting Process') {
    $(".fe_out_"+response.data.current_process.id).text(parseFloat(response.data.current_process.fe_out).toFixed(4));  
  } else {
    $(".out_lot_purity_"+response.data.current_process.id).text(parseFloat(response.data.current_process.out_lot_purity).toFixed(4));
    $(".out_lot_purity_"+response.data.current_process.id).val(parseFloat(response.data.current_process.out_lot_purity).toFixed(4));
  }

  if (response.data.current_process.previous_process_update==true) {
    set_previous_process_field_value(response.data.previous_process);
  }

  $(".karigar_"+response.data.current_process.id).val(response.data.current_process.karigar);
    show_print_bar_code_tounch_in();
    // setTimeout(function () {
    //     location.reload(true);
    //   },500);

}

function set_previous_process_field_value(response) {
  $(".balance_"+response.id).text(parseFloat(response.balance).toFixed(4)); 
  $(".balance_fine_"+response.id).text(parseFloat(response.balance_fine).toFixed(4));
  $(".balance_gross_"+response.id).text(parseFloat(response.balance_gross).toFixed(4));
  $(".next_department_wastage_"+response.id).text(parseFloat(response.next_department_wastage).toFixed(4));
}

function set_process_field_value_after_delete(response) {
  $("tr.process_"+response.data.current_process.process_field_id).hide();
  set_process_field_value(response);
}

function show_print_bar_code_tounch_in(){
  $(".hide_all").hide();
  $(".tounch_in").keyup(function(e){
    var product_id = $(this).attr('id');
    $(".tounch_add_"+product_id).show();
    var current_value = $(this).val();
    if(current_value == ''){
      $(".tounch_add_"+product_id).hide();
    }
  });
  $(".tounch_in").each(function(key,value){
    var value = $(this).val();
    if(value != '' && value != 0.0000){
      var id = $(this).attr('id');
      $(".tounch_add_"+id).show();
    }
  });
}

function archive_initialization(){
  $(".process_archive").click(function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');//base_url+'processes/process_archives/update/'+id
    const form = document.createElement('form');
    form.method = 'post';
    form.action = base_url+'processes/process_archives/update/'+id;
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'process_archives[id]';
    hiddenField.value = id;
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
  });
}

function outside_initialization(){
  $(".process_outside").click(function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    const form = document.createElement('form');
    form.method = 'post';
    form.action = base_url+'processes/process_outsides/update/'+id;
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'process_outsides[id]';
    hiddenField.value = id;
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
  })
}
function status_initialization(){
  $(".process_status").click(function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    const form = document.createElement('form');
    form.method = 'post';
    form.action = base_url+'processes/process_statuses/update/'+id;
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'process_statuses[id]';
    hiddenField.value = id;
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
  })
}

function search_parent_and_lot_no(){
  lot_no=$('input[name*="lot_no"]').val();
  karigar=$('input[name*="karigar"]').val();
  worker=$('input[name*="worker"]').val();
  in_lot_purity=$('input[name*="in_lot_purity"]').val();
  parent_lot_no=$('input[name*="parent_lot_no"]').val();
  created_at=$('input[name*="created_at"]').val();
  archive=$('input[name*="archive"]').val();
  if(lot_no!=''){
    lot_no='lot_no='+lot_no;
  }
  if(karigar!=''){
    karigar='karigar='+karigar;
  }if(worker!=''){
    worker='worker='+worker;
  }if(in_lot_purity!=''){
    in_lot_purity='in_lot_purity='+in_lot_purity;
  }
  if(parent_lot_no!=''){
    parent_lot_no='&parent_lot_no='+parent_lot_no;
  }
  if(created_at!=''){
    created_at='&created_at='+created_at;
  }
  if(archive!=''){
    archive='&archive='+archive;
  }
  // window.location.href = '?'+lot_no+parent_lot_no+karigar+worker+in_lot_purity+archive;
  window.location.href = '?'+lot_no+parent_lot_no+karigar+worker+in_lot_purity+archive+created_at;

}
$('.clear_btn').click(function(){
  var url = window.location.href;
  var new_url = url.split('?')[0];

  window.location.href=new_url;
});

$('.processes_json_search').click(function(){
  var new_url = $('#jsoncode').val();
  window.location.href='?jsoncode='+new_url;
});

function onload_factory_order_processes() {
  on_click_ka_chain_factory_process_id_calculate_weight();
}

function on_click_ka_chain_factory_process_id_calculate_weight(){
  // $('.factory_order_select_all').on('click', function(){
  //   $('.factory_order_detail_id').each(function() {
  //   $(this).prop("checked", true);
  //     calculate_factory_order_weight();
  //   });
  //   });

  $('.market_order_detail_id').on('click', function(){
    if ($(this).is(':checked')) {
        calculate_factory_order_weight();
    }
  });


}


function calculate_factory_order_weight(){
  var total_in_weight = 0;
  var total_qty = 0;
  var customer_name = "";
  $('.market_order_detail_id:checked').each(function() {
    total_in_weight = total_in_weight + parseFloat($(this).closest("tr").find(".total_weight").text());
    total_qty = total_qty + parseFloat($(this).closest("tr").find(".total_qty").text());
    customer_name = $(this).closest("tr").find(".customer_name").text();
    
  });
  set_factory_order_process_field_value('factory_order_weight',total_in_weight);
  set_customer_name_value('customer_name',customer_name);
  set_qty_field_value('total_qty',total_qty);
}

function set_factory_order_process_field_value(field_name, value) {
  $($('input[name="factory_order_weight"]')).val((value).toFixed(4));
}
function set_qty_field_value(field_name, value) {
  $($('input[name="total_qty"]')).val(value);
}
function set_customer_name_value(field_name, value) {
  $($('input[name="process_fields[customer_name]')).val(value);
}



