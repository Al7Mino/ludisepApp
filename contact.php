<?php 
require_once('./includes/fonctions.php');
secure_session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Contact - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>		
		<script src="script/main.js"></script>
	</head>
	<body id="contact">
		<?php require 'header.php'; ?>
		<section>
			<div class="informations">
				<div>
					<h3>Emplacement :</h3>
					<p>28, rue Notre-Dame-des-Champs</p>
					<p>75 006 PARIS</p>
				</div>
				<div>
					<h3>Nous contacter :</h3>
					<p>ludisep.isep@gmail.com</p>
				</div>
			</div>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1856.6319636916824!2d2.326567024181161!3d48.84535470221285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671ce3fd4afd3%3A0xb729389a530d1380!2s28+Rue+Notre+Dame+des+Champs%2C+75006+Paris%2C+France!5e0!3m2!1sfr!2sca!4v1535831354634" width="500" height="375" frameborder="0" style="border:0" allowfullscreen></iframe>
		</section>
		<?php require 'footer.php';?>
	</body>
</html>