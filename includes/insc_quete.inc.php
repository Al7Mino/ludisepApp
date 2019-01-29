<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		if (isset($_POST['perso'])) {
			$id = addslashes($_POST['perso']);
			$id_quete = addslashes($_POST['quete']);
			inscription_quete($conn, $id, $id_quete);
		}
		else {
			$_SESSION['erreur'] = "Vous n'avez pas sélectionné de personnage à inscrire.";
		}
		header('Location: ../quete.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>