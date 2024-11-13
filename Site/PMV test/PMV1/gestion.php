<?php
	// On démarre la session
	session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title>IBookIn</title>
</head>



<body>

<div align='center'>
	<h1> <a href="index.php">IBookIn</a> </h1>

	<form method="POST" action="index.php">
		<p> <input type="text" name="categorie" placeholder="Cours PHP"> </p>
		<p> <input type="text" name="isbn" placeholder="9791092928228"> </p>
		<p> <input type="submit" value="Rechercher" name="rechercher"> </p>
	</form>
	<hr>
</div>


<!-- Traitement des données - PHP -->

<?php

if (!empty($_POST['rechercher'])){

	// On récupère les champs de recherche
	echo "<div align='center'>";
	echo "<h2>Votre recherche : </h2>";
	if (!empty($_POST['categorie'])){
		$catego = $_POST['categorie'];
		echo "Nom : ".$catego."</p>";
	}
	if (!empty($_POST['isbn'])){
		$ISBN = $_POST['isbn'];
		echo "<p>ISBN : ".$ISBN."</p>";
	}
	echo "</div>";


	include('BookSearcher.class.php');

	$googleBook = new BookSearcher();


	echo "<div align='center'>";
	if (!empty($_POST['categorie']))
	{
		// Exemple de recherche par mot clés //
		$livres = $googleBook->getBooksByKeyword($catego);

		echo '<h1>Exemple de recherche</h1>';
		for ($i=0; $i<count($livres); $i++) {
			echo 'Livre ' . ($i+1) . '<br />';
			echo "<h3>".$livres[$i]['titre']."</h3>";
			if (isset($livres[$i]['image']))
			{
				$livres[$i]['image'] = str_replace ('&edge=curl' ,'' , $livres[$i]['image']);
				echo "<img id='dynamic' src='" . $livres[$i]['image']. "'>";
			}
			else
				echo "<h5>Aucune image trouvée :/ </h5>";
			echo "<h4>Description du livre</h4>";
			if (isset($livres[$i]['auteur'])){
				$auteur = $livres[$i]['auteur'];
				echo "<p>Auteur(s) : ".$auteur."</p>";
			}
			if (isset($livres[$i]['editeur'])){
				$editeur = $livres[$i]['editeur'];
				echo "<p>Editeur : ".$editeur."</p>";
			}

			echo '<pre>';
				print_r($livres[$i]);
			echo '</pre><br />';
		}
	}
	echo "</div>";


	echo "<div align='center'>";
	if (!empty($_POST['isbn']))
	{
		// Exemple de recherche par ISBN //
		echo '<h1>Exemple de recherche par ISBN</h1>';
		$livre = $googleBook->getBookByISBN($ISBN);

		echo '<p>Livre '.$ISBN.'<p/>';
		echo "<h3>".$livre['titre']."</h3>";
		if (isset($livre['image']))
		{
			$livre['image'] = str_replace ('&edge=curl' ,'' , $livre['image']);
			echo "<img id='dynamic' src='" . $livre['image']. "'>";
		}
		else
				echo "<h5>Aucune image trouvée :/ </h5>";
		echo "<h4>Description du livre</h4>";
		echo '<pre>';
			print_r($livre);
		echo '</pre><br />';
	}
	echo "</div>";
}

?>



</body>
</html>