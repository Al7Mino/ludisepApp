<?php 
require_once('./includes/fonctions.php');
secure_session_start();
if (!isset($_SESSION['infos_oubliees'])) {
    header("Location: ./informations_oubliees.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Informations oubliées - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>		
		<script src="script/main.js"></script>
	</head>
	<body id="recup_compte">
		<?php require 'header.php'; ?>
		<main class="content-fit main-content box">
			<h1>Retrouver votre compte</h1>
			<?php
				if (isset($_SESSION['erreur_recup'])) {
					if($_SESSION['erreur_recup']) {
						echo "<p style='color: red;'>Le code renserigné n'est pas le même qui a été envoyé par e-mail.</p>";
					}
					else {
						echo "<p style='color: green;'>Le compte a bien été mis à jour avec vos nouveaux identifiants.</p>";
					}
				}
				$_SESSION['erreur_recup'] = NULL;
			?>
			<p>Veuillez saisir le code qui vous a été envoyé par e-mail ainsi que votre nouveau login et mot de passe.</p>
			<form method="POST" action="./includes/recup_compte.inc.php">
				<label>Code de vérification : </label><input type="text" name="code" required /></br>
				<label>Login : </label><input type="text" name="login" required /></br>
				<label>Mot de passe :</label><input type="password" name="mdp" required /><i class="far fa-eye"></i></br>
				<input type="submit" value="Envoyer">
			</form>
		</main>
		<?php require 'footer.php';?>
	</body>
</html>