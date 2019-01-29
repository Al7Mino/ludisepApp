<?php 
require_once('./includes/fonctions.php');
secure_session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Univers : Découvrez nos univers de jeu de rôle - Ludisep</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style-smartphone.css">
		<link rel="icon" type="image/png" href="img/logo.png">
		<script src="script/jquery-3.2.1.min.js"></script>		
		<script src="script/main.js"></script>
	</head>
	<body id="univers">
		<?php require 'header.php'; ?>
		<main>
			<section>
				<div class="img-univers">
					<div class="message-univers">
						<h1>Des univers uniques pour des expériences de jeu incroyables</h1>
						<p>Découvrez les différents univers dans lesquels vous pourrez évoluer durant les séances de jeu de rôle</p>
					</div>
				</div>
				<div class="credit"><p>© <i>Fantasy Landscape</i> by rainerpetterart</p></div>
			</section>
			<article class="presentation odd-part">
				<h1>Le jeu de rôle, qu'est-ce que c'est ?</h1>
				<p>Le jeu de rôle est une activité de loisir et de divertissement qui consiste à raconter une histoire à plusieurs. Installés autour d’une table, les joueurs interprètent le rôle d’un personnage au sein d’un univers fictif. Chacun décrit comment son personnage interagit avec le monde et les personnages qui l’entourent.<br><em>(définition de la ffjdr)</em></p>
			</article>
			<article class="even-part">
				<div>
					<h1>Comment ça marche ?</h1>
					<p>Les joueurs créent tout d'abord un personnage dans <strong>un système de règles</strong> et dans <strong>un univers de jeu</strong> dans lesquels se déroulera la partie.</p>
					<p>Dans cette partie, les joueurs vont incarner leur personnage, vivant une aventure créée par le maître du jeu. Ce dernier contera l'histoire, décidera du résultat des actions des joueurs, interprétera les personnages secondaires et arbitrera la partie. Durant une aventure, les personnages seront confrontés à des obstacles qu'ils devront surmonter pour atteindre leur objectif.</p>
				</div>
			</article>
			<article class="odd-part">
			<h1>Quelques univers de jeu</h1>
				<div class="types-univers flex">
					<section>
						<img alt="Paysage de ruines anciennes explorées par des aventuriers" src="./img/ancient_ruins___cronicas_rpg_by_caiomm-d87idos.jpg">
						<div class="credit"><p>© <i>Ancient Ruins - Cronicas Rpg</i> by caiomm</p></div>
						<h2>Multi-Univers / Fantastique</h2>
						<p class="citation">" La plupart des individus croit que nous choisissons la vie que nous menons. Il n'en ait rien ! Notre destin est écrit le jour de notre naissance, guide nos pensées, et, en tant que Gardiens, maîtres de l'équilibre des mondes, nous nous devons de le suivre... ou bien mourir. "</p>
						<p class="credit"><span>Traité de l'Equilibre des Mondes</span> - Athos le Sage</p></br>
						<p>Vous incarnerez un Gardien, un être supérieur, né dans un entre univers qui permet d’accéder à tous les univers qui existe, appelé Harmonia. Le seul univers auquel vous ne pouvez accéder est Artificia, l'univers de vos rivaux naturels, les Dominateurs. En tant que Gardien, votre rôle est de préserver l’harmonie des univers, c'est-à-dire de s'assurer de l'indépendance des mondes et de garantir l'évolution normale de chaque univers. Cela peut impliquer des missions contraire à votre éthique, mais la vie ne laisse pas le choix. Vous êtes né Gardien, et vous le resterez.</p>
					</section>
					<section>
						<img alt="Bataille spatiale chasseurs vs destroyer Star Wars" src="./img/bataille_spatiale_chasseur_vs_destroyer.jpg">
						<div class="credit"><p>© <i>Tannhauser Gate</i> by ornicar</p></div>
						<h2>Star Wars</h2>
						<p>Il y a bien longtemps, dans une galaxie très lointaine... La guerre civile fait rage entre l'Empire galactique et l'Alliance rebelle. L'Empire, dirigé par l'empereur Palpatine, étend sa domination sur une grande partie de la galaxie, notamment grâce à son armée de Stormtrooper et au seigneur Sith Dark Vador. Mais une récente victoire de la Rébellion, qui a réussi à détruire l'Etoile de la Mort, une arme capable d'annihiler des planètes entières, redonne espoir.</p>
						<p>C'est dans ce contexte, correspondant à la fin du film Star Wars IV, que vous évoluerez, en tant que rebelle (ou pro-rebelle).</p>
					</section>
				</div>
			</article>
			<!-- <h1>Univers 1</h1>
			<p>Il y a 800 ans, Edelia vivait dans un semblant d’harmonie, les peuples étaient dirigés par des gouvernements (dictature, monarchie, démocratie) ; on distinguait alors 10 grandes nations qui ne se mêlaient pas entre elles, ils formaient ce qu’on appellerait maintenant des races :</p>
			<ul>
			    <li>Les humains typés occidentaux (royauté)</li>
			    <li>Les humains typés extrême orient (Empire dictatorial)</li>
			    <li>Les humains typés moyen orient (démocratie)</li>
			    <li>Les Simiens</li>
			    <li>Les elfes blancs</li>
			    <li>Les elfes noirs</li>
			    <li>Les nains</li>
			    <li>Les vikings</li>
			    <li>Les démons</li>
			    <li>Les fonguciens</li>
			</ul>
			</br>
			<p> Ils se croyaient en sécurité, mais les dragons, du jour au lendemain et sous les impulsions machiavéliques du grand mage noir Ragar, sont devenus fous. Il se sont mis à dévaster le monde d'Edelia, les citoyens mourrurent par milliers, l’inefficacité de la sécurité promise par les nations fut révélée au grand jour. Mais bien sûr, le dérèglement engendré par Ragar n’a pas seulement affecté les dragons, mais aussi les âmes des gens, qui se sont déréglées et qui se mirent régulièrement à rester accrocher à leur corps défunt. Les mages prirent rapidement l'habitude d'utiliser les fluctuations de magie pour avoir des informations sur les dernières pensées ou émotions d'un mort. Mais la situation était différente, de nombreuses âmes restèrent sur terre et créèrent ce que l'on appelle des Mires. Un grand rassemblement de ces Mires peut créer d'affreuses créatures nommées Sins (Sin signifiait mal des âmes dans les langages anciens), et ces Sins agressifs frappèrent régulièrement la population.</p>

			<p>Le seul peuple y ayant résisté fut alors celui des démons. Effectivement, ils sont organisés selon une sorte de monarchie où la famille la plus forte domine. De plus, les dragons n’ont que peu attaqué leurs terres déjà dévastées par leur guerre interne qui s'est passée il y a 1200 ans lors de leur découverte de cette terre, sur laquelle vous vivrez. (Se référer à la partie démon pour mieux comprendre).</p>

			<p>C’est alors que naquirent les guildes, des organismes privés de la défense des nations. Autrefois, elles défendaient la population gratuitement car le monde était dans un état apocalyptique. Cependant une fois les dragons maîtrisés et tués le monde avait besoin d’un nouvel ordre mondial, et les Sins ne se stoppèrent pas avec la mort de Ragar. Le royaume des humains fût alors éclaté et la population se dirigea naturellement vers les villes que construisait les guildes.</p>

			<p>La population oublia alors le système de gouvernement politique et décida d’être sous le dogme de guildes, de les payer et les nourrir contre protection. C’est alors qu’à émerger de grandes guildes principales, même s’il est fréquent qu’un regroupement de grands guerriers tente de se créer leurs guildes :</p>

			<h2>Les guildes :</h2>
			<ul>
				<li>
					<h3>Royalis</h3>
					<p>Cette guilde est ce qu’il reste de l’ancienne royauté humaine. La guilde se situe dans l’ancienne capital des orientaux : Port Réal. Réputée pour posséder dans leur adhérence pour une grande partie de l’ex-noblesse, ils ont développé de grands moyens de défense des transports de marchandises afin que leur ville se développe de façon commerciale dans cette nouvelle ère. Leur chef est choisie par les liens du sang.</p>
				</li>
				<li>
					<h3>Stélaria</h3>
					<p>Cette guilde a créé la ville la plus grande en superficie : Stélaria. Les membres de Stélaria sont tous d’ex elfes blancs qui ont fini drogué au mana, ils ont développé de très grands pouvoirs magiques. Cette guilde de par sa restriction des membres (uniquement elfes blancs) fait que certaines personnes considèrent ses membres (ou les enfants de ses membres) comme une nouvelle race : les elfes de mana. Leur chef est choisi par la population (sorte de démocratie).</p>
				</li>
				<li>
					<h3>Isepia (votre guilde)</h3>
					<p>Il s’agit d’une guilde située à l’est du monde dans la ville d’Isep-town. Isépia est une guilde très polyvalente de pars ses races et ses missions qu’elle accomplit, c’est une guilde très appréciée par la population alentour car elle fait partie de l’une des premières guildes créée qui ont servi a protéger la population des dragons. Le chef actuel est Liemly un très grand mage assez âgé, d’une sagesse et d’une tolérance incommensurable, mais il ne faut pas oublier qu’il reste un chef qui veut développer la puissance de sa guilde. Le chef de la guilde se décide lorsque l’ex-chef prend sa retraite (s'il vient à mourir le chef a normalement mit dans une urne le nom du successeur).</p>
				</li>
				<li>
					<h3>La pièce</h3>
					<p>Cette guilde a construit sa ville ; capitalisum, dans les montagnes naines, il s’agit d’une guilde marchande qui a été construite il y a une centaine d’année, car elle s'occupe de développer ses ressources en faisant sous-traiter la défense et la protection à d’autres guildes, elle n’avait donc pas sa place avant, cependant maintenant le monde semble retrouver un semblant de calme, il n’est pas rare aujourd’hui qu’un aventurier a déjà participé à une mission pour cette guilde même sans en faire partie. Le chef est tout simplement le plus riche de la guilde au moment où il meurt.</p>
				</li>
				<li>
					<h3>Le sable doré</h3>
					<p>Le désert est un climat très difficile à apprivoiser. C’est pour cela que cette guilde s’est positionnée dedans, grâce à leurs grands savoirs ils ont pu dompter le terrain, servant alors de très bonne défense aux attaques des morts et des démons aux alentours. Leur ville : Raha est considérée comme le cœur technologique du monde. Cette guilde choisit leur chef de manière démocratique tous les 10 ans.</p>
				</li>
				<li>
					<h3>Anachronia</h3>
					<p>La folie, La démence, la perversion, tout ce qui est mentalement instable est dans cette guilde. Si vous avez besoin de leur aide ce n’est pas forcement de l’or qu’ils demanderont, il faut toujours faire gaffe. Leur capital se trouve dans les terres désolées, Gotham, toute les rues de cette ville veulent votre mort. Bien sur leur chef est choisi tout simplement à la loi du plus fort.</p>
				</li>
				<li>
					<h3>L’évolution</h3>
					<p>Cette guilde fût l’une des premières créées pour rivaliser directement avec Royalis, ils ne supportent pas la royauté, ils les méprisent, et font en sorte d’être les meilleurs afin de montrer que la population peut vivre sans domination, ils se basent sur une liberté totale de leurs concitoyens, qui en retour sont bienveillant et font énormément de dons.	La guilde est basée sur l’honneur et la fidélité. Ils ont surement l’un des plus grands capitaux de nombre de dragons tués. Leur ville est New Port Réal juste pour embêter Port Réal. Leur chef est choisi par démocratie.</p>
				</li>
				<li>
					<h3>Lyandha</h3>
					<p>Lors de l’attaque des dragons la forêt du lyandir a été gravement touché car l’une des zones la plus peuplé de dragon, elle fut ravagée. Heureusement lorsque les guildes pour amoindrir la force des dragons. C’est ainsi que la guilde de Lyandra, depuis leur ville Lyandra, a commencé à calmer la forêt qui sombre, aujourd’hui encore dans la folie et la terreur. Leur chef est Lyandir, un grand elfe qui arrive sur ses 3250 ans. Vu qu’ils n'ont jamais eu d’autre chef ils ne savent pas encore comment ils feront quand Lyandir mourra.</p>
				</li>
				<li>
					<h3>La feuille d’argent</h3>
					<p>Cette guilde ne croit pas au progrès technologique mais préfère communier avec la nature afin qu’elle leur rende la protection. Cette guilde compte peu d’adeptes (il s’agit même plus d’une secte) mais ils sont néanmoins très puissant. Nul ne connaît leur chef, Il réside dans la ville d’écologia dans fongucéa.</p>
				</li>
				<li>
					<h3>La lune bleu</h3>
					<p>Cette guilde a posé sa ville : Hakima dans les îles siemiennes, autrefois cette île était convoitée par les siemiens et les humains, mais avec l’attaque des dragons un groupement de personnes se sont alliés pour défier et abattre ses viles créatures. Même si les conflits existent encore entre siemiens et humains, cette guilde fait en sorte d'apaiser les querelles. Leur chef est Lee Zhou, Un kage qui a prouvé sa valeur par la grande maitrise de sa puissance. A la mort d’un kage le prochain est choisi par le conseil des anciens.</p>
				</li>
			</ul> -->
		</main>
		<?php require 'footer.php';?>
	</body>
</html>