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
            .sub, .main h3{margin:0px 10px;border:1px solid rgb(91,255,36); border-bottom:none;}
            .main h3 i{color:#F48204;}
            .main:last-child .sub, .main:last-child h3{border:1px solid rgb(91,255,36) !important; }
            .main h3{color:rgb(91,255,36); padding:0px 10px; font-size:1.5em;cursor:pointer;}
            .main h3:hover, .act{color:#fff !important; background-color:rgb(91,255,36);}
            .pHover{font-size:14px !important;font-weight:bold !important;margin:0px !important;padding:5px!important;color:#fff !important;background-color:rgb(91,255,36);}
            .sub{display:none;background:#f4f0ec;}
            .sub img{display:block; margin:0px auto; padding:30px 0px;}
        </style>
    </head>
    <body>
        <div id="container">
            <div id="wrap">
                <?php if ($_SESSION['username']!='guest'){require("inc/sessione.php");}?>
                <div id="header"><?php require_once ("inc/header.php"); ?></div><!--header-->
                <div id="content">
                    <div id="fontiContent">
                        <p>&nbsp;</p>
                        <p>La ricerca ha preso in considerazione <b>nove tipologie di fonti</b>:</p>
                        <p><b>archivistiche</b>, <b>bibliografiche</b>, <b>fotografiche</b>, <b>architettoniche</b>, <b>orali</b>, <b>relative alla cultura materiale</b>, <b>archeologiche</b>, <b>storico-artistiche</b>, <b>cartografiche</b>.</p>
                        <p>Nelle finestre sottostanti sono descritte le caratteristiche e specificati i criteri di schedatura di ciascuna di esse. Il database è potenzialmente integrabile con ulteriori tipologie di fonti, che potrebbero essere, in futuro, oggetto di indagine e schedatura.</p>  
                    </div>
                    <div class="main">
                        <h3 class="act"><i class="fa fa-minus-circle"></i> FONTI ARCHIVISTICHE</h3>
                        <div class="sub open">
                            <h4>Premessa</h4>
                            <p>La sezione "fonti archivistiche" prevede la schedatura degli archivi, pubblici e privati, che conservano materiale relativo alla storia e al territorio di Primiero. Per archivio s'intende la raccolta ordinata degli atti di un ente o di un individuo costituitasi durante lo svolgimento delle attività politiche, culturali, sociali, economiche, amministrative di quell'ente o individuo, ma anche la raccolta "disordinata" di fotografie, materiale audiovisivo, scritture autobiografiche, lettere ecc. che si conservano negli archivi privati di famiglia, la cui individuazione e schedatura acquista un'importanza fondamentale per la loro stessa natura sfuggente, ma spesso storicamente significativa.</p>
                            <p>Nell'individuazione delle fonti si deve tener conto della situazione di confine che ha caratterizzato la storia di Primiero influendo anche sulla "geografia delle fonti". Essa comprende due grandi aree: quella veneta e quella tirolese-austriaca le quali, a seconda dei diversi periodi storici e dei campi di indagine, possono fornire materiale documentario e fonti scritte, dirette o preterintenzionali, sulla storia della valle. Gli archivi d'interesse saranno quindi non solo quelli conservati in valle, ma anche quelli di Feltre, Trento, Bolzano, Innsbruck, Vienna, per citare solo i centri principali.</p> 
                            <p>Il criterio di selezione è il puntuale riferimento alla valle ricostruibile, nel caso di archivi situati al di fuori del suo territorio, attraverso fonti edite o studi che si siano occupati della materia. L'arco cronologico considerato va dalle prime testimonianze scritte conservate alla contemporaneità, includendo tutti gli archivi storici, ma anche archivi privati di rilievo storico. 
Si è deciso di segnalare l'esistenza di tutti gli archivi, anche se soggetti a vincolo archivistico e quindi non consultabili.</p> 

                            <h4>La schedatura </h4>
                            <p>La scheda delle fonti archivistiche si organizza su tre livelli dedicati rispettivamente agli archivi intesi come insiemi (primo livello), ai fondi conservati al loro interno (secondo livello) e ai singoli documenti (terzo livello).</p>
                            <img src="img/pagineFonti/archivistiche.png" />
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> FONTI BIBLIOGRAFICHE</h3>
                        <div class="sub">
                            <h4>Premessa</h4>
                            <p>La sezione "fonti bibliografiche" ha previsto l'individuazione e la schedatura delle fonti secondarie edite e inedite, monografiche o periodiche, nonché delle edizioni di fonti relative alla storia ed al territorio di Primiero; operazioni fondamentali volte ad integrare e supportare il lavoro di reperimento delle fonti primarie.</p>
                            <p>Per fonti secondarie si intende l'insieme della letteratura scientifica edita (monografie, saggi, articoli, recensioni, cataloghi) e non edita (tesi di laurea e di dottorato, inventari d'archivio) che è frutto dello studio e dell'interpretazione delle fonti primarie.</p>
                            <p>È stato innanzitutto definito un criterio significativo per circoscrivere il campo delle fonti bibliografiche indicizzabili. Si è ritenuto opportuno prendere in considerazione le opere che contengono <i>espliciti</i> riferimenti a Primiero o al suo territorio (paesi, valli, località del comprensorio) escludendo quindi dall'indice gli studi riguardanti, in senso generico, istituzioni od organismi statali sovraterritoriali che pure hanno incorporato Primiero nella loro compagine. Il lavoro rischierebbe altrimenti di estendersi oltre misura e soprattutto di risultare dispersivo e non sufficientemente utile allo scopo, che è quello di individuare uno specifico <i>status quaestionis</i> storiografico e scientifico sul territorio di Primiero e conseguentemente di fornire un preciso strumento di supporto alle future ricerche su di esso.</p>
                            <h4>La schedatura</h4>
                            <p>All'interno dell'architettura del database, la schedatura delle singole fonti bibliografiche si articola al secondo livello di approfondimento – dove vengono fornite specifiche informazioni sul documento, con la precisazione degli elementi di interesse in esso contenuti per la storia del territorio di Primiero – mentre il primo livello è dedicato a quelli che possono essere considerati come "insiemi di conservazione": vale a dire, principalmente, le biblioteche, i musei, le emeroteche. Si specifica che, essendo le biblioteche trentine coordinate e messe in relazione da un sistema unitario (SBT, Sistema Bibliotecario Trentino) e le opere ivi conservate indicizzate in un catalogo unico (CBT, Catalogo Bibliografico Trentino), tali biblioteche verranno considerate come insieme anche nella scheda di primo livello; verrà quindi indicizzato l'SBT, non la singola biblioteca, la cui indicazione ci è sembrata poco utile, a meno che l'opera schedata nel corrispondente secondo livello sia conservata <i>solo</i> nella Biblioteca Intercomunale di Primiero, oppure sia un'opera antica, difficilmente reperibile, appartenente ad un fondo storico (conservato ad esempio nella Biblioteca Comunale di Trento o nella Biblioteca Civica di Rovereto): in questi casi si specifica la biblioteca di appartenenza. </p>
                            <img src="img/pagineFonti/bibliografiche.png" />
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> FONTI FOTOGRAFICHE</h3>
                        <div class="sub">
                            <h4>Premessa</h4>
                            <p>Questa sezione è dedicata alla schedatura sia di fotografie storiche (conservate in collezioni e archivi pubblici e privati, ma anche pubblicate in libri, articoli, siti web), sia delle immagini appositamente realizzate dai curatori del progetto nel corso del lavoro di individuazione delle fonti.</p>
                            <h4>La schedatura</h4>
                            <p>I due livelli di schedatura sono stati modellati sulle tabelle delle fonti bibliografiche. Al secondo livello vengono schedate le singole fotografie, mentre il primo è dedicato agli "insiemi" che conservano tale documentazione: una collezione privata, un fondo archivistico, un articolo, un volume, un sito internet. Un'apposita scheda di primo livello è stata inoltre creata per l'archivio virtuale "Le fonti per la storia", ossia quello che contiene le immagini che documentano le fonti schedate dai curatori del progetto.</p>
                            <img src="img/pagineFonti/fotografiche.png" />
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> FONTI ARCHITETTONICHE</h3>
                        <div class="sub">
                            <h4>Premessa</h4>
                            <p>Per fonte architettonica si intende esclusivamente il bene monumentale o architettonico del quale la Soprintendenza per i beni architettonici della Provincia Autonoma di Trento ha riconosciuto la particolare importanza sottoponendolo a tutela.</p>
                            <p>Diversamente da altre tipologie di fonti, la scelta di un riconoscimento formale per la definizione di fonte architettonica è motivata dalla volontà di distinguere inequivocabilmente elementi monumentali e architettonici già sottoposti a tutela, da elementi che hanno simili caratteristiche e uguale importanza sotto il profilo storico-territoriale ma non sottoposti a tutela. Questa distinzione formale permette innanzitutto di separare chiaramente tipologie di fonti simili (edifici nobili/edifici rurali, fontane monumentali/fontane storiche, ecc.); in secondo luogo pone l'accento sulla necessità di salvaguardare elementi storici che, sebbene fondamentali per la storia di un territorio, non sono ancora sottoposti a tutela e quindi figurano all'interno del progetto non quali fonti architettoniche, pur avendone il valore, bensì come fonti archeologiche.</p>
                            <p>La scelta del limite geografico comprensoriale segue coerentemente l'indirizzo stabilito di concerto con gli altri curatori.</p>
                            <h4>La schedatura</h4>
                            <p>Il primo livello di schedatura corrisponde all'individuazione dei beni monumentali o architettonici sottoposti a tutela. Il secondo livello è dedicato alle singole fasi architettoniche rinvenibili in relazione al bene in oggetto. Il terzo livello di schedatura, per il momento non previsto, prenderebbe eventualmente in considerazione i singoli elementi architettonici di particolare interesse presenti all'interno di una fase architettonica, della quale rappresentano una caratteristica stilistica o un elemento datante (stili decorativi, aperture, iscrizioni, ecc.).</p>
                            <img src="img/pagineFonti/architettoniche.png" />
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> FONTI ORALI</h3>
                        <div class=" sub">
                            <h4>Premessa</h4>
                            <p>La strutturazione della scheda "fonti orali" parte dal presupposto che la <i>fonte orale</i> tendenzialmente considera e fornisce lo spunto per l'analisi di almeno due livelli di esperienza sociale: collettiva o di gruppo (classe, movimento ecc.) e individuale. L'atto del narrare è infatti sempre, allo stesso tempo, memoria autobiografica, trasmissione di un'esperienza di vita e tradizione. La <i>memoria soggettiva</i> apparentemente non strutturata contiene sempre delle linee lungo le quali essa si condensa, cristallizza e organizza.</p> 
                            <p>Partendo da questo presupposto è stata creata una scheda che non considera la singola intervista come un atto isolato, individuale, ma la inserisce all'interno di un'"esperienza" ampia, creando così dei "gruppi di interviste" (questi coincideranno con i vari "archivi orali" qualora le interviste appartengano già a delle raccolte chiuse; se invece esse sono state realizzate appositamente per il progetto “Le fonti per la storia”, sono stati creati dei nuovi "gruppi"). Si è quindi deciso di sviluppare la scheda su tre livelli, in modo tale da evidenziare e catalogare, oltre al contenuto della singola intervista e le caratteristiche performative e tecniche, anche una delle possibili <i>linee</i> attorno alle quali essa si "organizza" e "cristallizza".</p>
                            <h4>La schedatura</h4>
                            <p>Per la strutturazione della scheda si è preso spunto dai campi presenti nella scheda ministeriale per i Beni Demoetnoantropologici Immateriali (BDI): alcuni campi sono riportati singolarmente, altri raggruppati per snellire la scheda, altri ancora sono  aggiunti per avere una migliore contestualizzazione e per creare elementi comuni con le altre fonti.<p> 
                            <p>Il primo livello di schedatura segnala le caratteristiche dell'"archivio audio" per le interviste appartenenti a precise raccolte chiuse. Per quelle realizzate appositamente per il progetto "Le fonti per la storia" sono stati creati dei "gruppi" in base alla <i>linea</i> territoriale del "paese narrato": es. Gruppo Sagron, Gruppo Tonadico, Gruppo Canal San Bovo ecc.</p>
                            <p>Il secondo livello considera la singola intervista. Vi vengono delineate le modalità di svolgimento (luogo, contesto, attrezzature e riversamento), le caratteristiche dell'informatore (modalità comunicativa, dati anagrafici) e dell'intervista (categoria, occasione di reperimento ecc.); sono poi riportati gli elementi di contenuto. La scheda non prevede la trascrizione del documento perché questa andrebbe a sostituire l'audio limitandone l'uso. È invece riportato l'indice degli elementi strutturali e delle unità logiche contenute nell'intervista. Quest’ultima è indicizzata attraverso quattro valori: il <i>tempo</i> di registrazione (es. 00h 34' 35''; 01h 5' 23''), l'<i>argomento</i> trattato nei vari segmenti (es. produzione burro; situazione familiare; festa patronale ecc.), la <i>parola chiave</i> dell'argomento ed il <i>periodo storico</i> di riferimento.</p> 
                            <p>Il terzo livello si concentra sugli elementi territoriali presenti a livello di contenuto. È stata creata un'apposita scheda per ogni "spazio narrato" nell'intervista: per essere meritevoli di schedatura i brani dovranno fornire elementi storici o aneddotici rilevanti dal punto di vista storico e culturale su di un particolare luogo (per esempio: strutture, sentieri, spazi aperti, località ecc.).</p>
                            <img src="img/pagineFonti/orali.png" />
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> FONTI DELLA CULTURA MATERIALE</h3>
                        <div class="sub">
                            <h4>Premessa</h4>
                            <p>La sezione "fonti della cultura materiale" riguarda l'individuazione, la schedatura e lo studio di manufatti intesi come oggetti prodotti o alterati dall'uomo (utensili, macchinari, strutture del territorio). Tale sezione è rivolta alla ricostruzione del quadro dei rapporti che intercorrono fra l'uomo, visto come collettività-comunità, e i suoi prodotti, e alla definizione delle pratiche produttive e delle relazioni che si creano fra i manufatti all'interno del sistema socio-economico e culturale del territorio in esame. Come ambito cronologico si considera soprattutto il periodo postmedievale, con la possibilità di comprendere anche oggetti d'epoca medievale.</p> 
                            <p>Sono state, anzitutto, individuate e censite le collezioni museali e le raccolte private di oggetti, nonché gli studi tipologici relativi alle fonti materiali (ad esempio le baite). Tale operazione è molto importante per quanto riguarda la conoscenza sia delle raccolte spontanee o "fai da te" presenti presso le abitazioni private, altrimenti ignorate, sia degli oggetti provenienti dal comprensorio di Primiero posti in collezioni museali lontane dal territorio d'origine. Il censimento può anche essere un'operazione preliminare alla progettazione di un'eventuale inventariazione di raccolte non musealizzate, di proprietà di enti locali.</p> 
                            <p>In secondo luogo la ricerca si è proposta, come obiettivo iniziale, l'analisi della rete di infrastrutture (strade principali e secondarie, mulattiere, sentieri, vie d'acqua, ecc.) da un punto di vista storico-materiale, attraverso la documentazione dei manufatti presenti sul territorio e la disamina delle fonti relative (cartografia storica, fonti d'archivio ecc.). Questo studio ha previsto sia un approccio analitico, spingendosi oltre la semplice individuazione, sia anche tipologico. Dopo aver schedato campioni di infrastrutture, selezionandoli secondo le funzioni che ricoprivano e in base al loro valore storico-paesaggistico, è stato possibile avviare lo studio tipologico delle evidenze analizzate. La ricerca si è posta inoltre, come secondo obiettivo, quello di avviare anche la schedatura di oggetti della cultura materiale e lo studio delle tipologie a cui questi si possono ricondurre.</p>
                            <p>Le strutture viarie sono fondamentali per il movimento dell'uomo e sono funzionali alle sue attività: in ambiente montano collegano il fondovalle, la media e l'alta montagna, il paese con i masi e le malghe, con i luoghi di approvvigionamento di materie prime, di risorse foraggere e alimentari, con i siti produttivi. La scelta di quest'ambito non è affatto casuale, è una priorità: l'ambiente "strade" si comporta di per sé come una struttura che lega numerosi nodi tematici relativi sia alla cultura materiale sia alle altre fonti documentarie. Lo studio delle infrastrutture costituisce così la base sulla quale innestare e sviluppare in seguito altri temi relativi ad attività produttive, economiche e sociali.</p>
                            <h4>La schedatura</h4>
                            <p>Il sistema di schedatura si struttura su tre livelli. Il primo è rivolto all'individuazione delle collezioni/raccolte di oggetti e degli studi, in alcuni casi tipologici, di categorie di manufatti. L'analisi della rete infrastrutturale è schedata e descritta in questo primo livello come ricerca specifica condotta appositamente per il progetto "Le fonti per la storia". Al secondo e terzo livello si affrontano rispettivamente la parte dedicata alle tipologie di infrastrutture, o di oggetti della cultura materiale, e la parte riferita alle singole evidenze viarie individuate sul territorio, o ai singoli manufatti conservati nelle collezioni museali o raccolte private. </p>
                            <img src="img/pagineFonti/cultura.png" />
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> FONTI ARCHEOLOGICHE</h3>
                        <div class="sub">
                            <h4>Premessa</h4>
                            <p>In linea con i principi metodologici del progetto, per fonte archeologica non si intende esclusivamente il sito o l'oggetto recuperato dal sottosuolo, ma l'insieme delle informazioni che riguardano sia gli scavi archeologici e gli oggetti rinvenuti in stratigrafia o decontestualizzati, sia il territorio nella sua dimensione storica.</p>
                            <p>L'insieme dei "beni archeologici" <i>stricto sensu</i> non è stato il punto di partenza della ricerca; essa si è infatti mossa da una visione globale di un complesso territoriale che ha subito mutamenti storici, dove la presenza dell'uomo ne ha segnato e plasmato i lineamenti. Il territorio, la sua trasformazione, il suo abbandono, il suo complesso <i>iter</i> evolutivo diventano quindi fonti da analizzare in una prospettiva archeologica.</p> 
                            <p>Il complesso dei reperti rinvenuti o presenti nel territorio oggetto di ricerca ed i rispettivi siti sono stati intesi, innanzitutto, come fonti portatrici di informazioni storico-territoriali. La sezione "fonti archeologiche" prevede appunto l'individuazione e la schedatura di tali informazioni.</p>
                            <p>Sono quindi stati presi in considerazione gli scavi archeologici effettuati nel comprensorio di Primiero, i beni archeologici rinvenuti in essi, come anche i ritrovamenti decontestualizzati. La consultazione parallela di fonti non archeologiche (bibliografiche, catastali, cartografiche ecc.) e la collaborazione con i curatori delle altre sezioni, hanno fornito ulteriori indizi per la datazione di alcune fonti (ad esempio gli edifici rurali) o per la stessa loro individuazione (come nel caso di una strada antica della cui esistenza si hanno tracce solo in mappe storiche o di destinazioni d' uso di suoli desumibili da fonti d'archivio).</p>
                            <p>La scelta del limite geografico comprensoriale, oltre a seguire coerentemente l'indirizzo stabilito di concerto con gli altri curatori, risponde ai criteri sempre più frequentemente utilizzati dall'archeologia contemporanea, ossia la tendenza a lavorare su territori omogenei e quindi, in contesto alpino, necessariamente ridotti. </p>
                            <h4>La schedatura</h4>
                            <p>Il primo livello di schedatura corrisponde all'individuazione di indagini archeologiche (scavi archeologici o ricerche ad indirizzo archeologico, intesi come "insiemi" di siti archeologici).</p>
                            <p>Il secondo livello è dedicato ai siti archeologici (intesi come singole fasi stratigrafiche).
L'eventuale terzo livello di schedatura sarà rivolto alle singole fonti archeologiche, che quasi sempre corrispondono ai beni archeologici, ma possono essere anche singoli elementi di un "sito archeologico" che forniscono informazioni sulla datazione del sito stesso (ad esempio una trave con millesimo, un'epigrafe su intonaco ecc.). </p>
                            <img src="img/pagineFonti/archeologiche.png" />
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> FONTI STORICO-ARTISTICHE</h3>
                        <div class="sub">
                            <h4>Premessa</h4>
                            <p>La sezione dedicata alle fonti storico-artistiche prevede l'individuazione e la schedatura del patrimonio storico-artistico presente sul territorio di Primiero, con un'apertura a quello ultraterritoriale che possa avere sotto diversi aspetti attinenza con Primiero in quanto fonte per la sua storia.</p>
                            <p>Rientrano pertanto in questa sezione le raccolte di musei, pinacoteche, gallerie e altri luoghi espositivi; le collezioni o serie di oggetti di interesse storico-artistico; gli affreschi, gli stemmi, i graffiti, le lapidi, le iscrizioni, gli arredi e gli ornamenti di edifici; le opere di pittura, scultura, grafica e qualsiasi oggetto d'arte.</p>
                            <p>Si è deciso di rispettare in linea di massima il <i>terminus ante quem</i> cronologico indicato dalla legislazione, escludendo le opere eseguite nei 50 anni precedenti l'inizio dell'inventariazione (2010).</p>
                            <h4>La schedatura</h4>
                            <p>Al fine di registrare i dati secondo criteri omogenei e condivisibili a livello nazionale, per la costruzione della scheda si sono rispettate, qualora possibile, le voci previste dagli standard ministeriali, sul modello delle schede OA per l'opera e l'oggetto d'arte.</p> 
                            <p>All'interno dell'architettura del database, la schedatura si articola in un primo e in un secondo livello di approfondimento: mentre il secondo livello è dedicato alla singola opera, il primo livello incorpora quelli che possono essere considerati "insiemi di conservazione": raccolte pubbliche o private, collezioni o serie, ma anche e soprattutto – considerato il numero esiguo di musei/collezioni presenti sul territorio – "sistemi" coerenti in cui più oggetti d'arte sono presenti o collocati/custoditi (ad esempio una casa privata decorata con diversi dipinti murali; la pieve; ecc.).<br>Va rilevato a questo proposito che questi "insiemi" non verranno considerati nella loro qualità di beni architettonici (per i quali è previsto un trattamento specifico), ma trattati sotto l'aspetto prettamente funzionale di "collettori" di dati comuni dei singoli oggetti (collocazione, consultabilità, dati anagrafici ecc.): infatti l'inventario vero e proprio si sviluppa sul II livello, ossia sull'individuazione e schedatura del singolo oggetto storico-artistico. Alla luce di ciò si spiega l'esiguità di informazioni specifiche del primo livello, che si limita di fatto alla sola denominazione dell'"insieme" (es. "chiesa arcipretale di Fiera") ed a eventuali note: dato che, per restare nell'esempio, la chiesa arcipretale di Fiera non sarà valutata come oggetto in sé stesso, ma come "contenitore" di singole opere (es. "affresco parietale", "tabernacolo", "pala d'altare" ecc.) che condividono alcuni dati comuni.</p>
                            <img src="img/pagineFonti/storicoArt.png" />
                        </div>
                    </div>
                    <div class="main">
                        <h3><i class="fa fa-plus-circle"></i> FONTI CARTOGRAFICHE</h3>
                        <div class="sub">
                            <img src="img/pagineFonti/wip.png" alt="Work in progress" />
                        </div>
                    </div>
                </div>
            </div><!--content-->
            <div id="footer"><?php require_once ("inc/footer.php"); ?></div><!--footer-->
        </div><!-- wrap-->
    </div><!--container-->
    <script type="text/javascript" src="lib/jquery-core/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="lib/jquery_friuli/js/jquery-ui-1.8.10.custom.min.js"></script>
    <script type="text/javascript" src="lib/funzioni.js"></script>
    <script type="text/javascript" src="lib/menu.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.sub').first().show();
            $(".main h3").on("click",function(){
                if(!$(this).next('div').hasClass('open')){
                    $(".main h3").removeClass('act');
                    if($(".main h3 i").hasClass('fa-minus-circle')){
                        $(".main h3 i").removeClass('fa-minus-circle').addClass('fa-plus-circle');
                        $(this).children('i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
                    }
                    $(this).addClass('act');
                    $('.sub').slideUp(500).removeClass('open');
                    $(this).next('div').slideDown(500).addClass('open');
                }
            });
        });
    </script>
    </body>
</html>