<?php
session_start();
if (!isset($_SESSION['username'])){$_SESSION['username']='guest';}
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
        <link href="css/default.css" type="text/css" rel="stylesheet" media="screen" />
        <link href="css/ico-font/css/font-awesome.css" type="text/css" rel="stylesheet" media="screen" />
        <link rel="shortcut icon" href="img/icone/favicon.ico" />
        <style>
            .main:last-child{margin-bottom:50px;}
            .sub, .main h3{margin:0px 10px;border:1px solid rgb(0, 102, 255); border-bottom:none;}
            .main:last-child .sub, .main:last-child h3{border:1px solid rgb(0, 102, 255) !important; }
            .main h3{color:rgb(0, 102, 255); padding:5px 10px; font-size:1.3em;cursor:pointer;}
            .main h3:hover, .act{color:#fff !important; background-color:rgb(0, 102, 255);}
            .sub{display:none;background:#f4f0ec;padding-bottom:10px;}
            .sub img{display:block; margin:0px auto; padding:30px 0px;}
            .borderBottom{border-bottom:1px solid rgb(255, 137, 82) !important;}
            .pHover{font-size:14px !important;font-weight:bold !important;margin:0px !important;padding:5px!important;color:#fff !important;background-color:rgb(0, 102, 255);}
            .titoletto{position:absolute; top:30px; left: 28px; font-size:12px;}
            #imgDialog{display: none;position: fixed; top:0px; left:0px; background-color: rgba(255, 255, 255,0.8) !important; width: 100%; height:100%;z-index: 100;}  
            #panWrap { position:relative; width:650px;height:650px;margin:10px auto 0px; border:1px solid  rgb(0,102,255);}
            #imgDialog #closePan{background:rgb(0, 102, 255); text-align:right;padding:5px 10px;font-size:1.3em;color:#fff;}
            #closePan i{cursor:pointer;}
            #panImgWrap{position:relative;width:100%;height:575px;margin:0px;padding:0px;}
            #pan img{display:block;width:550px; height:553px; margin:10px auto;}
            #imgControls{ width:600px; margin:15px auto 0px; text-align:center; }
        </style>
    </head>
    <body>
        <div id="container">
            <div id="wrap">
                <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php");}?>
                <div id="header"><?php require_once ("inc/header.php"); ?></div><!--header-->
                <div id="content">
                    <div id="webgisContent">
                        <p>&nbsp;</p>
                        <div class="main">
                            <h3 class="act"><i class="fa fa-minus-circle"></i> La struttura relazionale del database</h3>
                            <div class="sub">
                                <p>Come tutti i database relazionali, il progetto “Le fonti per la storia” utilizza un insieme di tabelle e di dati strettamente collegati ed organizzati attorno ad una <b>struttura di relazioni</b>.</p>
                                <p>Le 19 tabelle incluse nel progetto (8 tipi di fonti per 2 livelli di approfondimento, alle quali si aggiungono ulteriori 3 forms di terzo livello) riproducono l'architettura interna del database, semplificando gli aspetti relazionali per rendere agevole agli utenti la navigazione e l'interrogazione.</p>
                                <p>Tutte le tabelle delle fonti storico-territoriali, oltre a rispettare una serie di liste valori comuni, condividono l’impianto organizzativo della banca dati. Il cuore di quest’ultima è rappresentato da tre grandi insiemi: i <b>campi e le tabelle comuni</b> a tutti i record, la <b>dimensione cronologica</b> e la <b>dimensione geometrica/geografica</b> dei dati raccolti.</p>
                                <p>A questa catena centrale di relazioni si aggiungono una serie di <b>collegamenti verticali</b> tra fonti di differente livello analitico ma dello stesso tipo, e <b>collegamenti orizzontali</b> tra fonti e livelli di tipo diverso.</p>
                                <p>Il <big><a>grafo relazionale</a></big> che qui si propone illustra l’architettura del database.</p>
                                <p>All’interno del grafo sono semplificati i legami che intercorrono tra gli elementi strutturali del progetto. Accanto a questi sono rappresentate anche le relazioni concettuali tra singoli elementi o porzioni di tabelle.</p>
                                <p>Questi collegamenti possono offrire un buon punto di partenza per intraprendere ricerche specifiche all’interno dei dati raccolti. La complessa struttura del database permette di far dialogare dal punto di vista cronologico e geografico differenti tipi di fonti, ed è proprio attraverso tali relazioni che il database esprime al meglio il suo carattere interdisciplinare.</p>
                                <div style="text-align:center;">
                                    <img src="img/layout/schema_relazionale_small.png" id="thumb" style="cursor:pointer;" alt="Work in progress"/>
                                    <label style="display:block;">Clicca sull'immagine per ingrandirla</label> 
                                </div>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> Il software utilizzato</h3>
                            <div class="sub">
                                <p>Si elencano qui di seguito gli strumenti utilizzati per la strutturazione del progetto:</p>
                                <p><b>Database</b></p>
                                <p>– <a href="http://www.postgresql.org/docs/9.2/static/release-9-2-4.html">PostgreSQL v.9.2.4</a> <br> – <a href="http://postgis.net/">PostGIS</a></p>
                                <p><b>Server geografico</b></p>
                                <p>– <a href="http://geoserver.org/">GeoServer v.2.2.4</a></p>
                                <p><b>Librerie JavaScript</b></p>
                                <p>– <a href="http://jquery.com/">jQuery</a><br>– <a href="http://jqueryui.com/">jQuery-ui</a><br>– <a href="http://tablesorter.com/docs/">jQuery tablesorter</a><br> – <a href="http://craigsworks.com/projects/qtip/">qTip</a><br>– <a href="http://plugins.jquery.com/">jQuery-plugin</a><br>– <a href="http://openlayers.org/">OpenLayers</a><br></p>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> Le licenze d'uso e il copyright</h3>
                            <div class="sub">
                                <p><b>Codice sorgente della parte web (struttura delle pagine, funzioni php e javascript inedite)</b><p>
                                <p><a href="http://www.gnu.org/licenses/agpl-3.0.html">Affero GPL</a><br>La GNU Affero General Public License o GNU AGPL è una licenza di software libero pubblicata dalla Free Software Foundation. La GNU AGPL è simile alla capostipite GNU General Public License, con l'eccezione di una sezione aggiuntiva (la numero 13) che si riferisce all'utilizzo del software su una rete di calcolatori. Tale sezione richiede che il codice sorgente, se modificato, sia reso disponibile a chiunque utilizzi l'opera sulla rete. Il codice da fornire non sarà solo quello coperto da AGPL, ma anche tutti i moduli da esso utilizzati (escluse naturalmente le librerie di sistema). Come quasi tutte le licenze, la AGPL proibisce la rimozione della licenza stessa.<br>[Fonte: wikipedia]</p>
                                <img src="img/icone/logoAGPL.png"/>
                                <p><b>Codice sorgente della parte web (funzioni javascript di OpenLayers e jQuery)</b><p>
                                <p><a href="https://www.gnu.org/licenses/lgpl.html">Lesser GPL</a><br>La GNU Lesser General Public License (abbreviata in GNU LGPL o solo LGPL) è una licenza di software libero creata dalla Free Software Foundation, studiata come compromesso tra la GNU General Public License e altre licenze non copyleft come la Licenza BSD, la Licenza X11 e la Licenza Apache.<br>La LGPL è una licenza di tipo copyleft ma, a differenza della licenza GNU GPL, non richiede che un eventuale software "linkato" al programma sia rilasciato sotto la medesima licenza.<br>[Fonte: wikipedia]</p>
                                <img src="img/icone/logoLGPL.png"/>
                                <p><b>Struttura del database, dati geografici, contenuti delle pagine web, immagini originali</b><p>
                                <p><a href="http://creativecommons.org/about/cc0">CC0 Public Domain</a><br>Chi associa un proprio lavoro a questa licenza dedica l'Opera al pubblico dominio attraverso la rinuncia a tutti i suoi diritti protetti dal diritto d'autore, inclusi i diritti ad esso connessi, in tutto il mondo, nei limiti consentiti dalla legge. Salvo indicazione esplicita contraria, la persona che associa questa licenza ad una propria Opera non fornisce alcuna garanzia riguardo all'Opera stessa, e declina ogni responsabilità per tutti gli usi dell'Opera, nella misura massima consentita dalla legge applicabile. Quando si utilizza o si cita l'Opera, ciò non deve implicare alcun avallo, riconoscimento o sponsorizzazione da parte dell'autore o del dichiarante. CC0 consente a scienziati, educatori, artisti, altri creatori e proprietari di diritti d'autore o di altri contenuti protetti dalle norme sulle banche dati di rinunciare a tali diritti sulle loro opere e, quindi, lasciarli nel modo più completo possibile al pubblico dominio, in modo che altri possano liberamente sviluppare, migliorare e riutilizzare le opere per altri scopi senza le restrizioni relative al diritto d'autore o al diritto di protezione delle banche dati.<br> [Fonte: Creative Commons]</p>
                                <img src="img/icone/logoC0.png"/>
                                <p><b>Immagini riutilizzate</b><p>
                                <p>Delle immagini riutilizzate – la maggior parte delle quali con licenza open – è sempre specificata la fonte. Le immagini della parte grafica (icone, immagini di layout ecc.) sono state create appositamente per il sito ed è stato pertanto possibile licenziarle con CC0.</p>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> What's new?</h3>
                            <div class="sub">
                                <p>Molte sono le rifiniture progettate e messe in atto per rispettare l'idea di fondo del progetto ed il concetto stesso di WebGIS storico.<br>Per gestire correttamente i dati geografici raccolti e per salvaguardare la coerenza logica dell'interno sistema sono state sviluppate alcune funzioni specifiche, sfruttando la naturale interazione tra le librerie utilizzate all'interno del progetto: ciò è risultato necessario, ad esempio, per permettere l’interrogazione delle geometrie nel WebGIS le quali, facendo capo a forme spaziali ed a riferimenti concettuali diversi, non potevano essere trattate in modo univoco.<br>Un’ulteriore “rifinitura” è l'utilizzo del modulo Full Text Search di PostgreSQL e di alcune importanti funzioni come il calcolo del rank e l'highlight delle parole immesse nella pagina di ricerca del database. Poiché il progetto è in continuo progresso, per facilitare la ricerca  è stata applicata la funzione ts_stat che crea un vocabolario di tutte le parole via via indicizzate.</p>
                            </div>
                        </div>
                    </div>
                </div><!--content-->
                <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
            </div><!-- wrap-->
        </div><!--container-->
        <div id="imgDialog">
            <div id="panWrap">
                <div id="closePan"><i class="fa fa-times"></i></div>
                <div id="panImgWrap">
                    <div id="pan"> <img src="img/layout/schema_relazionale.png" /></div>
                </div>
                <div id="imgControls">
                    <a id="zoomin" href="#" title="ingrandisci l'immagine"><img src="img/icone/zoom_in.png"></a>
                    <a id="zoomout" href="#" title="diminuisci l'immagine"><img src="img/icone/zoom_out.png"></a>
                    <a id="reset" href="#" title="torna alle dimensioni iniziali"><img src="img/icone/arrow_out.png"></a>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="lib/jquery.panzoom.min.js"></script>
        <script type="text/javascript" src="lib/menu.js"></script>
        <script type="text/javascript" src="lib/funzioni.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                initPanZoom();
                $('.sub').first().show();
                $(".main h3").on("click",function(){toggleSezioni($(this));});
                $('#thumb').click(function () { $('#imgDialog').fadeIn(500); });
                $('#closePan i').click(function () { $('#imgDialog').fadeOut(500); });
            });
        </script>
</body>
</html>
