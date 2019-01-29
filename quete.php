<?php 
require_once('./includes/fonctions.php');
require_once('./includes/show_quete.inc.php');
secure_session_start();
verif_connexion();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Quêtes - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		<script src="script/main.js"></script>
	</head>
	<body id="quete">
		<?php require 'header.php'; ?>
		<section class="content main-content quetes">
			<h1>Quêtes</h1>
			<?php
			if (addslashes($_SESSION['utilisateur']['role']>1)) {
				echo('<button>Ajouter une quête</button>');
			}
			if (isset($_SESSION['erreur'])) {
				echo('<p style="color: red;text-align: center;">'.$_SESSION["erreur"].'</p>');
				$_SESSION['erreur']=NULL;
			}
			?>
			<?php
				show_quete_venir();
			?>
			<section class="quete-cours">
				<h2>Quêtes en cours</h2>
				<ul>
					<?php
						show_quete_cours();
					?>
				</ul>
			</section>
			<section class="quete-term">
				<h2>Quêtes terminées</h2>
				<ul>
					<?php
						show_quete_terminee();
					?>
				</ul>
			</section>
		</section>
		<?php require 'footer.php';?>
	</body>
</html>