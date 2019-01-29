<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$nom = htmlspecialchars($_POST['nom']);
		$info = nl2br(htmlspecialchars($_POST['info']));
		ajouter_puce($conn, $nom, $info);
		$id = recup_id_puce($conn, $nom);
		echo $id;
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>