<?php
/*
Il file functions.php è un file presente all'interno di ogni tema di WordPress e serve a specificare le 
funzionalità e le personalizzazioni del tema. Il file functions.php è un file PHP, quindi può contenere 
codice PHP, ma anche codice HTML, CSS e JavaScript.
|
Il file functions.php è un file importante perché permette di aggiungere funzionalità al tuo tema, senza 
modificare il codice del tema stesso. Ciò significa che, se si decide di cambiare tema in futuro, le personalizzazioni 
create nel file functions.php non verranno perse.
|
Il file functions.php può essere utilizzato per:
Aggiungere funzionalità al tuo tema, come ad esempio la creazione di un menu personalizzato, l'aggiunta di 
widget personalizzati o la creazione di shortcode personalizzati.
Personalizzare il comportamento predefinito di WordPress, come ad esempio la modifica della lunghezza 
dell'estratto dei post o la modifica della lunghezza del titolo della pagina.
|
Caricare risorse esterne, come ad esempio i file CSS o JavaScript.
Eseguire qualsiasi altra operazione che si desidera eseguire prima che il tema venga caricato.
In sintesi, il file functions.php è un file presente in ogni tema di wordpress, permette di aggiungere 
funzionalità e personalizzazioni al tema senza modificare il codice del tema stesso, può contenere diversi 
tipi di codice e permette di personalizzare il comportamento predefinito di wordpress.
*/

//carica correttamente i file .css
function load_stylesheets()
{
	wp_enqueue_style('bootstrap', get_template_directory_uri() . "/css/default/bootstrap.min.css", array(), '5.2.3', 'all');
}
add_action('wp_enqueue_scripts', 'load_stylesheets');

//carica correttamente i file .js
function load_js()
{
	//wp_enqueue_script('jQuery', get_template_directory_uri() . "/js/default/jquery-3.6.3.min.js", array(), '3.6.3', true);
	wp_enqueue_script('bootstrap', get_template_directory_uri() . "/js/default/bootstrap.bundle.min.js", array(), '5.1.3', true);
}
add_action('wp_enqueue_scripts', 'load_js');