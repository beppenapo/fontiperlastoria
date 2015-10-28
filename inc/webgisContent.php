<div id="webgisContent">
<p>&nbsp;</p>
 

 
</div>

<div class="accordion">
 

<h3><a>La struttura relazionale del database</a></h3>
<div class="sez" style="font-size: 11px; font-family: 'Open Sans', sans-serif !important;">
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

<h3><a>Il software utilizzato</a></h3>
<div class="sez" style="font-size: 11px; font-family: 'Open Sans', sans-serif !important;">
 <p>Si elencano qui di seguito gli strumenti utilizzati per la strutturazione del progetto:</p><br>
 <p><b>Database</b></p>
<p>– <a href="http://www.postgresql.org/docs/9.2/static/release-9-2-4.html">PostgreSQL v.9.2.4</a> <br>
   – <a href="http://postgis.net/">PostGIS</a></p>

<p><b>Server geografico</b></p>
<p>– <a href="http://geoserver.org/">GeoServer v.2.2.4</a></p>

<p><b>Librerie JavaScript</b></p>
<p>– <a href="http://jquery.com/">jQuery</a><br>
   – <a href="http://jqueryui.com/">jQuery-ui</a><br>
   – <a href="http://tablesorter.com/docs/">jQuery tablesorter</a><br>
   – <a href="http://craigsworks.com/projects/qtip/">qTip</a><br>
   – <a href="http://plugins.jquery.com/">jQuery-plugin</a><br>
   – <a href="http://openlayers.org/">OpenLayers</a><br></p>
</div>

<h3><a>Le licenze d'uso e copyright</a></h3>
<div class="sez" style="font-size: 11px; font-family: 'Open Sans', sans-serif !important;">
 <p><b>Codice sorgente della parte web (struttura delle pagine, funzioni php e javascript inedite)</b><p>
 <p><a href="http://www.gnu.org/licenses/agpl-3.0.html">Affero GPL</a><br>
 La GNU Affero General Public License o GNU AGPL è una licenza di software libero pubblicata dalla Free Software Foundation. La GNU AGPL è simile alla capostipite GNU General Public License, con l'eccezione di una sezione aggiuntiva (la numero 13) che si riferisce all'utilizzo del software su una rete di calcolatori. Tale sezione richiede che il codice sorgente, se modificato, sia reso disponibile a chiunque utilizzi l'opera sulla rete. Il codice da fornire non sarà solo quello coperto da AGPL, ma anche tutti i moduli da esso utilizzati (escluse naturalmente le librerie di sistema). Come quasi tutte le licenze, la AGPL proibisce la rimozione della licenza stessa.<br>
 [Fonte: wikipedia]</p>
 <p align="center"><img src="img/icone/logoAGPL.png"/></p><br>

<p><b>Codice sorgente della parte web (funzioni javascript di OpenLayers e jQuery)</b><p>
 <p><a href="https://www.gnu.org/licenses/lgpl.html">Lesser GPL</a><br>
 La GNU Lesser General Public License (abbreviata in GNU LGPL o solo LGPL) è una licenza di software libero creata dalla Free Software Foundation, studiata come compromesso tra la GNU General Public License e altre licenze non copyleft come la Licenza BSD, la Licenza X11 e la Licenza Apache.<br>
 La LGPL è una licenza di tipo copyleft ma, a differenza della licenza GNU GPL, non richiede che un eventuale software "linkato" al programma sia rilasciato sotto la medesima licenza.<br>
   [Fonte: wikipedia]</p>
 <p align="center"><img src="img/icone/logoLGPL.png"/></p><br>

<p><b>Struttura del database, dati geografici, contenuti delle pagine web, immagini originali</b><p>
 <p><a href="http://creativecommons.org/about/cc0">CC0 Public Domain</a><br>
 Chi associa un proprio lavoro a questa licenza dedica l'Opera al pubblico dominio attraverso la rinuncia a tutti i suoi diritti protetti dal diritto d'autore, inclusi i diritti ad esso connessi, in tutto il mondo, nei limiti consentiti dalla legge.
Salvo indicazione esplicita contraria, la persona che associa questa licenza ad una propria Opera non fornisce alcuna garanzia riguardo all'Opera stessa, e declina ogni responsabilità per tutti gli usi dell'Opera, nella misura massima consentita dalla legge applicabile.
Quando si utilizza o si cita l'Opera, ciò non deve implicare alcun avallo, riconoscimento o sponsorizzazione da parte dell'autore o del dichiarante.
CC0 consente a scienziati, educatori, artisti, altri creatori e proprietari di diritti d'autore o di altri contenuti protetti dalle norme sulle banche dati di rinunciare a tali diritti sulle loro opere e, quindi, lasciarli nel modo più completo possibile al pubblico dominio, in modo che altri possano liberamente sviluppare, migliorare e riutilizzare le opere per altri scopi senza le restrizioni relative al diritto d'autore o al diritto di protezione delle banche dati.<br>
 [Fonte: Creative Commons]</p>
 <p align="center"><img src="img/icone/logoC0.png"/></p><br>

<p><b>Immagini riutilizzate</b><p>
 <p>Delle immagini riutilizzate – la maggior parte delle quali con licenza open – è sempre specificata la fonte. Le immagini della parte grafica (icone, immagini di layout ecc.) sono state create appositamente per il sito ed è stato pertanto possibile licenziarle con CC0.</p>
</div>

<h3><a>What's new?</a></h3>
<div class="sez" style="font-size: 11px; font-family: 'Open Sans', sans-serif !important;">
 <p>Molte sono le rifiniture progettate e messe in atto per rispettare l'idea di fondo del progetto ed il concetto stesso di WebGIS storico.<br>
Per gestire correttamente i dati geografici raccolti e per salvaguardare la coerenza logica dell'interno sistema sono state sviluppate alcune funzioni specifiche, sfruttando la naturale interazione tra le librerie utilizzate all'interno del progetto: ciò è risultato necessario, ad esempio, per permettere l’interrogazione delle geometrie nel WebGIS le quali, facendo capo a forme spaziali ed a riferimenti concettuali diversi, non potevano essere trattate in modo univoco.<br>
Un’ulteriore “rifinitura” è l'utilizzo del modulo Full Text Search di PostgreSQL e di alcune importanti funzioni come il calcolo del rank e l'highlight delle parole immesse nella pagina di ricerca del database. Poiché il progetto è in continuo progresso, per facilitare la ricerca  è stata applicata la funzione ts_stat che crea un vocabolario di tutte le parole via via indicizzate.</p>
</div>

</div>

