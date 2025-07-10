function toggle_table() {
  $(".toggle_row").each(function() {
    $(this).on("click", function(){     
      $(this).toggleClass("active");
      $(this).closest('tbody').find("tr.toggle_content").toggle();     
    });
  });
}
