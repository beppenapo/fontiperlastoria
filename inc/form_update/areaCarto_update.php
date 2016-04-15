<?php
require('../db.php');
$id = $_POST['id'];
$areaq = "select nome, tipo from area where id = $id;";
$areaExec = pg_query($connection, $areaq);
$areaNome = pg_fetch_array($areaExec);

$listaq=("select a.id, array_to_string(array_agg(c.comune || ' (' || l.localita || ')' ), ', ') as lista from area ac, aree a, comune c, localita l where a.nome_area = ac.id and a.id_comune = c.id and a.id_localita = l.id and ac.id = $id group by a.id; ");
$listaExec = pg_query($connection, $listaq);
$listaArr;
while($lista = pg_fetch_array($listaExec)){$listaArr .="<li><input type='checkbox' name='locDel' id='locDel".$lista['id']."' value='".$lista['id']."' /> <label for='locDel".$lista['id']."'>".$lista['lista']."</label></li>";}
?>

<div id="compilazione_form">
    <label>* Tipologia area</label>
    <select id="tipoUp" name="tipoUp" class="form">
        <option value="1">area di interesse</option>        
        <option value="3">cartografia</option>
    </select>
    <label class='main'>* Nome area</label>
    <textarea id="nomeUp" class="form" style="height:15px;"><?php echo $areaNome['nome']; ?></textarea>
    <label class='main'>Località associate all'area, seleziona le località da eliminare</label>
    <div class="listaDiv"><ul><?php echo $listaArr; ?></ul></div>
    <label class='main'>* Aggiungi località all'area</label>
    <select id="comNew" name="comNew" class="form"  style="width:95%;">
        <option value="15">--scegli Comune--</option>
        <?php
        $q1 = ("SELECT DISTINCT id, comune FROM comune WHERE id != 15 order by comune asc;");
        $q1ex = pg_query($connection, $q1);
        $q1r = pg_num_rows($q1ex);
        while($row = pg_fetch_array($q1ex)){
            echo "<option value=".$row['id'].">".stripslashes($row['comune'])."</option>";
        }
        ?>
    </select>
    <div id="locWrap">
        <label>Dopo aver selezionato le località clicca sul pulsante "Aggiungi area" per rendere effettive le modifiche</label>
        <div id="locList" class="listaDiv"></div>
        <button type="button" name ="addNewArea">Aggiungi area</button>
    </div>
    <div id="locNewTotWrap">
        <label>Località selezionate per essere aggiunte all'area</label>
        <div class="listaDiv"><ul id="locNewTot"></ul></div>
    </div>
    <input type="hidden" id="id" value="<?php echo($id); ?>" />
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
var tipoUp = <?php echo $areaNome['tipo']; ?>;
$(document).ready(function(){
    $("select[name=tipoUp]").val(tipoUp);
    $("#locWrap, #locNewTotWrap").hide();
    $('#chiudi, #no').click(function(){$(this).closest('.ui-dialog-content').dialog('close');});
    $("select[name=comNew]").change(function() {
        var comId = $(this).val();
        var obj = "select[name=comNew]";
        var com = $(obj + "option:selected").text();
        if(comId==15){$('#locWrap').hide();}else{$('#locWrap').show();}
        $.ajax({
            type: "POST"
            , url: "inc/dinSelLocalitaCarto.php"
            , data: {id:comId}
            , cache: false
            , success: function(data){
                $("#locList").html(data);
                var checkLoc = $("input[name=localitaCartoCheck]");
                var checkAll = $("input[name=lcAll");
                var checkLocChecked;
                checkAll.click(function(){ if($(this).attr('checked')){ checkLoc.attr('checked',true); }else{ checkLoc.attr('checked',false); } });
            }
        });
    });
    var arrNewLoc = new Array();
    var arrDel = new Array();
    $("button[name=addNewArea]").click(function(){
        var arrLocNome = new Array();
        var com = $("select[name=comNew] option:selected").text();
        var comId = $("select[name=comNew]").val();
        var checkLocChecked = $("input[name=localitaCartoCheck]:checked");
        var locLength = checkLocChecked.length;
        if (locLength==0){
            arrLocNome.push('nessuna località specifica');
            arrNewLoc.push({com: comId, loc:0});
        }else{
            checkLocChecked.each(function(){
                var nome = $(this).data('loc');
                var id = $(this).val();
                arrLocNome.push( nome);
                arrNewLoc.push({com: comId, loc:id});
            });
        }
        $("#locNewTotWrap").fadeIn(500);
        $("#locNewTot").append("<li><i class='fa fa-times removeArea' title='Elimina area'></i> Comune: "+com+", Località: <span class='idLoc' data-arrloc='"+arrNewLoc.join()+"'>"+arrLocNome.join(", ")+"</span></li>");
        $(".removeArea").click(function(){$(this).parent("li").remove();checkLocLi();});
        $("#locWrap").fadeOut('fast');
        $("#comNew").val(15);
    });
    $('#elimina').click(function(){
        $("#delDialog").dialog({ resizable:false, width: 500, title: "ATTENZIONE!!!"});
        $('#si').click(function(){
            var idDel = $('#id').val();
            $.ajax({
                url: 'inc/deleteArea.php',
                type: 'POST',
                data: {idDel:idDel},
                success: function(data){ $(data).dialog().delay(2500).fadeOut(function(){ window.location.href = 'aree.php?c=0&t=0'; }); }
            });//ajax
        });
    });//elimina

$('#salva').click(function(){
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
   });
});
</script>
