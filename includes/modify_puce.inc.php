<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id_puce = addslashes($_POST['id_puce']);
		$id_sort = addslashes($_POST['numSort']);
		$modification = htmlspecialchars($_POST['modification']);
		$value = nl2br(htmlspecialchars($_POST['value']));
		if($id_sort==-1) {
			modify_puce($conn, $id_puce, $modification, $value);
		}
		else if($id_sort==-2) {
			
		}
		else {
			if($modification == 'sort') {
				$modification = 'nom';
			}
			modify_sort($conn, $id_sort, $modification, $value);
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>