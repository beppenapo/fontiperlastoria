<?php
include('db.php');

$id = $_POST['id_ubi'];
$tipo = $_POST['tipo'];
$q=("SELECT localita.localita FROM ubicazione, aree, localita WHERE ubicazione.area = aree.id AND aree.id_localita = localita.id AND ubicazione.id = $id");
$r=pg_query($connection, $q);
$row =pg_num_rows($r);
$arr = pg_fetch_array($r, 0, PGSQL_ASSOC);
echo "<div class='titLocUbi'>".stripslashes($arr['localita'])."</div>";

$query = ("
with a as( 
  SELECT madre.id AS id_madre, madre.dgn_numsch AS madre, madre.livello AS liv_madre, figlia.id AS id_figlia, figlia.dgn_numsch AS figlia, figlia.livello AS liv_figlia, css.css, crono.cro_spec as crono, madre.dgn_dnogg as ogg 
  FROM altrif_parenti as alt_madre, ubicazione, aree, aree_scheda, scheda, scheda  as madre, scheda as figlia, lista_dgn_tpsch as css, cronologia as crono 
  WHERE scheda.dgn_tpsch = css.id and alt_madre.id_scheda = scheda.id AND alt_madre.id_scheda = madre.id AND alt_madre.id_parente = figlia.id AND ubicazione.area = aree.id AND aree_scheda.id_area = aree.id AND crono.id_scheda = madre.id and aree_scheda.id_scheda = scheda.id AND madre.livello = 1 AND ubicazione.id = $id AND scheda.dgn_tpsch=$tipo
) 
,b as ( SELECT madre.id AS id_madre, madre.dgn_numsch AS madre, madre.livello AS liv_madre, figlia.id AS id_figlia, figlia.dgn_numsch AS figlia, figlia.livello AS liv_figlia, css.css, crono.cro_spec as crono, madre.dgn_dnogg as ogg FROM altrif_parenti alt_madre, ubicazione, aree, aree_scheda, scheda, scheda madre, scheda figlia, lista_dgn_tpsch as css, cronologia as crono WHERE scheda.dgn_tpsch = css.id and alt_madre.id_scheda = scheda.id AND alt_madre.id_scheda = madre.id AND alt_madre.id_parente = figlia.id AND ubicazione.area = aree.id AND aree_scheda.id_area = aree.id AND crono.id_scheda = madre.id AND aree_scheda.id_scheda = scheda.id AND madre.livello = 2 AND ubicazione.id = $id AND scheda.dgn_tpsch=$tipo) 
,c as (SELECT scheda.id as id_madre, scheda.dgn_numsch as madre, css.css, crono.cro_spec as crono, scheda.dgn_dnogg as ogg FROM ubicazione, aree, aree_scheda, scheda, lista_dgn_tpsch as css, cronologia as crono WHERE crono.id_scheda = scheda.id AND scheda.dgn_tpsch = css.id and scheda.dgn_tpsch = css.id and ubicazione.area = aree.id AND aree_scheda.id_area = aree.id AND aree_scheda.id_scheda = scheda.id AND ubicazione.id = $id AND scheda.dgn_tpsch=$tipo) 
select a.id_madre, a.madre, a.css, a.crono, a.ogg from a where exists(select * from a) 
union 
select b.id_madre, b.madre, b.css, b.crono, b.ogg from b where b.id_madre not in(select a.id_figlia from a) or not exists(select * from a) 
union 
select c.id_madre, c.madre, c.css, c.crono, c.ogg from c where c.id_madre not in(select b.id_figlia from b) AND c.id_madre not in(select b.id_madre from b);");
$result = pg_query($connection, $query);
$righe = pg_num_rows($result);
echo "<div class='ulContent'><ul class='ulpopup'>";
if($righe != 0) {
   for ($x = 0; $x < $righe; $x++){
       $idScheda = pg_result($result, $x,"id_madre");
       $numScheda = pg_result($result, $x,"madre");
       $stile = pg_result($result, $x,"css");
       $crono = pg_result($result, $x,"crono");
       $ogg = pg_result($result, $x,"ogg");
       echo "<li>
               <h2 class='$stile'>
                <a href='http://www.lefontiperlastoria.it/scheda_archeo.php?id=$idScheda' title='Apri scheda' target='_blank' class='$stile'>$numScheda</a>
               </h2>
               <p>$crono</p>
               <p>$ogg</p>
             </li>";
   }
}else {
   echo "<li><h1>L'ubicazione selezionata non ha schede associate</h1></li>";
}
echo "</div></ul>";
?>
