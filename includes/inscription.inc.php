<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$nom = addslashes($_POST['nom']);
		$prenom = addslashes($_POST['prenom']);
		$login = addslashes($_POST['login']);
		$mdp = addslashes($_POST['mdp']);
		$mdp_confirm = addslashes($_POST['mdp_confirm']);
		$mail = addslashes($_POST['adresse_mail']);

		if(preg_match("#^[a-zA-Z0-9._-]+@isep.fr$#", $mail)) {
			$utilisateurs = all_utilisateur($conn);
			foreach ($utilisateurs as $utilisateur) {
				$utilisateur_mail = info_utilisateur($conn, $utilisateur['id'])['mail'];
				if($utilisateur_mail == $mail) {
					$_SESSION['erreur_inscription'] = "Un compte utilisant les informations renseignées a déjà été créé. Vous ne pouvez avoir qu'un seul compte. S'il s'agit là d'une erreur, merci d'en informer les administrateurs du site : ludisep.isep@gmail.com";
					$conn = NULL;
					header('Location: ../inscription.php');
				}
			}
			if($mdp == $mdp_confirm) {
			    $mdp = hash('sha256', $mdp);
			    inscription($conn, $prenom, $nom, $login, $mdp, $mail, 1);
    			$_SESSION['confirm'] = "Votre compte a bien été créé.";
    			$conn = NULL;
    			header('Location: ../espace_membre.php');
			}
			else {
			    $_SESSION['erreur_inscription'] = "Le mot de passe renseigné est différent du mot de passe de confirmation.";
    			$conn = NULL;
    			header('Location: ../inscription.php');
			}
		}
		else {
			$_SESSION['erreur_inscription'] = "L'adresse mail renseignée n'est pas valide. Vous devez utiliser votre adresse mail ISEP.";
			$conn = NULL;
			header('Location: ../inscription.php');
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>