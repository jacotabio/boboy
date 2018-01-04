$(document).ready(function(){
//open popup
$(".pop").click(function(){
  $("#overlay_form").fadeIn(1000);
  $(".background_overlay").fadeIn(500);
  positionPopup();
});

//close popup
$("#close, .background_overlay").click(function(){
	$("#overlay_form").fadeOut(500);
	$(".background_overlay").fadeOut(500);
	window.location.assign("index.php?mod=dashboard&sub=products");
});
});

//position the popup at the center of the page
function positionPopup(){
  if(!$("#overlay_form").is(':visible')){
    return;
  } 
  $("#overlay_form").css({
      left: ($(window).width() - $('#overlay_form').width()) / 2,
      top: ($(window).width() - $('#overlay_form').width()) / 7,
      position:'absolute'
  });
}

//maintain the popup at center of the page when browser resized
$(window).bind('resize',positionPopup);