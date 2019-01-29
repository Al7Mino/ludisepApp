<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id = addslashes($_POST['id']);
		$personnage = recup_info_personnage($conn, $id);
		$image = $personnage['image'];
		$fiche = $personnage['fiche'];
		$directory = $_SERVER['DOCUMENT_ROOT'].'/files/personnages/'.$personnage['nom'];
		unlink($_SERVER['DOCUMENT_ROOT'].'/'.$image);
		unlink($_SERVER['DOCUMENT_ROOT'].'/'.$fiche);
		rmdir($directory);
		supprimer_inscription($conn, $id, NULL);
		supprimer_personnage($conn, $id);
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>