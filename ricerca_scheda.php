<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);

 require_once("inc/db.php");
 $t = $_GET["tpsch"];
 $l = $_GET["liv"];
 $utente = $_SESSION['nome']. ' '.$_SESSION['cognome'];
 $idUsr = $_SESSION['id'];
 $tipoUsr = $_SESSION['tipo'];
 $data = date("Y-m-d");

switch ($l) {
  case "1": $liv='primo';break;
  case "2": $liv='secondo';break;
  case "3": $liv='terzo';break;
}
switch ($t.$l) {
 case 11: $tipo = "orali";              $logo='logoSkOrale.png';     $tab = "orale1";        $js="orale1.js";        break;
 case 12: $tipo = "orali";              $logo='logoSkOrale.png';     $tab = "orale2";        $js="orale2.js";        break;
 case 13: $tipo = "orali";              $logo='logoSkOrale.png';     $tab = "orale3";        $js="orale3.js";        break;
 case 21: $tipo = "materiali";          $logo='logoSkMateriale.png'; $tab = "materiale1";    $js="materiale1.js";    break;
 case 22: $tipo = "materiali";          $logo='logoSkMateriale.png'; $tab = "materiale2";    $js="materiale2.js";    break;
 case 23: $tipo = "materiali";          $logo='logoSkMateriale.png'; $tab = "materiale3";    $js="materiale3.js";    break;
 case 41: $tipo = "archivistiche";      $logo='logoSkArchiv.png';    $tab = "archivi1";      $js="archivi1.js";      break;
 case 42: $tipo = "archivistiche";      $logo='logoSkArchiv.png';    $tab = "archivi2";      $js="archivi2.js";      break;
 case 43: $tipo = "archivistiche";      $logo='logoSkArchiv.png';    $tab = "archivi3";      $js="archivi3.js";      break;
 case 51: $tipo = "bibliografiche";     $logo='logoSkBiblio.png';    $tab = "biblio1";       $js="biblio1.js";       break;
 case 52: $tipo = "bibliografiche";     $logo='logoSkBiblio.png';    $tab = "biblio2";       $js="biblio2.js";       break;
 //case 53: $tipo = "bibliografiche";     $logo='logoSkBiblio.png';    $tab = "biblio3";       $js="biblio3.js";       break;
 case 61: $tipo = "archeologiche";      $logo='logoSkArcheo.png';    $tab = "archeo1";       $js="archeo1.js";       break;
 case 62: $tipo = "archeologiche";      $logo='logoSkArcheo.png';    $tab = "archeo2";       $js="archeo2.js";       break;
 case 63: $tipo = "archeologiche";      $logo='logoSkArcheo.png';    $tab = "archeo3";       $js="archeo3.js";       break;
 case 71: $tipo = "fotografiche";       $logo='logoSkFoto.png';      $tab = "foto1";         $js="foto1.js";         break;
 case 72: $tipo = "fotografiche";       $logo='logoSkFoto.png';      $tab = "foto2";         $js="foto2.js";         break;
 //case 73: $tipo = "fotografiche";       $logo='logoSkFoto.png';      $tab = "foto3";         $js="foto3.js";         break;
 case 81: $tipo = "architettoniche";    $logo='logoSkArchitett.png'; $tab = "fonti_archtt1"; $js="fonti_archtt1.js"; break;
 case 82: $tipo = "architettoniche";    $logo='logoSkArchitett.png'; $tab = "fonti_archtt2"; $js="fonti_archtt2.js"; break;
 //case 83: $tipo = "architettoniche";    $logo='logoSkArchitett.png'; $tab = "fonti_archtt3"; $js="fonti_archtt3.js"; break;
 case 91: $tipo = "storico-artistiche"; $logo='logoSkStoart.png';    $tab = "stoart1";       $js="stoart1.js";       break;
 case 92: $tipo = "storico-artistiche"; $logo='logoSkStoart.png';    $tab = "stoart2";       $js="stoart2.js";       break;
 //case 93: $tipo = "storico-artistiche"; $logo='logoSkStoart.png';    $tab = "stoart3";       $js="stoart3.js";       break;
}
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
  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>

  <link href="lib/jquery_friuli/css/start/jquery-ui-1.8.10.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/ico-font/css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <link type="text/css" rel="stylesheet" href="css/jquery.qtip.min.css" />
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    input.form{height:20px !important;}
    select.form{height:28px !important;}
    /*.sezioni{background-color:#CFC4B1; cursor: default !important;}*/
    .ui-autocomplete {max-height: 100px;overflow-y: auto;overflow-x: hidden;}
     div.schAssoc{width:auto;float:left;margin:0px 10px 10px 0px;}
     .areeList{display:block;width: 98%; margin:10px 0px}
     .areeListRecord{float:left; margin:2px 10px; width:250px;}
     .areeListRecord label{font-size: 1em !important;}
     #areeAdd{border-radius: 15px;-moz-border-radius: 15px;-webkit-border-radius: 15px;margin-top: 7px;margin-bottom: 0px;}
     #ai select, #ubi select{width:95% !important;}
     #confirm{display:none;position:fixed;z-index:1000;top:100px;left:25%;height:300px;width:50%;background:rgba(255,255,255,0.7);border:2px solid #8C8C8C;box-shadow:0px 0px 20px #000;margin:0px;padding:0px;}
     #headerConfirm {padding:5px;text-align:right;}
     #headerConfirm .fa{color: rgb(203,142,46);font-size: 2.5em;}
     #contentConfirm{width:94%; margin:3% 0px 3% 5%;height:230px;overflow:auto;}
  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="content">
     <div id="logoSchedaSx"><img src="img/layout/logo.png" alt="logo" /></div>
 <div id="livelloScheda">
  <ul>
   <li id="catalogoTitle" class="livAttivo">CERCA TRA LE FONTI <?php echo (strtoupper($tipo)); ?> DI <?php echo (strtoupper($liv)); ?> LIVELLO</li>
  </ul>
 </div>
 <div id="logoSchedaDx"><img src="img/layout/loghiSchede/<?php echo($logo); ?>" alt="logo scheda archeo"></div>
 <div id="skArcheoContent">
  <div class="inner primo">
    <div style="width:450px; float:left; margin-left:-70px;">
         <input type="hidden" id="tpsch" value="<?php echo($t); ?>"/>
         <input type="hidden" id="livello" value="<?php echo($l); ?>"/>
         <table class="mainData">
          <tr>
           <td>
            <div class="arrow_box numsch">Inserire descrizione campo Inserire descrizione campo Inserire descrizione campo Inserire descrizione campo Inserire descrizione campo Inserire descrizione campo Inserire descrizione campo </div>
            <label><i class="fa fa-info-circle" data-class="numsch"></i> NUMERO SCHEDA</label>
            <textarea id="dgn_numsch" class="form obbligatorio"></textarea>
           </td>
           <td>
              <div class="arrow_box liv">Inserire descrizione campo</div>
              <label><i class="fa fa-info-circle" data-class="liv"></i> LIVELLO INDIVIDUAZIONE DATI</label>
              <select id="dgn_livind" class="form obbligatorio">
               <option value="">--seleziona un valore dalla lista --</option>
               <?php
               $query =  ("SELECT * FROM public.lista_dgn_livind order by definizione asc; ");
               $result = pg_query($connection, $query);
               $righe = pg_num_rows($result);
               $i=0;
               for ($i = 0; $i < $righe; $i++){
                $id_livind = pg_result($result, $i, "id");
                $def = pg_result($result, $i, "definizione");
                echo "<option value=\"$id_livind\">$def</option>";
               }
               ?>
              </select>
            </td>
          </tr>
          <tr>
           <td colspan="2">
             <div class="arrow_box defogg">Inserire descrizione campo</div>
             <label><i class="fa fa-info-circle" data-class="defogg"></i> DEFINIZIONE OGGETTO</label>
             <textarea id="dgn_dnogg" class="form obbligatorio"></textarea>
           </td>
          </tr>
          <tr>
           <td colspan="2">
             <div class="arrow_box note">Inserire descrizione campo</div>
             <label><i class="fa fa-info-circle" data-class="note"></i> NOTE</label>
             <textarea id="dgn_note" class="form" style="height:100px !important"></textarea>
           </td>
          </tr>
         </table>
       </div>
       <div style="float: right;width: 400px;height: 300px;margin-top: 30px !important;padding: 0px;"></div>
       <div style="clear:both"></div>
       <div class="toggle">
        <div class="sezioni" style="margin-top:20px;"><h2>DETTAGLIO CRONOLOGIA</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
              <div class="arrow_box cronoiniz">Inserire descrizione campo</div>
              <label><i class="fa fa-info-circle" data-class="cronoiniz"></i> CRONOLOGIA INIZIALE</label>
              <input type="text" id="cro_iniz" name="cro_iniz" maxlength="4" value=""  class="form"/>
             </td>
             <td>
              <div class="arrow_box cronofine">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="cronofine"></i> CRONOLOGIA FINALE</label>
              <input type="text" id="cro_fin" name="cro_fin" maxlength="4" value=""  class="form"/>
              <label class="avviso" id="croTmp"></label>
             </td>
             <td>
              <div class="arrow_box cronospec">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="cronospec"></i> CRONOLOGIA SPECIFICA</label>
              <textarea id="cro_spec" class="form" placeholder="campo testo libero"></textarea>
             </td>
             <td>
               <div class="arrow_box cronomotiv">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="cronomotiv"></i> MOTIVAZIONE CRONOLOGIA</label>
               <select id="cro_motiv" name="cro_motiv" class="form">
                <option value="">-- seleziona un valore dalla lista --</option>
                <?php
                $query =  ("SELECT * FROM public.lista_cro_motiv order by definizione asc; ");
                $result = pg_query($connection, $query);
                $righe = pg_num_rows($result);
                $i=0;
                for ($i = 0; $i < $righe; $i++){
                  $idcro = pg_result($result, $i, "id");
                  $def = pg_result($result, $i, "definizione");
                  echo "<option value=\"$idcro\">$def</option>";
                }
               ?>
              </select>
             </td>
            </tr>
            <tr>
             <td colspan="4">
              <div class="arrow_box crononote">Inserire descrizione campo</div>
              <label><i class="fa fa-info-circle" data-class="crononote"></i> NOTE</label>
              <textarea id="cro_note" class="form" style="height:100px !important"></textarea>
             </td>
           </tr>
           <tr>
            <td colspan="4">
             <label>I campi  CRONOLOGIA INIZIALE e CRONOLOGIA FINALE sono campi numerici, eventuali caratteri alfanumerici non verranno accettati.<br/>Il campo CRONOLOGIA SPECIFICA è di tipo testuale.</label>
            </td>
           </tr>
          </table>
        </div>
       </div>
       <div class="toggle">
        <div class="sezioni"><h2>COMPILAZIONE</h2></div>
        <div class="slide" style="margin:10px;">
         <table>
          <tr>
           <td style="width:50%;">
            <div class="arrow_box denric">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="denric"></i> DENOMINAZIONE RICERCA</label>
            <select id="denric" name="denric" class="form">
                 <option value="">--seleziona un valore dalla lista--</option>
                 <?php
                  $query =  ("SELECT * FROM ricerca order by denric asc; ");
                  $result = pg_query($connection, $query);
                  $righe = pg_num_rows($result);
                  $i=0;
                  for ($i = 0; $i < $righe; $i++){
                   $ric = pg_result($result, $i, "id");
                   $def = pg_result($result, $i, "denric");
                   echo "<option value=\"$ric\">$def</option>";
                  }
                 ?>
               </select>
              </td>
              <td>
                <div class="arrow_box enresp">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="enresp"></i> ENTE RESPONSABILE</label>
                <textarea id="enresp" class="form"></textarea>
              </td>   
              </tr>
              <tr>
               <td>
                <div class="arrow_box comp">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="comp"></i> COMPILATORE</label>
                <select id="compilatore" name="compilatore" class="form">
                 <option value="">--seleziona un valore dalla lista--</option>
                 <?php
                  $query =  ("SELECT * FROM usr order by cognome asc; ");
                  $result = pg_query($connection, $query);
                  $righe = pg_num_rows($result);
                  for ($i = 0; $i < $righe; $i++){
                   $idComp = pg_result($result, $i, "id_user");
                   $cognome = pg_result($result, $i, "cognome");
                   $nome = pg_result($result, $i, "nome");
                   echo "<option value=\"$idComp\">$cognome $nome</option>";
                  }
                 ?>
               </select>
               </td>
               <td>
                <div class="arrow_box respric">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="respric"></i> RESPONSABILE RICERCA</label>
                <textarea id="respric" class="form"></textarea>
               </td>
              </tr> 
              <tr>
               <td>
                <div class="arrow_box datacomp">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="datacomp"></i> DATA</label>
                <textarea id="dataric" class="form"></textarea>
               </td>
               <td>
                <div class="arrow_box compnote">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="compnote"></i> NOTE</label>
                <textarea id="noteric" class="form"></textarea>
               </td>
              </tr>
             </table>
       </div>
       <div class="toggle">
        <div class="sezioni"><h2>PROVENIENZA DATI</h2></div>
        <div class="slide" style="margin:10px;">
         <table>
          <tr>
           <td style="width:50%;">
            <div class="arrow_box provric">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="provric"></i> DENOMINAZIONE RICERCA</label>
            <select id="denricprov" name="denricprov" class="form">
                 <option value="">--seleziona un valore dalla lista--</option>
                 <?php
                  $query =  ("SELECT * FROM ricerca order by denric asc; ");
                  $result = pg_query($connection, $query);
                  $righe = pg_num_rows($result);
                  $i=0;
                  for ($i = 0; $i < $righe; $i++){
                   $ric = pg_result($result, $i, "id");
                   $def = pg_result($result, $i, "denric");
                   echo "<option value=\"$ric\">$def</option>";
                  }
                 ?>
               </select>
              </td>
              <td>
                <div class="arrow_box provenresp">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="provenresp"></i> ENTE RESPONSABILE</label>
                <textarea id="enrespprov" class="form"></textarea>
              </td>   
              </tr>
              <tr>
               <td>
                <div class="arrow_box redatt">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="redatt"></i> REDATTORE</label>
                <textarea id="redattore" class="form"></textarea>
               </td>
               <td>
                <div class="arrow_box provrespric">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="provrespric"></i> RESPONSABILE RICERCA</label>
                <textarea id="respricprov" class="form"></textarea>
               </td>
              </tr> 
              <tr>
               <td>
                <div class="arrow_box provdata">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="provdata"></i> DATA</label>
                <textarea id="dataprov" class="form"></textarea>
               </td>
               <td>
                <div class="arrow_box provnote">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="provnote"></i> NOTE</label>
                <textarea id="noteprov" class="form"></textarea>
               </td>
              </tr>
            </table>
       </div>
       <div class="toggle">
        <div class="sezioni"><h2>AREA DI INTERESSE</h2></div>
        <div class="slide">
           <table class="mainData" style="width:98% !important;" id="ai">
            <tr>
             <td>
               <div class="arrow_box aistato">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="aistato"></i> STATO</label>
               <select id="stato_update" class="form">
                <option value="">--seleziona un valore dalla lista--</option>
                <?php
                $q1 = ("SELECT DISTINCT id, stato FROM stato where id != 9 order by stato asc;");
                $q1ex = pg_query($connection, $q1);
                $q1r = pg_num_rows($q1ex);
                if($q1r != 0) {
                 for ($a1 = 0; $a1 < $q1r; $a1++){
                  $id = pg_result($q1ex, $a1,"id"); 	
                  $stato = pg_result($q1ex, $a1,"stato");
                  $stato = stripslashes($stato);
                  echo "<option value=\"$id\">$stato</option>";
                 }
                }
               ?>
              </select>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box aiprov">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="aiprov"></i> PROVINCIA</label>
               <select id="provincia_update" name="provincia_update" class="form"></select>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box aicom">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="aicom"></i> COMUNE</label>
               <select id="comune_update" name="comune_update" class="form"></select>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box ailoc">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ailoc"></i> LOCALITA'</label>
               <select id="localita_update" name="localita_update" class="form"></select>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box aiind">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="aiind"></i> INDIRIZZO</label>
               <select id="indirizzo_update" name="indirizzo_update" class="form"></select>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box aimotiv">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="aimotiv"></i> MOTIVAZIONE AREA D' INTERESSE</label>
               <select id="motiv_update" name="motiv_update" class="form">
                <option value="<?php echo($id_motiv); ?>"><?php echo($motivai); ?></option>
                <?php
                $query =  ("SELECT * FROM lista_ai_motiv order by definizione asc; ");
                $result = pg_query($connection, $query);
                $righe = pg_num_rows($result);
                for ($i = 0; $i < $righe; $i++){
                 $idMotivAi = pg_result($result, $i, "id");
                 $def = pg_result($result, $i, "definizione");
                 echo "<option value=\"$idMotivAi\">$def</option>";
                }
               ?>
              </select>
             </td>
            </tr>
           </table> 
        </div>
       </div>
       <div class="toggle">
        <div class="sezioni"><h2>UBICAZIONE</h2></div>
        <div class="slide">
          <div style="margin:10px">
           <table class="mainData" style="width:98% !important;" id="ubi">
            <tr>
             <td>
               <div class="arrow_box ubistato">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubistato"></i> STATO</label>
               <select id="statoubi_update" class="form">
                <option value="">--seleziona un valore dalla lista--</option>
                <?php
                $q1 = ("SELECT DISTINCT id, stato FROM stato where id != 9 order by stato asc;");
                $q1ex = pg_query($connection, $q1);
                $q1r = pg_num_rows($q1ex);
                if($q1r != 0) {
                 for ($a1 = 0; $a1 < $q1r; $a1++){
                  $id = pg_result($q1ex, $a1,"id"); 	
                  $stato = pg_result($q1ex, $a1,"stato");
                  $stato = stripslashes($stato);
                  echo "<option value=\"$id\">$stato</option>";
                 }
                }
               ?>
              </select>
             </td>
             <td>
               <div class="arrow_box ubitel">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubitel"></i> TELEFONO</label>
               <textarea id="ubi_tel" class="form"></textarea>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box ubiprov">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubiprov"></i> PROVINCIA</label>
               <select id="provinciaubi_update" name="provinciaubi_update" class="form"></select>
             </td>
             <td>
               <div class="arrow_box ubimail">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubimail"></i> INDIRIZZO E-MAIL</label>
               <textarea id="ubi_mail" class="form"></textarea>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box ubicom">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubicom"></i> COMUNE</label>
               <select id="comuneubi_update" name="comuneubi_update" class="form"></select>
             </td>
             <td>
               <div class="arrow_box ubiweb">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubiweb"></i> SITO WEB</label>
               <textarea id="ubi_web" class="form"></textarea>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box ubiloc">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubiloc"></i> LOCALITA'</label>
               <select id="localitaubi_update" name="localitaubi_update" class="form"></select>
             </td>
             <td rowspan="3">
               <div class="arrow_box ubinote">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubinote"></i> NOTE</label>
               <textarea id="ubi_note" class="form" style="height:180px;"></textarea>
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box ubiind">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubiind"></i> INDIRIZZO</label>
               <select id="indirizzoubi_update" name="indirizzoubi_update" class="form"></select>
             </td>
             <td>
               
             </td>
            </tr>
            <tr>
             <td>
               <div class="arrow_box ubimotiv">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="ubimotiv"></i> MOTIVAZIONE UBICAZIONE</label>
               <select id="motivubi_update" name="motivubi_update" class="form">
                <option value="<?php echo($id_motiv); ?>"><?php echo($motivai); ?></option>
                <?php
                $query =  ("SELECT * FROM lista_ai_motiv order by definizione asc; ");
                $result = pg_query($connection, $query);
                $righe = pg_num_rows($result);
                for ($i = 0; $i < $righe; $i++){
                 $idMotivAi = pg_result($result, $i, "id");
                 $def = pg_result($result, $i, "definizione");
                 echo "<option value=\"$idMotivAi\">$def</option>";
                }
               ?>
              </select>
             </td>
             <td>    
             </td>
            </tr>
           </table> 
          </div>
        </div>
       </div>
 <div class="toggle">
  <div class="sezioni"><h2>ANAGRAFICA</h2></div>
  <div class="slide" style="margin:10px;">
    <label style="display:block;">Scegli un sogetto dalla rubrica generale.</label>
    <div class="arrow_box ananome">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="ananome"></i> NOME</label>
    <select id="ana_id" name="ana_id" class="form">
     <option value="">--seleziona un valore dalla lista--</option>
     <?php
      $query =  ("SELECT * FROM anagrafica order by nome asc; ");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      for ($i = 0; $i < $righe; $i++){
       $id = pg_result($result, $i, "id");
       $nome = pg_result($result, $i, "nome");
       echo "<option value=\"$id\">$nome</option>";
      }
     ?>
    </select>
    <div class="arrow_box ananote">Inserire descrizione campo</div>
    <label><i class="fa fa-info-circle" data-class="ananote"></i> NOTE SUL SOGGETTO</label>
    <textarea id="ana_note" class="form" style="height:100px !important"></textarea>
   </div>
</div>
<div class="toggle">
 <div class="sezioni"><h2>CONSULTABILITA'</h2></div>
 <div class="slide">
  <table class="mainData" style="width:98% !important;">
   <tr>
    <td colspan="2">
     <div class="arrow_box cons">Inserire descrizione campo</div>
     <label><i class="fa fa-info-circle" data-class="cons"></i> CONSULTABILITA'</label>
     <textarea id="consultabilita" class="form" style="height:100px !important"></textarea>
    </td>
   </tr>
   <tr>
    <td>
     <div class="arrow_box orario">Inserire descrizione campo</div>
     <label><i class="fa fa-info-circle" data-class="orario"></i> ORARIO</label>
     <textarea id="orario" class="form"></textarea>
    </td>
    <td>
     <div class="arrow_box servizi">Inserire descrizione campo</div>
     <label><i class="fa fa-info-circle" data-class="servizi"></i> SERVIZI</label>
     <select id="servizi" class="form">
      <option value="">--seleziona un valore dalla lista--</option>
     <?php
      $query =  ("SELECT * FROM lista_cre_servizi order by definizione asc; ");
      $result = pg_query($connection, $query);
      $righe = pg_num_rows($result);
      for ($i = 0; $i < $righe; $i++){
       $idServ = pg_result($result, $i, "id");
       $serv = pg_result($result, $i, "definizione");
      echo "<option value='$serv'>$serv</option>";
      }
     ?>
     </select>
    </td>
   </tr>
  </table>
 </div>
</div>
<div class="toggle">
 <div class="sezioni"><h2>STATO DI CONSERVAZIONE</h2></div>
 <div class="slide">
   <table class="mainData" style="width:98% !important;">
    <tr>
     <td>
      <div class="arrow_box statocons">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="statocons"></i> STATO DI CONSERVAZIONE</label>
      <select id="scn_id" name="scn_id" class="form">
       <option value="">--seleziona un valore --</option>
        <?php
         $query =  ("SELECT * FROM lista_stato_conserv order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idScn = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$idScn\">$def</option>";
         }
        ?>
      </select>
     </td>
    </tr>
    <tr>
     <td>
      <div class="arrow_box statoconsnote">Inserire descrizione campo</div>
      <label><i class="fa fa-info-circle" data-class="statoconsnote"></i> NOTE</label>
      <textarea id="scn_note" class="form" style="height:100px !important;"></textarea>
     </td>
    </tr>
   </table>
  </div>
</div>

       <div class="toggle">
        <div class="sezioni"><h2>NOTE GENERALI</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
               <div class="arrow_box notegen">Inserire descrizione campo</div>
               <label><i class="fa fa-info-circle" data-class="notegen"></i> NOTE</label>
               <textarea id="note_gen" class="form" style="height:100px !important"></textarea>
             </td>
            </tr>
          </table>
        </div>
       </div>
       
      </div>
     </div>
    </div><!--content-->
    <?php include_once("inc/form_ricerche/".$tab.".php"); ?>
    <div class="login2" style="width:98% !important; margin:20px auto 5px;" id="findRecord">Cerca record</div>
   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
  </div><!-- wrap-->
 </div><!--container-->
 <!--div invisibili -->
  <div id="confirm">
   <div id="headerConfirm"><i class="fa fa-times-circle"></i></div>
   <div id="contentConfirm"></div>
  </div>
  <div class="loader"></div>
  <script type="text/javascript" src="lib/jquery.qtip.min-2.0.1.js"></script>
  <script type="text/javascript" src="lib/menu.js"></script>
  <script type="text/javascript" src="lib/select.js"></script>
  <script type="text/javascript" src="lib/update.js"></script>
  <!--<script type="text/javascript" src="<?php echo("inc/form_ricerche/".$js); ?>"></script>-->
<script type="text/javascript" >
var tpsch = "<? echo($tipoScheda); ?>";
var numItems;
$(document).ready(function() {
  $(document).ajaxStart(function(){$("body").addClass("loading");});
  $(document).ajaxComplete(function(){$("body").removeClass("loading");});
  $('.slide').hide();
  $('.sezioni').click(function(){
   $(this).next('.slide').slideToggle();
   $(this).toggleClass('sezAperta');
  });

  $("#comune_update").change(function () {var val=$(this).val();if (val == 15) {$("#areeAdd").fadeOut('slow');}});

  $("#motiv_update").change(function () {$("#areeAdd").fadeIn('slow');});

  $('.avviso').hide();
  $('#livello').change(function(){
    var livello_list = $(this).val();
    //alert(tpsch); return false;
    $.ajax({
     type: "POST",
     url: "inc/last_numsch.php",
     data: {livello_list:livello_list, tpsch:tpsch},
     cache: false,
     success: function(html){$("#last_numsch").html(html).fadeIn('slow');}
    });//ajax1
  });

  $('#cro_iniz').keyup(function(){
    var croTmp = $(this).val();
    $('#croTmp').fadeIn('slow').text('puoi lasciare vuoto il campo o inserire un valore >= '+croTmp);
  });

///PASSO IL VALORE DELLA CRONO INIZIALE ALLA FINALE NEL CASO IN CUI L'UTENTE NON COMPILI LA CRONO FINALE/////
/*  $('#cro_iniz').blur(function(){
    var c = $(this).val();
    $('#cro_fin').val(c);
  });
*/

////// CONTROLLO CAMPI /////////////////
  $('#cro_fin').blur(function(){
    //var checkCrono = $(this).text().length;
    var checkIniz = $('#cro_iniz').val();
    var checkFin = $('#cro_fin').val();
    if(checkFin < checkIniz){
       $(this).addClass('errore');
       alert("attenzione, valore non valido!"); return false;
    }else{
      $(this).removeClass('errore');
    }
  });


  $(".arrow_box").hide();
  $("i").hover(function(){
    var tip = $(this).data('class');
    var h = $("."+tip).height();
    $("."+tip).css("margin-top", "-"+h-15).toggle();
    //$("."+tip).toggle();
  });
  
  $('#headerConfirm .fa').click(function(){$('#confirm').fadeOut('slow');});

});
</script>
</body>
</html>
