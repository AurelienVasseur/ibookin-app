<?php
	// On démarre la session
	session_start();
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8"/>
	<title>iBookin</title>
</head>

<body>

	<?php
		// On inclut le fichier contenant les fonctions
		include('fonctions.php');

		// On se connecte à la BDD
		$bdd = connexionBDD();
		echo "Connexion réussie";
	?>


	<!-- FORMULAIRE DE CREATION DE COMPTE UTILISATEUR -->

	<form method="POST" action="index.php">
		<input type="text" name="username_creation_compte" placeholder="username" required>
		<input type="password" name="password_creation_compte" required>
		<input type="submit" name="creation_compte" value="Créer Compte">
	</form>

	<!-- FORMULAIRE DE CONNEXION AU COMPTE UTILISATEUR -->

	<form method="POST" action="index.php">
		<input type="text" name="username_connexion_compte" placeholder="username" required>
		<input type="password" name="password_connexion_compte" required>
		<input type="submit" name="connexion_compte" value="Se connecter">
	</form>


	<?php
		if (isset($_POST['creation_compte'])){
			$username = $_POST['username_creation_compte'];
			$password = $_POST['password_creation_compte'];
			creation_compte($username, $password);
		}

		if (isset($_POST['connexion_compte'])){
			$username = $_POST['username_connexion_compte'];
			$password = $_POST['password_connexion_compte'];
			connexion_compte($username, $password);
		}




		liste_compte();

	?>


</body>

</html>