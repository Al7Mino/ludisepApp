<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id = addslashes($_SESSION['utilisateur']['id']);
		$personnages = recup_personnages($conn, $id);
		echo('<select name="perso">');
		foreach ($personnages as $perso) {
			$nb_attribution = recup_nombre_attribution($conn, $perso['id']);
			if($nb_attribution < 2) {
				echo('<option value="'.$perso['id'].'">'.$perso['nom'].'</option>');
			}
		}
		echo('</select>');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>