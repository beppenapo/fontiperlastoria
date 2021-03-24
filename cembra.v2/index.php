<?php
require("class/global.class.php");
$tags=new General;
$tagList = $tags->tagList();
$luoghi = array();
foreach ($tagList['geotag'] as $item) {
    $firstLetter = substr(strtoupper($item['tag']), 0, 1);
    $luoghi[$firstLetter][] = $item;
}
$parole = array();
foreach ($tagList['tag'] as $item) {
    $firstLetter = substr(strtoupper($item['tag']), 0, 1);
    $parole[$firstLetter][] = $item;
}
?>
<!doctype html>
<html lang="it">
  <head>
    <?php require('inc/meta.php'); ?>
    <?php require('inc/css.php'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
  <link rel="stylesheet" href="css/L.Control.MousePosition.css">
  </head>
  <body>
    <?php require('inc/header.php'); ?>
    <div class="maintitle headerHome lozad" data-background-image="img/header_prova2.jpg" id="home"></div>
    <div class="mainScope pt-5">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <div class="text-center">
              <p class="ancora animation">IMMAGINI</p>
            </div>
          </div>
          <div class="col-4">
            <div class="text-center">
              <p class="ancora animation">LUOGHI</p>
            </div>
          </div>
          <div class="col-4">
            <div class="text-center">
              <p class="ancora animation">PAROLE</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="pt-2 mainText text-justify">L’archivio fotografico nasce a fine 2019 a supporto della candidatura del territorio della Valle di Cembra all’interno del Registro nazionale dei Paesaggi Rurali Storici. Le fotografie qui raccolte e catalogate provengono da archivi storici fotografici della provincia di Trento e da archivi privati. Le informazioni a corredo delle immagini derivano da dati archivistici, dati storici e da informazioni raccolte durante il periodo di attività del comitato Vi.Va.Ce. - Viticoltura Valle di Cembra.
L’auspicio è che il progetto possa proseguire con il più ampio coinvolgimento dei cembrani e degli enti locali.
Le fotografie costituiscono infatti una documentazione di grande importanza sulla storia e la memoria di questi luoghi, di cui possono liberamente fruire studiosi, ricercatori e cultori della storia locale, le scuole e le biblioteche comunali, le associazioni culturali, gli enti di promozione turistica, tutti i cittadini interessati. Il valore pubblico di questo materiale d’archivio è reso ancora più importante dal ruolo che esso può svolgere nell’attività di pianificazione a favore di uno sviluppo equilibrato e sostenibile.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div id="mainSection">
      <div class="mt-5 bg-white" id="immagini">
        <div class="container">
          <div class="row my-2">
            <div class="col">
              <h2 class="py-2 m-0">
                <i class="far fa-image"></i>
                IMMAGINI
                <a href="#home" class="text-dark float-right scroll" data-id="home">
                  <i class="fas fa-angle-double-up"></i>
                </a>
              </h2>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid mb-5">
        <div class="row wrapImg"></div>
      </div>

      <div class="mt-5 bg-white" id="luoghi">
        <div class="container">
          <div class="row my-2">
            <div class="col">
              <h2 class="py-2 m-0">
                <i class="fas fa-map-signs pr-2"></i>
                LUOGHI
                <a href="#home" class="text-dark float-right scroll" data-id="home">
                  <i class="fas fa-angle-double-up"></i>
                </a>
              </h2>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-2 mb-5">
        <div class="row">
          <div class="col text-center">
            <form class="form geoTagContent" action="gallery.php" method="get" name="geoTagForm">
              <?php
              foreach ($luoghi as $key => $value) {
                echo "<span class='firstLetter h1 geotag'>".$key."</span>";
                foreach ($value as $tag) {
                  echo "<label class='tag geotag animation rounded' style='font-size:".$tag['size']."px' data-id='".$tag['geoid']."' data-filtro='geotag' data-tag='".$tag['tag']."'>".str_replace('\\','',$tag['tag'])."<span class='d-none d-lg-inline-block animation'>".$tag['schede']."</span></label>";
                }
              }
              ?>
            </form>
            <div class="pt-3 pb-5">
              <?php if (count($luoghi) > 0) { ?>
                <button type="button" class="mx-auto w-50 p-2 animation rounded pointer border-0" name="loadMore" data-section="geotag">show more <i class="fas fa-angle-double-down"></i></button>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div id="mapContent" class="bg-white">
              <div id="map" class="bg-white">
                <div id='loader' class="flex-center w-100 h-100"><i class="fas fa-spinner fa-spin fa-7x"></i></div>
                <div class="mySwitch">
                  <div class="input-group">
                    <input type="radio" name="baseLayer" value="thunderF" id="thunderF" checked>
                    <label for="thunderF">Thunderforest neighbourhood</label>
                  </div>
                  <div class="input-group">
                    <input type="radio" name="baseLayer" value="osm" id="osm">
                    <label for="osm">OpenStreetMap</label>
                  </div>
                </div>
              </div>
              <div id="panel" class="">
                <div class="panel-content">
                  <header id="nome-area" class="border-bottom h5"></header>
                  <section class="imgGallery"></section>
                  <footer class="border-top pointer closePanel">chiudi pannello <i class="fas fa-arrow-right"></i> </footer>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5 bg-white" id="parole">
        <div class="container">
          <div class="row">
            <div class="col">
              <h2 class="py-2 m-0">
                <i class="fas fa-hashtag pr-2"></i>
                PAROLE
                <a href="#home" class="text-dark float-right scroll" data-id="home">
                  <i class="fas fa-angle-double-up"></i>
                </a>
              </h2>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-2 mb-5">
        <div class="row">
          <div class="col text-center">
            <form class="form geoTagContent" action="gallery.php" method="get" name="geoTagForm">
              <?php
              foreach ($parole as $key => $value) {
                echo "<span class='firstLetter h1 textag'>".$key."</span>";
                foreach ($value as $tag) {
                  echo "<label class='tag textag animation rounded' style='font-size:".$tag['size']."px' data-id='".$tag['id']."' data-filtro='tag' data-tag='".$tag['tag']."'>".$tag['tag']."<span class='d-none d-lg-inline-block'>".$tag['schede']."</span></label>";
                }
              }
              ?>
            </form>
            <div class="pt-3">
              <?php if (count($parole) > 0) { ?>
              <button type="button" class="mx-auto w-50 p-2 animation rounded pointer border-0" name="loadMore" data-section="textag">show more <i class="fas fa-angle-double-down"></i></button>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5 bg-white" id="aboutus">
        <div class="container">
          <div class="row">
            <div class="col">
              <h2 class="py-2 m-0">
                ABOUT US
                <a href="#home" class="text-dark float-right scroll" data-id="home">
                  <i class="fas fa-angle-double-up"></i>
                </a>
              </h2>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-2 mb-5">
        <div class="row">
          <div class="col">
            <p class="pt-2 mainText text-justify">
              Il progetto per la costruzione di un archivio storico fotografico della Valle di Cembra è un'iniziativa promossa dal comitato Vi.Va.Ce. - Viticoltura Valle di Cembra, in collaborazione con la Cooperativa di ricerca TeSto. 
Il comitato Viticonltura in Valle di Cembra (VI.VA.CE.) è stato costituito il 21 febbraio 2019 con lo specifico scopo di promuovere il paesaggio terrazzato della Valle di Cembra, per candidarlo all’iscrizione al Registro nazionale dei paesaggi rurali storici previsto dall’Osservatorio Nazionale del Paesaggio rurale, delle pratiche agricole e conoscenze tradizionali (ONPR).
Membri del Comitato sono i principali attori del territorio nei settori agricolo e turistico, ventidue soci tra imprese agricole, associazioni locali e istituzioni, rappresentanti di aziende, associazioni e istituzioni.
Il comitato garantisce un coinvolgimento delle realtà private, delle Istituzioni e delle Associazioni del territorio, favorendo la crescita di una consapevolezza diffusa del valore rappresentato dai terrazzamenti vitati della Valle di Cembra, da un punto di vista paesaggistico, economico e turistico.
Il progetto si propone di raccogliere fotografie e cartoline con immagini di paesaggi, nonché cartografie e altre forme di rappresentazione iconografica del territorio, presso gli enti locali, le biblioteche e i musei, le associazioni, i collezionisti e le famiglie.
Il materiale raccolto viene duplicato in formato digitale e subito restituito ai proprietari. Le copie digitali, ordinate e catalogate sono rese liberamente disponibili, per la consultazione e per attività di studio e di ricerca, grazie a questo sito web dedicato. I materiali originali restano nella piena proprietà dei prestatori, il cui nominativo, previa autorizzazione, viene indicato nelle scheda correlata a ogni immagine nell'archivio on-line, affinché ci si possa rivolgere direttamente a loro per eventuali richieste di utilizzo delle immagini.
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <img src="img/aboutus1.jpg" class="img-fluid my-3 rounded" alt="logo sezione about us">
          </div>
        </div>
      </div>

      <div class="mt-5 bg-white" id="download">
        <div class="container">
          <div class="row">
            <div class="col">
              <h2 class="py-2 m-0">
                DOWNLOAD
                <a href="#home" class="text-dark float-right scroll" data-id="home">
                  <i class="fas fa-angle-double-up"></i>
                </a>
              </h2>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-2 mb-5">
        <div class="row">
          <div class="col">
            <p class="pt-2 mainText text-justify">
              Le immagini qui pubblicate in media risoluzione sono disponibili al download gratuito senza formalità. Il Comitato Vi.Va.Ce. - Viticoltura Valle di Cembra conserva i files originali ad alta definizione. Gli interessati possono chiederne copia al Comitato che la rilascerà previa dichiarazione di assenza di scopo di lucro. In tutti i casi, qualora l'immagine venisse stampata o comunque riprodotta, va obbligatoriamente mantenuto il formato originale e dichiarata la proprietà attraverso la formula:
            </p>
            <p class="border border-dark bg-light rounded text-center p-3">Archivio fotografico Viticoltura terrazzata Valle di Cembra<br>
            Proprietà del comitato VI.VA.CE. - Viticoltura Valle di Cembra</p>
          </div>
        </div>
      </div>

      <!-- <div class="mt-5 bg-white" id="miniere"> 
        <div class="container">
          <div class="row">
            <div class="col">
              <h2 class="py-2 m-0">
                QUANDO ANDAVAMO IN MINIERA
                <a href="#home" class="text-dark float-right scroll" data-id="home">
                  <i class="fas fa-angle-double-up"></i>
                </a>
              </h2>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-2 mb-5">
        <div class="row">
          <div class="col">
            <p class="pt-2 mainText text-justify">
              Quasi 800 immagini raccolte nell'archivio iconografico provengono dal progetto "Quando andavamo in miniera. Immagini e voci dei paesaggi minerari storici della Comunità Alta Valsugana e Bersntol". Questo lavoro è stato promosso dall'Ecomuseo Argentario con il patrocinio della Comunità Alta Valsugana e Bersntol ed è stato realizzato con il contributo finanziario della Fondazione Cassa di Risparmio di Trento e Rovereto (bando 2016 per progetti di valorizzazione della memoria delle comunità). E’ stato inoltre supportato da un ampio partenariato di realtà locali, quali Amministrazioni Comunali, Biblioteche Comunali, Fondazione Museo Storico del Trentino, Parco Minerario Alta Valsugana e Bersntol, Associazione culturale Filò di Vignola Falesina, Gruppo culturale minatori di Calceranica al Lago e Museo Pietra Viva di Sant’Orsola Terme.
			  L'iniziativa, sviluppata tra settembre 2016 e aprile 2017, si è proposta di raccogliere e valorizzare immagini e ricordi legati ai paesaggi costruiti dall'attività estrattiva storica (miniere e cave), grazie alla collaborazione di enti, associazioni, collezionisti e famiglie.
              La raccolta del materiale in copia digitale – fotografie, cartoline e altre illustrazioni, carte topografiche, geologiche e catastali, planimetrie, progetti, rilievi dalla fine dell’Ottocento ai giorni nostri – si è svolta tra ottobre e dicembre 2016 presso Biblioteche e Punti di Lettura della Comunità, coinvolgendo enti pubblici, associazioni e privati. Contemporaneamente sono state realizzate interviste ad anziani ed ex lavoratori delle miniere e delle cave e ad appassionati dell’esplorazione sotterranea.
              </p>
              <p class="pt-2 mainText text-justify">
              Il progetto è stato ideato dall'Ecomuseo Argentario, che ha curato la progettazione nonché il coordinamento scientifico e organizzativo delle attività. Per l'Ecomuseo ha collaborato Katia Lenzi, che ha seguito le attività di raccolta e di schedatura dei materiali e di realizzazione delle interviste audio e video.
			  Il Servizio Urbanistica della Comunità Alta Valsugana e Bersntol ha collaborato all'iniziativa. Per la Comunità di Valle hanno inoltre collaborato Cinzia Frisanco, Assessore all'Urbanistica e Serena Tonezzer.
              La progettazione di database e WebGIS e l'implementazione del sito web sono state effettuate dalla Cooperativa di ricerca TeSto territorio, storia e società, di Fiera di Primiero (TN), con Ester e Francesca Brunet, Alberto Cosner, Simone Gaio, Angelo Longo e Giuseppe Naponiello (Arc-Team).
              </p>
          </div>
        </div>
        <div class="row my-5 pb-5">
          <div class="col text-center">
            <div class="pt-3">
              <a href="gallery.php?filtro=miniere" class="form-control mx-auto w-50 p-2 animation rounded pointer border-0 loadMiniere">GALLERY</a>
            </div>
          </div>
        </div>
        <div class="row my-5 pb-5">
          <div class="col text-center">
            <img src="img/loghi/logoEcomuseo.png" width="300" alt="">
          </div>
        </div>
        <div class="row my-5 pb-5">
          <div class="col text-center">
            <img src="img/logo_caritro.png" width="300" alt="">
          </div>
        </div>
      </div>
    </div>-->

      <div class="mt-5 bg-white" id="credits">
        <div class="container">
          <div class="row">
            <div class="col">
              <h2 class="py-2 m-0">
                CREDITS
                <a href="#home" class="text-dark float-right scroll" data-id="home">
                  <i class="fas fa-angle-double-up"></i>
                </a>
              </h2>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-2 mb-5">
        <div class="row">
          <div class="col">
            <p class="pt-2 mainText text-justify">
              L'<strong>Archivio fotografico Viticoltura terrazzata Valle di Cembra</strong> è stato ideato da Alberto Cosner (Cooperativa di ricerca TeSto), che ha curato la progettazione nonché il coordinamento scientifico e organizzativo delle attività per la realizzazione, incluso il sito web. La realizzazione della banca dati e dei sistemi informatici di gestione e visualizzazione delle informazioni raccolte è frutto del lavoro della <strong><a href="http://www.cooptesto.it/" title="home page [link esterno]" target="_blank" class="text-dark">Cooperativa TeSto</a></strong> (Alberto Cosner) e di <strong><a href="http://www.arc-team.com" title="home page [link esterno]" target="_blank"  class="text-dark">Arc-Team</a></strong> (Giuseppe Naponiello).
Per la struttura di database e WebGIS si è fatto riferimento, con alcune integrazioni e adattamenti, al progetto  <strong><a href="http://www.lefontiperlastoria.it/" title="home page [link esterno]" target="_blank"  class="text-dark">Fonti per la storia</a></strong>, archivio curato dalla stessa Cooperativa TeSto su incarico della Fondazione Museo storico del Trentino e della Comunità di Primiero, e dai progetti <strong><a href="http://www.bibliopaganella.org/" title="home page [link esterno]" target="_blank"  class="text-dark">Progetto Memoria - Fototeca documentaria Altopiano della Paganella</a></strong> e <strong><a href="http://www.altavalsugana.paesaggiocomunita.it/" title="home page [link esterno]" target="_blank"  class="text-dark">Archivio Iconografico dei Paesaggi della Comunità Alta Valsugana e Bersntol</a></strong> che si ringraziano per aver cortesemente messo a disposizione parte dei risultati di tale attività.
            </p>
            
          </div>
        </div>
      </div>
    </div>
    <?php require('inc/footer.php'); ?>
    <?php require('inc/lib.php'); ?>
    <script src="js/index.js"></script>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js" charset="utf-8"></script>
    <!-- <script src="lib/spin/dist/spin.min.js"></script> -->
    <!-- <script src="lib/leaflet.spin.min.js"></script> -->
    <script src="lib/L.Control.MousePosition.js"></script>
    <script src="js/map.js"></script>
  </body>
</html>
