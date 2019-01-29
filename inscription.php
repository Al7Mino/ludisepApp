<?php 
require_once('./includes/fonctions.php');
secure_session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Inscription - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href=<?=CSS_DIR.'/style.css'?> >
		<link rel="stylesheet" type="text/css" href="../css/style-smartphone.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src=<?=SCRIPT_DIR."/jquery-3.2.1.min.js"?> ></script>		
		<script src=<?=SCRIPT_DIR."/main.js"?> ></script>
	</head>

	<body id="inscription">
		<?php require 'header.php'; ?>
		<section class="content main-content">
			<h1>Inscription</h1>
			<h2>Pas encore inscrit ? Créez votre compte !</h2>
			<?php
				if (isset($_SESSION['erreur_inscription'])) {
					echo '<p style="color: red; text-align: center;">'.$_SESSION['erreur_inscription'].'</p>';
					$_SESSION['erreur_inscription']=NULL;
				}
			?>
			<form action="./includes/inscription.inc.php" method="POST">
				<label>Prenom * : </label>  <input type="text" name="prenom" required /></br>
				<label>Nom * : </label> <input type="text" name="nom" id="nom" required /><br />
				<label>Login * : </label><input type="text" name="login" required /></br>
				<label>Mot de passe * :</label><div><input type="password" name="mdp" required /><i class="far fa-eye"></i></div>
				<label>Confirmation du mot de passe * :</label><input type="password" name="mdp_confirm" required /><br />
				<label>Mail * :</label><input type="text" name="adresse_mail" required /></br>
				<p>* = champs obligatoires</br></p>
				<input type="submit" value="S'inscrire">
			</form>
		</section>
		<?php require 'footer.php';?>
	</body>
</html>