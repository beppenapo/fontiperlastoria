<?php
require('../db.php');
$areaq = "select area.id as id_area, area.nome as area, comune.id as id_comune, comune.comune, indirizzo.id as id_indirizzo, indirizzo.indirizzo, indirizzo.cap, anagrafica.id as id_rubrica, anagrafica.nome as rubrica from area left join aree on aree.nome_area=area.id left join comune on aree.id_comune = comune.id left join indirizzo on aree.id_indirizzo = indirizzo.id left join anagrafica on aree.id_rubrica = anagrafica.id where area.id = ".$_POST['id'].";";
$areaExec = pg_query($connection, $areaq);
$area = pg_fetch_array($areaExec);
?>

<div id="compilazione_form">
    <label class='main'>* Nome area</label>
    <textarea name="areaUp" class="form" style="height:15px;"><?php echo $area['area']; ?></textarea>

    <label class='main'>* Comune</label>
    <select name="comuneUp" class="form"  style="width:95%;">
        <option value="15">--scegli Comune--</option>
        <?php
        $q1 = ("SELECT DISTINCT id, comune FROM comune WHERE id != 15 order by comune asc;");
        $q1ex = pg_query($connection, $q1);
        while($row = pg_fetch_array($q1ex)){
          $comSel = ($row['id']==$area['id_comune']) ? "selected" : '';
          echo "<option value=".$row['id']." ".$comSel.">".stripslashes($row['comune'])."</option>";
        }
        ?>
    </select>

    <label>Indirizzo</label>
    <select name="indirizzoUp" class="form"  style="width:95%;">
        <option value="0">--scegli indirizzo--</option>
        <?php
        $q2 = "select id, indirizzo, cap from indirizzo where comune = ".$area['id_comune'];
        $q2ex = pg_query($connection, $q2);
        while($row2 = pg_fetch_array($q2ex)){
          $indSel = ($row2['id']==$area['id_indirizzo']) ? "selected" : '';
          echo "<option value=".$row2['id']." ".$indSel.">".stripslashes($row2['indirizzo'])." - ".$row2['cap']."</option>";
        }
        ?>
    </select>

    <label>Riferimento rubrica</label>
    <select name="rubricaUp" class="form"  style="width:95%;">
        <option value="7">--scegli riferimento rubrica--</option>
        <?php
        $q3 = "select id, nome from anagrafica where comune = ".$area['id_comune'];
        $q3ex = pg_query($connection, $q3);
        while($row3 = pg_fetch_array($q3ex)){
          $rubSel = ($row3['id']==$area['id_rubrica']) ? "selected" : '';
          echo "<option value=".$row3['id']." ".$rubSel.">".stripslashes($row3['nome'])."</option>";
        }
        ?>
    </select>

    <input type="hidden" id="id" value="<?php echo($_POST['id']); ?>" />
    <div id="upMsg" style="margin:10px auto;text-align:center;"></div>
    <div id="salva" class="login2" style="margin-top:20px;" id="compilazione_update">Salva modifiche</div>
    <div id="chiudi" class="login2">Annulla modifiche</div>
    <div id="elimina" class="login2">Elimina record</div>
</div>


<div id="delDialog" style="display:none; text-align:center;">
 <h2>Hai scelto di eliminare il record</h2>
 <p>Eliminando il record eliminerai anche i collegamenti con le schede</p>
 <p>Sei sicuro di voler eliminare il record?</p>
 <div id="no" class="login2" style="margin-top:20px;" id="compilazione_update">NO, non eliminare</div>
 <div id="si" class="login2">SI, procedi con l'eliminazione</div>
</div>
<script type="text/javascript" src="./lib/select.js"></script>
<script type="text/javascript" >
$(document).ready(function(){
    $('#chiudi, #no').click(function(){$(this).closest('.ui-dialog-content').dialog('close');});
    $("select[name=comuneUp]").change(function() {var comId = $(this).val(); ubi(comId,1);});
    $('#salva').click(function(){
      var id = $('#id').val();
      var area = $('textarea[name=areaUp]').val();
      var comune = $('select[name=comuneUp]').val();
      var indirizzo = $('select[name=indirizzoUp]').val();
      var rubrica = $('select[name=rubricaUp]').val();
      if(!area){$("#upMsg").text("Devi inserire un nome per l'area che stai modificando");}
      else if(comune == 15){$("#upMsg").text("Devi selezionare un Comune dalla lista");}
      else{
        $.ajax({
             url: 'inc/areaUbiUpdateScript.php'
             ,type: 'POST'
             ,data: {id:id,area:area,comune:comune,indirizzo:indirizzo,rubrica:rubrica}
             ,success: function(data){
               $("#upMsg").text(data).delay(2000).hide(function(){window.location.href = 'aree.php?c=0&t=0';});
             }
        });
      }
    });

/*$('#salva').click(function(){
    arrDel.length=0;
    var idUp = $('#id').val();
    var tipoUp = $('#tipoUp').val();
    var nomeUp = $('#nomeUp').val();
    //console.log(idUp+" "+tipoUp+" "+nomeUp);
    var checkLocDel = $("input[name=locDel]:checked");
        var locDelLength = checkLocDel.length;
        if (locDelLength==0){
            arrDel.push=0;
        }else{
            checkLocDel.each(function(){
                var id = $(this).val();
                arrDel.push(id);
            });
        }
     $.ajax({
          url: 'inc/updateArea_script.php',
          type: 'POST',
          data: {id:idUp,tipo:tipoUp,nome:nomeUp,arrNew:arrNewLoc, arrDel:arrDel},
          success: function(data){
            $("#salva").text(data).delay(2000).hide(function(){window.location.href = 'aree.php?c=0&t=0';});
          }
     });
   });*/
});
</script>
