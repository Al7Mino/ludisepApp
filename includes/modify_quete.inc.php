<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		if (isset($_POST['etat'])) {
			$id = addslashes($_POST['quete']);
			$modification = "etat";
			$value = addslashes($_POST['etat']);
		}
		else {
			$id = addslashes($_POST['quete']);
			$modification = htmlspecialchars($_POST['modification']);
			$value = nl2br(htmlspecialchars($_POST['value']));
		}
		modify_quete($conn, $id, $modification, $value);
		header('Location: ../quete.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>