// costanti per funzioni ajax
const connector = 'class/connector.php'
const type = 'POST'
const dataType = 'json'
const $root = $('html, body');
const observer = lozad('.lozad', { rootMargin: '10px 0px', threshold: 0.1 });
const page = window.location.pathname.split('/').pop().split('.')[0]
$(document).ready(function(){
  if (page=='gallery') {
    get=window.location.search;
    if (get) {
      g1 = get.slice(1).split('&')[0];
      g2 = get.slice(1).split('&')[1];
      if (g1.split('=')[1]=='titolo') { $("#txtSearch").val(g2.split('=')[1].replace(/\+/g,' '))}
    }
  }
  $('.scroll').on('click',function() {
    var href = $(this).attr('href').split("#").pop();
    var $target = $($("#"+href));
    $root.animate({ scrollTop: $target.offset().top }, 500, function () {window.location.hash = href; });
  });
  $("#txtSearch").tooltip({trigger:'focus',placement: "left"})

  $(".dropdown").on('show.bs.dropdown', function(){ $("#navbarDropdownMenuLink").addClass('linkActive'); })
  $(".dropdown").on('hide.bs.dropdown', function(){ $("#navbarDropdownMenuLink").removeClass('linkActive'); })

  $(".tag").on('click',function(){
    id=$(this).data('id')
    filtro=$(this).data('filtro')
    tag=$(this).data('tag')
    form = $('[name=geoTagForm]');
    $('<input/>',{type:'hidden',name:'val',value:id}).appendTo(form)
    $('<input/>',{type:'hidden',name:'tag',value:tag}).appendTo(form)
    $('<input/>',{type:'hidden',name:'filtro',value:filtro}).appendTo(form)
    form.submit();
  });

  $("body").on('click', '.hyperLink', function(event) {
    event.preventDefault();
    numsch = $(this).attr('href').slice(1);
    data={}
    data['oop']={file:'global.class.php',classe:'General',func:'getIdByNumsch'}
    data['dati']={numsch: numsch}
    $.ajax({url: connector, type: type, dataType: dataType, data: data})
    .done(function(data) { linkScheda(data[0].id) });
  });
  menuFooter();

  $(function () {
    $(".textag").slice(0, 75).show();
    $(".geotag").slice(0, 75).show();
    $("[name=loadMore]").on('click', function (e) {
        e.preventDefault();
        var section = $(this).data('section');
        $("."+section+":hidden").slice(0, 75).slideDown('fast');
        $(".firstLetter."+section+":visible").addClass('d-inline-block')
        if ($("."+section+":hidden").length == 0) {
            $(this).fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top - 500 + "px"
        }, 500);
    });
    $('.firstLetter:visible').addClass('d-inline-block')
    //$('.firstLetter').eq(0).remove();
  });

  $(".logoutBtn").on('click', function(e){
    e.preventDefault();
    logout();
  })

  $(".toggleSideBar").on('click', function(e){
    e.preventDefault();
    toggleSideBar();
  });
})
function toggleSideBar(){
  $(".sidebar").toggleClass('open closed');
}
function wrapImgWidth(){ $(".imgDiv").height($("#img0").width()) }

function imgWall(limit){
  data={}
  data['oop']={file:'global.class.php',classe:'General',func:'imgWall'}
  data['dati']={limit:limit}
  $.ajax({url: connector, type: type, dataType: dataType, data: data})
    .done(function(data) {
      data.forEach(function(val,idx){
        if (val.dgn_dnogg && val.dgn_dnogg !== '-' && val.dgn_dnogg !== '') {
          titolo = val.dgn_dnogg;
        }else if (!val.dgn_dnogg && val.sog_titolo) {
          titolo = val.sog_titolo;
        }else {
          titolo = val.path.slice(0,-4);
        }
        d1=$("<div/>",{id:'img'+idx})
          .attr("data-scheda",val.id)
          .addClass('col-12 col-sm-6 col-md-4 col-lg-3 p-0 imgDiv')
          .appendTo('.wrapImg')
          .on('click',function(){ linkScheda(val.id) });
        d2=$("<div/>").addClass('imgContent animation text-center lozad')
          // .html('<i class="fas fa-circle-notch fa-spin fa-5x"></i>')
          .attr("data-background-image","foto_medium/"+val.path)
          .appendTo(d1)
        d3=$("<div/>")
          .addClass('animation imgTxt')
          .appendTo(d1)
        $("<p/>").addClass('animation').html(titolo).appendTo(d3)
        wrapImgWidth();
      })
      observer.observe();
    }
  );
}
function lazyImg(){
  data={}
  data['oop']={file:'global.class.php',classe:'General',func:'lazyLoad'}
  $.ajax({url: connector, type: type, dataType: dataType, data: data})
    .done(function(data) {
      data.forEach(function(val,idx){
        if (!val.sog_titolo || val.sog_titolo == '-' || val.sog_titolo == '') {titolo = val.path.slice(0,-4); }else {titolo = val.sog_titolo;}
        d1=$("<div/>",{id:'img'+idx})
          .attr("data-scheda",val.id)
          .addClass('col-12 col-sm-6 col-md-4 col-lg-3 p-0 imgDiv')
          .appendTo('.progImg')
          .on('click',function(){ linkScheda(val.id) });
      })
    }
  );
}

function linkScheda(id){
  var form = $("<form/>",{action:'scheda.php',method:'get'}).appendTo('body')
  $('<input/>',{type:'hidden',name:'scheda',value:id}).appendTo(form)
  form.submit();
}
function menuFooter(){
  logUrl = localStorage.getItem('logged') ? 'logout' : 'login';
  $('.mainMenu .mf').each(function(){
    li=$("<li/>").appendTo('.menuFooter');
    $("<a/>",{class:"scroll animation", href:$(this).attr('href')}).text($(this).text()).appendTo(li);
  });
  login = $("<li/>",{class:"border-top py-2"}).appendTo('.menuFooter');
  $("<a/>",{href:logUrl + ".php", class:logUrl+"Btn"}).text(logUrl.toUpperCase()).appendTo(login);
}

function countdown(sec,page){
  $("#countdowntimer").text(sec);
  var downloadTimer = setInterval(function(){
    sec--;
    $("#countdowntimer").text(sec);
    if(sec === 0){ window.location.href=page; }
  },1000);
}

function logout(){
  localStorage.removeItem('logged');
  window.location.href='logout.php';
}
