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
            .sub, .main h3{margin:0px 10px;border:1px solid rgb(171,200,55); border-bottom:none;}
            .main:last-child .sub, .main:last-child h3{border:1px solid rgb(171,200,55) !important; }
            .main h3{color:rgb(171,200,55); padding:5px 10px; font-size:1.3em;cursor:pointer;}
            .main h3:hover, .act{color:#fff !important; background-color:rgb(171,200,55);}
            .sub{display:none;background:#f4f0ec;padding-bottom:10px;}
            .sub img{display:block; margin:0px auto; padding:30px 0px;}
            .pHover{font-size:14px !important;font-weight:bold !important;margin:0px !important;padding:5px!important;color:#fff !important;background-color:rgb(0, 102, 255);}
            .titoletto{position:absolute; top:30px; left: 28px; font-size:12px;}
            
        </style>
    </head>
    <body>
        <div id="container">
            <div id="wrap">
                <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php");}?>
                <div id="header"><?php require_once ("inc/header.php"); ?></div><!--header-->
                <div id="content">
                    <div id="progCorrContent">
                        <p>&nbsp;</p>
                        <p>A <i>latere</i> del progetto "Le fonti per la storia", sono state avviate altre ricerche più specifiche legate al territorio del comprensorio di Primiero, i cui risultati sono poi confluiti nel database.</p>  
                        <div class="main">
                            <h3 class="act"><i class="fa fa-minus-circle"></i> Ricerca storico-antropologica e interventi di salvaguardia e valorizzazione culturale nell’ambito territoriale del Comune di Sagron-Mis</h3>
                            <div class="sub">
                                <p>Il progetto, promosso e finanziato dall'Associazione "Laboratorio Sagron Mis" e realizzato tra il 2010 e il 2012 dai soci della Cooperativa TeSto, consiste nello studio incrociato di un'ampia gamma di fonti archivistiche, orali, cartografiche, fotografiche, archeologiche e della cultura materiale, inquadrabili fra il XV e il XX secolo e relative al territorio di Sagron Mis. La ricerca ha consentito di ricostruire gli aspetti storico-archeologici ed antropologici del territorio comunale, allo scopo di comprendere i fattori socio-economici che hanno determinato le dinamiche demografiche e l’organizzazione territoriale di questo "microcosmo". La volontà di realizzare tale progetto è nata dall'esigenza di far emergere le premesse storiche di un periodo di transizione sociale e culturale, i cui effetti sono, da diversi anni, la denatalità e lo spopolamento del territorio.</p>
                                <p>La ricerca ha dato origine ad un apposito database – parzialmente confluito nel progetto “Le fonti per la storia” – consultabile presso la sede della Pro Loco Sagron Mis. Alcuni dei temi indagati verranno poi approfonditi in una serie di pubblicazioni specifiche, ora in preparazione. Tratti dai risultati del progetto sono inoltre i seguenti articoli: Alberto Cosner, Simone Gaio, <i>GRASS alle prese col carbone. Analisi in ambiente GRASS per un'archeologia delle piazze da carbone in contesto dolomitico</i>, «GW 11» – FOSS4G-it: Genova 2013, pp. 71-92 (scaricabile dal sito <a href="http://geomatica.como.polimi.it/workbooks/n11/index.php" target="_blank">http://geomatica.como.polimi.it/workbooks/n11/index.php</a>); Alberto Cosner, Simone Gaio, Angelo Longo, <i>Neri frammenti di storia. Analisi di fonti per la storia della produzione di carbone a Sagron Mis (Trentino-Alto Adige, Dolomiti Orientali)</i>, «FACTA. A Journal of Medieval and Postmedieval Material Culture» – in corso di pubblicazione; Alberto Cosner, Simone Gaio, <i>Handling Charcoal with GRASS. Analysis in GRASS environment for an archaeology of charcoal kiln sites in Dolomitic contexts</i> – in corso di stampa nella collana “Confluent des sciences” della University Press of Provence; Angelo Longo, <i>Partire, restare, tornare: sei sguardi sull'emigrazione di Sagron Mis di Primiero tra sec. XIX e sec. XX</i>, in corso di pubblicazione su «Rivista feltrina».</p>
                                <p class="link" rel="http://www.primiero.tn.it/Aree-Tematiche/Cultura-Storia-Sport/Rete-Storia-e-Memoria/Progetti-in-corso/Progetto-di-ricerca-storico-archivistica-nel-Comune-Sagron-Mis">Link diretto alla pagina del progetto</p>
                                <img src="img/progCorrImg/sagron.png" title="Ricerca storico-antropologica e interventi di salvaguardia e valorizzazione culturale nell’ambito territoriale del Comune di Sagron-Mis" alt="Ricerca storico-antropologica e interventi di salvaguardia e valorizzazione culturale nell’ambito territoriale del Comune di Sagron-Mis" class="imgSez"/>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> Sagron Mis, evoluzione di un paesaggio - ipotesi di valorizzazione partecipata del territorio in abbandono</h3>
                            <div class="sub">
                                <p>Questo secondo progetto, finanziato dal Comune di Sagron Mis, ha coinvolto diversi collaboratori tra i quali i soci della Cooperativa TeSto, che si sono specificamente occupati, alla luce dei risultati della prima ricerca sopra descritta, della comprensione delle dinamiche evolutive ed involutive del sistema prato-bosco di media-alta quota, caratteristico del territorio preso in considerazione, allo scopo di attivare interventi di conservazione e salvaguardia dello stesso.</p> 
                                <p>Il sistema prato-bosco è stato studiato entro una dimensione storica, inquadrabile tra l'inizio del '700 e il primo decennio del ventunesimo secolo, in ambiente GRASS-GIS attraverso l'utilizzo incrociato della cartografia catastale storica, di ortofotografie, e dei rilievi digitali di terreno e superficie (DTM e DSM). Questi risultati sono stati confrontati con l'analisi archeologica di dettaglio sul paesaggio antropizzato (oltre 600 siti) particolarmente mirata alla comprensione delle dinamiche insediative, tenendo pure conto dell'analisi vegetazionale sugli habitat prativi-boschivi realizzata dal botanico Cesare Lasen, anch’egli collaboratore del progetto.</p>
                                <p>La ricerca si è poi sviluppata in un'ulteriore direzione pluridisciplinare; nello specifico, la documentazione archivistica otto e novecentesca ha fornito dati preziosi sull'andamento demografico e la popolazione animale nel territorio, mentre dalle numerose interviste realizzate nel corso del progetto "Ricerca storico-antropologica e interventi di salvaguardia e valorizzazione culturale nell'ambito territoriale del Comune di Sagron-Mis" sono state selezionate le informazioni sull'utilizzo colturale e sulla percezione attuale dello spazio agrario.</p> 
                                <p>I risultati emersi – ossia la ricostruzione storico-territoriale del paesaggio, l'analisi vegetazionale e delle dinamiche di abbandono, la stesura di protocolli di intervento per la salvaguardia degli habitat e delle emergenze archeologiche – permetteranno alla locale amministrazione comunale di pianificare azioni partecipate volte alla conservazione, e talvolta al parziale recupero, di questi ambienti insediativi specifici, riattivando in alcuni casi quelle pratiche gestionali in parte scomparse che storicamente hanno modificato profondamente il territorio.</p>
                                <p>I risultati del progetto, corredati dalle fotografie di Luigi Valline, sono confluiti nella pubblicazione <i>Un luogo in cui resistere. Atlante dei paesaggi di Sagron Mis (secoli XVI-XXI)</i>, a cura di Cooperativa di ricerca TeSto - territorio storia e società, Sagron (TN)/Mori, 2013. Frutto del lavoro di ricerca è inoltre l’articolo di Alberto Cosner, Simone Gaio, <i>Pianificazione e salvaguardia del territorio attraverso l'analisi di fonti in ambiente GRASS-GIS. Il paesaggio a prato-bosco di Sagron Mis: aspetti vegetazionali, storici e archeologici diventano azione partecipata</i>, «Archeologia e calcolatori», supp. 4: <i>ArcheoFOSS. Free, Libre and Open Source Software e Open Format nei processi di ricerca archeologica. Atti del VII Workshop (Roma, 11-13 giugno 2012)</i>, a cura di Mirella Serlorenzi, 2013, pp. 96-103.</p>
                                <img src="img/progCorrImg/prati.png" title="Sagron Mis, evoluzione di un paesaggio - ipotesi di valorizzazione partecipata del territorio in abbandono" alt="Sagron Mis, evoluzione di un paesaggio - ipotesi di valorizzazione partecipata del territorio in abbandono" class="imgSez"/>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> Transacqua comune fiorito d'Europa</h3>
                            <div class="sub">
                                <p>Il progetto, condotto nel 2011 su incarico del Comune di Transacqua nell'ambito delle iniziative legate al Concorso Comune fiorito d'Europa, ha previsto l'individuazione e la schedatura di alcuni luoghi di interesse nel paese di Transacqua, divisi in sezioni (aree verdi, edifici storici, edifici pubblici, siti artistici). Il lavoro ha prodotto il corredo testuale di una mappa per percorsi di visita, pubblicata su supporto web e cartaceo.</p>
                                <p class="link" id="p1" rel="http://www.transacqua.com/comunefiorito/mappa.html">Link diretto alla pagina del progetto</p>
                                <img src="img/progCorrImg/comune_fiorito.png" alt="Transacqua comune fiorito d'Europa" title="Transacqua comune fiorito d'Europa" class="imgSez"/>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> Mezzano - Segni sparsi del rurale: indagine sulle architetture del centro storico</h3>
                            <div class="sub">
                                <p>Il progetto pluriennale "Segni sparsi del rurale", coordinato e finanziato dal Comune di Mezzano, fin dal principio aveva, tra i suoi scopi, quello di riflettere sulle caratteristiche architettoniche del centro storico di Mezzano, disseminato di tracce che rivelano la sua originaria natura rurale, ormai prevalentemente desueta.</p>
                                <p>Uno dei primi risultati del progetto è il Prontuario per gli interventi sugli elementi dell'edilizia rurale del centro storico che interessano lo spazio pubblico degli architetti Michele Baggio e Henry Zillo, redatto nel 2007, il quale, a partire dall'analisi minuziosa degli edifici del centro storico, individua e descrive tutti gli elementi architettonici che lo caratterizzano.</p>
                                <p>Nel corso del 2011 il Comune ha promosso la restituzione dei risultati del prontuario con un progetto che da una parte integrasse il lavoro di ricerca avviato dagli architetti Baggio e Zillo, e dall'altra lo rendesse fruibile attraverso uno specifico percorso informativo. Scopo di tale percorso è, primariamente, la valorizzazione di tutto un mondo sociale, economico e comunitario scomparso, attraverso la conoscenza di quegli elementi urbanistici ed architettonici che sono stati plasmati ed impressi da esso e che ne sono la declinazione tuttora visibile.</p> 
                                <p>Con il conforto dell'analisi delle mappe catastali compilate nel corso degli ultimi due secoli, sono stati quindi individuati circa venti edifici che presentano nell'insieme, o in alcuni singoli particolari, elementi caratterizzanti il complesso architettonico storico del paese.</p> 
                                <p>Sugli edifici scelti è stata condotta una ricerca storica che si è appoggiata a fonti di varia natura, nell'ottica della non gerarchia delle stesse e all'interno di una visione globale del rapporto tra uomo e territorio, affiancando a percorsi più tradizionali (le fonti archivistico-bibliografiche, il patrimonio storico-artistico, archeologico ed architettonico) una riflessione sulle fonti orali e sulla cultura materiale.</p> 
                                <p>Per ogni singolo edificio ed elemento architettonico individuato, sulla base dei dati raccolti ed analizzati nella fase di ricerca e con il fondamentale supporto del prontuario, sono stati realizzati dei particolari pannelli informativi, nei quali brevi testi esplicativi sono arricchiti da materiale iconografico, schizzi, fotografie e mappe storiche.</p> 
                                <p>Nei pannelli sono stati messi in luce più livelli di approfondimento e analisi. A partire da un inquadramento della morfologia del centro di Mezzano nel corso di diverse fasi storiche, da un lato i curatori hanno analizzato l'evoluzione di esso, la gestione degli spazi da parte delle persone che lo abitavano (tanto i possidenti e i commercianti quanto le famiglie contadine) e i suoi luoghi di aggregazione (come la piazza o la lisiera); dall'altro sono stati segnalati gli elementi architettonici caratterizzanti (ad esempio le scale, gli archi, i timpani, le soffitte, gli intonaci). </p>
                                <img src="img/progCorrImg/mezzano.png" alt="Mezzano - Segni sparsi del rurale: indagine sulle architetture del centro storico" title="Mezzano - Segni sparsi del rurale: indagine sulle architetture del centro storico" class="imgSez"/>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> Ricerca storica e storico-architettonica riguardante l'edificio "Casa Piazza" di Pieve (Transacqua) e la famiglia Piazza</h3>
                            <div class="sub">
                                <p>Contestualmente ed a supporto dell’elaborazione del progetto di restauro di Casa Piazza – edificio storico situato nella frazione di Pieve, Comune di Transacqua –, l'allora Soprintendenza per i beni architettonici della Provincia Autonoma di Trento ha promosso e finanziato, nel corso del 2012, una ricerca storica e storico-architettonica allo scopo di reperire informazioni sull’edificio stesso, la sua struttura e le sue funzioni, nonché sulla storia della famiglia che ne fu per secoli proprietaria.</p> 
                                <p>Il progetto si è sviluppato quindi su più livelli: innanzitutto quello prettamente storico, condotto attraverso un preciso spoglio di documenti d'archivio, necessario per dipanare i molteplici rami genealogici della famiglia Piazza che, a partire dal diciassettesimo secolo, si svilupparono a Primiero, intrecciati indissolubilmente alle proprietà di famiglia fra le quali anche, appunto, la casa Piazza di Pieve. Un secondo livello di approfondimento è consistito nella ricerca puntuale di materiale fotografico documentante l’edificio, che ha permesso di chiarire alcune trasformazioni architettoniche recenti. In terzo luogo è stato utilizzato il metodo archeologico applicato allo studio degli elevati al fine di comprendere le vicende strutturali che hanno interessato l’edificio fra l’inizio del XVIII secolo ed oggi. Un'ultima sezione ha analizzato in dettaglio, da un punto di vista materiale, stilistico, iconografico e contestuale, i dipinti murali dell'edificio.</p>
                                <p>Parte dei risultati della ricerca sono illustrati nell’articolo di Ester Brunet, Alberto Cosner, Simone Gaio, <i>La Casa Piazza di Pieve. Stratigrafie murarie e corpi di fabbrica, una lettura architettonica preliminare (XVIII-XX secolo)</i>, in corso di stampa nel volume <i>Monumenti. Conoscenza, restauro, valorizzazione. 2009-2013</i>, curato dalla Soprintendenza per i beni culturali della Provincia Autonoma di Trento.</p>
                                <img src="img/progCorrImg/casa_piazza.png" alt="Ricerca storica e storico-architettonica riguardante l'edificio "Casa Piazza" di Pieve (Transacqua) e la famiglia Piazza" title="Ricerca storica e storico-architettonica riguardante l'edificio "Casa Piazza" di Pieve (Transacqua) e la famiglia Piazza" class="imgSez"/>
                            </div>
                        </div> 
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> ReMo: Il Relitto MasO. L'edificato, il vivente, il sepolto. Stratigrafie di architetture, vegetazione, suoli, attraverso l'indagine archeologica di un micro sistema insediativo montano.</h3>
                            <div class="sub">
                                <p>Il progetto, finanziato dal Parco Naturale Paneveggio Pale di San Martino, avviato nel 2010 e tuttora in corso di realizzazione, riguarda lo studio di una struttura insediativa di media montagna, sintetizzabile nel "sistema maso", ossia quel complesso produttivo a carattere stagionale composto da stalla, fienile e <i>caséra</i>, inserito in un'area coltivata a prato e bosco. Il sito viene analizzato tramite metodologia archeologica, nella sua evoluzione storica, dalla sua fondazione fino al parziale abbandono.</p>
                                <p>La ricerca si colloca all'interno del dibattito scientifico sulle strutture rurali della montagna alpina, nella loro evoluzione dall'epoca medievale fino al XX secolo, e mira a comprendere le trasformazioni radicali tutt'ora in corso subite da questo spazio. L'attore principale di tali cambiamenti è l'uomo, che nel passato ha modellato il territorio sia attraverso disboscamenti e bonifiche per la creazione di aree utilizzabili (ossia i prati di pre e post alpeggio e i pascoli), sia con la costruzione di insediamenti sparsi e di una rete infrastrutturale (strade e terrazzamenti).</p> 
                                <p>L'approccio pluridisciplinare della ricerca – storico, ambientale e archeologico – da un lato fornisce elementi utili a far luce su un contesto rurale solo apparentemente privo di storia; dall'altro consente di interpretare più efficacemente il significato economico e sociale dei resti materiali, attraverso lo studio delle tecniche di costruzione e dell'organizzazione e diffusione di attività artigianali.</p> 
                                <p>La scelta di utilizzare tale approccio offre anche la possibilità di analizzare sistemi produttivi e costruttivi partendo da elementi materiali; i dati ottenuti dall'analisi delle murature (in pietre e malta, in legno) e delle relative tecniche costruttive possono arricchire le strategie di intervento su edifici storicamente di pregio con misure di conservazione e restauro integrate alle tecniche e ai materiali antichi dando risposte concrete ed immediate su possibili interventi. Da questi dati si evidenzieranno inoltre indirizzi di intervento, di recupero e salvaguardia potenzialmente estensibili a contesti simili.</p>
                                <p class="link" id="p1" rel="http://www.parcopan.org/it/news/il-relitto-maso.-ledificato-il-vivente-il-sepolto-n153.html">Link diretto alla pagina del progetto</p>
                                <img src="img/progCorrImg/tambaril.png" title="ReMo: Il Relitto MasO. L'edificato, il vivente, il sepolto. Stratigrafie di architetture, vegetazione, suoli, attraverso l'indagine archeologica di un micro sistema insediativo montano" alt="ReMo: Il Relitto MasO. L'edificato, il vivente, il sepolto. Stratigrafie di architetture, vegetazione, suoli, attraverso l'indagine archeologica di un micro sistema insediativo montano" class="imgSez"/>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> Ricerca storico-antropologica sulla Campagna (Comuni di Tonadico e Siror)</h3>
                            <div class="sub">
                                <p>La ricerca, avviata nel 2012 e finanziata dall'Unione Alto Primiero, è mirata ad un'analisi storica e contemporanea sull'uso e sull'assetto dei suoli, delle infrastrutture e dell'edificato della Campagna, area situata all'interno del territorio dei Comuni di Tonadico e Siror.</p> 
                                <p>Gli ambiti di indagine presi in considerazione sono quello cartografico (attraverso l'analisi della cartografia storica, delle ortofoto storiche e dei dati satellitari conservati presso gli archivi statali e provinciali, con una particolare attenzione alle caratteristiche geografico-fisiche ed ai principali attributi qualitativi che hanno determinato l'evoluzione storica del contesto territoriale e del sistema particellare); quello archivistico (con una ricerca negli archivi parrocchiali e comunali di Siror e Tonadico, privilegiando le tipologie documentarie strettamente legate alla ricerca cartografica, come i registri d'estimo); e quello antropologico (vale a dire sia il recupero di materiali in archivi audio e video esistenti, sia la realizzazione di nuove interviste sull'utilizzo e sulla percezione della Campagna nel passato sia, infine, una "ricerca di campo" sull'utilizzo attuale della stessa).</p>
                                <img src="img/progCorrImg/campagna.png" title="Ricerca storico-antropologica sulla Campagna (Comuni di Tonadico e Siror)" alt="Ricerca storico-antropologica sulla Campagna (Comuni di Tonadico e Siror)" class="imgSez"/>
                            </div>
                        </div>
                        <div class="main">
                            <h3><i class="fa fa-plus-circle"></i> "Archivio Negrelli" della Biblioteca intercomunale di Primiero</h3>
                            <div class="sub">
                                <p>Tra il 2013 ed il 2014 la Cooperativa di ricerca TeSto si è occupata, su incarico della Biblioteca intercomunale di Primiero e con il coordinamento dell'allora Soprintendenza per i beni storico-artistici, librari e archivistici della Provincia Autonoma di Trento, del parziale riordino, inventariazione e schedatura del cosiddetto “Archivio Negrelli”. Quest'ultimo è costituito da un insieme eterogeneo di documenti e materiale a stampa relativi alla famiglia Negrelli e specialmente alla figura dell'ingegnere Luigi, conservati perlopiù nella sede della biblioteca e in piccola parte presso l'allestimento dedicato a Luigi Negrelli, esposto nelle sale del Palazzo delle Miniere di Pieve.</p> 
                                <p>I risultati del lavoro – entrambi consultabili presso la Biblioteca intercomunale – sono un database (parzialmente confluito del progetto “Le fonti per la storia”), che indicizza nel dettaglio le varie unità archivistiche, ed un inventario descrittivo del materiale, introdotto da un inquadramento storico della figura di Luigi Negrelli, dei suoi famigliari e discendenti e dalla ricostruzione delle vicende formative dell’Archivio stesso.</p>
                                <img src="img/progCorrImg/negrelli.png" title="Ricerca storico-antropologica sulla Campagna (Comuni di Tonadico e Siror)" alt="Ricerca storico-antropologica sulla Campagna (Comuni di Tonadico e Siror)" class="imgSez"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="footer"><?php require_once ("inc/footer.php"); ?></div>
            </div>
        </div>
        <script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="lib/menu.js"></script>
        <script type="text/javascript" src="lib/funzioni.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.sub').first().show();
                $(".main h3").on("click",function(){toggleSezioni($(this));});
            }); 
        </script>
    </body>
</html>
