<?php
	require_once('bdd_connect.php');
	require_once('func_calendrier.php');
	try {
		$id = addslashes($_POST['id']);
		supprimer_event($conn, $id);
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>