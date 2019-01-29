<?php 
require_once('./includes/fonctions.php');
secure_session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Accéder à l'espace membre - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>		
		<script src="script/main.js"></script>
	</head>

	<body id="espace_membre">
		<?php require 'header.php'; ?>
		<section class="content main-content">
			<?php
				if (isset($_SESSION['confirm'])) {
					echo '<p style="color: green;">'.$_SESSION['confirm'].'</p>';
					$_SESSION['confirm']=NULL;
				}
			?>
			<div class="flex connexion">
				<div>
					<h2>Se connecter</h2>
					<?php
						if(isset($_SESSION['erreur_connexion'])) {
							if($_SESSION['erreur_connexion'])
								echo '<p style="color: red;">Login ou mot de passe incorrect</p>';
						}
						if (isset($_SESSION['erreur_recup'])) {
							if(!$_SESSION['erreur_recup']) {
								echo "<p style='color: green;'>Le compte a bien été mis à jour avec vos nouveaux identifiants.</p>";
							}
							$_SESSION['erreur_recup'] = NULL;
						}
					?>
					<form action="./includes/connexion.inc.php" method="post">
						<label for="login">Login : </label></br><input id="login" type="text" name="login" required /></br>
						<label for="mdp">Mot de passe :</label></br><input id="mdp" type="password" name="mdp" required /><br />
						<a class="infos_oubliees" href="./informations_oubliees.php">Informations de compte oubliées ?</a>
						<input type="submit" value="Connexion">
					</form>
				</div>
				<div>
					<h2>S'inscrire</h2>
					<p>Créer un nouveau compte, pour concevoir ses personnages, imaginer de nouvelles quêtes et se lancer dans des aventures épiques !</p>
					<a href="./inscription.php"><button>Inscription</button></a>
				</div>
			</div>			
		</section>
		<?php require 'footer.php';?>
	</body>
</html>