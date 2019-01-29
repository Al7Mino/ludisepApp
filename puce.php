<?php 
require_once('./includes/fonctions.php');
secure_session_start();
verif_connexion();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Puces - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		<?php if (addslashes($_SESSION['utilisateur']['role'])!=1) {
			echo '<script src="script/mj.js"></script>';
		} ?>
		<script src="script/main.js"></script>
	</head>
	<body id="puce">
		<?php require 'header.php'; ?>
		<section class="content main-content">
			<h1>Puces</h1>
			<div class="puces">
				<?php include_once('./includes/show_puce.inc.php'); ?>
			</div>
			<?php 
				if(addslashes($_SESSION['utilisateur']['role']) != 1){
					echo('<button class="bouton ajout" type="button">Ajouter une puce</button>');
				}
			?>
		</section>
		<?php require 'footer.php';?>
	</body>
</html>