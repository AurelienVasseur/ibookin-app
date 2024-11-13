<?php


require "vendor/autoload.php";   // Inclusion de l'autoload


$response = Requests::get('https://www.googleapis.com/books/v1/volumes?q=développement%20personnel&key=API_KEY_HERE&maxResults=40&startIndex=0');

$books = json_decode($response->body);

var_dump($response->status_code);

echo "<br/> <br/>";

echo "<p>Nombre de résultats : ".count($books->items)."</p>";

echo "<h2>Résultats de la recherche : </h2>";

for ($i=0; $i<count($books->items); $i++) {
	$titre = $books->items[$i]->volumeInfo->title;
	$image = '';
	if (isset($books->items[$i]->volumeInfo->imageLinks->smallThumbnail)) {
		$image = $books->items[$i]->volumeInfo->imageLinks->smallThumbnail;
		$image = str_replace('&edge=curl', '', $image);
	} elseif (isset($books->items[$i]->volumeInfo->imageLinks->thumbnail)) {
		$image = $books->items[$i]->volumeInfo->imageLinks->thumbnail;
		$image = str_replace('&edge=curl', '', $image);
	}

	echo "<p> Livre numéro : ".$i."</p>";
	echo "<p> Titre : ".$titre."</p>";
	echo "<img src='".$image."'/>";
}
