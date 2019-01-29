<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$code = htmlspecialchars($_POST['code']);
		if($code == $_SESSION['infos_oubliees']['code']) {
			$login = htmlspecialchars($_POST['login']);
			$mdp = hash('sha256', htmlspecialchars($_POST['mdp']));
			$id = $_SESSION['infos_oubliees']['id'];

			modify_utilisateur($conn, $id, 'login', $login);
			modify_utilisateur($conn, $id, 'mdp', $mdp);

			$_SESSION['erreur_recup'] = false;
			$_SESSION['infos_oubliees'] = NULL;
			header('Location: ../espace_membre.php');
		}
		else {
			$_SESSION['erreur_recup'] = true;
			header('Location: ../recuperation.php');
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>