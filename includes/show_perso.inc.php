<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	try {
		$id = addslashes($_SESSION['utilisateur']['id']);
		$personnages = recup_personnages($conn, $id);
		if (!empty($personnages)) {
			foreach ($personnages as $personnage) {
				$id = $personnage['id'];
				$image = $personnage['image'];
				$nom = $personnage['nom'];
				$description = $personnage['description'];
				$fiche = $personnage['fiche'];
				$nameFiche = basename($fiche);
				$visible = $personnage['visible'];
				echo('<div>
						<h2 class="perso border-perso">'.$nom.'</h2>
						<div class="border-perso">
							<div class="image-perso">
								<label class="hide">Image du personnage</label>
								<input form="save_modif_perso'.$id.'" type="hidden" name="MAX_FILE_SIZE" value="1000000">
								<input form="save_modif_perso'.$id.'" class="hide" type="file" name="modif_image">
								<img alt="Portrait du personnage" src="'.$image.'">
							</div>
							<div class="description-perso">
								<textarea form="save_modif_perso'.$id.'" class="hide" name="modif_description" rows="10" cols="100">'.$description.'</textarea>
								<fieldset>
									<legend>Description</legend>
									<p>'.$description.'</p>
								</fieldset>
							</div>
							<div class="info-perso">
									<label class="hide">Nom du personnage</label>
									<input form="save_modif_perso'.$id.'" class="hide" type="text" name="modif_nom" value="'.$nom.'">
									<label class="hide">Fiche du personnage</label>
									<input form="save_modif_perso'.$id.'" type="hidden" name="MAX_FILE_SIZE" value="500000">
									<input form="save_modif_perso'.$id.'" class="hide" type="file" name="modif_fiche">
									<a href="'.$fiche.'">'.$nameFiche.'</a>
									');
					if($visible) {
							echo('	<div><label>Fiche visible </label><input id="ficheVisibleCheck" type="checkbox" checked></div>');
					}
					else {
							echo('	<div><label>Fiche visible </label><input id="ficheVisibleCheck" type="checkbox"></div>');
					}
					echo('		</div>
							<div>
								<img alt="Bouton d\'édition" class="edit" src="./img/edit-icon.png" title="Modifier le personnage">
								<img alt="Bouton de supression" class="suppr" src="./img/suppr-icon.png" title="Supprimer le personnage">
							</div>
						</div>
						<form id="save_modif_perso'.$id.'" class="hide" method="POST" action="./includes/modify_personnage.inc.php" enctype="multipart/form-data">
							<input type="hidden" name="id_perso" value="'.$id.'">
							<input class="bouton" type="submit" name="envoyer" value="Enregistrer les modifications">
						</form>
					</div>');
			}
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>