<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	try {
		$id = addslashes($_SESSION['membre']);
		$role = addslashes($_SESSION['utilisateur']['role']);
		$personnages = recup_personnages($conn, $id);
		if (!empty($personnages)) {
			foreach ($personnages as $personnage) {
				$id = $personnage['id'];
				$image = $personnage['image'];
				$nom = $personnage['nom'];
				$description = $personnage['description'];
				$fiche = $personnage['fiche'];
				$visible = $personnage['visible'];
				$nameFiche = basename($fiche);
				echo('<div>
						<h2 class="perso border-perso">'.$nom.'</h2>
						<div class="border-perso">
							<div class="image-perso">
								<img alt="Portrait du personnage" src="'.$image.'">
							</div>
							<div class="description-perso">
								<fieldset>
									<legend>Description</legend>
									<p>'.$description.'</p>
								</fieldset>
							</div>
							<div class="info-perso">
								<div>');
					if($visible OR $role!=1) {
						echo('<a href="'.$fiche.'">'.$nameFiche.'</a>');
					}
							echo('</div>
							</div>
						</div>
					</div>');
			}
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>