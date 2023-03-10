<!--
Il file page.php è un file presente nella maggior parte dei temi di WordPress e serve per specificare 
la struttura e il contenuto delle singole pagine del sito.

In WordPress, le pagine sono utilizzate per creare contenuti statici come la pagina "Chi siamo", 
"Contatti" o "Termini e condizioni" del tuo sito web. Il file page.php è utilizzato per creare la 
struttura e il contenuto di queste pagine.

Il file page.php può contenere codice HTML, CSS e PHP per creare la struttura e il contenuto della pagina, 
inclusi loop per mostrare i contenuti personalizzati. Inoltre, può utilizzare le funzionalità e le personalizzazioni 
create nel file functions.php.

Se il tema in uso non contiene il file page.php, WordPress utilizzerà il file index.php per mostrare la pagina. 
In questo caso, per creare una pagina personalizzata è possibile utilizzare il file single.php o creare un template 
personalizzato per la pagina.

In sintesi, il file page.php è un file presente in molti temi di wordpress, che serve per specificare la struttura 
e il contenuto delle singole pagine del sito, può contenere codice HTML, CSS e PHP, e può utilizzare le funzionalità 
e le personalizzazioni create nel file functions.php. Se non presente, wordpress utilizzerà il file index.php o un 
template personalizzato per mostrare la pagina.
-->

<?php
$DEBUG = false;

if (is_page('login-page')) {
    get_template_part('pages/page', 'login');
}

if ($DEBUG == false) {
    if (is_page('profile')) {
        get_template_part('pages/page', 'profile');
    }
    if (is_page('cart')) {
        get_template_part('pages/page', 'cart');
    }
    if (is_page('order')) {
        get_template_part('pages/page', 'order');
    }
    if (is_page('catalog')) {
        get_template_part('pages/page', 'catalog');
    }
    if (is_page('product')) {
        get_template_part('pages/page', 'single_product');
    }
} else {
    if (is_page('profile')) {
        get_template_part('pages-test/page', 'profile-test');
    }
    if (is_page('cart')) {
        get_template_part('pages-test/page', 'cart-test');
    }
    if (is_page('order')) {
        get_template_part('pages-test/page', 'order-test');
    }
    if (is_page('product')) {
        get_template_part('pages-test/page', 'single_product-test');
    }
}
?>