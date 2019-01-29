<?php 
require_once('./includes/fonctions.php');
secure_session_start();
verif_connexion();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Personnages - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
		<script src="script/main.js"></script>
	</head>
	<body id="personnage">
		<?php require 'header.php'; ?>
		<section class="content main-content">
			<h1>Personnages</h1>
			<section class="personnages">
				<?php
					if (isset($_GET['id']) && $_GET['id']!=$_SESSION['utilisateur']['id']) {
						$_SESSION['membre']=addslashes($_GET['id']);
						include_once('./includes/show_other_perso.inc.php');
					}
					else {
						include_once('./includes/show_perso.inc.php');
						/* insertion du form pour création nouveau perso */
						
						if (isset($_SESSION['erreur_upload'])) {
							echo '<p style="color: red; text-align: center;">'.$_SESSION['erreur_upload'].'</p>';
							$_SESSION['erreur_upload']=NULL;
						}
						echo ('<button class="bouton ajout" type="button">Ajouter un personnage</button>');
					}
				?>
			</section>
		</section>
		<?php require 'footer.php';?>
	</body>
</html>