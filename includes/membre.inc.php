<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	try {
		$utilisateurs = all_utilisateur($conn);
		$user_role = addslashes($_SESSION['utilisateur']['role']);
		$roles = all_roles($conn);
		foreach ($utilisateurs as $utilisateur) {
			$id = $utilisateur['id'];
			$avatar = $utilisateur['avatar'];
			$prenom = $utilisateur['prenom'];
			$nom = $utilisateur['nom'];
			$utilisateur_role = $utilisateur['role'];
			$utilisateur_role_id = $utilisateur['role_id'];
			echo('<div><a class="membre" href="./personnage.php?id='.$id.'">
					<div class="avatar-content">
						<img alt="Avatar" class="avatar" src="./'.$avatar.'">
					</div>');
			if($user_role==3 && $utilisateur_role_id!=3) {
				echo('</a>
					<p>'.$prenom.' '.$nom.'</p>
					<select class="role">
						<option value='.$utilisateur_role_id.'>'.$utilisateur_role.'</option>');
				foreach ($roles as $role) {
					if ($role['id']!=3 && $role['id']!=$utilisateur_role_id) {
						echo('<option value='.$role["id"].'>'.$role["nom"].'</option>');
					}
				}
				echo('</select></div>');
			}
			else{
				echo('<p>'.$prenom.' '.$nom.' ('.$utilisateur_role.')</p>
				</a></div>');
			}
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>