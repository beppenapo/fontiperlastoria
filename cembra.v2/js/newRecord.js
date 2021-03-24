$(".header").on('click', function(){
  $(".header").not(this).each(function(){ $(this).removeClass('active'); });
  $(this).toggleClass("active");
});

oopListe={file:'nuova_scheda.class.php',classe:'NuovaScheda',func:'getListe'}
$.ajax({
  url: "class/connector.php",
  type: "POST",
  data: {oop:oopListe},
  dataType: 'json',
}).done(function(data){
  console.log(data);
  $.each(data.dgn_livind,function(i,v){
    $("<option/>",{text:v.definizione}).val(v.id).appendTo('[name=dgn_livind]');
  });
  $("#compilatore").text(data.compilatore[0].compilatore);
  $("#compilazione").text(new Date().toJSON().slice(0,10));
  $("[name=compilazione]").val(new Date().toJSON().slice(0,10));
  $.each(data.cro_motiv,function(i,v){
    $("<option/>",{text:v.definizione}).val(v.id).appendTo('[name=cro_motiv]');
  });
});
