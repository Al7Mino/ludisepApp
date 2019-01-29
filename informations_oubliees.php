<?php 
require_once('./includes/fonctions.php');
secure_session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Informations oubliées - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>		
		<script src="script/main.js"></script>
	</head>
	<body id="infos_oubliees">
		<?php require 'header.php'; ?>
		<main class="content-fit main-content box">
			<h1>Retrouver votre compte</h1>
			<?php
				if (isset($_SESSION['erreur_recup'])) {
					echo "<p style='color:red;'>".$_SESSION['erreur_recup']."</p>";
				}
				$_SESSION['erreur_recup'] = NULL;
			?>
			<p>Veuillez saisir votre adresse e-mail pour rechercher votre compte.</p>
			<form method="POST" action="./includes/infos_oubliees.inc.php">
				<label>Mail : </label><input type="text" name="adresse_mail" required /></br>
				<input type="submit" value="Envoyer">
			</form>
		</main>
		<?php require 'footer.php';?>
	</body>
</html>