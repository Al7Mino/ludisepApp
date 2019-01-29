<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id = addslashes($_POST['id']);
		supprimer_sort($conn, $id);
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>