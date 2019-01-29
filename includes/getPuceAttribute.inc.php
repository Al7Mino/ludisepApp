<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id = addslashes($_SESSION['utilisateur']['id']);
		$id_puce = addslashes($_POST['id_puce']);
		$perso_id = recup_attribution($conn, $id_puce);
		$personnages = recup_personnages($conn, $id);
		if(in_multiarrays($perso_id, $personnages, '', 1, 2)) {
			echo('<p>Souhaitez-vous retirer la puce ?</p>');
		}
		else {
			echo('<p class="erreur">Cette puce est déjà attribuée au personnage d\'un autre joueur</p>');
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>