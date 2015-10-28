<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//IT"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="IT" >
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="Giuseppe Naponiello" />
  <meta name="keywords" content="gfoss, archaeology, anthropology, openlayer, jquery, grass, postgresql, postgis, qgis, webgis, informatic" />
  <meta name="description" content="Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi" />
  <meta name="robots" content="INDEX,FOLLOW" />
  <meta name="copyright" content="&copy;2011 Museo Provinciale" />

  <title>Le fonti per la storia. Per un archivio delle fonti sulle valli di Primiero e Vanoi</title>
  <link href="css/default.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/icone/favicon.ico" />

  <style>
   table{width:850px;margin: 0px auto;}
   table tr td{padding:0px 50px;}
   div#loghi{margin-top:200px;}
   .logDiv{width:100%;display:inline-block !important;}
   .logDiv input,.logDiv select{width:80% !important;display:inline-block !important;margin-left:-4px !important;}
   .logDiv select{padding:9px 8px !important;width:85% !important;background-color:white !important;}
   .fa{border: 1px solid #cacaca;padding: 11px;color:#3b3b3b}
   .par{font-size: 18px;line-height:18px;}
  </style>
</head>
<body>
 <div id="container">
  <div id="wrap">
   <div id="loginWrap">
   <?php 
     if($_SESSION['username']=='guest') {
   ?>
    <div id="loginTitle">Bentornato</div>
    <div id="loginForm">
      <form id="login_form" name="login_form" action="inc/loginScript.php" method="post">
       <input name="login" type="hidden" value="yes"/>
       <div class="logDiv">
        <i class="fa fa-cog fa-fw fa-2x"></i>
        <select name="hub" id="hub" class="text"> 
         <option value='0'>--  accedi a  --</option>
         <?php
          require("inc/db.php");
          $q = pg_query($connection,"select * from hub order by sito asc;");
          $r = pg_num_rows($q);
          for($i=0;$i<$r;$i++){
           $id = pg_result($q, $i,"id"); 	
           $def = pg_result($q, $i,"sito");
           echo "<option value='".$id."'>".$def."</option>";
          }
         ?>
        </select>
       </div>
       <div class="hideDiv">
        <div class="logDiv">
         <i class="fa fa-user fa-fw fa-2x"></i>
         <input id="username" name="username" class="text" type="text" placeholder="Nome utente"/>
        </div>
        <div class="logDiv">
         <i class="fa fa-plug fa-fw fa-2x"></i>
         <input id="password" name="password" class="text" type="Password" placeholder="password"/>
        </div>
        <div id="username_errors" class="form_errors"></div>
        <input name="login_button" value="Accedi" type="submit" />
       </div>
     </form>
    </div>
   <?php
     }else {
   ?>
    <div id="loginTitle">Ciao <?php echo($_SESSION['username']);?></div>
    <div id="loginForm">
      <div class="loginTitle2">La tua sessione di lavoro è già aperta!</div>
      <div class="login2" id="home">Torna alla home page</div>
      <div class="login2" id="mappa">Accedi alla mappa</div>
      <form id="login_form" name="login_form" action="inc/loginScript.php" method="post">
       <input name="login" type="hidden" value="no"/>
       <input name="login_button" value="Chiudi sessione" type="submit" />
     </form>
    </div>
   <?php } ?>
   </div>
  </div><!-- wrap-->
 </div><!--container-->
<script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
<script type="text/javascript" src="lib/menu.js"></script>
<script type="text/javascript" >
 $(document).ready(function() {
   $('#home').click(function(){window.location.href= 'home.php';});
   $('#mappa').click(function(){window.location.href= 'webgis.php';});
   $('.hideDiv').hide();
   $('select[name=hub]').change(function(){
    var t=$(this).val();
    if(t!=0){$('.hideDiv').fadeIn('fast');}else{$('.hideDiv').fadeOut('fast');}
   });
 });
</script>
</body>
</html>
