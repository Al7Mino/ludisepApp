<?php
	require_once('bdd_connect.php');
	function show_quete_venir() {
		global $conn;
		$id_utilisateur = addslashes($_SESSION['utilisateur']['id']);
		$role = addslashes($_SESSION['utilisateur']['role']);
		$etats = recup_etats($conn);
		try {
			if ($role > 1) { //On affiche les quêtes à venir uniquement pour les MJ et les admins
				echo('<section class="quete-venir">
						<h2>Quêtes à venir</h2>
						<ul>');
				$quetes = recup_quetes($conn);
				if (!empty($quetes)) {
					foreach ($quetes as $quete) {
						$id = $quete['id'];
						$auteur = $quete['auteur'];
						$titre = $quete['titre'];
						$description = $quete['description'];
						$etat = $quete['etat'];
						if ($etat == 1) {
							if ($auteur == $id_utilisateur OR $role == 3) { //On affiche les options de modifications si l'utilisateur est l'auteur de la quête ou si c'est un administrateur
								echo('<li>
									<h3>'.$titre.' 
										<img alt="Bouton d\'édition" class="edit" src="./img/edit-icon.png" title="Modifier la quête">
										<img alt="Bouton de suppression" class="suppr" src="./img/suppr-icon.png" title="Supprimer la quête">
									</h3>
									<p>'.$description.'</p>
									<textarea class="titre quete-'.$id.' hide" rows="1">'.$titre.'</textarea>
									<span class="hide img"><img alt="Bouton d\'édition" class="edit" src="./img/edit-icon.png"></span>
									<textarea class="description quete-'.$id.' hide" rows="7">'.$description.'</textarea>
									<form method="POST" action="./includes/modify_quete.inc.php">
										<input type="hidden" name="quete" value="'.$id.'">
										<select name="etat">');
								if ($role == 3) {
									foreach ($etats as $nomEtat) {
										echo('<option value="'.$nomEtat['id'].'">'.$nomEtat['etat'].'</option>');
									}
								}
								else {
									echo('<option value="2">En cours</option>');
								}
								echo('</select>
									<input type="submit" value="Modifier l\'état">
									</form>
									</li>');
							}
							else {
								echo('<li>
									<h3>'.$titre.'</h3>
									<p>'.$description.'</p>
								</li>');
							}
						}
					}
				}
				echo('</ul>
					</section>');
			}
		}
		catch(PDOException $e) {
			echo ($e->getMessage());
		}
	}
	function show_quete_cours() {
		global $conn;
		$id_utilisateur = addslashes($_SESSION['utilisateur']['id']);
		$role = addslashes($_SESSION['utilisateur']['role']);
		$etats = recup_etats($conn);
		try {
			$quetes = recup_quetes($conn);
			$joueurs = recup_all_inscrits($conn);
			$personnages = recup_personnages($conn, $id_utilisateur);
			if (!empty($quetes)) {
				foreach ($quetes as $quete) {
					$id = $quete['id'];
					$titre = $quete['titre'];
					$description = $quete['description'];
					$etat = $quete['etat'];
					$auteur = $quete['auteur'];
					$inscrits = recup_id_inscrits($conn, $id);
					if ($etat == 2) {
						echo('<li>
								<h3>'.$titre);
						if ($auteur == $id_utilisateur OR $role == 3) { //On affiche les options de modifications si l'utilisateur est l'auteur de la quête ou si c'est un administrateur
							echo('<img alt="Bouton d\'édition" class="edit" src="./img/edit-icon.png" title="Modifier la quête">');
							if ($role == 3) {
								echo('<img alt="Bouton de suppression" class="suppr" src="./img/suppr-icon.png" title="Supprimer la quête">');
							}
							echo('</h3>
								<p>'.$description.'</p>
								<textarea class="titre quete-'.$id.' hide" rows="1">'.$titre.'</textarea>
								<span class="hide img"><img alt="Bouton d\'édition" class="edit" src="./img/edit-icon.png"></span>
								<textarea class="description quete-'.$id.' hide" rows="7">'.$description.'</textarea>
								<form method="POST" action="./includes/modify_quete.inc.php">
									<input type="hidden" name="quete" value="'.$id.'">
									<select name="etat">');
							if ($role == 3) {
								foreach ($etats as $nomEtat) {
									echo('<option value="'.$nomEtat['id'].'">'.$nomEtat['etat'].'</option>');
								}
							}
							else {
								echo('<option value="3">Terminée</option>');
							}
							echo('</select>
								<input type="submit" value="Modifier l\'état">
								</form>');
						}
						else {
							echo('</h3>
								<p>'.$description.'</p>');
						}
						echo ('<h4>Participants :</h4>
								<ul class="participants">');
						if (!empty($inscrits)) { // Si des personnages sont inscrits à la quête, on les affiche
							foreach ($inscrits as $inscrit) {
								$id_inscrit = $inscrit['id'];
								$personnage = recup_info_personnage($conn, $id_inscrit);
								$nom = $personnage['nom'];
								echo('<li><span id="personnage-'.$id_inscrit.'">'.$nom.'</span></li>');
							}
						}
						echo "</ul>";
						if (!in_multiarrays($id_utilisateur, $joueurs, '', 1, 2)) { // Si l'utilisateur n'est inscrit à aucune quête, on affiche les options d'inscriptions

							echo('<form method="POST" action="./includes/insc_quete.inc.php">
									<input type="hidden" name="quete" value="'.$id.'">
									<select name="perso">');
							foreach ($personnages as $perso) {
								echo('<option value="'.$perso['id'].'">'.$perso['nom'].'</option>');
							}
							echo('	</select>
									<input type="submit" name="envoyer" value="S\'inscrire">
								</form>
							</li>');
						}
						else if(!empty($inscrits[0]) AND in_multiarrays($inscrits,$personnages,'id', 2, 2)) { //Si l'utilisateur a inscrit un personnage à une quête, alors on affiche l'option de désinscription

							foreach ($personnages as $personnage) {
								foreach ($inscrits as $inscrit) {
									if (in_array($personnage['id'], $inscrit)) {
										$_SESSION['personnage']['id'] = $personnage['id'];
									}
								}
							}
							echo('<form method="POST" action="./includes/desinsc_quete.inc.php">
									<input type="submit" name="envoyer" value="Se désinscrire">
								</form>
								</li>');
						}
						else {
							echo "</li>";
						}
					}
				}
			}
		}
		catch(PDOException $e) {
			echo ($e->getMessage());
		}
	}
	function show_quete_terminee() {
		global $conn;
		$id_utilisateur = addslashes($_SESSION['utilisateur']['id']);
		$role = addslashes($_SESSION['utilisateur']['role']);
		try {
			$quetes = recup_quetes($conn);
			if (!empty($quetes)) {
				foreach ($quetes as $quete) {
					$id = $quete['id'];
					$titre = $quete['titre'];
					$description = $quete['description'];
					$etat = $quete['etat'];
					if ($etat == 3) {
						echo('<li>
								<h3>'.$titre.' <img alt="Flèche" class="arrow" src="./img/arrow-down-icon.png">');
						if ($role == 3) {
							echo('<img alt="Bouton d\'édition" class="edit" src="./img/edit-icon.png" title="Modifier la quête">
								<img alt="Bouton de suppression" class="suppr" src="./img/suppr-icon.png" title="Supprimer la quête">');
						}
						echo('</h3>
								<p class="hidden">'.$description.'</p>');
						if ($role == 3) {
							echo('<textarea class="titre quete-'.$id.' hide" rows="1">'.$titre.'</textarea>
							<span class="hide img"><img alt="Bouton d\'édition" class="edit" src="./img/edit-icon.png"></span>
							<textarea class="description quete-'.$id.' hide" rows="7">'.$description.'</textarea>');
						}
						echo('</li>');
					}
				}
			}
		}
		catch(PDOException $e) {
			echo ($e->getMessage());
		}
		$conn = NULL;
	}
?>