<?php 
require_once('./includes/fonctions.php');
secure_session_start();
verif_connexion();
require_once('./includes/compte.inc.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mon compte - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>
		<script src="script/main.js"></script>
	</head>
	<body id="compte">
		<?php require 'header.php'; ?>
		<section class="content main-content">
			<h1>Profil</h1>
			<div class="profil">
				<div class="img-avatar">
					<form class="flex" method="POST" action="./includes/modify_user.inc.php" enctype="multipart/form-data">
						<input class="select-img" type="file" name="avatar" accept="image/*" title="Modifiez votre avatar">
						<input class="bouton submit-img" type="submit" value="Enregistrer l'image">
					</form>
					<div class="avatar-content">
						<?php echo '<img alt="Avatar" class="avatar" src="./'.$utilisateur['avatar'].'">'; ?>
						<div>Modifier</div>
					</div>
				</div>
				<div class="login">
					<h3>Login</h3>
					<div class="flex">
						<textarea class="login hide" rows="1"><?php echo $utilisateur['login'] ?></textarea>
						<span><?php echo $utilisateur['login'] ?></span>
						<img alt="Bouton d'édition" class="edit" src="./img/edit-icon.png" title="Modifier le login">
					</div>
				</div>
				<div class="mdp">
					<h3>Mot de passe</h3>
					<div class="flex">
						<textarea class="mdp hide" rows="1"></textarea>
						<span>***</span>
						<img alt="Bouton d'édition" class="edit" src="./img/edit-icon.png" title="Modifier le mot de passe">
					</div>
				</div>
				<div class="nom">
					<h3>Nom</h3>
					<div class="flex">
						<textarea class="nom hide" rows="1"><?php echo $utilisateur['nom'] ?></textarea>
						<span><?php echo $utilisateur['nom'] ?></span>
						<img alt="Bouton d'édition" class="edit" src="./img/edit-icon.png" title="Modifier le nom">
					</div>
				</div>
				<div class="prenom">
					<h3>Prénom</h3>
					<div class="flex">
						<textarea class="prenom hide" rows="1"><?php echo $utilisateur['prenom'] ?></textarea>
						<span><?php echo $utilisateur['prenom'] ?></span>
						<img alt="Bouton d'édition" class="edit" src="./img/edit-icon.png" title="Modifier le prénom">
					</div>
				</div>
				<div class="mail">
					<h3>Adresse mail</h3>
					<div class="flex">
						<textarea class="mail hide" rows="1" cols="40"><?php echo $utilisateur['mail'] ?></textarea>
						<span><?php echo $utilisateur['mail'] ?></span>
						<img alt="Bouton d'édition" class="edit" src="./img/edit-icon.png" title="Modifier l'adresse mail">
					</div>
				</div>
				<div class="role">
					<h3>Rôle</h3>
					<div class="flex">
						<span><?php echo $utilisateur['role'] ?></span>
						<img alt="Bouton d'aide" class="aide" src="./img/help-button.png" title="Les rôles disponibles sont 'Joueur' ou 'Maître du jeu'. Si vous souhaitez changer de rôle, veuillez contacter un administrateur.">
						<?php
							/*if ($_SESSION['utilisateur']['role']!=3) {
								echo('<select class="role hide">
									<option value='.$utilisateur['role_id'].'>'.$utilisateur['role'].'</option>');
								foreach ($roles as $role) {
									if ($role['id']!=3 && $role['id']!=$utilisateur['role_id']) {
										echo('<option value='.$role["id"].'>'.$role["nom"].'</option>');
									}
								}
									echo('</select>
								<span>'.$utilisateur['role'].'</span>
								<img class="edit" src="./img/edit-icon.png" title="Modifier le rôle">');
							}
							else {
								echo('<span class="admin">'.$utilisateur['role'].'</span>');
							}*/
						?>
					</div>
				</div>
			</div>
		</section>
		<?php require 'footer.php';?>
	</body>
</html>