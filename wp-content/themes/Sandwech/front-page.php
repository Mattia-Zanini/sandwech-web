<!--
Il file front-page.php è un file presente all'interno di alcuni temi di WordPress e serve per specificare la struttura 
e il contenuto della pagina principale del sito. La pagina principale è quella che viene visualizzata per prima quando si accede al sito.

In alcuni casi, i temi di wordpress utilizzano il file front-page.php per sovrascrivere la pagina principale predefinita 
di wordpress, in modo da creare una pagina personalizzata per la homepage del tuo sito web. In altri casi, 
il file front-page.php è utilizzato per creare una pagina di presentazione, una landing page o una pagina di benvenuto per il tuo sito.

Il file front-page.php può contenere codice HTML, CSS e PHP per creare la struttura e il contenuto della pagina, 
inclusi loop per mostrare i post, le pagine o i contenuti personalizzati. Inoltre, può utilizzare le funzionalità 
e le personalizzazioni create nel file functions.php.

Se il tema in uso non contiene il file front-page.php, WordPress utilizzerà il file index.php per mostrare la pagina principale.
In questo caso, per creare una pagina personalizzata per la homepage del tuo sito web, è possibile utilizzare la funzionalità 
"Pagina iniziale statica" nelle impostazioni di wordpress.

In sintesi, il file front-page.php è un file presente in alcuni temi di wordpress, permette di specificare la struttura e il 
contenuto della pagina principale del sito, può essere utilizzato per sovrascrivere la pagina principale predefinita di wordpress,
può contenere codice HTML, CSS e PHP e può utilizzare le funzionalità e le personalizzazioni create nel file functions.php.
-->


<?php
/*
get_header() è utilizzato per includere il contenuto del file header.php nell'inizio di ogni pagina del tuo sito web. 
In questo modo, è possibile creare un'intestazione coerente per tutte le pagine del tuo sito web senza dover ripetere 
il codice per ogni singola pagina.
*/
get_header();
?>
<link href="<?php echo get_template_directory_uri(); ?>/css/front-page.css" rel="stylesheet" type="text/css">


<div class="container-fluid">
    <div class="row" style="margin-top: 2vh;">
        <div class="col-1">
            <img style="max-width: 5vw; margin-left: 2vw;"
                src="<?php echo get_template_directory_uri(); ?>/assets/logo.png">
        </div>
        <div class="col-1 offset-1" style="margin-left: 4vw;">
            <a href="#" class="noulink-black">
                <h1 class="nav-menu">Home</h1>
            </a>
        </div>
        <div class="col-1">
            <a href="#" class="noulink-black">
                <h1 class="nav-menu">Ordina</h1>
            </a>
        </div>
    </div>
    <div class=" row" style="margin-top: 13vh; margin-left: 10vw;">
        <div class="col-5">
            <h1 class="front-page-title">Delicious</h1>
            <h1 class="front-page-subtitle">Food-Place</h1>
            <p class="front-page-paragraph">
                Siamo fieri di offrire una vasta selezione di panini deliziosi, realizzati con ingredienti freschi e di
                alta qualità. Siamo convinti che ogni persona meriti un pasto delizioso e nutriente, per questo mettiamo
                il massimo impegno nella preparazione dei nostri panini. Scegli il tuo preferito o provali tutti, siamo
                certi che non te ne pentirai! Venite a trovarci e gustate la vera essenza del panino.</p>
            <button class="btn btn-to-order">ORDINA ORA</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies.js"></script>

<?php
/*
get_footer() è utilizzato per includere il contenuto del file footer.php alla fine di ogni pagina del tuo sito web. 
In questo modo, è possibile creare un piè di pagina coerente per tutte le pagine del tuo sito web senza dover ripetere 
il codice per ogni singola pagina.
*/
get_footer();
?>