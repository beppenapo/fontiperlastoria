<div id="area_interesse_add_form">
    <table class="mainData" style="width:98% !important;">
        <tr>
            <td style="padding:0px !important;">
                <label>Seleziona un'area dall'elenco</label>
                <select id="aa" name="aa" class="form" style="width:220px !important;">
                    <?php 
                        if($tpsch==10){
                            $opt = "<option value='261'>-- seleziona area di interesse cartografico --</option>";
                            $t=3;
                            $defVal = 261;
                        }else{
                            $opt = "<option value='261'>-- seleziona area di interesse --</option>";
                            $t=1;
                            $defVal = 261;
                        }
                        $qai =  "SELECT id, nome from area where tipo = $t order by nome asc;";
                        $resai = pg_query($connection, $qai);
                        echo $opt;
                        while($x = pg_fetch_array($resai)){ echo "<option value='".$x['id']."'>".$x['nome']."</option>"; } 
                    ?>
                </select>
            </td>
            <td style="padding:0px 0px 0px 5px!important;">
                <label>MOTIVAZIONE AREA</label>
                <select id="mu" name="mu" class="form">
                    <option value="16">Non determinabile</option>
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
            <td>
                <div class="login2" id="areeAdd">+</div>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <label id="areeMsg"><b>Se vuoi aggiungere un'area alla scheda devi selezionare un valore dalla lista e aggiungere una motivazione, altrimenti lascia la sezione vuota.</b></label>
                <div id="areeWrap">
                    <div id="aree"></div>
                    <div id="areeListCanc" class="login2" style="font-size:1.2em;width:250px !important;margin-top:10px;"></div>
                </div>
            </td>
        </tr>
    </table>
    <div class="login2" style="margin-top:20px;" id="area_add">Salva modifiche</div>
    <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
$(document).ready(function() {
    $("#area_add, #areeWrap, #areeListCanc").hide();
    $("#areeAdd").click(function () {
        $("#areaDefault").remove();
        var id_area=$("#aa").val();
        var motiv=$("#mu").val();
        if(id_area == 261 || motiv == 16){return false; }
        else{
            $("#areeMsg").fadeOut('fast');
            var area = $( "#aa option:selected" ).text();
            var motivTxt = $( "#mu option:selected" ).text();
            $("#aree").append('<div class="areeList" val="'+id_area+','+motiv+'"><div class="areeListRecord"><label>'+area+'</label></div><div class="areeListRecord"><label>'+motivTxt+'</label></div></div>');
            $("#areeWrap, #areeListCanc").fadeIn('slow');
            areeFunc();
        }
    });

    $("#areeListCanc").click(function(){
        $("div[class=areeList]:last").remove();
        areeFunc();
    });
});
</script>
