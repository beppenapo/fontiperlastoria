<div id="area_interesse_add_form">
    <table class="mainData" style="width:98% !important;">
        <tr>
            <td style="padding:0px !important;">
                <label>Seleziona un'area dall'elenco</label>
                <select id="aa" name="aa" class="form" style="width:220px !important;">
                    <?php 
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
                        echo $opt;
                        while($x = pg_fetch_array($resai)){ echo "<option value='".$x['id']."'>".$x['nome']."</option>"; } 
                    ?>
                </select>
                <input type="hidden" id="defVal" value="<?php echo $defVal; ?>">
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
                <label id="areeMsg" style="display:none;"><b>Se vuoi aggiungere un'area alla scheda devi selezionare un valore dalla lista e aggiungere una motivazione, altrimenti lascia la sezione vuota.</b></label>
                <div id="areeWrap" style="display:none;">
                    <div id="aree"></div>
                </div>
            </td>
        </tr>
    </table>
    <div class="login2" style="display:none;" id="area_add">Salva modifiche</div>
    <div class="chiudiForm login2">Annulla modifiche</div>
</div>
<script type="text/javascript" >
    var def=document.getElementById("areeAdd");
    var add=document.getElementById("areeAdd");
    add.onclick=function(){areaAdd(def);};
</script>
