<?php
	require_once('bdd_connect.php');
	require_once('func_calendrier.php');
	try {
		$titre = htmlspecialchars($_POST['titre']);
		$date_debut = htmlspecialchars($_POST['date_debut']);
		$date_fin = htmlspecialchars($_POST['date_fin']);
		$contenu = nl2br(htmlspecialchars($_POST['contenu']));
		ajouter_event($conn, $titre, $date_debut, $date_fin, $contenu);
		header('Location: ../admin_event.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>