function set_input_add_more(){
	$(".set_input_add_more").click(function(){
		var input_class = $(this).attr('data-class');
	  var href= $(this).attr('href')+'&type=1&field_class='+input_class;
	  ajax_get_request(href);
	});
}

function append_add_more_html(html,field_name,field_class){
	$("."+field_class).after(html);
	if(field_name == 'out_weight'){
		var find_input = $(".set_cursor_out_weight").find();
		if(typeof(find_input.prevObject) != 'undefined')
			$(find_input.prevObject).focus()[find_input.prevObject.length];
		else
			$("."+field_name+"_"+'out_weight').focus();

	}
}

function set_cursor_on_out_weight(){
	var url = $(".out_weight").attr('href');
	var input_class = $(".out_weight").attr('data-class');
	if(typeof(input_class) !='undefined'){
	  var href= url+'&type=1&field_class='+input_class;
	  ajax_get_request(href,'ADD OUT');
	}
}

function show_more_intialized(){//initialize
	$(".show_more_details").click(function(e){
		var form = new FormData();
		var product_name = $(this).attr('data-chain');
		var collapse_value = $(this).attr('data-collapse');
		var request = $(this).attr('data-request');
		var common_class = $(this).attr('data-list');
		var hide_after_class = $(this).attr('data-hide');
		if(collapse_value == 0)
			$(this).attr('data-collapse',1);
			$(this).attr('data-request',1);
			var span = $(this).find('span');
			$(span).removeClass('fa fa-plus');
			$(span).addClass('fa fa-minus');
			if(request == 0){
				form.append('product_name',product_name);
				ajax_post_request(base_url+'processes/process_report_lists/index',form,'autocomplete');
			}else{
				$("."+hide_after_class+'_hide').show();
			}
		if(collapse_value == 1){
			$("."+hide_after_class+'_hide').hide();
			$("."+common_class+'_hide_all').hide();
			$(this).attr('data-collapse',0);
			var span = $(this).find('span');
			$(span).removeClass('fa fa-minus');
			$(span).addClass('fa fa-plus');
		}
	});

	$(".show_more_department_details").click(function(e){
		var form = new FormData();
		var department_names = $(this).attr('data-chain');
		var collapse_value = $(this).attr('data-collapse');
		var request = $(this).attr('data-request');
		var common_class = $(this).attr('data-list');
		var hide_after_class = $(this).attr('data-hide');
		if(collapse_value == 0)
			$(this).attr('data-collapse',1);
			$(this).attr('data-request',1);
			var span = $(this).find('span');
			$(span).removeClass('fa fa-plus');
			$(span).addClass('fa fa-minus');
			if(request == 0){
				form.append('department_name',department_names);
				form.append('department_list',common_class);
				ajax_post_request(base_url+'stock_summary_reports/stock_report_lists/index',form,'autocomplete');
			}else{
				$("."+hide_after_class+'_hide').show();
			}
		if(collapse_value == 1){
			$("."+hide_after_class+'_hide').hide();
			$("."+common_class+'_hide_all').hide();
			$(this).attr('data-collapse',0);
			var span = $(this).find('span');
			$(span).removeClass('fa fa-minus');
			$(span).addClass('fa fa-plus');
		}
	});
}


function set_tounch_in_on_field(){
	$(".tounch_in").keyup(function(e){
		if($(this).val() !=""){
			var tounch_value = $("#id").val();
			$(".tounch_no").val(tounch_value);
		}else{
			$(".tounch_no").val('0.0000');
		}
	});
}

function set_fire_tounch_in_on_field(){
	$(".fire_tounch_in").keyup(function(e){
		if($(this).val() !=""){
			var fire_tounch_value = $("#id").val();
			$(".fire_tounch_no").val(fire_tounch_value);
		}else{
			$(".fire_tounch_no").val('0.0000');
		}
	});
}

function render_show_more(html,show_class,is_initialize){
	$(html).insertAfter('.'+show_class);
	if(is_initialize != 1){
		initialize_third_layer();
	}
	tr_heighlighted(is_initialize);

	//$("."+show_class).html(html);
}

function tr_heighlighted(is_initialize){
	$('.table-row').hover(function() {            
		$(this).css("background-color","rgb(57, 181, 241);");
	}, function() {
		$(this).css("background-color","#F0F0F0");
	});
}
/*function initialize_third_layer(){
	$(".get_third_layer_data").click(function(e){
		var get_form_content = $(this).attr('data-values');
		$('<form target="_blank" method="GET" action="'+base_url+'processes/process_report_lists/view/1"><input name="data" value="'+encodeURI(get_form_content)+'"></form>').appendTo('body').submit();
	});
}	*/

function initialize_third_layer(){
	$(".get_third_layer_data").click(function(e){
		var hide_after_class = $(this).attr('data-hide');
		var get_form_content = $(this).attr('data-values');
		var set_class = $(this).attr('data-class');
		var clicked = $(this).attr('data-clicked');
		var common_class = $(this).attr('data-list');
		var request = $(this).attr('data-request');
		var name = $(this).attr('data-name');
		var i = $(this).find('i');
		var tr = $(this).find('tr');		
		if(clicked == 0){
			$(this).removeClass('table-row');
			$(this).css("font-weight",500);
			$(this).css("color",'brown');
			$(this).attr('data-clicked',1);
			$(this).attr('data-request',1);
			var form = new FormData();
			if(request == 0){
				form.append('data',get_form_content);
				form.append('class',set_class);
				form.append('hide-class',hide_after_class);
				form.append('process',common_class);
				ajax_post_request(base_url+'processes/process_report_lists/view/1',form,'autocomplete');
			}else{
				$(this).css("font-weight",700);
				$(this).css("color",'brown');
				$("."+hide_after_class).show();
			}
			$(i).removeClass('fas fa-angle-double-right');
			$(i).addClass('fas fa-angle-double-down');
		}else{
			$("."+hide_after_class).hide();
			$(this).attr('data-clicked',0);
			$(i).removeClass('fas fa-angle-double-down');
			$(i).addClass('fas fa-angle-double-right');
			$(this).css("background-color","#F0F0F0");
			$(this).css("font-weight",100);
			$(this).css("color",'black');
			$(this).addClass('table-row');
	
		}
		
	});
	$(".get_third_layer_department_data").click(function(e){
		var hide_after_class = $(this).attr('data-hide');
		var get_form_content = $(this).attr('data-values');
		var set_class = $(this).attr('data-class');
		var clicked = $(this).attr('data-clicked');
		var common_class = $(this).attr('data-list');
		var request = $(this).attr('data-request');
		var name = $(this).attr('data-name');
		var i = $(this).find('i');
		var tr = $(this).find('tr');		
		if(clicked == 0){
			$(this).removeClass('table-row');
			$(this).css("font-weight",500);
			$(this).css("color",'brown');
			$(this).attr('data-clicked',1);
			$(this).attr('data-request',1);
			var form = new FormData();
			if(request == 0){
				form.append('data',get_form_content);
				form.append('class',set_class);
				form.append('hide-class',hide_after_class);
				form.append('process',common_class);
				ajax_post_request(base_url+'stock_summary_reports/stock_report_lists/view/1',form,'autocomplete');
			}else{
				$(this).css("font-weight",700);
				$(this).css("color",'brown');
				$("."+hide_after_class).show();
			}
			$(i).removeClass('fas fa-angle-double-right');
			$(i).addClass('fas fa-angle-double-down');
		}else{
			$("."+hide_after_class).hide();
			$(this).attr('data-clicked',0);
			$(i).removeClass('fas fa-angle-double-down');
			$(i).addClass('fas fa-angle-double-right');
			$(this).css("background-color","#F0F0F0");
			$(this).css("font-weight",100);
			$(this).css("color",'black');
			$(this).addClass('table-row');
	
		}
		
	});
}
$(".process_tounch_loss_fine").click(function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    const form = document.createElement('form');
    form.method = 'post';
    form.action = base_url+'processes/process_tounch_loss_fine/update/'+id+'?from=view';
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'process_tounch_loss_fine[id]';
    hiddenField.value = id;
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
  });

/*function change_inlot_purity() {
  $('.change_inlotpurity').change(function(){
    var inlotpurity = $('select[name=in_lot_purity] option').filter(':selected').val();
    var url = document.location.href+"?in_lot_purity="+inlotpurity;
    document.location = url;
  });
}*/
