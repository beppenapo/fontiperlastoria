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
 $data = date("Y-m-d");
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
  <link href="lib/jquery_friuli/css/start/jquery-ui-1.8.10.custom.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <link type="text/css" rel="stylesheet" href="css/jquery.qtip.min.css" />
  <script type="text/javascript" src="lib/jquery-core/jquery-1.4.4.min.js"></script>
  <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    input.form, textarea.form{height:20px !important;}
    select.form{height:28px !important;}
    .sezioni{background-color:#CFC4B1; cursor: default !important;}
    .ui-autocomplete {
      max-height: 100px;
      overflow-y: auto;
      overflow-x: hidden;
     }
     div.schAssoc{width:auto;float:left;margin:0px 10px 10px 0px;}
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
     <div id="logoSchedaSx"><img src="img/layout/logo.png" alt="logo" /></div>
 <div id="livelloScheda">
  <ul>
   <li id="catalogoTitle" class="livAttivo">STAI INSERENDO UNA NUOVA SCHEDA <?php echo($titolo); ?></li>
  </ul>
 </div>
 <div id="skArcheoContent">
  <div class="inner primo">
   <div>
    <div id="tip">Prima di procedere con l'inserimento verifica che nelle liste valori siano presenti i dati necessari, altrimenti ti conviene aggiornare prima le liste valori e successivamente procedere con la compilazione della scheda.</div>
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
                $def = pg_result($result, $i, "definizione");
                echo "<option value=\"$id_livind\">$def</option>";
               }
               ?>
              </select>
            </td>
          </tr>
          <tr>
           <td colspan="2">
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
         </table>
       </div>
       <div style="clear:both"></div>

       <?php

        ?>
       <div class="toggle">
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

       <?php

       ?>
       <div class="toggle">
        <div class="sezioni"><h2>COMPILAZIONE</h2></div>

        <div class="slide">
          <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
               <label>DENOMINAZIONE RICERCA</label>
                <select id="denric_update" name="denric_update" class="form">
                 <option value="0">--seleziona un valore dalla lista--</option>
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
               <label style="font-size:1em;">Selezionando una ricerca dall'elenco verranno automaticamente compilati i campi ENTE RESPONSABILE e RESPONSABILE RICERCA</label>
             <div id="tabellaRicerca">
              <label>ENTE RESPONSABILE</label>
              <textarea id="enteresp_update" class="form"></textarea>
              <br/>
              <label>RESPONSABILE RICERCA</label>
              <textarea id="respric_update" class="form"></textarea>
            </div>
             </td>
             <td>
               <label>COMPILATORE</label>
               <select id="cmp_id" class="form">
                <option value="<?php echo($idUsr); ?>"><?php echo($utente); ?></option>
                <?php
                  $query =  ("SELECT * FROM usr where id_user != $idUsr order by cognome asc; ");
                  $result = pg_query($connection, $query);
                  $righe = pg_num_rows($result);
                  $i=0;
                  for ($i = 0; $i < $righe; $i++){
                   $cmpId = pg_result($result, $i, "id_user");
                   $cmpNome = pg_result($result, $i, "nome");
                   $cmpCognome = pg_result($result, $i, "cognome");
                   echo "<option value=\"$cmpId\">$cmpCognome $cmpNome</option>";
                  }
                 ?>
               </select>
               <!--<input type="text" id="compilatore_update" class="form"><?php echo($utente); ?></textarea>-->
               <br/>
               <label>DATA</label>
               <textarea id="datacmp_update" class="form"><?php echo($data); ?></textarea>
             </td>
            </tr>
            <tr>
             <td colspan="2">
               <label>NOTE</label>
               <textarea id="notecmp" class="form" style="height:100px !important"></textarea>
             </td>
           </tr>
          </table>
        </div>
       </div>

       <?php

       ?>
       <div class="toggle">
        <div class="sezioni"><h2>PROVENIENZA DATI</h2></div>

        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
              <label>DENOMINAZIONE RICERCA</label>
              <select id="denricprv_update" name="denricprv_update" class="form">
               <option value="0">--seleziona un valore dalla lista--</option>
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
              <label style="font-size:1em;">Selezionando una ricerca dall'elenco verranno automaticamente compilati i campi ENTE RESPONSABILE e RESPONSABILE RICERCA</label>
              <div id="tabellaRicercaPrv">
               <!-- tabella ricerca -->
               <label>ENTE RESPONSABILE</label>
               <textarea id="enrespprv_update" class="form"></textarea>

               <!-- tabella ricerca -->
               <label>RESPONSABILE RICERCA</label>
               <textarea id="respricprv_update" class="form"></textarea>
              </div>
             </td>
             <td>
              <!-- tabella compilazione -->
              <label>REDATTORE</label>
              <select id="prv_id" class="form">
                <option value="<?php echo($idUsr); ?>"><?php echo($utente); ?></option>
                <?php
                  $query =  ("SELECT * FROM usr where id_user != $idUsr order by cognome asc; ");
                  $result = pg_query($connection, $query);
                  $righe = pg_num_rows($result);
                  $i=0;
                  for ($i = 0; $i < $righe; $i++){
                   $prvId = pg_result($result, $i, "id_user");
                   $prvNome = pg_result($result, $i, "nome");
                   $prvCognome = pg_result($result, $i, "cognome");
                   echo "<option value=\"$prvId\">$prvCognome $prvNome</option>";
                  }
                 ?>
               </select>
              <!--<textarea id="compilatoreprv_update" class="form"><?php echo($utente); ?></textarea>-->
              <br/>
              <!-- tabella compilazione -->
              <label>DATA</label>
              <textarea id="dataprv_update" class="form"><?php echo($data); ?></textarea>
             </td>
            </tr>
            <tr>
              <td colspan="2">
              <!-- tabella compilazione -->
              <label>NOTE</label>
              <textarea id="noteprv_update" class="form" style="height:100px !important"></textarea>
             </td>
           </tr>
          </table>
        </div>
       </div>

       <?php

       ?>
       <div class="toggle">
        <div class="sezioni"><h2>AREA DI INTERESSE</h2></div>

        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
              <label>STATO</label>
              <select id="stato_update" name="stato_update" class="form">
               <option value="0">-- seleziona uno Stato --</option>
               <?php
                $query =  ("SELECT * FROM stato order by stato asc; ");
                $result = pg_query($connection, $query);
                $righe = pg_num_rows($result);
                $i=0;
                for ($i = 0; $i < $righe; $i++){
                 $idStato = pg_result($result, $i, "id");
                 $def = pg_result($result, $i, "stato");
                 echo "<option value=\"$idStato\">$def</option>";
                }
               ?>
              </select>
             </td>
             <td>
              <label>PROVINCIA</label>
              <select id="provincia_update" name="provincia_update" class="form" >
               <option value="0"></option>

              </select>
             </td>
             <td>
              <label>COMUNE</label>
              <select id="comune_update" name="comune_update" class="form disabilitata" disabled>
                <option value="0"></option>

              </select>
             </td>
           </tr>
           <tr>
            <td>
 <label>LOCALITA'</label>
 <select id="localita_update" name="localita_update" class="form disabilitata" disabled>
   <option value="0"></option>

  </select>
 </select>
           </td>
           <td>
 <label>INDIRIZZO</label>
  <select id="indirizzo_update" name="indirizzo_update" class="form disabilitata" disabled>
   <option value="0"></option>

  </select>
        </td>
        <td>
 <label>MOTIVAZIONE AREA DI INTERESSE</label>
 <select id="motiv_update" name="motiv_update" class="form">
       <option value="0">--seleziona un valore dalla lista--</option>
       <?php
         $query =  ("SELECT * FROM lista_ai_motiv order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
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

       <?php

       ?>
       <div class="toggle">
        <div class="sezioni"><h2>UBICAZIONE</h2></div>

        <div class="slide">

         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
  <label>STATO</label>
  <select id="statoubi_update" name="statoubi_update" class="form">
       <option value="0">--Seleziona uno Stato--</option>
       <?php
         $query =  ("SELECT * FROM stato order by stato asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idStatoUbi = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "stato");
           echo "<option value=\"$idStatoUbi\">$def</option>";
         }
       ?>
  </select>
  </td>
  <td>
  <label>PROVINCIA</label>
  <select id="provinciaubi_update" name="provinciaubi_update" class="form">
       <option value="0"></option>

  </select>
  </td>
  <td>
 <label>COMUNE</label>
 <select id="comuneubi_update" name="comuneubi_update" class="form disabilitata" disabled>
       <option value="0"></option>

  </select>
  </td>
 </tr>
 <tr>
  <td>
 <label>LOCALITA'</label>
 <select id="localitaubi_update" name="localitaubi_update" class="form disabilitata" disabled>
   <option value="0"></option>

 </select>
  </td>
  <td>
 <label>INDIRIZZO</label>
  <select id="indirizzoubi_update" name="indirizzoubi_update" class="form disabilitata" disabled>
   <option value="0"></option>

  </select>
  </td>
  <td>
  <label>MOTIVAZIONE UBICAZIONE</label>
 <select id="motivubi_update" name="motivubi_update" class="form">
       <option value="0">--Seleziona un vaore dalla lista--</option>
       <?php
         $query =  ("SELECT * FROM lista_ai_motiv where id != $id_motiv order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idMotivAi = pg_result($result, $i, "id");
           $def = pg_result($result, $i, "definizione");
           echo "<option value=\"$idMotivAi\">$def</option>";
         }
       ?>
  </select>
  </td>
 </tr>
 <tr>
  <td>
  <label>TELEFONO</label>
  <textarea id="telubi" class="form"></textarea>
  </td>
  <td>
  <label>INDIRIZZO E-MAIL</label>
  <textarea id="mailubi" class="form"></textarea>
  </td>
  <td>
  <label>SITO WEB</label>
  <textarea id="webubi" class="form"></textarea>
             </td>
           </tr>
          </table>
        </div>
       </div>

      <?php

      ?>
       <div class="toggle">
        <div class="sezioni"><h2>ANAGRAFICA</h2></div>
         <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
  <label>NOME</label>
  <textarea id="nome_ana_update" class="form"></textarea>
 </td>
 <td>
  <label>COMUNE</label>
  <select id="comune_ana_update" name="comune_ana_update" class="form">
       <option value="0">--Seleziona un Comune dalla lista--</option>
       <?php
         $query =  ("SELECT * FROM public.comune order by comune asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idComAna = pg_result($result, $i, "id");
           $defComAna = pg_result($result, $i, "comune");
           echo "<option value=\"$idComAna\">$defComAna</option>";
         }
       ?>
  </select>
 </td>
 <td>
  <label>LOCALITA'</label>
  <select id="localita_ana_update" name="localita_ana_update" class="form disabilitata" disabled>
   <option value="0"></option>
       <?php
         $query = ("SELECT localita.id AS id_localita, localita.comune AS id_comune, comune.comune, localita.localita FROM public.localita, public.comune WHERE localita.comune = comune.id order by localita asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idLocAna = pg_result($result, $i, "id_localita");
           $locAna = pg_result($result, $i, "localita");
           echo "<option value=\"$idLocAna\">$locAna</option>";
         }
       ?>
  </select>
 </td>
 <td>
 <label>INDIRIZZO</label>
  <select id="indirizzo_ana_update" name="indirizzo_ana_update" class="form disabilitata" disabled>
   <option value="0"></option>
       <?php
         $query =  ("SELECT indirizzo.id AS id_indirizzo, indirizzo.comune as id_comune, comune.comune, indirizzo.indirizzo FROM comune,indirizzo WHERE indirizzo.comune = comune.id order by indirizzo asc;");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idIndAna = pg_result($result, $i, "id_indirizzo");
           $indAna = pg_result($result, $i, "indirizzo");
           echo "<option value=\"$idIndAna\">$indAna</option>";
         }
       ?>
  </select>
 </td>
</tr>
<tr>
 <td>
  <label>TELEFONO</label>
  <textarea id="tel_ana" class="form"></textarea>
 </td>
 <td>
  <label>INDIRIZZO E-MAIL</label>
  <textarea id="mail_ana" class="form"></textarea>
 </td>
 <td>
  <label>SITO WEB</label>
  <textarea id="web_ana" class="form"></textarea>
 </td>
 <td></td>
 </tr>
 <tr>
 <td colspan="4">
  <label>NOTE</label>
  <textarea id="note_ana" class="form" style="height:100px !important"></textarea>
 </td>
</tr>
</table>
 </div>
</div>

       <div class="toggle">
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
  <select id="servizi" name="servizi_update" class="form">
       <option value="0">-- seleziona un valore --</option>
       <?php
         $query =  ("SELECT * FROM lista_cre_servizi order by definizione asc; ");
         $result = pg_query($connection, $query);
         $righe = pg_num_rows($result);
         $i=0;
         for ($i = 0; $i < $righe; $i++){
           $idServ = pg_result($result, $i, "id");
           $serv = pg_result($result, $i, "definizione");
           echo "<option value=\"$idServ\">$serv</option>";
         }
       ?>
  </select>
             </td>
           </tr>
          </table>
        </div>
       </div>

       <?php

       ?>
       <div class="toggle">
        <div class="sezioni"><h2>STATO DI CONSERVAZIONE</h2></div>
        <div class="slide">
         <table class="mainData" style="width:98% !important;">
            <tr>
             <td>
  <label>STATO CONSERVAZIONE</label>
  <select id="scn" name="scn" class="form">
       <option value="0">--selziona un valore --</option>
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

       <div class="toggle">
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

       <div class="toggle">
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

          <div class="login2" style="margin:20px auto 5px;" id="salva">Crea nuova scheda</div>

        </div>
       </div>
      </div>
     </div>
     <?php } ?>
    </div><!--content-->

   <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->


  </div><!-- wrap-->
 </div><!--container-->

 <!--div invisibili -->

  <script type="text/javascript" src="lib/jquery.qtip.min-2.0.1.js"></script>
  <script type="text/javascript" src="lib/menu.js"></script>
  <script type="text/javascript" src="lib/select.js"></script>
  <script type="text/javascript" src="lib/update.js"></script>

<script type="text/javascript" >
var tpsch = "<? echo($tipoScheda); ?>";
var numItems;
$(document).ready(function() {
  $('#tip').fadeIn(3000).delay(5000).fadeOut("slow");
  $("#schAssocCanc").hide();

  $( "#term" ).autocomplete({
      source: "inc/autocomplete.php",
      minLength: 2,
      select: function( event, ui ) {
        //alert(ui.item.id+'\n'+ui.item.value); return false;
        $("td#result").append("<div class='schAssoc' id='"+ui.item.id+"'>"+ui.item.value+"</div>");
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
   var tpsch = $("#tpsch").val();
   var livello = $('#livello').val();
   var dgn_numsch = $('#dgn_numsch').val();
   var dgn_livind = $('#dgn_livind').val();
   var dgn_dnogg = $('#dgn_dnogg').val();
   var dgn_note = $('#dgn_note').val();

   //cronologia
   var cro_iniz = $('#cro_iniz').val();
   var cro_fin = $('#cro_fin').val();
   var cro_spec = $('#cro_spec').val();
   var cro_motiv = $('#cro_motiv').val();
   var cro_note = $('#cro_note').val();

   //COMPILAZIONE
   var denric_update = $('#denric_update').val();
   var enteresp_update = $('#enteresp_update').val();
   var respric_update = $('#respric_update').val();
   var cmp_id = $('#cmp_id').val();
   //var compilatore_update = $('#compilatore_update').val();
   var datacmp_update = $('#datacmp_update').val();
   var notecmp = $('#notecmp').val();

   //PROVENIENZA
   var denricprv_update = $('#denricprv_update').val();
   var enrespprv_update = $('#enrespprv_update').val();
   var respricprv_update = $('#respricprv_update').val();
   var prv_id = $('#prv_id').val();
   //var compilatoreprv_update = $('#compilatoreprv_update').val();
   var dataprv_update = $('#dataprv_update').val();
   var noteprv_update = $('#noteprv_update').val();

   //AREA INTERESSE
   var stato_update = $('#stato_update').val();
   var provincia_update = $('#provincia_update').val();
   var comune_update = $('#comune_update').val();
   var localita_update = $('#localita_update').val();
   var indirizzo_update = $('#indirizzo_update').val();
   var motiv_update = $('#motiv_update').val();

   //UBICAZIONE
   var statoubi_update = $('#statoubi_update').val();
   var provinciaubi_update = $('#provinciaubi_update').val();
   var comuneubi_update = $('#comuneubi_update').val();
   var localitaubi_update = $('#localitaubi_update').val();
   var indirizzoubi_update = $('#indirizzoubi_update').val();
   var motivubi_update = $('#motivubi_update').val();
   var telubi = $('#telubi').val();
   var webubi = $('#webubi').val();

   //ANAGRAFICA
   var nome_ana_update = $('#nome_ana_update').val();
   var comune_ana_update = $('#comune_ana_update').val();
   var localita_ana_update = $('#localita_ana_update').val();
   var indirizzo_ana_update = $('#indirizzo_ana_update').val();
   var tel_ana = $('#tel_ana').val();
   var mail_ana = $('#mail_ana').val();
   var web_ana = $('#web_ana').val();
   var note_ana = $('#note_ana').val();

   //CONSUTABILITA
   var consultabilita = $('#consultabilita').val();
   var orario = $('#orario').val();
   var servizi = $('#servizi').val();

   //STATO DI CONSERVAZIONE
   var scn = $('#scn').val();
   var scn_note = $('#scn_note').val();

   //SCHEDE CORRELATE
   //creare array per i div.schAssoc
   var schAssoc ='';
   $("div.schAssoc").each(function(){schAssoc += $(this).attr('id') + ',';});
   //alert(schAssoc+'\n'); return false;
   //ricordati di esplodere l'array nello script di inserimento!!!!

   //NOTE GENERALI
   var note_gen = $('#note_gen').val();

   var errori = '';
   if (!livello) {errori += '<li>LIVELLO</li>';$('#livello').addClass('errore');}else{$('#livello').removeClass('errore');}
   if (!dgn_numsch) {errori += '<li>NUMERO SCHEDA</li>';$('#dgn_numsch').addClass('errore');}else{$('#dgn_numsch').removeClass('errore');}
   if (!dgn_livind) {errori += '<li>LIVELLO INDIVIDUAZIONE DATI</li>';$('#dgn_livind').addClass('errore');}else{$('#dgn_livind').removeClass('errore');}
   if (!dgn_dnogg) {errori += '<li>DEFINIZIONE OGGETTO</li>';$('#dgn_dnogg').addClass('errore');}else{$('#dgn_dnogg').removeClass('errore');}
   if(errori){
   	//alert('I sguenti campi sono obbligatori e vanno compilati: \n' + errori); return false;
   	errori = '<h3>I seguenti campi sono obbligatori e vanno compilati:</h3><ol>' + errori;
        $("<div id='errorDialog'>" + errori + "</ol></div>").dialog({
          resizable: false,
          height: 'auto',
          width: 'auto',
          position: 'top',
          title:'Errori',
          modal: true,
          buttons: {'Chiudi finestra': function() {$(this).dialog('close');} }//buttons
       });//dialog
       return false;
   }else{
    return false;
    //alert(livello+'\n'+ dgn_numsch+'\n'+ dgn_livind+'\n'+ dgn_dnogg+'\n'+ dgn_note ); return false;
    $.ajax({
          url: 'inc/scheda_nuova_script.php',
          type: 'POST',
          data: {tpsch:tpsch, livello:livello, dgn_numsch:dgn_numsch, dgn_livind:dgn_livind, dgn_dnogg:dgn_dnogg, dgn_note:dgn_note, cro_iniz:cro_iniz, cro_fin:cro_fin, cro_spec:cro_spec, cro_motiv:cro_motiv, cro_note:cro_note,denric_update:denric_update, enteresp_update:enteresp_update, respric_update:respric_update, cmp_id:cmp_id, datacmp_update:datacmp_update, notecmp:notecmp, denricprv_update:denricprv_update, enrespprv_update:enrespprv_update, respricprv_update:respricprv_update, prv_id:prv_id, dataprv_update:dataprv_update, noteprv_update:noteprv_update, stato_update:stato_update, provincia_update:provincia_update, comune_update:comune_update, localita_update:localita_update, indirizzo_update:indirizzo_update, motiv_update:motiv_update, statoubi_update:statoubi_update, provinciaubi_update:provinciaubi_update, comuneubi_update:comuneubi_update, localitaubi_update:localitaubi_update, indirizzoubi_update:indirizzoubi_update, motivubi_update:motivubi_update, telubi:telubi, webubi:webubi, nome_ana_update:nome_ana_update, comune_ana_update:comune_ana_update, localita_ana_update:localita_ana_update, indirizzo_ana_update:indirizzo_ana_update, tel_ana:tel_ana, mail_ana:mail_ana, web_ana:web_ana, note_ana:note_ana, consultabilita:consultabilita, orario:orario, servizi:servizi, scn:scn, scn_note:scn_note, schAssoc:schAssoc, note_gen:note_gen},
          success: function(data){
               //alert('Record inserito correttamente');
              $("#documentoConfirm").html(data);
              $("#documentoConfirm").dialog({
                 resizable: false,
                 height:600,
                 width:600,
                 position: 'top',
                 title:'Risultato query',
                 modal: true,
                 buttons: {
                   'Chiudi finestra': function() {
                       $(this).dialog('close');
                       window.location.href = 'progetti.php';
                    }
                 }//buttons
              });//dialog
           }//success
        });//ajax
   }
 });

});
</script>
</body>
</html>
