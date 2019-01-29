<?php 
require_once('./includes/fonctions.php');
secure_session_start();
if(verif_connexion()!=3) {
	header("Location: ./espace_membre.php");
}
require_once('./includes/show_event.inc.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ludisep - Association de jeux de rôle et jeux de société</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		<script src="script/main.js"></script>
	</head>
	<body id="admin_event">
		<?php require 'header.php'; ?>
		<main class="content main-content">
			<h1>Gestion des évènements</h1>
			<ul>
				<?php showAllEvents(); ?>
			</ul>
			<button class="bouton ajout">Ajouter un événement</button>
		</main>
		<?php require 'footer.php';?>
	</body>
</html>