<nav>
	<ul>
		<li><div><a href="./accueil.php">Accueil</a></div></li>
		<li><div><a href="./univers.php">Univers</a></div></li>
		<li><div><a href="./jeux.php">Nos Jeux</a></div></li>
		<li><div><a href="./contact.php">Contact</a></div></li>
		<li><div><a href="./secret_santa.php">Secret Santa</a></div></li>
		<li><div id="nav_sous_menu"><span>Espace membre <img alt="Flèche de menu" class="arrow" src=<?=IMG_DIR."/arrow-down-icon.png"?>></span></div>
			<ul class="hidden level-2">
				<li><a href="./compte.php">Mon compte</a></li>
				<li><a href="./membre.php">Membres</a></li>
				<li><a href="./personnage.php">Personnages</a></li>
				<li><a href="./quete.php">Quêtes</a></li>
				<li><a href="./puce.php">Puces</a></li>
				<?php
					if (isset($_SESSION['utilisateur']['role']) && $_SESSION['utilisateur']['role']==3) {
						echo('<li><a href="./admin_event.php">Événements</a></li>');
					}
					if (isset($_SESSION['utilisateur']['id'])) {
						echo('<li><a href="./includes/deconnexion.php">Déconnexion</a></li>');
					}
					else {
						echo('<li><a href="./espace_membre.php">Connexion</a></li>');
					}
				?>
			</ul>
		</li>
	</ul>
</nav>