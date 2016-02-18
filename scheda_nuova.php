<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
ini_set( "display_errors", 0);
require_once("inc/db.php");
$tipoScheda = $_GET["tpsch"];
$definizione = $_GET["def"];
$titolo = strtoupper($definizione);
$utente = $_SESSION['nome']. ' '.$_SESSION['cognome'];
$idUsr = $_SESSION['id'];
$tipoUsr = $_SESSION['tipo'];
$hub = $_SESSION['hub'];
$data = date("Y-m-d");

$dv = ($hub==2)?1286:1287;

if($tipoScheda==10){
    $opt = "<option value='".$dv."'>-- seleziona area di interesse cartografico --</option>";
    $t=3;
    $defVal = $dv;
}else{
    $opt = "<option value='".$dv."'>-- seleziona area di interesse --</option>";
    $t=1;
    $defVal = $dv;
}
$qai =  "SELECT id, nome from area where tipo = $t order by nome asc;";
$resai = pg_query($connection, $qai);
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
  <link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <link type="text/css" rel="stylesheet" href="css/jquery.qtip.min.css" />
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    input.form{height:20px !important;}
    select.form{height:28px !important;}
    .ui-autocomplete { max-height: 100px; overflow-y: auto; overflow-x: hidden;  }
     div.schAssoc{width:auto;float:left;margin:0px 10px 10px 0px;}
     .areeList{display:block;width: 100%; margin:10px 0px}
     .areeListRecord{display:inline-block; margin:2px 10px; width:45%;}
     .areeListRecord label{font-size: 1em !important;}
     #areeAdd{ border-radius: 15px; -moz-border-radius: 15px; -webkit-border-radius: 15px;  margin-top: 7px; margin-bottom: 0px;}
  </style>

</head>
<body>
 <div id="container">
  <div id="wrap">
   <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
   <div id="content">
     <?php if ($_SESSION['username']=='guest'){?>
 <div id="wrapBacheca">
  <div id="tabProg">
   <div align="center" style="padding-top:150px;">
    <img src="img/layout/noAccess.png" />
    <h1>Attenzione! Stai cercando di entrare in una sezione privata del sito</h1>
    <h3>Per visualizzare i contenuti della pagina devi prima effettuare il login.</h3>
   </div>
  </div>
 </div>
  <?php }else{ ?>
  <?php require_once('inc/logoHub.php'); ?>
 <div id="livelloScheda">
  <ul>
   <li id="catalogoTitle" class="livAttivo">STAI INSERENDO UNA NUOVA SCHEDA <?php echo($titolo); ?></li>
  </ul>
 </div>
 <div id="skArcheoContent">
  <div class="inner primo">
  <div id="tip">Prima di procedere con l'inserimento verifica che nelle liste valori siano presenti i dati necessari, altrimenti ti conviene aggiornare prima le liste valori e successivamente procedere con la compilazione della scheda.</div>
   <div class="check bassa" style="margin-top:60px !important;">
         <input type="hidden" id="tpsch" value="<?php echo($tipoScheda); ?>"/>
         <table class="mainData">
          <tr>
           <td colspan="3">* campi obbligatori</td>
          </tr>
          <tr>
           <td>
             <label>* LIVELLO</label>
             <select id="livello" class="form obbligatorio">
              <option value="">--seleziona livello--</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
             </select>
           </td>
           <td>
            <label>* NUMERO SCHEDA</label>
            <textarea id="dgn_numsch" class="form obbligatorio"></textarea>
            <label class="avviso" id="last_numsch">Ultimo numero utilizzato</label>
           </td>
           <td>
              <label>* LIVELLO INDIVIDUAZIONE DATI</label>
              <select id="dgn_livind" class="form obbligatorio">
               <option value="">--seleziona un valore dalla lista --</option>
               <?php
               $query =  ("SELECT * FROM public.lista_dgn_livind order by definizione asc; ");
               $result = pg_query($connection, $query);
               $righe = pg_num_rows($result);
               $i=0;
               for ($i = 0; $i < $righe; $i++){
                $id_livind = pg_result($result, $i, "id");
                $d = pg_result($result, $i, "definizione");
                echo "<option value=\"$id_livind\">$d</option>";
               }
               ?>
              </select>
            </td>
          </tr>
          <tr>
           <td colspan="3">
             <label>* DEFINIZIONE OGGETTO</label>
             <textarea id="dgn_dnogg" class="form obbligatorio"></textarea>
           </td>
          </tr>
          <tr>
           <td colspan="3">
             <label>NOTE</label>
             <textarea id="dgn_note" class="form" style="height:100px !important"></textarea>
           </td>
          </tr>
          <tr class="compilatoreFirst">
           <td>
             <label>COMPILATORE</label><br/>
             <label style="font-weight:bold;"><?php echo($utente); ?></label>
             <input id="compilatore" type="hidden" value="<?php echo($idUsr); ?>">
           </td>
           <td>
            <label>DATA</label><br/>
            <label style="font-weight:bold;"><?php echo($data); ?></label>
            <input id="data_compilazione" type="hidden" value="<?php echo($data); ?>">
           </td>
           <td></td>
          </tr>
         </table>
       </div>
       <div style="clear:both"></div>

       <?php

        ?>
       <div class="toggle check bassa">
        <div class="sezioni" style="margin-top:20px;"><h2>DETTAGLIO CRONOLOGIA</h2></div>

        <div class="slide">
           <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
              <label>CRONOLOGIA INIZIALE</label>
              <input type="text" id="cro_iniz" name="cro_iniz" maxlength="4" value="0"  class="form"/>
             </td>
             <td>
              <label>CRONOLOGIA FINALE</label>
              <input type="text" id="cro_fin" name="cro_fin" maxlength="4" value="0"  class="form"/>
              <label class="avviso" id="croTmp"></label>
             </td>
             <td>
              <label>CRONOLOGIA SPECIFICA</label>
              <textarea id="cro_spec" class="form" placeholder="campo testo libero"></textarea>
             </td>
             <td>
               <label>MOTIVAZIONE CRONOLOGIA</label>
               <select id="cro_motiv" name="cro_motiv" class="form">
                <option value="18">-- seleziona un valore dalla lista --</option>
                <?php
                $query =  ("SELECT * FROM public.lista_cro_motiv order by definizione asc; ");
                $result = pg_query($connection, $query);
                $righe = pg_num_rows($result);
                $i=0;
                for ($i = 0; $i < $righe; $i++){
                  $idcro = pg_result($result, $i, "id");
                  $d = pg_result($result, $i, "definizione");
                  echo "<option value=\"$idcro\">$d</option>";
                }
               ?>
              </select>
             </td>
            </tr>
            <tr>
             <td colspan="4">
              <label>NOTE</label>
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
      <?php if($hub==1){ ?>
       <div class="toggle check bassa">
        <div class="sezioni"><h2>COMPILAZIONE</h2></div>
        <div class="slide" style="margin:10px;">
         <label style="display:block;">Scegli la ricerca o il progetto per il quale si sta compilando la presente scheda.</label>
          <label>DENOMINAZIONE RICERCA</label>
          <select id="cmp_id" name="cmp_id" class="form">
           <option value="1">--seleziona un valore dalla lista--</option>
           <?php
            $query =  ("SELECT * FROM ricerca WHERE hub = ".$_SESSION['hub']." order by denric asc; ");
            $result = pg_query($connection, $query);
            $righe = pg_num_rows($result);
            for ($i = 0; $i < $righe; $i++){
             $ric = pg_result($result, $i, "id");
             $def = pg_result($result, $i, "denric");
             $def = stripslashes($def);
             echo "<option value=\"$ric\">$def</option>";
            }
           ?>
          </select>
          <div id="dati_ricerca_cmp"></div>
          <label>NOTE</label>
          <textarea id="cmp_note" class="form" style="height:100px !important"></textarea>
        </div>
       </div>
      <?php } ?>
       <div class="toggle check">
        <div class="sezioni"><h2>PROVENIENZA DATI</h2></div>

        <div class="slide" style="margin:10px;">
         <label style="display:block;">Scegli la ricerca o il progetto dal quale provengono i dati che hanno permesso la compilazione della presente scheda.</label>
              <label>DENOMINAZIONE RICERCA</label>
              <select id="prv_id" name="prv_id" class="form">
               <option value="1">--seleziona un valore dalla lista--</option>
               <?php
                $query =  ("SELECT * FROM ricerca order by denric asc; ");
                $result = pg_query($connection, $query);
                $righe = pg_num_rows($result);
                $i=0;
                for ($i = 0; $i < $righe; $i++){
                  $ric = pg_result($result, $i, "id");
                  $def = pg_result($result, $i, "denric");
                  $def = stripslashes($def);
                  echo "<option value=\"$ric\">$def</option>";
                }
               ?>
              </select>
              <div id="dati_ricerca_prv"></div>
              <label>NOTE</label>
              <textarea id="prv_note" class="form" style="height:100px !important"></textarea>
        </div>
       </div>
       <div class="toggle check bassa">
        <div class="sezioni"><h2>AREA DI INTERESSE</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
          <tr>
           <td>
            <label>Seleziona un'area dall'elenco</label>
            <select id="id_area" name="id_area" class="form">
             <?php
                echo $opt;
                while($x = pg_fetch_array($resai)){ echo "<option value='".$x['id']."'>".$x['nome']."</option>"; }
            ?>
            </select>
          </td>
          <td>
           <label>MOTIVAZIONE AREA DI INTERESSE</label>
           <select id="motiv_update" name="motiv_update" class="form">
            <option value="16">--seleziona un valore dalla lista--</option>
            <?php
             $query =  ("SELECT * FROM lista_ai_motiv order by definizione asc; ");
             $result = pg_query($connection, $query);
             while($x = pg_fetch_array($result)){ echo "<option value='".$x['id']."'>".$x['definizione']."</option>"; }
            ?>
           </select>
           </td>
           <td>
            <div class="login2" id="areeAdd" style="font-size: 1.5em;">+</div>
           </td>
          </tr>
          <tr>
           <td colspan="3">
            <label id="areeMsg"><b>Se vuoi aggiungere un'area alla scheda devi selezionare un valore dalla lista e aggiungere una motivazione, altrimenti lascia la sezione vuota.</b></label>
           <div id="areeWrap">
            <label><b>ELENCO AREE SELEZIONATE</b></label>
            <div id="aree">
             <div class="areeList" id="areaDefault" val="<?php echo $defVal; ?>,16"></div>
            </div>
            <div id="areeListCanc" class="login2" style="font-size:1.2em;width:250px !important;margin-top:10px;"></div>
           </div>
           </td>
          </tr>
          <tr>
           <td colspan="3">
            <label>NOTE</label>
            <textarea id="noteAi" class="form" placeholder="Inserisci note" style="height:100px !important"></textarea>
           </td>
          </tr>
         </table>

        </div>
       </div>
       <div class="toggle check">
        <div class="sezioni"><h2>UBICAZIONE</h2></div>
        <div class="slide">
          <div style="margin:10px">
           <label>ANAGRAFICA UBICAZIONE</label>
           <select id="ana_ubi" name="ana_ubi" class="form">
            <option value="1107">--seleziona un valore dalla lista--</option>
            <?php
             $query = "SELECT a.id, a.nome AS area, an.nome FROM aree, area a, anagrafica an  WHERE aree.nome_area = a.id  AND aree.id_rubrica = an.id  AND a.tipo = 2;";
             $result = pg_query($connection, $query);
             while($x = pg_fetch_array($result)){ echo "<option value='".$x['id']."'>".$x['area']." - ".$x['nome']."</option>"; }
            ?>
           </select>
           <label>MOTIVAZIONE UBICAZIONE</label>
           <select id="motivubi_update" name="motivubi_update" class="form">
            <option value="16">--seleziona un valore dalla lista--</option>
            <?php
             $query =  ("SELECT * FROM lista_ai_motiv order by definizione asc; ");
             $result = pg_query($connection, $query);
             while ($m = pg_fetch_array($result)) { echo "<option value='".$m['id']."'>".$m['definizione']."</option>"; }
            ?>
           </select>
           <div id="ubi_info" style="margin:0px 10px;"></div>
            <label>NOTE</label>
            <textarea id="noteUbi" class="form" placeholder="Inserisci note" style="height:100px !important"></textarea>
          </div>
        </div>
       </div>

 <div class="toggle check bassa">
  <div class="sezioni"><h2>ANAGRAFICA</h2></div>
  <div class="slide" style="margin:10px;">
    <label style="display:block;">Scegli un sogetto dalla rubrica generale.</label>
    <label>NOME</label>
    <select id="ana_id" name="ana_id" class="form">
     <option value="7">--seleziona un valore dalla lista--</option>
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
    <div id="ana_info"></div>
    <label>NOTE SUL SOGGETTO RELATIVE ALLA NUOVA SCHEDA</label>
    <textarea id="ana_note" class="form" style="height:100px !important"></textarea>
   </div>
</div>

       <div class="toggle check">
        <div class="sezioni"><h2>CONSULTABILITA'</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td colspan="2">
  <label>CONSULTABILITA'</label>
  <textarea id="consultabilita" class="form" style="height:100px !important"></textarea>
   </td>
  </tr>
  <tr>
   <td>
  <label>ORARIO</label>
  <textarea id="orario" class="form"></textarea>
   </td>
   <td>
  <label>SERVIZI</label>
<?php
    $query =  ("SELECT * FROM lista_cre_servizi order by definizione asc; ");
    $result = pg_query($connection, $query);
    $righe = pg_num_rows($result);
    $i=0;
    for ($i = 0; $i < $righe; $i++){
      $idServ = pg_result($result, $i, "id");
      $serv = pg_result($result, $i, "definizione");
      echo "<label for='servizio$serv' style='display:block;cursor:pointer;margin-bottom:3px; padding-right:3px;'><input type='checkbox' name='servizi' id='servizio$serv' value='$serv' />$serv</label>";
    }
  ?>
             </td>
           </tr>
          </table>
        </div>
       </div>

       <?php

       ?>
       <div class="toggle check">
        <div class="sezioni"><h2>STATO DI CONSERVAZIONE</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
  <label>STATO CONSERVAZIONE</label>
  <select id="scn_id" name="scn_id" class="form">
       <option value="7">--seleziona un valore --</option>
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
  <label>NOTE</label>
  <textarea id="scn_note" class="form" style="height:100px !important;"></textarea>
             </td>
           </tr>
          </table>
        </div>
       </div>
       <?php

       ?>

       <div class="toggle check bassa">
        <div class="sezioni"><h2>SCHEDE CORRELATE</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td colspan="2">
              <label>Inizia a digitare il nome della scheda da associare (es. "ARCHEO-"), la ricerca non è case sensitive.</label>
             </td>
            </tr>
            <tr>
             <td style="width:150px;">
              <input class="form" id="term" style="width:150px !important;"/>
              <label id="numItems"></label>
              <div class="login2" id="schAssocCanc" style="font-size:1em; width:90% !important;">Annulla immissione</div>
             </td>
             <td id="result">
             </td>
           </tr>
          </table>
        </div>
       </div>

      <?php if($hub==2){ ?>
       <div class="toggle check bassa">
        <div class="sezioni"><h2>COMPILAZIONE</h2></div>
        <div class="slide" style="margin:10px;">
         <label style="display:block;">Scegli la ricerca o il progetto per il quale si sta compilando la presente scheda.</label>
          <label>DENOMINAZIONE RICERCA</label>
          <select id="cmp_id" name="cmp_id" class="form">
           <option value="1">--seleziona un valore dalla lista--</option>
           <?php
            $query =  ("SELECT * FROM ricerca WHERE hub = ".$_SESSION['hub']." order by denric asc; ");
            $result = pg_query($connection, $query);
            $righe = pg_num_rows($result);
            for ($i = 0; $i < $righe; $i++){
             $ric = pg_result($result, $i, "id");
             $def = pg_result($result, $i, "denric");
             echo "<option value=\"$ric\">$def</option>";
            }
           ?>
          </select>
          <div id="dati_ricerca_cmp"></div>
          <label>NOTE</label>
          <textarea id="cmp_note" class="form" style="height:100px !important"></textarea>
        </div>
       </div>
      <?php } ?>

       <div class="toggle check">
        <div class="sezioni"><h2>NOTE GENERALI</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
               <label>NOTE</label>
               <textarea id="note_gen" class="form" style="height:100px !important"></textarea>
             </td>
            </tr>
          </table>
        </div>
       </div>
       <?php if($tipoUsr != 3) {?>
       <div id="fine">
        <label style="display:block;">Vuoi chiudere subito la scheda e renderla pubblica o preferisci lasciarla aperta e chiuderla in un secondo momento?</label>
        <br/>
        <label><input type="radio" name="fine" value="1" checked /> lascia aperta</label>
        <label><input type="radio" name="fine" value="2" /> chiudi scheda</label>
       </div>
       <?php }else {?>
        <div id="fine">
        <label style="display:block;">STATO SCHEDA</label>
        <br/>
        <label><input type="radio" name="fine" value="1" checked /> scheda aperta</label>
       </div>
       <?php } ?>
       <div>
        <table class="mainData" style="width:300px !important;">
         <tr class="compilatoreLast">
          <td>
           <label>COMPILATORE</label><br/>
           <label style="font-weight:bold;"><?php echo($utente); ?></label>
           <input id="compilatore" type="hidden" value="<?php echo($idUsr); ?>">
          </td>
          <td>
           <label>DATA</label><br/>
           <label style="font-weight:bold;"><?php echo($data); ?></label>
           <input id="data_compilazione" type="hidden" value="<?php echo($data); ?>">
          </td>
         </tr>
       </table>
       </div>
       <div class="login2" style="width:98% !important; margin:20px auto 5px;" id="salva">Salva dati</div>
      </div>
     </div>
     <?php } ?>
    </div><!--content-->

   <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->


  </div><!-- wrap-->
 </div><!--container-->

 <!--div invisibili -->
  <div id="confirm"></div>
 <script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
 <script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
  <script type="text/javascript" src="lib/jquery.qtip.min-2.0.1.js"></script>
  <script type="text/javascript" src="lib/menu.js"></script>
  <script type="text/javascript" src="lib/select.js"></script>
  <script type="text/javascript" src="lib/update.js"></script>
  <script type="text/javascript" src="lib/funzioni.js"></script>

<script type="text/javascript" >
var tpsch = "<?php echo($tipoScheda); ?>";
var hub = '<?php echo($hub); ?>';
var def = <?php echo($defVal); ?>;
var numItems;
$(document).ready(function() {
  $('#tip').fadeIn(3000).delay(5000).fadeOut("slow");
  $('#servizionessuno').attr('checked', 'checked');//checkbox servizi consultabilità
  $('.slide').hide();
  $('.sezioni').click(function(){
   $(this).next('.slide').slideToggle();
   $(this).toggleClass('sezAperta');
  });

  $("#schAssocCanc").hide();
  if(hub==1){$("tr.compilatoreLast").remove();}
  if(hub==2){
   $( "div.check:not([class~='bassa']), #note" ).hide();
   //$("#areaDefault").attr("val","1286,16");
   $("tr.compilatoreFirst").remove();
  }

  $( "#term" ).autocomplete({
      source: "inc/autocomplete.php",
      minLength: 2,
      select: function( event, ui ) {
        //alert(ui.item.id+'\n'+ui.item.value); return false;
        $("td#result").append("<div class='schAssoc' livello='"+ui.item.livello+"'tpsch='"+ui.item.tpsch+"' id='"+ui.item.id+"'>"+ui.item.value+"</div>");
        $(this).val("");
        numItems = $('.schAssoc').length;
        $('#numItems').text('Schede associate: '+numItems);
        $("#schAssocCanc").fadeIn('slow');
        event.preventDefault();
      }
    });

   $('#schAssocCanc').click(function(){
      $("div[class=schAssoc]:last").remove();
      numItems = $('.schAssoc').length;
      $('#numItems').text('Schede associate: '+numItems);
      if (numItems == 0) {$(this).fadeOut('slow');}
   });

   $("#areeWrap, #areeListCanc").hide();
    $("#areeAdd").click(function () {
        $("#areaDefault").remove();
        var id_area=$("#id_area").val();
        var motiv=$("#motiv_update").val();
        if(id_area == def || motiv == 20){return false; }
        else{
            $("#areeMsg").fadeOut('fast');
            var area = $( "#id_area option:selected" ).text();
            var motivTxt = $( "#motiv_update option:selected" ).text();
            $("#aree").append('<div class="areeList" val="'+id_area+','+motiv+'"><div class="areeListRecord"><label>'+area+'</label></div><div class="areeListRecord"><label>'+motivTxt+'</label></div></div>');
            $("#areeWrap, #areeListCanc").fadeIn('slow');
            areeFunc();
        }
    });

    $("#areeListCanc").click(function(){
        $("div[class=areeList]:last").remove();
        areeFunc();
    });

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
    $('#croTmp').fadeIn('slow').text('Valore permesso >= '+croTmp);
  });


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

 $('#salva').click(function(){
   //////// TAB SCHEDA //////////////////////////////////////
   //dati generali
   var tpsch = $("#tpsch").val();
   var livello = $('#livello').val();
   var dgn_numsch = $('#dgn_numsch').val();
   var dgn_livind = $('#dgn_livind').val();
   var dgn_dnogg = $('#dgn_dnogg').val();
   var dgn_note = $('#dgn_note').val();
   var compilatore = $('#compilatore').val();
   var data_compilazione = $('#data_compilazione').val();

   //COMPILAZIONE
   var cmp_id = $('#cmp_id').val();
   cmp_id = (hub==2 && cmp_id==1)?'63': cmp_id;
   var cmp_note = $('#cmp_note').val();

   //PROVENIENZA
   var prv_id = (hub==2)?'1': $('#prv_id').val();
   var prv_note = $('#prv_note').val();

   //ANAGRAFICA
   var ana_id = $('#ana_id').val();
   var ana_note = $('#ana_note').val();

   //STATO DI CONSERVAZIONE
   var scn_id = $('#scn_id').val();
   var scn_note = $('#scn_note').val();

   //NOTE GENERALI
   var note_gen = $('#note_gen').val();
   var fine = $('input[name=fine]').val();

   //////// CRONOLOGIA //////////////////////////////////////
   var cro_iniz = $('#cro_iniz').val();
   var cro_fin = $('#cro_fin').val();
   var cro_spec = $('#cro_spec').val();
   var cro_motiv = $('#cro_motiv').val();
   var cro_note = $('#cro_note').val();

   //////// AREE_SCHEDA //////////////////////////////////////
   var areeList = '';
   $("div.areeList").each(function(){areeList += $(this).attr('val') + '|';});
   var noteAi = $('#noteAi').val();
   //alert(areeList); return false;

   //////// UBI_SCHEDA //////////////////////////////////////
   var motivubi_update = $('#motivubi_update').val();
   var ana_ubi = $('#ana_ubi').val();
   var noteUbi = $('#noteUbi').val();
   //////// CONSULTABILITA //////////////////////////////////////
   var consultabilita = $('#consultabilita').val();
   var orario = $('#orario').val();
   var servizi='';
   $("input[name=servizi]:checked").each(function () {
    var s = $(this).val();
    servizi+=s+', ';
   });
   //var id_servizi = $('#id_servizi').val();

   //////// TAB ALTRIF //////////////////////////////////////
   //creare array per i div.schAssoc
   var schAssoc ='';
   $("div.schAssoc").each(function(){
      var id = $(this).attr('id');
      var tpsch = $(this).attr('tpsch');
      var livello = $(this).attr('livello');
      schAssoc += id + ','+tpsch+','+livello+'|';
   });
   //alert(schAssoc+'\n'); return false;
   //ricordati di esplodere l'array nello script di inserimento!!!!
   //console.log(cmp_id);return false;
   var errori = '';
   if (!livello) {errori += '<li>LIVELLO</li>';$('#livello').addClass('errore');}else{$('#livello').removeClass('errore');}
   if (!dgn_numsch) {errori += '<li>NUMERO SCHEDA</li>';$('#dgn_numsch').addClass('errore');}else{$('#dgn_numsch').removeClass('errore');}
   if (!dgn_livind) {errori += '<li>LIVELLO INDIVIDUAZIONE DATI</li>';$('#dgn_livind').addClass('errore');}else{$('#dgn_livind').removeClass('errore');}
   if (!dgn_dnogg) {errori += '<li>DEFINIZIONE OGGETTO</li>';$('#dgn_dnogg').addClass('errore');}else{$('#dgn_dnogg').removeClass('errore');}
   if (ana_ubi!=1107 && motivubi_update == 20) {errori+= '<li>MOTIVAZIONE UBICAZIONE</li>';$('#motivubi_update').addClass('errore');}else {$('#motivubi_update').removeClass('errore');}
   if(errori){
   	//alert('I sguenti campi sono obbligatori e vanno compilati: \n' + errori); return false;
   	errori = '<h3>I seguenti campi sono obbligatori e vanno compilati:</h3><ol>' + errori;
        $("<div id='errorDialog'>" + errori + "</ol></div>").dialog({
          resizable: false,
          width: 'auto',
          title:'Errori',
          modal: true,
          buttons: {'Chiudi finestra': function() {$(this).dialog('close');} }//buttons
       });//dialog
       return false;
   }else{
    $.ajax({
          url: 'inc/scheda_nuova_script.php',
          type: 'POST',
          data: {
            id_area:$("#id_area").val(),
            motiv:$("#motiv_update").val(),
            tpsch:tpsch,
            livello:livello,
            dgn_numsch:dgn_numsch,
            dgn_livind:dgn_livind,
            dgn_dnogg:dgn_dnogg,
            dgn_note:dgn_note,
            compilatore:compilatore,
            data_compilazione:data_compilazione,
            cmp_id:cmp_id,
            cmp_note:cmp_note,
            prv_id:prv_id,
            prv_note:prv_note,
            ana_id:ana_id,
            ana_note:ana_note,
            scn_id:scn_id,
            scn_note:scn_note,
            note_gen:note_gen,
            fine:fine,
            cro_iniz:cro_iniz,
            cro_fin:cro_fin,
            cro_spec:cro_spec,
            cro_motiv:cro_motiv,
            cro_note:cro_note,
            areeList:areeList,
            noteAi:noteAi,
            noteUbi:noteUbi,
            motivubi_update:motivubi_update,
            ana_ubi:ana_ubi,
            consultabilita:consultabilita,
            orario:orario,
            servizi:servizi,
            schAssoc:schAssoc},
          success: function(data){
               //alert('Record inserito correttamente');
              $("#confirm").html(data);
              $("#confirm").dialog({
                 resizable: false,
                 width:600,
                 title:'Risultato query'
              });//dialog
           }//success
        });//ajax
   }
 });

});
</script>
</body>
</html>
