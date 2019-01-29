<?php
	require_once('bdd_connect.php');
	require_once('func_calendrier.php');
	try {
		$id = htmlspecialchars($_POST['id']);
		$titre = htmlspecialchars($_POST['titre']);
		$date_debut = htmlspecialchars($_POST['date_debut']);
		$date_fin = htmlspecialchars($_POST['date_fin']);
		$contenu = nl2br(htmlspecialchars($_POST['contenu']));
		modify_event($conn, $id, "titre", $titre);
		modify_event($conn, $id, "date_debut", $date_debut);
		modify_event($conn, $id, "date_fin", $date_fin);
		modify_event($conn, $id, "contenu", $contenu);
		header('Location: ../admin_event.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>