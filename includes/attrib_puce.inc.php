<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	try {
		if (isset($_POST['perso'])) {
			$id = addslashes($_POST['perso']);
			$id_puce = addslashes($_POST['id_puce']);
			attribution_puce($conn, $id, $id_puce);
		}
		header('Location: ../puce.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>