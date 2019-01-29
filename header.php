<header>
	<div class="first-section">
		<div class="header-logo">
			<img alt="Logo Ludisep" class="logo" src=<?=IMG_DIR."/logo.png"?>>
		</div>
		<div class="header-title">
			<h1>Ludisep</h1>
		</div>
		<?php
			if (isset($_SESSION['utilisateur'])) {
				echo('<a href="./compte.php"><div class="header-conn flex">');
					echo('<div class="avatar-content"><img alt="Avatar" src="./'.$_SESSION['utilisateur']['avatar'].'"></div>');
					echo('<span>'.$_SESSION['utilisateur']['prenom'].' '.$_SESSION['utilisateur']['nom'].'</span>
					</div></a>
					<a class="deconnexion bouton" href="./includes/deconnexion.php">Déconnexion</a>');
			}
			else {
				echo('<div class="header-conn flex">');
					echo('<a class="bouton" href="./espace_membre.php">connexion</a>');
				echo('</div>');
			}
		?>
	</div>
	<?php require 'nav.php'; ?>
</header>