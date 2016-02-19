<?php
include('db.php');

$id = $_POST['id_ubi'];
$tipo = $_POST['tipo'];
$q=("SELECT localita.localita FROM ubicazione, aree, localita WHERE ubicazione.id_area = aree.nome_area AND aree.id_localita = localita.id AND ubicazione.id = $id");
$r=pg_query($connection, $q);
$row =pg_num_rows($r);
$arr = pg_fetch_array($r);
echo "<div class='titLocUbi'>".stripslashes($arr['localita'])."</div>";

$query = ("
with listone as(
 with a as
  (SELECT madre.id AS id_madre, madre.dgn_numsch AS madre, madre.livello AS liv_madre, figlia.id AS id_figlia, figlia.dgn_numsch AS figlia, figlia.livello AS liv_figlia FROM altrif_parenti alt_madre, ubicazione, aree, aree_scheda, scheda, scheda madre, scheda figlia WHERE alt_madre.id_scheda = scheda.id AND  alt_madre.id_scheda = madre.id AND alt_madre.id_parente = figlia.id AND ubicazione.id_area = aree.nome_area AND aree_scheda.id_area = aree.nome_area AND aree_scheda.id_scheda = scheda.id AND madre.livello = 1 AND ubicazione.id = $id)
,b as
  (SELECT madre.id AS id_madre, madre.dgn_numsch AS madre, madre.livello AS liv_madre, figlia.id AS id_figlia, figlia.dgn_numsch AS figlia, figlia.livello AS liv_figlia FROM altrif_parenti alt_madre, ubicazione, aree, aree_scheda, scheda, scheda madre, scheda figlia WHERE alt_madre.id_scheda = scheda.id AND  alt_madre.id_scheda = madre.id AND alt_madre.id_parente = figlia.id AND ubicazione.id_area = aree.nome_area AND aree_scheda.id_area = aree.nome_area AND aree_scheda.id_scheda = scheda.id AND madre.livello = 2 AND ubicazione.id = $id)
,c as
  (SELECT madre.id AS id_madre, madre.dgn_numsch AS madre, madre.livello AS liv_madre, figlia.id AS id_figlia, figlia.dgn_numsch AS figlia, figlia.livello AS liv_figlia FROM altrif_parenti alt_madre, ubicazione, aree, aree_scheda, scheda, scheda madre, scheda figlia WHERE alt_madre.id_scheda = scheda.id AND  alt_madre.id_scheda = madre.id AND alt_madre.id_parente = figlia.id AND ubicazione.id_area = aree.nome_area AND aree_scheda.id_area = aree.nome_area AND aree_scheda.id_scheda = scheda.id AND madre.livello = 3 AND ubicazione.id = $id)
,d as
  (SELECT scheda.id as id_madre, scheda.dgn_numsch as madre FROM ubicazione, aree, aree_scheda, scheda WHERE ubicazione.id_area = aree.nome_area AND aree_scheda.id_area = aree.nome_area AND aree_scheda.id_scheda = scheda.id AND ubicazione.id = $id)
SELECT a.id_madre, a.madre FROM a where exists(select * from a)
UNION
SELECT b.id_figlia, b.figlia FROM b where b.id_figlia in(select d.id_madre from d) AND b.id_madre not in(select a.id_figlia from a) or not exists(select * from a) AND b.liv_figlia = 2 AND NOT b.liv_madre = 2
UNION
SELECT b.id_madre, b.madre FROM b where b.id_figlia not in(select d.id_madre from d) AND b.id_madre in(select d.id_madre from d)  AND b.liv_figlia = 1 AND b.liv_madre = 2
UNION
SELECT c.id_madre, c.madre FROM c where c.id_madre in(select d.id_madre from d) AND c.id_figlia not in(select a.id_madre from a) AND c.id_figlia not in(select b.id_madre from b) AND c.liv_madre = 3 AND NOT c.liv_figlia = 3
UNION
SELECT d.id_madre, d.madre FROM d where d.id_madre not in(select b.id_figlia from b) AND d.id_madre not in(select b.id_madre from b) AND d.id_madre not in(select c.id_madre from c)
)
SELECT listone.id_madre, listone.madre, css.css, cronologia.cro_spec as crono, scheda.dgn_dnogg as ogg, scheda.dgn_tpsch
FROM listone, lista_dgn_tpsch as css, cronologia, scheda
where listone.id_madre = scheda.id AND cronologia.id_scheda = listone.id_madre AND scheda.dgn_tpsch = css.id AND scheda.dgn_tpsch = $tipo
order by listone.madre ASC;");
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
