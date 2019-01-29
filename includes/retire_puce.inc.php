<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	try {
		if (isset($_POST['id_puce'])) {
			$id_puce = addslashes($_POST['id_puce']);
			retirer_puce($conn, $id_puce);
		}
		header('Location: ../puce.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>