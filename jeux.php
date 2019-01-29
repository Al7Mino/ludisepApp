<?php 
require_once('./includes/fonctions.php');
secure_session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Jeux : Découvrez tous nos jeux - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>		
		<script src="script/main.js"></script>
	</head>
	<body id="jeux">
		<?php require 'header.php'; ?>
		<main>
			<div class="img-jeux">
				<section class="message-jeux">
					<h1>De nombreux jeux de société pour varier les plaisirs</h1>
					<p>Découvrez tous nos jeux de société qui sont mis à votre disposition au cloître de NDL</p>
				</section>
			</div>
			<article class="presentation odd-part">
				<h1>Nos jeux, pour vous</h1>
				<p>Pour vous permettre de vous divertir et de décompresser, <strong>Ludisep met à disposition de tous les étudiants un grand nombre de jeux de société.</strong></p>
				<p>Vous pouvez aussi nous retrouver lors des séances ou des évènements Ludisep pour jouer avec nous !</p>
				<p>Les jeux sont situés dans une étagère du cloître à NDL.</p>
				<br>
				<section class="informations">
					<p><img class="important" alt="Important" src="./img/important.png">Ces jeux étant mis à la disposition de tous, on espère que <strong>vous en prendrez bien soin</strong>.</p>
					<p>De plus, ils sont <strong>la propriété de Ludisep</strong> ; si vous désirez emprunter un jeu plutôt que de jouer sur place, vous devez en <strong>faire la demande à Ludisep</strong>.</p>
				</section>
			</article>
			<section class=" even-part">
				<div class="nos_jeux">
					<h1>Découvrez nos jeux</h1>
					<ul>
						<li><a href="#dixit">Dixit</a></li>
						<li><a href="#skull">Skull</a></li>
						<li><a href="#loup-garou">Les Loups-Garous de Thiercelieux</a></li>
						<li><a href="#citadelle">Citadelles</a></li>
						<li><a href="#smallworld">Small World</a></li>
						<li><a href="#lonny_quest">Loony Quest</a></li>
						<li><a href="#arena_for_the_gods">Arena : For The Gods !</a></li>
						<li>...</li>
					</ul>
				</div>
			</section>
			<section class="odd-part">
				<article id="dixit" class="jeu odd">
					<h1>Dixit</h1>
					<div class="flex">
						<p>Le jeu Dixit fait appel à votre imagination, à votre interprétation et à votre univers personnel. Confrontez votre vision des cartes avec celles de vos amis, et découvrez vous les uns les autres. Dans ce jeu familial, rêve, imagination, poésie, et références culturelles aboutissent à un mélange d'exception.</p>
						<img alt="Boîte de jeu Dixit" src="./img/jeux/dixit.jpg">
					</div>
				</article>
				<article id="skull" class="jeu even">
					<h1>Skull</h1>
					<div class="flex">
						<img alt="Boîte de jeu Skull" src="./img/jeux/skull.jpg">
						<p>Un jeu de bluff et d'enchères. Gagnez vos défis en évitant de révéler des Skulls !</p>
					</div>
				</article>
				<article id="loup-garou" class="jeu odd">
					<h1>Les Loups-Garous de Thiercelieux</h1>
					<div class="flex">
						<p>Chaque nuit, dans le village de Thiercelieux, pendant que les villageois dorment profondément, les loups-garous rôdent. À chaque réveil, le village déplore la mort d'un villageois et tentent de démasquer un loup-garou. Mais attention à ne pas se tromper et éliminer un villageois innocent ! Saurez vous relevez le défis de débarrasser Thiercelieux de tous ses Loups-Garous ?</p>
						<img alt="Boîte de jeu Les Loups-Garous de Thiercelieux" src="./img/jeux/loupsGarous.jpg">
					</div>
				</article>
				<article id="citadelle" class="jeu even">
					<h1>Citadelles</h1>
					<div class="flex">
						<img alt="Boîte de jeu Dixit" src="./img/jeux/citadelles.jpg">
						<p>L'édification d'une citadelle digne de ce nom se fait à grands frais: tout est affaire d'ambition, d'argent et de filouterie. Chacun à son tour choisit l'un des huit personnages, qui ont tous une capacité spéciale : bâtir plusieurs quartiers, recevoir de l'argent, échanger ses cartes, voler un autre joueur, voire même l'assassiner… Le système de choix des personnages fait autant appel au bluff qu'au sens tactique. Les autres joueurs devineront-ils quel personnage vous jouerez-ce tour-ci ? Vous ferez-vous voler ou assassiner? À moins que vous ne soyez vous-même l'assassin…</p>
					</div>
				</article>
				<article id="smallworld" class="jeu odd">
					<h1>Small World</h1>
					<div class="flex">
						<p>Luttez pour établir votre civilisation dans un monde fantastique et fantasque. Cependant, ce monde est tout petit, et il n'y a pas assez de place pour tous ...</p>
						<img alt="Boîte de jeu Dixit" src="./img/jeux/smallworld.jpg">
					</div>
				</article>
				<article id="lonny_quest" class="jeu even">
					<h1>Loony Quest</h1>
					<div class="flex">
						<img alt="Boîte de jeu Dixit" src="./img/jeux/loonyQuest.png">
						<p>Sur la planète d'Arkadia, le vieux roi Fedoor n'a pas d'héritier. Il organise un championnat afin d'offrir son trône au plus grand aventurier du royaume. Les finalistes devront traverser 7 mondes inconnus peuplés de créatures déjantées et récolter un maximum d'XP pour remporter la couronne !</p>
					</div>
				</article>
				<article id="arena_for_the_gods" class="jeu odd">
					<h1>Arena : For The Gods !</h1>
					<div class="flex">
						<p>Bienvenue dans l'Arène des Tout-Puissants, là où les plus grands héros mythologiques s'affrontent pour l'honneur et le plaisir des divinités. Offrez ce que vous avez de plus cher aux Dieux pour obtenir leurs faveurs et vous équipez au mieux pour votre ultime combat. Soyez rusés et frappez fort, car un seul d'entre vous pourra prétendre au titre d'Elu des Dieux. Entrez dans l'Arène, et que le combat commence !</p>
						<img alt="Boîte de jeu Dixit" src="./img/jeux/arena-for-the-gods.jpg">
					</div>
				</article>
			</section>
		</main>
		<?php require 'footer.php';?>
	</body>
</html>