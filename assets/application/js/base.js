/* ----------- Scroll On Drag page ----------------*
$(function(){
	var clicked = false, clickY;
	$(document).on({
	    'mousemove': function(e) {
	        clicked && updateScrollPos(e);
	    },
	    'mousedown': function(e) {
	        clicked = true;
	        clickY = e.pageY;
	    },
	    'mouseup': function() {
	        clicked = false;
	        $('html').css('cursor', 'auto');
	    }
	});

	var updateScrollPos = function(e) {
	    $('html').css('cursor', 'row-resize');
	    $(window).scrollTop($(window).scrollTop() + (clickY - e.pageY));
	}	
})
/* ----------- Scroll On Drag page Close ----------------*/



/* ----------- Horizontal Scroll on mouse wheel  ----------------*/
// jQuery(function ($) {
// 	scrollbar();
//   $.fn.hScroll = function (amount) {
//     amount = amount || 120;
//     $(this).bind("DOMMouseScroll mousewheel", function (event) {
//         var oEvent = event.originalEvent, 
//             direction = oEvent.detail ? oEvent.detail * -amount : oEvent.wheelDelta, 
//             position = $(this).scrollLeft();
//         position += direction > 0 ? -amount : amount;
//         $(this).scrollLeft(position);
//         event.preventDefault();
//     })
//   };
// });

$(document).ready(function() {
  // $('.table-responsive').hScroll(60); // You can pass (optionally) scrolling amount
  $( "#arrange_column_body" ).sortable();
  $( "#arrange_column_body" ).disableSelection();
  ajax_on_a_tag();
  ajax_post_on_tag();
  toggle_table();
  ajax_post_onclick_submit();
}).ajaxStop(function(){
	//autocomplete();
});
/* ----------- Horizontal Scroll on mouse wheel Close ----------------*/



$("body").on('click', '.choosetext_js li', function(){
	const thisval = $(this).html();
	alert(thisval);
});


$('body').on('click', '.helptext_js', function(){
	const thisname = $(this).attr('name');	
	mystring = thisname.replace(/"/g, "").replace(/'/g, "").replace(/\[|\]/g, "");
	$('.'+mystring).show();

});