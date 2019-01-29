<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id = addslashes($_POST['id']);
		$personnage = recup_info_personnage($conn, $id);
		$id_utilisateur = $personnage['id_utilisateur'];
		$utilisateur = info_utilisateur($conn, $id_utilisateur);
		$utilisateur['login']=NULL;
		$utilisateur['mail']=NULL;
		$image = $personnage['image'];
		$fiche = $personnage['fiche'];
		$nameFiche = basename($fiche);
		$description = $personnage['description'];
		$prenom = $utilisateur['prenom'];
		$nom = $utilisateur['nom'];
		$visible = $personnage['visible'];
		if ($visible OR addslashes($_SESSION['utilisateur']['role'])>1) {
			echo('<div class="flex">
				<div class="image-perso">
					<img alt="Portrait du personnage" src="'.$image.'">
				</div>
				<div class="description-perso">
					<p>'.$description.'</p>
				</div>
				<div class="info-perso">
					<div>
						<p>Joueur : '.$prenom.' '.$nom.'</p>
						<a href="'.$fiche.'">'.$nameFiche.'</a>
					</div>
				</div>
			</div>');
		}
		else {
			echo('<div class="flex">
				<div class="image-perso">
					<img alt="Portrait du personnage" src="'.$image.'">
				</div>
				<div class="description-perso">
					<p>'.$description.'</p>
				</div>
				<div class="info-perso">
					<div>
						<p>Joueur : '.$prenom.' '.$nom.'</p>
					</div>
				</div>
			</div>');
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>