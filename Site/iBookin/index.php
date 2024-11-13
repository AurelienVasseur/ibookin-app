<?php

require "vendor/autoload.php";

$loader = new Twig_Loader_Filesystem(dirname(__FILE__) . '/views');
$twigConfig = array(
    // 'cache' => './cache/twig/',
    // 'cache' => false,
    'debug' => true,
);

Flight::register('view', 'Twig_Environment', array($loader, $twigConfig), function ($twig) {
    $twig->addExtension(new Twig_Extension_Debug()); // Add the debug extension
});

Flight::route('/', function(){
    $data = [
        'prenom' => "Aurélien",
    ];
    Flight::view()->display('index.twig', $data);
});

Flight::start();