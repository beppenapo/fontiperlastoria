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
            h1{font-size:2em !important;}
            .main:last-child{margin-bottom:50px;}
            .sub, .main h3{margin:0px 10px;border:1px solid rgb(255, 137, 82); border-bottom:none;}
            .main:last-child .sub, .main:last-child h3{border:1px solid rgb(255, 137, 82) !important; }
            .main h3{color:rgb(255, 137, 82); padding:5px 10px; font-size:1.3em;cursor:pointer;}
            .main h3:hover, .act{color:#fff !important; background-color:rgb(255, 137, 82);}
            .sub{display:none;background:#f4f0ec;padding-bottom:10px;}
            .sub img{display:block; margin:0px auto; padding:30px 0px;}
            .borderBottom{border-bottom:1px solid rgb(255, 137, 82) !important;}
  </style>

</head>
<body>
    <div id="container">
        <div id="wrap">
            <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php");}?>
            <div id="header"><?php require_once ("inc/header.php"); ?></div><!--header-->
            <div id="content">
                <div id="istruzioniContent">
                    <p>&nbsp;</p>
                    <h1> Il WebGIS </h1>
                    <div class="main">
                        <h3 class="act"><i class="fa fa-minus-circle"></i> Come navigare nella mappa</h3>
                        <div class="sub">
                            <p>Il pannello degli <b>strumenti</b> <i>pan</i> (spostamento) e <i>zoom</i> (ingrandimento) è in basso a sinistra.</p>
                            <p>Partendo dall’alto, i pulsanti <b>+</b> e <b>–</b> servono per aumentare e diminuire lo <b>zoom</b> della mappa (lo zoom si ottiene anche con il doppio click).<br>Premendo il pulsante “<b>mondo</b>” tra il + ed il – si resetta lo zoom per tornare alla scala di partenza.</p>
                            <p>I due pulsanti sottostanti (ossia le due <b>lenti di ingrandimento con le frecce</b>) permettono di muoversi all’interno della cronologia degli zoom.</p>
                            <p>Per tornare, dopo lo zoom, ad usare il mouse come <b>puntatore</b>, è sufficiente cliccare sul <b>pulsante rotondo con le quattro frecce</b> (pan).</p>
                            <p>Il pulsante “<b>lente di ingrandimento</b>”, infine, permette di selezione l’area da ingrandire, cliccando e trascinando il puntatore. </p>
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> Come utilizzare la cartografia di base</h3>
                        <div class="sub">
                            <p>La parte superiore del pannello principale, in alto a destra, è dedicata alla <b>cartografia di base</b>.</p>
                            <p>È possibile scegliere tra due tipi di visualizzazioni: la prima (già impostata) è quella <b>aerofotografica</b> Bing Maps Aerial (Data by <a href="http://www.microsoft.com/maps//" title="Link alla pagina del progetto Microsoft Bing Maps">Microsoft® Bing™ Maps </a>), basata su fotografie scattate nel settembre 2012. Selezionando <b>openstreetmap</b> viene invece visualizzata la mappa OpenStreetMap (Data CC-By-SA by <a href="http://www.openstreetmap.org/" title="Link alla pagina del progetto OpenSreetMap">OpenStreetMap</a>).</p>
                            <p>Sono inoltre già impostate le opzioni <b>comuni</b> e <b>toponomastica</b>: la prima evidenzia i confini amministrativi dei territori comunali; la seconda permette di visualizzare – una volta ingrandita sufficientemente la mappa – i principali toponimi. Per deselezionare queste opzioni, è sufficiente spuntare i box di selezione corrispondenti. </p>
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> Come visualizzare le aree di interesse</h3>
                        <div class="sub">
                            <p>Le aree di interesse delle fonti schedate sono distinte in base alla categoria di fonte cui si riferiscono (archeologica, architettonica, archivistica, bibliografica, della cultura materiale, fotografica, orale, storico artistica), ciascuna delle quali è associata ad un colore. Spuntando una o più categorie si visualizzano le aree di interesse corrispondenti.<br>
 Cliccando sulla scritta “<b>area di interesse</b>” si attivano contemporaneamente le aree di tutte le categorie di fonti.</p>
                            <p>La barra scorrevole sottostante l’elenco delle fonti permette di aumentare o diminuire la <b>trasparenza</b> delle aree di interesse. </p>
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> Come interrogare le aree di interesse</h3>
                        <div class="sub">
                            <p>Utilizzando il pulsante <b>pan</b> (il puntatore con le quattro frecce nel pannello in basso a sinistra) è possibile interrogare le aree di interesse visualizzate.</p>
                            <p>Cliccando sulla mappa all’interno di un’area colorata, si apre un <b>box</b> in cui vengono elencate le <b>geometrie</b> – dalla più piccola alla più grande – che contengono il punto selezionato. Ad esempio: se si clicca su un edificio del centro storico di Mezzano, nel box verranno elencate le seguenti geometrie: l’edificio stesso, il centro storico, il Comune di Mezzano, la Comunità di Primiero.</p>
                            <p>Scorrendo il puntatore sull’elenco, senza cliccare, tali aree vengono evidenziate in blu sulla mappa: ciò permette di individuare in modo immediato la geometria che interessa interrogare.</p>
                            <p>Cliccando sulla geometria prescelta, appare l’<b>elenco delle schede associate</b> ad essa.</p>
                            <p>Ogni scheda è individuata da un <b>codice alfanumerico colorato</b> (es: MATER-II-0020, ARCHEO-I-0003, ecc.): cliccando su quest’ultimo è possibile aprire direttamente la scheda.</p>
                            <p>Si badi che i risultati dell’elenco sono relativi esclusivamente alle categorie di fonti selezionate nel pannello a destra (ad esempio, se si sceglie di visualizzare le aree di interesse delle fonti archivistiche ed orali, nel box compariranno solo schede archivistiche ed orali, anche se magari la stessa geometria è condivisa da fonti di altro tipo).</p>
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> Come visualizzare le ubicazioni</h3>
                        <div class="sub">
                            <p>A differenza delle le aree di interesse, le <b>ubicazioni</b> delle schede (ossia il luogo in cui si trova od è conservata la fonte) sono esclusivamente puntiformi.</p>
  <p>Per visualizzare i <b>punti di ubicazione</b> collegati ad un tipo di fonte occorre spuntare i box di selezione corrispondenti.</p>
  <p>Anche in questo caso si possono attivare le ubicazioni di più categorie di fonti contemporaneamente.</p>
                        </div>
                    </div>
                    <div class="main">
                        <h3 class="borderBottom"><i class="fa fa-plus-circle"></i> Come interrogare le ubicazioni</h3>
                        <div class="sub borderBottom">
                            <p>Utilizzando il pulsante <b>pan</b> (il puntatore con le quattro frecce nel pannello in basso a sinistra) è possibile interrogare le ubicazioni.</p>
                            <p>Cliccando su un punto, appare un <b>box</b> in cui viene specificata la <b>denominazione di tale punto</b>, con elencate in successione le schede delle fonti collocate in quel luogo. Per rendere questa operazione più snella, si è scelto di non indicare tutte le singole fonti associate ad un punto di ubicazione, ma di risalire sempre alla scheda di livello superiore che possa comprenderle. Ad esempio, se si clicca sull’edificio ospitante un archivio, nel box non saranno elencate tutte le schede di secondo e terzo livello relative ad i fondi ed ai documenti lì conservati, bensì esclusivamente la scheda di primo livello che le comprende, ossia quella dell’archivio stesso.</p>
                            <p>Ogni scheda è individuata da un <b>codice alfanumerico colorato</b> (es: MATER-III-0020, ARCHEO-I-0003, ecc.): cliccando su quest’ultimo è possibile aprire direttamente la scheda.</p>
                            <p>Si badi che i risultati dell’elenco sono relativi esclusivamente alle categorie di fonti selezionate nel pannello a destra (ad esempio, se si sceglie di visualizzare le ubicazioni delle fonti archivistiche ed orali, nel box compariranno solo schede archivistiche ed orali, anche se magari in quello stesso punto di ubicazione sono collocate fonti di altro tipo).</p>
                        </div>
                    </div>
                    <h1> Il database </h1>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> Prima di iniziare, la struttura in sintesi</h3>
                        <div class="sub">
                            <p>Il database contiene schede di fonti appartenenti a <b>otto tipologie</b> (archivistiche, bibliografiche, fotografiche, architettoniche, orali, relative alla cultura materiale, archeologiche, storico-artistiche). <br>
La schedatura, inoltre, è sviluppata su <b>diversi livelli di approfondimento</b>: nelle schede di <b>primo livello</b> sono riportate le informazioni relative agli “insiemi” di fonti (biblioteche, archivi, collezioni, musei, scavi archeologici, gruppi di interviste, ecc.); le schede di <b>secondo livello</b> sono dedicate alle unità contenute in tali insiemi (articoli, fondi archivistici, manufatti, fotografie, siti archeologici, interviste, opere d’arte, ecc.). <br>
Alcuni tipi di fonti (segnatamente, allo stato attuale, quelle archivistiche, orali e relative alla cultura materiale) hanno richiesto l’elaborazione di una schedatura di <b>terzo livello</b>, che permette di dettagliare ulteriormente l’analisi: qui vengono schedati, rispettivamente, documenti archivistici, singoli frammenti narrativi all’intero di un’intervista e, nel caso delle fonti materiali, singole evidenze viarie o singoli manufatti.</p> 
                            <p>Nella pagina dedicata al database, sotto alle stringhe di ricerca e di filtro, è visualizzato, in forma riassuntiva, l’intero catalogo dei record schedati. Per ogni record sono indicati i seguenti dati: il numero della scheda, il livello di individuazione, la denominazione dell’oggetto schedato, le eventuali note relative a tale denominazione, la cronologia specifica della fonte. </p>
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> Come eseguire una ricerca per parola chiave all'interno del catalogo</h3>
                        <div class="sub">
                            <p>La ricerca semplice è organizzata per <b>parola chiave</b>; essa si basa su un thesaurus chiuso costantemente aggiornato di frammenti di vocaboli (i <i>lexems</i> utilizzati nella <a href="http://www.postgresql.org/docs/8.3/static/textsearch-intro.html" >Full Text Search</a> di PostgreSQL) terminanti con asterisco: ad es. mas*, masc*, mascher*…<br>
Per facilitare la ricerca, non appena si digitano delle lettere nell’apposita stringa di immissione, compare una lista di <b>suggerimenti</b> dalla quale selezionare il vocabolo. <br> Scelto il vocabolo da ricercare, si clicca sul pulsante “lente di ingrandimento”. <br>
L’elenco dei record sottostante le stringhe di ricerca e di filtro viene quindi aggiornato, visualizzando esclusivamente i <b>risultati</b> della ricerca.</p>
                            <p>Nella lista dei risultati i record sono disposti  in <b>ordine di rilevanza</b> (rank). Se la parola chiave cercata è presente nei campi visualizzati, essa viene <b>evidenziata</b> in grassetto. </p>
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> Come eseguire una ricerca incrociata per parole chiave all'interno del catalogo</h3>
                        <div class="sub">
                            <p>La ricerca semplice, condotta nel modo illustrato nel paragrafo precedente, permette l’utilizzo incrociato di più parole chiave. <br> 
Selezionando il comando “aggiungi parola”, si possono utilizzare fino a <b>tre chiavi di ricerca</b>, legate da diverse combinazioni logiche:</p>
                            <p>– <b>AND</b> consente di visualizzare i record in cui sono presenti tutte le parole digitate;<br>– <b>OR</b> seleziona i record in cui compare almeno una delle chiavi ricercate;<br>– <b>NOT</b>, infine, serve per individuare i record che contengono una parola e che contemporaneamente ne escludono un’altra. </p>
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i>Come filtrare le schede del catalogo</h3>
                        <div class="sub">
                            <p>L’elenco dei risultati ottenuto con la ricerca semplice illustrata nei paragrafi precedenti, può essere filtrato in base a <b>tre parametri</b>:</p>
                            <p>– il <b>tipo di fonte</b>,<br>– il <b>livello di schedatura</b>,<br>– l’<b>arco cronologico</b>.</p>
                            <p>Per applicare tali filtri basta selezionare, da sinistra, uno o più degli otto pulsanti che rappresentano i tipi di fonti presenti nel database; il livello od i livelli (primo, secondo o terzo) di schedatura prescelti e la cronologia, che può essere circoscritta utilizzando la barra del tempo. <br> Cliccando quindi il pulsate “scolapasta” si ottiene la lista dei record che rispettano i parametri stabiliti.<br>Per condurre una nuova ricerca è necessario deselezionare (cliccandoci sopra) i filtri impostati o semplicemente aggiornare la pagina.</p>
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i>Come eseguire una ricerca specifica all’interno di un determinato tipo e livello di scheda</h3>
                        <div class="sub">
                            <img src="img/pagineFonti/wip.png" alt="Work in progress" />
                        </div>
                    </div>
                </div>
            </div><!--content-->
            <div id="footer"><?php require_once ("inc/footer.inc"); ?></div><!--footer-->
        </div><!-- wrap-->
    </div><!--container-->
    <script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
    <script type="text/javascript" src="lib/menu.js"></script>
    <script type="text/javascript" src="lib/funzioni.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('.sub').first().show();
    $(".main h3").on("click",function(){toggleSezioni($(this));});
}); //fine funzione principale
</script>
</body>
</html>
