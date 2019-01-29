<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id = htmlspecialchars($_SESSION['utilisateur']['id']);
		$titre = htmlspecialchars($_POST['titre']);
		$description = nl2br(htmlspecialchars($_POST['description']));
		$etat = 1;
		ajouter_quete($conn, $titre, $description, $etat, $id);
		header('Location: ../quete.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>