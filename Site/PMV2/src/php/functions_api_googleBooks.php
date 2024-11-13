<?php

function recherche_api_googleBooks() {
	$response = Requests::get('https://www.googleapis.com/books/v1/volumes?q=9791092928228&key=AIzaSyAGr-apcARa0DsYXyG7H-b0g2so3ELjYCU&maxResults=40&startIndex=0');

	var_dump($response->status_code);
	$books = json_decode($response->body);

	echo "<p>Nombre de résultats : ".count($books->items)."</p>";

	echo "<h2>Résultats de la recherche : </h2>";

	for ($i=0; $i<count($books->items); $i++) {
		$titre = $books->items[$i]->volumeInfo->title;
		$image = '';
		if (isset($books->items[$i]->volumeInfo->imageLinks->smallThumbnail)) {
			$image = $books->items[$i]->volumeInfo->imageLinks->smallThumbnail;
			$image = str_replace('&edge=curl', '', $image);
		}

		echo "<p> Livre numéro : ".$i."</p>";
		echo "<p> Titre : ".$titre."</p>";
		echo "<img src='".$image."' />";
	}	
}

function retour_api_googleBooks() {
	$response = Requests::get('https://www.googleapis.com/books/v1/volumes?q=javascript&key=AIzaSyAGr-apcARa0DsYXyG7H-b0g2so3ELjYCU&maxResults=40&startIndex=0');

	$books = json_decode($response->body);	

	return $books;
}



