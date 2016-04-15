<?php
include('db.php');
if($_POST['id']){
	$id=$_POST['id'];
	$query = ("
	SELECT comune.comune, indirizzo.indirizzo, comune.cap, localita.localita, anagrafica.tel, anagrafica.cell, anagrafica.fax, anagrafica.mail, anagrafica.web,  lista_tipo_soggetto.definizione, anagrafica.note
	FROM anagrafica, comune, indirizzo, localita, lista_tipo_soggetto
	WHERE 
	 anagrafica.comune = comune.id AND 
	 anagrafica.indirizzo = indirizzo.id AND 
	 anagrafica.localita = localita.id AND 
	 anagrafica.tipo_soggetto = lista_tipo_soggetto.id AND 
	 anagrafica.id=$id");
	$result = pg_query($connection, $query);
	$righe = pg_num_rows($result);
	if($righe > 0){
		while($row = pg_fetch_array($result)){
			echo '
			 <table class="tableInfo">
			  <tr>
			   <td><label>TIPO SOGGETTO</label><br/><label><b>'.$row['definizione'].'</b></label></td>
			   <td><label>COMUNE</label><br/><label><b>'.$row['comune'].'</b></label></td>
            <td><label>INDIRIZZO</label><br/><label><b>'.$row['indirizzo'].'</b></label></td>
            <td><label>LOCALIT&Agrave</label><br/><label><b>'.$row['localita'].'</b></label></td>
            <td></td><td></td>
           </tr>
           <tr>
            <td><label>TEL.</label><br/><label><b>'.$row['tel'].'</b></label></td>
            <td><label>CELL.</label><br/><label><b>'.$row['cell'].'</b></label></td>
            <td><label>FAX</label><br/><label><b>'.$row['fax'].'</b></label></td>
            <td><label>MAIL</label><br/><label><b>'.$row['mail'].'</b></label></td>
            <td><label>WEB</label><br/><label><b>'.$row['web'].'</b></label></td>
           </tr>
           <tr>
            <td colspan="5"><label>NOTE SOGGETTO</label><br/><label><b>'.$row['note'].'</b></label></td>
           </tr>
          </table>
          ';
		}
	}
}
?>