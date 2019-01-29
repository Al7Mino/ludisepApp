<?php
	require_once('bdd_connect.php');
	require_once('func_calendrier.php');

	function showAllEvents() {
		global $conn;
		$events = getAllEvents($conn);
		foreach ($events as $event) {
			echo('<li data-id="'.$event['id'].'">
					<div>
						<h2>'.$event['titre'].'</h2>
						<span>Du <i class="date-debut">'.$event['debut'].'</i> au <i class="date-fin">'.$event['fin'].'</i></span>
						<p>'.$event['contenu'].'</p>
					</div>
					<img alt="Bouton d\'édition" class="edit" src="./img/edit-icon.png" title="Modifier l\'événement">
					<img alt="Bouton de supression" class="suppr" src="./img/suppr-icon.png" title="Supprimer l\'événement">
					<hr>
				</li>');
		}
		$conn = NULL;
	}

	try {
		if(isset($_POST['id'])) {
			$html = '';
			$ids = $_POST['id'];
			foreach ($ids as $id) {
				$id = htmlspecialchars($id);
				$event = getEvent($conn, $id);
				$html .= '<div class="event">
							<h2>'.$event['titre'].'</h2>
							<span>Du <i class="date-debut">'.$event['debut'].'</i> au <i class="date-fin">'.$event['fin'].'</i></span>
							<p>'.$event['contenu'].'</p>';
				$html .= '</div>';
			}
			echo $html;
			$conn = NULL;
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
		$conn = NULL;
	}
?>