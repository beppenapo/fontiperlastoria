<?php 
 require("inc/db.php");
 if ($_SESSION['username']!='guest'){
  $idUsr = $_SESSION['id_user'];
  $tipoUsr = $_SESSION['tipo'];
  $hub = $_SESSION['hub'];
?>
<div id='utente'>
 <ul id="sessionMenu">
  <li>Ciao <?php echo($_SESSION['username']); ?>, </li>
  <li>
   <a href="#" id="account" class='sessionLink' title="Gestisci la tua sessione di lavoro" >
    account 
    <span id="accountToggle" class="oc">+</span>
   </a>
   <ul class="submenu">
    <li>
     <a href='account.php' title="modifica i tuoi dati personali"> dati personali</a>
    </li> 
    <li>
     <a href='inc/loginScript.php?login=no' title='Chiudi la tua sessione di lavoro'>logout</a>
    </li>
   </ul>
  </li>
  <li>
   <a href='home.php' class='sessionLink' title="Torna alla home page del sito"> home</a>
  </li>
    
  <li>
   <a href="#" class='sessionLink' title="Cataloghi" id="catalogo"> 
    Cataloghi 
    <span id="cataloghiToggle" class="oc">+</span>
   </a>
   <ul class="submenu">
    <li>
     <a href='ricerca.php' title="Accedi al catalogo generale delle ricerche"> ricerche</a>
    </li>
    <li>
     <a href='catalogo.php' title="Accedi al catalogo generale delle schede"> schede</a>
    </li>
    <li>
     <a href='rubrica.php' title="Accedi alla rubrica condivisa"> rubrica</a>
    </li>
    <li>
     <a href='aree.php?c=0&t=0' title="Accedi alla lista delle aree di interesse e delle ubicazioni"> aree/ubicazioni</a>
    </li>
    <li>
     <a href='areeCarto.php?c=0' title="Accedi alla lista delle aree di interesse cartografico"> aree interesse cartografico</a>
    </li>
   </ul>
  </li>
  <li>
   <a href="#" id="nuova_scheda" class='sessionLink' title="Inserisci una nuova scheda" > 
    nuova scheda 
    <span id="schedaToggle" class="oc">+</span>
   </a>
   <ul class="submenu" id="nuovaScheda"> 
    <?php 
     $ql=("select * from lista_tipo_scheda where id <> 3 order by etichetta asc;");
     $qlr=pg_query($connection, $ql);
     while ($obj = pg_fetch_array($qlr)) {
      echo "<li class='link".$obj["id"]."'><a href='scheda_nuova.php?tpsch=".$obj["id"]."&def=".$obj["fonte"]."'>".$obj["etichetta"]."</a></li>";
     }
    ?>
   </ul>
  </li>
  <li>
   <a href="#" class='sessionLink' title="Modifica una lista valori" id="liste"> 
    liste 
    <span id="listeToggle" class="oc">+</span>
   </a>
   <ul class="submenu">
    <li><a href='vocabolari.php' title="modifica un vocabolario"> vocabolari</a></li> 
    <li><a href='stato.php' title='modifca lista Stato'>Stato</a></li>
    <li><a href='provincia.php' title='modifca lista Provincia'>Provincia</a></li>
    <li><a href='comune.php' title='modifca lista Comune'>Comune</a></li>
    <li><a href='localita.php' title='modifca lista Localita'>Localita</a></li>
    <li><a href='indirizzo.php' title='modifca lista Indirizzo'>Indirizzo</a></li>
   </ul>
  </li>
  <?php if($_SESSION['tipo'] == 1) {?>
  <li><a href='utenti.php' class='sessionLink' title="Lista utenti">utenti</a></li>
  <?php } if($_SESSION['tipo'] < 3) {?>
  <li><a href='notepad.php' class='sessionLink' title="Lista utenti">notepad</a></li>
  <?php } ?>
 </ul>
 <div style="clear:both"></div>
</div>
<?php } ?>
 
 <script type="text/javascript" >
 $(document).ready(function() {
  var idUsr = '<?php echo($idUsr); ?>';
  var tipoUsr = '<?php echo($tipoUsr); ?>';
  var hub = '<?php echo($hub); ?>';
  $('.submenu').hide();
  
  //per ora non più utilizzato
  var tutte='<li><a href="scheda_nuova.php?tpsch=6&def=archeologica">archeologica</a></li>'
           +'<li><a href="scheda_nuova.php?tpsch=8&def=architettonica">architettonica</a></li>'
           +'<li><a href="scheda_nuova.php?tpsch=4&def=archivistica">archivistica</a></li>'
           +'<li><a href="scheda_nuova.php?tpsch=5&def=bibliografica">bibliografica</a></li>'
           +'<li><a href="scheda_nuova.php?tpsch=2&def=materiale">cultura materiale</a></li>'
           +'<li><a href="scheda_nuova.php?tpsch=1&def=orale">fonte orale</a></li>'
           +'<li class="bassa"><a href="scheda_nuova.php?tpsch=7&def=fotografica">fotografica</a></li>'
           +'<li><a href="scheda_nuova.php?tpsch=9&def=storico-artistica">storico-artistica</a></li>'; 
   
 /*if(tipoUsr > 0){
  $('#nuova_scheda').click(function() { 
   $('#nuovaScheda').html(tutte);
   $(this).next().slideToggle();
  });
 }*/

 $('#nuova_scheda').click(function() {
  $(this).next().slideToggle();
 })
 .toggle(
  function() {$('#schedaToggle').text('-');}, 
  function() {$('#schedaToggle').text('+');
 });

 $('#account').click(function() { 
    $(this).next().slideToggle();
 })
 .toggle(
   function() {$('#accountToggle').text('-');}, 
   function() {$('#accountToggle').text('+');
 });
   
 $('#liste').click(function() { 
   $(this).next().slideToggle();
 })
 .toggle(
   function() {$('#listeToggle').text('-');}, 
   function() {$('#listaToggle').text('+');
 });
   
 $('#catalogo').click(function() { 
   $(this).next().slideToggle();
 })
 .toggle(
   function() {$('#catalogoToggle').text('-');}, 
   function() {$('#catalogoToggle').text('+');
 });
 
 if(hub==2){
  //$( "#nuovaScheda > li:not([class~='bassa'])" ).remove();
  $("#nuovaScheda li").each(function(){
   var remove = $( this ).attr("class");
   $( "#nuovaScheda > li:not([class='link7']):not([class='link10'])" ).remove();
  });
 }
});
</script>
