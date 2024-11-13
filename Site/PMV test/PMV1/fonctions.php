<?php


// =========== FONCTIONS - GESTION DES INTERACTIONS


function connexionBDD(){
	// Connexion à la base de données avec gestion des exceptions
	try{
		$db = new PDO('sqlite:bdd_ibookin.sqlite3');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}
}


// Fonction permettant de créer un compte utilisateur si l'username est disponible
function creation_compte($username, $password){
	// On se connecte à la BDD
	$bdd = connexionBDD();

	// =========== On commence par regarder si l'username est disponible
	// Construction de la Requête SQL
	$query = $bdd->prepare("SELECT COUNT(id) 
							FROM users
							WHERE username = :username");
	// Paramètres et exécution
	$query->execute(array('username'=>$username));

	// =========== Traitement des données récupérées
	$data = $query->fetch();

	if ($data[0]>=1){
		// Le nom d'utilisateur n'est pas disponible
		echo "<p>Ce nom d'utilisateur n'est pas disponible !</p>";
	}else{
		// Le nom d'utilisateur est disponible
		// Nous créons donc le compte

		// Construction de la Requête SQL 
		$query = $bdd->prepare("
					INSERT INTO users(username, password)
					VALUES(:username, :password)");
		// Paramètres et exécution
		$query->execute(array('username'=>$username,
								'password'=>$password));
	}
}


// Fonction permettant la connexion à un compte utilisateur
function connexion_compte($username, $password){
	// On se connecte à la BDD
	$bdd = connexionBDD();

	// =========== On commence par regarder si le compte existe
	// Construction de la Requête
	$query = $bdd->prepare("SELECT COUNT(id), id
							FROM users
							WHERE username = :username
							AND password = :password");
	// Paramètres et exécution
	$query->execute(array('username'=>$username,
							'password'=>$password));

	// =========== Traitement des données récupérées
	$data = $query->fetch();
	if ($data[0]==0){
		// Le nom d'utilisateur n'existe pas ou le MDP est faux
		echo "<p>Compte inexistant ou mauvais mot de passe !</p>";
	}else{
		echo "<p>Vous êtes connecté ! </p>";
		// On fait une redirection vers la page de gestion de bibliothèque
		header('Location: gestion.php');
		exit();
	}
}



// Fonction permettant d'afficher la liste de tous les comptes utilisateurs existants
function liste_compte(){
	// On se connecte à la BDD
	$bdd = connexionBDD();

	// Construction de la Requête SQL
	$query = $bdd->prepare("SELECT id, username, password
							FROM users");
	// Paramètres et exécution
	$query->execute(array());

	// Traitement des données récupérées
	while ($data = $query->fetch()){
		echo "<hr/>";
		echo "<h3>Id       :  ".$data[0];
		echo "<h3>Username :  ".$data[1];
		echo "<h3>Password :  ".$data[2];
	}
}

?>