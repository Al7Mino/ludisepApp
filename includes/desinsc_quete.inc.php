<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id = addslashes($_SESSION['personnage']['id']);
		desinscription_quete($conn, $id);
		$_SESSION['personnage']['id']=NULL;
		header('Location: ../quete.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>