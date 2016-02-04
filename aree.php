<?php
session_start();
ini_set( "display_errors", 0);
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
require("inc/db.php");
$usr = $_SESSION['id_user'];
if(!isset($_POST['c']) || $_POST['c']==0) {
    $and='>0';
    $jc = 0;
}else{
    $and= '='.$_POST['c'];
    $jc = $_POST['c'];
}
if(!isset($_POST['t']) || $_POST['t']==0) {
    $and2='>0';
    $jt = 0;
}else{
    $and2= '='.$_POST['t'];
    $jt = $_POST['t'];
}

$query = ("
    select ac.id 
            , ac.nome area
            , ac.tipo
            , array_to_string(array_agg(c.comune || ' (' || l.localita || ')' ), '<br/>') as lista
            , count(area_int_poly.id)::integer as geom
            , count(ubicazione.id)::integer as ubi
    from area ac
    inner join aree a on a.nome_area = ac.id
    inner join comune c on a.id_comune = c.id
    inner join localita l on a.id_localita = l.id
    left join area_int_poly on area_int_poly.id_area = ac.id
    left join ubicazione on ac.id = ubicazione.area and ac.tipo = 2
    where a.nome_area is not null and a.id_comune$and and ac.tipo$and2
    group by ac.id,ac.nome, ac.tipo
    order by area asc;
");      
$e = pg_query($connection, $query);
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
  <link href="lib/jquery-ui-1.11.4/jquery-ui.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/scheda.css" type="text/css" rel="stylesheet" media="screen" />
  <link href="css/ico-font/css/font-awesome.min.css" type="text/css" rel="stylesheet" media="screen" />
  <link rel="shortcut icon" href="img/icone/favicon.ico" />
  <style type="text/css">
    div#content{border: 1px solid #C1FEAE;margin-top:50px;}
    table.mainData{width:100% !important;}
    table.mainData td{vertical-align: top !important;}
    div.slide{margin:0px 10px 0px 10px; border:1px solid #CFC4B1;padding:10px;}
    table#catalogoTable{font-size: 12px;}
    #localitaCartoWrap{display:none;}
    #localitaCarto{position:relative; display:block; width:92%;height:auto;padding:1%; border:1px solid #cacaca;}
    .listaDiv{ padding: 10px; background: #fff; width: 91%; border: 1px solid #ccc;}
    .listaDiv label{cursor:pointer;}
    label.main{display:inline-block;margin-top:10px;}
    #tableHeader{margin:30px 3px 5px 10px;}
    #legendaWrap{display:inline-block;width:49%;}
    #filtriWrap{display:inline-block;width:49%;text-align:right;}
    button.submit{padding:3px 8px; background:#fff; border:1px solid #ccc; cursor:pointer;}
    button.submit:hover,select.filtri:hover{background:#ccc;}
    .modLista a{text-decoration:none;}
</style>

</head>
<body>
    <div id="container">
        <div id="wrap">
            <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php"); }?>
            <div id="content">
                <?php require_once('inc/logoHub.php'); ?>
                <div id="livelloScheda">
                    <ul>
                        <li id="catalogoTitle" class="livAttivo">ELENCO AREE</li>
                    </ul>
                </div>
 
                <div id="skArcheoContent">
                    <div class="inner primo">
                        <div>
                            <?php if($usr) {include("inc/areeNew.php"); } ?>        
                            <div id="tableHeader">
                                <div id="legendaWrap"><legend id="legenda"></legend></div>
                                <div id="filtriWrap">
                                    <form action="aree.php" id="filtra" method="post">
                                        filtra ricerca:
                                        <select id="t" name="t" class="filtri">
                                            <option value="0">--tutte le tipologie--</option>
                                            <option value="1">area di interesse</option>
                                            <option value="2">ubicazione</option>
                                            <option value="3">cartografia</option>
                                        </select>
                                        <select id="c" name="c" class="filtri" style="width:200px;">
                                            <option value="0">--tutti i comuni--</option>
                                            <?php
                                            $qf = ("SELECT DISTINCT aree.id_comune, comune.comune, comune.cap AS cap_comune FROM aree, comune WHERE aree.id_comune = comune.id order by comune asc;");
                                            $qex = pg_query($connection, $qf);
                                            $qfr = pg_num_rows($qex);
                                            if($qfr != 0) {
                                                for ($a = 0; $a < $qfr; $a++){
                                                    $id = pg_result($qex, $a,"id_comune"); 	
                                                    $comune = pg_result($qex, $a,"comune");
                                                    $comune=stripslashes($comune);
                                                    $cap = pg_result($qex, $a,"cap");
                                                    echo "<option value=\"$id\">$comune $cap</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <button type="submit" class="submit"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            <table id="catalogoTable">
                                <thead>
                                    <tr>
                                        <th style="width:20px">ID</th>
                                        <th style="width:100px">TIPO</th>
                                        <th style="width:250px">AREA</th>
                                        <th style="width:400px">LOCALITÀ</th>
                                        <?php if($usr == 1 || $usr == 2 || $usr == 6) {echo '<th style="width:100px; text-align:center">GEOMETRIE</th>';} ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($r = pg_fetch_array($e)){
                                        if($r['tipo'] == 3 && $r['geom'] == 0) {$azione = '<span style="color:red !important">inserisci</span>';}
                                        elseif($r['tipo'] ==2 && $r['ubi'] == 0) {$azione = '<span style="color:red !important">inserisci</span>';}
                                        else {$azione = '<span style="color:#000 !important">gestisci</span>';}
                                        switch($r['tipo']){
                                            case 1: $tipo = 'Area di interesse'; break;
                                            case 2: $tipo = 'Ubicazione'; break;
                                            case 3: $tipo = 'Cartografia'; break;
                                        }
                                        echo "<tr id='".$r['id']."' area='".$r['area']."' title='clicca per modificare o eliminare il record'>";
                                            echo "<td class='link' >".$r['id']."</td>";
                                            echo "<td class='link' >".$tipo."</td>";
                                            echo "<td class='link' >".$r['area']."</td>";
                                            echo "<td class='link' >".$r['lista']."</td>";
                                            if($usr == 1 || $usr == 2 || $usr == 6) {echo '<td class="modLista"><a href="aree_geom.php?a='.$r['id'].'">'.$azione.'</a></td>';}
                                        echo "</tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!--content-->
            <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
        </div><!-- wrap-->
    </div><!--container-->
 <!--div invisibili -->
    <div id="dialog">  </div>
    <script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="lib/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="lib/funzioni.js"></script>
    <script type="text/javascript" >
        var locLength,legenda;
        var c = <?php echo $jc; ?>;
        var t = <?php echo $jt; ?>;
        $(document).ready(function() {
            $('.slide, #addArea').hide();
            $('.sezioni').click(function(){$('.slide').slideToggle();});
            $('#c option[value='+c+']').attr('selected','selected');
            $('#t option[value='+t+']').attr('selected','selected');
            legenda = (t==0 && c==0)?'Il database contiene ':'La ricerca ha prodotto ';
            $("#rubrica").hide();
            $("#tipo").change(function () {  
                var i=$(this).val();
                if (i==2) {$("#rubrica").fadeIn("slow");}else {$("#rubrica").fadeOut("slow");}
            });
            $("select[name=comuneCarto]").change(function() {
                var comId = $(this).val();
                loc(comId);
            });
            var arrLoc = new Array();
            $("button[name=salvaAree]").hide();
            $("#addArea").click(function(){
                var arrLocNome = new Array();
                var com = $("#comuneCarto option:selected").text();
                var comId = $("#comuneCarto").val();
                var checkLocChecked = $("input[name=localitaCartoCheck]:checked");
                var locLength = checkLocChecked.length;
                if (locLength==0){
                    arrLocNome.push('nessuna località specifica');
                    arrLoc.push({com: comId, loc:0});
                }else{
                    checkLocChecked.each(function(){
                        var nome = $(this).data('loc'); 
                        var id = $(this).val(); 
                        arrLocNome.push( nome);
                        arrLoc.push({com: comId, loc:id});
                    });
                }
                $("#locTot").append("<li><i class='fa fa-times removeArea' title='Elimina area'></i> Comune: "+com+", Località: <span class='idLoc' data-arrloc='"+arrLoc.join()+"'>"+arrLocNome.join(", ")+"</span></li>"); 
                $(".removeArea").click(function(){$(this).parent("li").remove();checkLocLi();});
                $("#localitaCartoWrap").fadeOut('fast');
                $("#comuneCarto").val(15);
                checkLocLi();
            });
            $("button[name=salvaAree]").click(function(){
                var tipoArea = $("#tipo").val();
                var nomeArea = $("#nomeArea").val();
                var rubrica = $("select[name=rubrica]").val();
                if(!tipoArea){ $("#test").text("Il campo tipologia area è obbligatorio"); return false; }
                if(!nomeArea){ $("#test").text("Il campo nome area è obbligatorio"); return false; }
                $.ajax({
                    url: 'inc/areeIns.php',
                    type: 'POST', 
                    data: {n:nomeArea,a:arrLoc, t:tipoArea},
                    success: function(data){ $("#test").html(data).delay(5000).fadeOut(function(){ location.reload(); }); }
                });//ajax
            });

            $('td.geom').click(function(){ var id = $(this).parent('tr').attr('id'); window.location.href = 'aree_geom.php?a='+id; });

            var righe = $('#catalogoTable tbody tr:visible').length;
            $('#legenda').html(legenda+'<b>'+righe+'</b> record');
            $('.link').click(function(){
                    var area = $(this).parent('tr').attr('area');
                    var id = $(this).parent('tr').attr('id');
                    $.ajax({
                        url: 'inc/form_update/areaCarto_update.php',
                        type: 'POST', 
                        data: {id:id, area:area},
                        success: function(data){
                            $("#dialog").html(data);
                            $("#dialog").dialog({resizable:false, modal:true, width: 700, title: "Modifica area "+area });
                        }
                    });
                });
        });
    </script>
</body>
</html>
