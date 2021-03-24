observer.observe();
$(document).ready(function(){
  limit = screen.width < 768 ? 12 : 20
  imgWall(limit)
  // echo.init({ callback: function (el, op) { $(el).html(''); } });

})

//quando un device viene ruotato ricalcolo l'altezza delle immagini
window.addEventListener("orientationchange", function() {
  window.setTimeout(function() {
    wrapImgWidth()
    $(".imgMapDiv").height($("#imgMap0").width())
  }, 200);
}, false);

$(".closePanel").on('click', function(){
  $(".panel-content").animate({marginRight:"-=50%"},500, function(){
    $("#panel").hide()
    $(".imgGallery").html('')
  });
})
