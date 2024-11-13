<?php

require "vendor/autoload.php";  // Inclusion de l'autoloader


$loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/views');
$twigConfig = array(
	// 'cache' => './cache/twig/',
	// 'cache' => false,
	'debug' => true,
);

Flight::register('view', 'Twig_Environment', array($loader, $twigConfig), function($twig) {
	$twig->addExtension(new Twig_Extension_Debug());  // Add the debug extension
});


Flight::register('view', 'Twig_Environment', array($loader, $twigConfig), function ($twig) {
    $twig->addExtension(new Twig_Extension_Debug()); // Add the debug extension
    $twig->addGlobal('titre', "iBookin");
});



Flight::route('/first_view/', function() {
	$data = [
		'prenom' => "Aurélien",
	];
	Flight::view()->display('first_view.html', $data);
});


Flight::route('/api/', function() {
	$response = Requests::get('https://www.googleapis.com/books/v1/volumes?q=développement+personnel&key=AIzaSyAGr-apcARa0DsYXyG7H-b0g2so3ELjYCU&maxResults=40&startIndex=0');

	$books = json_decode($response->body);
	$data = [
		'books' => $books,
	];
	Flight::view()->display('retour_api.html', $data);
});


Flight::route('/api/test/', function() {
	recherche_api_googleBooks();
});




Flight::route('/', 'recherche_api_googleBooks');


Flight::route('/hello/@name', function($name){
	echo "Hello ".$name;
});



Flight::start();


