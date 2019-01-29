<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	try {
		$id = addslashes($_SESSION['utilisateur']['id']);
		$utilisateur = info_utilisateur($conn, $id);
		$roles = all_roles($conn);
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>