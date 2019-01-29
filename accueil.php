<?php 
require_once('./includes/fonctions.php');
secure_session_start();
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
	<body id="accueil">
		<?php require 'header.php'; ?>
		<main>
			<section>
				<div class="img-accueil">
					<div class="message-accueil">
						<h1>Bienvenue Isépiens, Isépiennes</h1>
						<p>Avec Ludisep, lancez vous dans des quêtes épiques lors des séances de jeu de rôle et amusez vous avec nos jeux de société</p>
					</div>
				</div>
				<div class="credit"><p>© <i>Quest</i> by DaisanART</p></div>
			</section>
			<article class="presentation odd-part">
				<h1>Qu'est-ce que Ludisep ?</h1>
				<p><strong>Ludisep est une association</strong> qui a pour but de vous divertir en proposant des activités autour du <strong>jeu de rôle et des jeux de société !</strong></p>
				<p>Convivialité et divertissement sont les maîtres mots de Ludisep.</p>
				<p>Des séances de jeu sont organisées tous les jeudi après-midi. Les séances durent généralement 3-4 heures, selon la disponibilité des joueurs. Si vous appréciez ces séances, nous pourrons continuer à jouer ensemble !</p>
			</article>
			<article class="actualites">
				<div>
					<h1>Actualités</h1>
					<aside class="calendar"></aside>
				</div>
			</article>
			<article class="type_joueur even-part">
				<div>
					<h1>Quel type de joueur es-tu ?</h1>
					<div class="activites flex">
						<section class="activite">
							<h2>Joueur curieux</h2>
							<p>Tu as envie de tester le jeu de rôle mais tu ne sais pas comment ça marche ? Tu regardes la série "Aventures" du Joueur du Grenier et tu trouves ça sympa ? Ton jeu vidéo préféré est un RPG ?</p>
							<p>Alors, qu'est-ce que tu attends ? Rejoins-nous !</p>
							<p>Les autres joueurs et maîtres de jeu t'aideront à prendre en main les règles, et tu pourras participer à une quête pour te faire les dents.</p>
							<p class="accroche">Viens tester le jdr pour une séance, et reviens si ça t'a plu !</p>
						</section>
						<section class="activite">
							<h2>Rôliste vétéran</h2>
							<div class="border-lateral">
								<p>Tu as déjà tué plusieurs centaines d'orques et gobelins ? Tu as déjà sauvé le monde 3 fois ? Tu connais par cœur le livre de règles de Donjons et Dragons v3.5 ?</p>
								<p>Alors rejoins nos rangs, héros !</p>
								<p>Tu pourras participer à de nombreuses quêtes, dans des univers très différents les uns des autres et préparés avec soin par nos MJ.</p>
								<p class="accroche">Viens découvrir ces univers uniques !</p>
							</div>
						</section>
						<section class="activite">
							<h2>Fou de Monopoly</h2>
							<p>Tu n'es pas spécialement intéressé par le jeu de rôle, mais par contre tu adores les jeux de société (et pas nécessairement le Monopoly) ?</p>
							<p>Alors viens tester nos nombreux jeux de société.</p>
							<p>Tu pourras découvrir et tester des jeux originaux ou nous montrer toute l'étendue de tes talents sur tes jeux favoris.</p>
							<p class="accroche">N'hésites pas à venir jouer avec nous !</p>
						</section>
					</div>
				</div>
			</article>
			<section class="jeu_role odd-part">
				<div class="flex">
					<div>
						<h1>Jeux de rôle</h1>
						<p>Découvrez ce qu'est le jeu de rôle et apprenez-en plus sur nos univers de jeux.</p>
						<a href="./univers.php">Le jeu de rôle et nos univers</a>
					</div>
					<aside>
						<img alt="Invitation à participer au jeu de rôle" src="./img/Festival2_-_dessin_de_bosse_-_couleurs_thomas_joiris.jpg">
						<div class="credit"><p>© <i>Festival2 - dessin de bosse</i> by Thomas Joiris</p></div>
					</aside>
				</div>
			</section>
			<section class="jeu_societe even-part">
				<div class="flex">
					<aside><img alt="Plateau de jeu de Catan" src="./img/the_settlers_of_catan_board_game_by_ninjawolfx-d5ucfsn.png"></aside>
					<div>
						<h1>Jeux de société</h1>
						<p>Découvrez les jeux de sociétés que nous possédons et que nous mettons à votre disposition.</p>
						<a href="./jeux.php">Nos jeux de sociétés</a>
					</div>
				</div>
			</section>
		</main>
		<?php require 'footer.php';?>
	</body>
</html>