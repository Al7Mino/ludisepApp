<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$login = htmlspecialchars($_POST['login']);
		$mdp = hash('sha256', htmlspecialchars($_POST['mdp']));
		$resultat_connexion_utilisateur = connexion_utilisateur($conn, $login, $mdp);
		if($resultat_connexion_utilisateur == '') {
			$_SESSION['erreur_connexion'] = true;
			header('Location: ../espace_membre.php');
		}
		else {
			$_SESSION['erreur_connexion'] = false;
			$utilisateur = recup_utilisateur($conn, $resultat_connexion_utilisateur, $mdp);
			$_SESSION['utilisateur']['id']=$utilisateur['id'];
			$_SESSION['utilisateur']['prenom']=$utilisateur['prenom'];
			$_SESSION['utilisateur']['nom']=$utilisateur['nom'];
			$_SESSION['utilisateur']['avatar']=$utilisateur['avatar'];
			$_SESSION['utilisateur']['role']=$utilisateur['role'];
			header('Location: ../accueil.php');
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>