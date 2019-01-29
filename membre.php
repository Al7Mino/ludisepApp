<?php 
require_once('./includes/fonctions.php');
secure_session_start();
verif_connexion();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Membres - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>		
		<script src="script/main.js"></script>
	</head>
	<body id="membre">
		<?php require 'header.php'; ?>
		<section class="content main-content">
			<div class="membres flex">
				<?php include_once('./includes/membre.inc.php'); ?>
			</div>
		</section>
		<?php require 'footer.php';?>
	</body>
</html>