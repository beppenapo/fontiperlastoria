$(document).ready(function () {
var pagina = window.location.pathname;


if(pagina!='/home.php'){
 $("#homeLink").hover(function() {$("#homeLinkImg").fadeIn("slow"); $("#homeLinkBg").removeClass('menu').addClass('hoverHome');});  
 $("#homeLink").mouseout(function() {$("#homeLinkImg").fadeOut("slow"); $("#homeLinkBg").removeClass('hoverHome').addClass('menu');});
 $("#homeLink").click(function(){window.location.href="home.php";});
}else{
 $('#progettoLinkImg, #fontiLinkImg, #istruzioniLinkImg, #dbLinkImg, #webgisLinkImg, #staffLinkImg, #progCorrLinkImg, #linkLinkImg, #materialiLinkImg').hide();
 $('#homeLinkBg').removeClass('menu').addClass('hoverHome');
 //$('#homeLink').css({'cursor':'default','color':'rgb(36,172,204)','text-shadow':'-1px 0 white, 0 1px white, 1px 0 white, 0 -1px white'}); 
 $('#homeLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(36,172,204)"); 
}

if(pagina!='/progetto.php'){
 $("#progettoLink").hover(function() {$("#progettoLinkImg").fadeIn("slow"); $("#progettoLinkBg").removeClass('menu').addClass('hoverProgetto');});  
 $("#progettoLink").mouseout(function() {$("#progettoLinkImg").fadeOut("slow"); $("#progettoLinkBg").removeClass('hoverProgetto').addClass('menu');});
 $("#progettoLink").click(function(){window.location.href="progetto.php";});
}else{
 $('#homeLinkImg, #fontiLinkImg, #istruzioniLinkImg, #dbLinkImg, #webgisLinkImg, #staffLinkImg, #progCorrLinkImg, #linkLinkImg, #materialiLinkImg').hide();
 $('#progettoLinkBg').removeClass('menu').addClass('hoverProgetto');
 $('#progettoLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(255,127,42)");
}

if(pagina!='/fonti.php'){
 $("#fontiLink").hover(function() {$("#fontiLinkImg").fadeIn("slow"); $("#fontiLinkBg").removeClass('menu').addClass('hoverFonti');});  
 $("#fontiLink").mouseout(function() {$("#fontiLinkImg").fadeOut("slow"); $("#fontiLinkBg").removeClass('hoverFonti').addClass('menu');});
 $("#fontiLink").click(function(){window.location.href="fonti.php";});
}else{
 $('#homeLinkImg, #progettoLinkImg, #istruzioniLinkImg, #dbLinkImg, #webgisLinkImg, #staffLinkImg, #progCorrLinkImg, #linkLinkImg, #materialiLinkImg').hide();
 $('#fontiLinkBg').removeClass('menu').addClass('hoverFonti');
 $('#fontiLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(91,255,36)");
}

if(pagina!='/istruzioni.php'){
 $("#istruzioniLink").hover(function() {$("#istruzioniLinkImg").fadeIn("slow"); $("#istruzioniLinkBg").removeClass('menu').addClass('hoverIstruzioni');});  
 $("#istruzioniLink").mouseout(function() {$("#istruzioniLinkImg").fadeOut("slow"); $("#istruzioniLinkBg").removeClass('hoverIstruzioni').addClass('menu');});
 $("#istruzioniLink").click(function(){window.location.href="istruzioni.php";});
}else{
 $('#homeLinkImg, #progettoLinkImg, #fontiLinkImg, #dbLinkImg, #webgisLinkImg, #staffLinkImg, #progCorrLinkImg, #linkLinkImg, #materialiLinkImg').hide();
 $('#istruzioniLinkBg').removeClass('menu').addClass('hoverIstruzioni');
 $('#istruzioniLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(255,85,85)");
}

if(pagina!='/db.php'){
 $("#dbLink").hover(function() {$("#dbLinkImg").fadeIn("slow"); $("#dbLinkBg").removeClass('menu').addClass('hoverDb');});  
 $("#dbLink").mouseout(function() {$("#dbLinkImg").fadeOut("slow"); $("#dbLinkBg").removeClass('hoverDb').addClass('menu');});
 $("#dbLink").click(function(){window.location.href="db.php";});
}else{
 $('#homeLinkImg, #progettoLinkImg, #istruzioniLinkImg, #fontiLinkImg, #webgisLinkImg, #staffLinkImg, #progCorrLinkImg, #linkLinkImg, #materialiLinkImg').hide();
 $('#dbLinkBg').removeClass('menu').addClass('hoverDb');
 $('#dbLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(255,204,0)");
}

if(pagina!='/webgisPage.php'){
 $("#webgisLink").hover(function() {$("#webgisLinkImg").fadeIn("slow"); $("#webgisLinkBg").removeClass('menu').addClass('hoverWebgis');});  
 $("#webgisLink").mouseout(function() {$("#webgisLinkImg").fadeOut("slow"); $("#webgisLinkBg").removeClass('hoverWebgis').addClass('menu');});
 $("#webgisLink").click(function(){window.location.href="webgisPage.php";});
}else{
 $('#homeLinkImg, #progettoLinkImg, #istruzioniLinkImg, #dbLinkImg, #fontiLinkImg, #staffLinkImg, #progCorrLinkImg, #linkLinkImg, #materialiLinkImg').hide();
 $('#webgisLinkBg').removeClass('menu').addClass('hoverWebgis');
 $('#webgisLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(0,102,255)");
}

if(pagina!='/staff.php'){
 $("#staffLink").hover(function() {$("#staffLinkImg").fadeIn("slow"); $("#staffLinkBg").removeClass('menu').addClass('hoverStaff');});
 $("#staffLink").mouseout(function() {$("#staffLinkImg").fadeOut("slow"); $("#staffLinkBg").removeClass('hoverStaff').addClass('menu');});
 $("#staffLink").click(function(){window.location.href="staff.php";});
}else{
 $('#homeLinkImg, #progettoLinkImg, #istruzioniLinkImg, #dbLinkImg, #webgisLinkImg, #fontiLinkImg, #progCorrLinkImg, #linkLinkImg, #materialiLinkImg').hide();
 $('#staffLinkBg').removeClass('menu').addClass('hoverStaff');
 $('#staffLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(255,0,255)");
}

if(pagina!='/progCorr.php'){
 $("#progCorrLink").hover(function() {$("#progCorrLinkImg").fadeIn("slow"); $("#progCorrLinkBg").removeClass('menu').addClass('hoverProgCorr');});
 $("#progCorrLink").mouseout(function() {$("#progCorrLinkImg").fadeOut("slow"); $("#progCorrLinkBg").removeClass('hoverProgCorr').addClass('menu');});
 $("#progCorrLink").click(function(){window.location.href="progCorr.php";});
}else{
 $('#homeLinkImg, #progettoLinkImg, #istruzioniLinkImg, #dbLinkImg, #webgisLinkImg, #staffLinkImg, #fontiLinkImg, #linkLinkImg, #materialiLinkImg').hide();
 $('#progCorrLinkBg').removeClass('menu').addClass('hoverProgCorr');
 $('#progCorrLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(171,200,55)");
}

if(pagina!='/link.php'){
 $("#linkLink").hover(function() {$("#linkLinkImg").fadeIn("slow"); $("#linkLinkBg").removeClass('menu').addClass('hoverLink');});
 $("#linkLink").mouseout(function() {$("#linkLinkImg").fadeOut("slow"); $("#linkLinkBg").removeClass('hoverLink').addClass('menu');});
 $("#linkLink").click(function(){window.location.href="link.php";});
}else{
 $('#homeLinkImg, #progettoLinkImg, #istruzioniLinkImg, #dbLinkImg, #webgisLinkImg, #staffLinkImg, #progCorrLinkImg, #fontiLinkImg, #materialiLinkImg').hide();
 $('#linkLinkBg').removeClass('menu').addClass('hoverLink');
 $('#linkLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(255,102,0)");
}


if(pagina!='/materiali.php'){
 $("#materialiLink").hover(function() {$("#materialiLinkImg").fadeIn("slow"); $("#materialiLinkBg").removeClass('menu').addClass('hoverMateriali');});
 $("#materialiLink").mouseout(function() {$("#materialiLinkImg").fadeOut("slow"); $("#materialiLinkBg").removeClass('hoverMateriali').addClass('menu');});
 $("#materialiLink").click(function(){window.location.href="materiali.php";});
}else{
 $('#homeLinkImg, #progettoLinkImg, #istruzioniLinkImg, #dbLinkImg, #webgisLinkImg, #staffLinkImg, #progCorrLinkImg, #linkLinkImg, #fontiLinkImg').hide();
 $('#materialiLinkBg').removeClass('menu').addClass('hoverMateriali');
 $('#materialiLink').css({'cursor':'default'});
 $('#content').css("border-color", "rgb(95,243,211)");
}

$("#logo").click(function(){window.location.href="home.php";});
$("#webgis").click(function(){window.location.href="webgis.php";});
$("#cerca").click(function(){window.location.href="ricerche.php";});

});
