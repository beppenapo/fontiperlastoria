 <div id="logoSchedaSx"><img src="img/layout/logo.png" alt="logo" /></div> 
 <div id="livelloScheda">
  <ul>
   <li id="liv1">PRIMO LIVELLO</li>
   <li id="liv2">SECONDO LIVELLO</li>
   <li id="liv3">TERZO LIVELLO</li>
  </ul>
 </div>
 <div id="logoSchedaDx"><img src="img/layout/loghiSchede/logoSkArcheo.png" alt="logo scheda archeo" /></div>
 
 <div id="skArcheoContent">
  <div class="inner primo">
   <div style="width:450px; float:left; margin-left:-70px;">
         <table class="mainData">
          <tr>
           <td>
            <label>NUMERO SCHEDA</label>
            <h1 class="<?php echo($stile);?>"><?php echo($numSch); ?></h1>
           </td>
           <td>
             <label>TIPO SCHEDA</label>
             <div class="valori"><?php echo($a['tipo_scheda']); ?></div>
           </td>
          </tr>
          <tr>
           <td colspan="2">
             <label>DEFINIZIONE OGGETTO</label>
             <div class="valori" style="height:50px; font-size:18px;"><?php echo($a['dgn_dnogg']); ?></div>
           </td>
          </tr>
          <tr>
            <td>
              <label>CRONOLOGIA</label>
              <div class="valori"><?php echo($a['cro_spec']); ?></div>
            </td>
            <td>
              <label>LIVELLO INDIVIDUAZIONE DATI</label>
              <div class="valori"><?php echo($a['individuazione']); ?></div>
            </td>
          </tr>
          <tr>
           <td colspan="2">
             <label>NOTE</label>
             <div class="valori"><?php echo($note); ?></div>
           </td>
          </tr>
         </table>
       </div>
       <div id="smallMap">
      
       </div>
       <div style="clear:both"></div>
       <div class="sezioni" style="margin-top:20px;">
        <h2>DETTAGLIO CRONOLOGIA</h2>
       </div>
       <div class="sezioni">
        <h2>COMPILAZIONE</h2>
       </div>
       <div class="sezioni">
        <h2>PROVENIENZA DATI</h2>
       </div>
       <div class="sezioni">
        <h2>AREA DI INTERESSE</h2>
       </div>
       <div class="sezioni">
        <h2>UBICAZIONE</h2>
       </div>
       <div class="sezioni">
        <h2>ANAGRAFICA</h2>
       </div>
       <div class="sezioni">
        <h2>CONSULTABILITA'</h2>
       </div>
       <div class="sezioni">
        <h2>STATO DI CONSERVAZIONE</h2>
       </div>
       <div class="sezioni">
        <h2>SCHEDE CORRELATE</h2>
       </div>
       <div class="sezioni">
        <h2>NOTE GENERALI</h2>
       </div>
   </div>

<?php require("inc/".$tab.".php"); ?>

   <div class="inner" style="border:none !important; background-color: none !important; height:auto !important">
    <div class="inner" style="width:200px !important; float:left; margin-right:10px;">
     <label>SCHEDE DI PRIMO LIVELLO</label><br />
     <?php 
      $q1 = ("select * from altrif where scheda = $id and tpsch_altrif = $tpsch and livello_altrif = 1");
      $r1 = pg_query($connection, $q1);
      $righe1 = pg_num_rows($r1);
      if($righe1 != 0) {
        for ($x = 0; $x < $righe1; $x++){
         $id = pg_result($r1, $x,"scheda_altrif"); 	
         $numsch = pg_result($r1, $x,"numsch_altrif");
         echo "<a href=\"scheda_archeo.php?id=$id\" target=\"_blank\" class=\"altrif $stile\">$numsch</a>  ";
        }
     }
     ?>
    </div>
   
    <div class="inner" style="width:324px !important; float:left; margin-right:10px;"> 
     <label>SCHEDE DI SECONDO LIVELLO</label><br />
     <?php 
      $q2 = ("select * from altrif where scheda = $id and tpsch_altrif = $tpsch and livello_altrif = 2");
      $r2 = pg_query($connection, $q2);
      $righe2 = pg_num_rows($r2);
      if($righe2 != 0) {
        for ($x = 0; $x < $righe2; $x++){
         $id = pg_result($r2, $x,"scheda_altrif"); 	
         $numsch = pg_result($r2, $x,"numsch_altrif");
         echo "<a href=\"scheda_archeo.php?id=$id\" target=\"_blank\" class=\"altrif $stile\">$numsch</a>  ";
        }
     }
     ?>
    </div>
   
    <div class="inner" style="width:400px !important; float:left;">
      <label>SCHEDE DI TERZO LIVELLO</label><br />
     <?php 
      $q3 = ("select * from altrif where scheda = $id and tpsch_altrif = $tpsch and livello_altrif = 3");
      $r3 = pg_query($connection, $q3);
      $righe3 = pg_num_rows($r3);
      if($righe3 != 0) {
        for ($x = 0; $x < $righe3; $x++){
         $id = pg_result($r3, $x,"scheda_altrif"); 	
         $numsch = pg_result($r3, $x,"numsch_altrif");
         echo "<a href=\"scheda_archeo.php?id=$id\" target=\"_blank\" class=\"altrif $stile\">$numsch</a>  ";
        }
     }
     ?>
    </div>
    <div style="clear:both"></div>
   </div>
 </div>

