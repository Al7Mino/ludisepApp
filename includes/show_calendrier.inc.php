<?php
	require_once('bdd_connect.php');
	require_once('func_calendrier.php');

	$html = '';

	if(isset($_POST['month']) && isset($_POST['year']) && is_numeric($_POST['month']) && is_numeric($_POST['year'])) {
		$month = htmlspecialchars($_POST['month']);
		$year = htmlspecialchars($_POST['year']);
	}
	else { // Si on ne récupère rien dans l'url, on prends la date du jour
		$month = date('m');
		$year = date('Y');
	}
	$events = getEventsDate($conn, $month, $year);
	
	// Si le mois correspond au mois actuel et l'année aussi, on retient le jour actuel pour le griser plus tard (sinon le jour actuel ne se situe pas dans le mois)
	if($month == date('m') && $year == date('Y'))
		$coloreNum = date('d');
	
	$m = array("01" => "Janvier", "02" => "Février", "03" => "Mars", "04" => "Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Août", "09" => "Septembre", "10" => "Octobre",  "11" => "Novembre", "12" => "Décembre");
	
	// 0 => Dimanche, 1 => Lundi, 2 = > Mardi...
	$numero_jour1er = date('w', mktime(0, 0, 0, $month, 1, $year));
	
	// Changement du numéro du jour car l'array commence à l'indice 0
	if ($numero_jour1er == 0) $numero_jour1er = 6; // Si c'est Dimanche, on le place en 6ème position (après samedi)
	else $numero_jour1er--; // Sinon on mets lundi à 0, Mardi à 1, Mercredi à 2...

	$html .= '<table class="calendrier">
			<caption>
				<i data-date="'.date('Y-m', mktime(0, 0, 0, $month-1, 1, $year)).'" class="fas fa-chevron-left"></i><span data-date="'.date('Y-m', mktime(0, 0, 0, $month, 1, $year)).'">'.$m[$month].' '.$year.'</span><i data-date="'.date('Y-m', mktime(0, 0, 0, $month+1, 1, $year)).'" class="fas fa-chevron-right"></i>
			</caption>
			<thead>
				<tr>
					<th>Lu</th>
					<th>Ma</th>
					<th>Me</th>
					<th>Je</th>
					<th>Ve</th>
					<th>Sa</th>
					<th>Di</th>
				</tr>
			</thead>
		';

	// Ecriture de la 1ère ligne
	$html .='<tbody>
				<tr>';
	// Ecriture de colones vides tant que le mois ne démarre pas
	for($i = 0 ; $i < $numero_jour1er ; $i++) {
		$html .= 	'<td class="previous-month">'.date('j', mktime(0, 0, 0, $month, 1 + ($i-$numero_jour1er), $year)).'</td>';
	}
	for($i = 1 ; $i <= 7 - $numero_jour1er; $i++) {
		$jour = $i;
		// Ce jour possède un événement
		$date = date('Y-m-d', mktime(0, 0, 0, $month, $jour, $year));
		$eventBind = false;
		$html .=	'<td data-events="';
		if(!empty($events)) {
			foreach ($events as $event) {
				if($date >= $event['debut'] AND $date <= $event['fin']) {
					$eventBind = true;
					$html .= $event['id'].' ';
				}
			}
		}
		if($eventBind || (isset($coloreNum) && $coloreNum == $jour)) {
			$html .= '" class="';
			if($eventBind) {
				$html .= 'jourEvent ';
			}
			if(isset($coloreNum) && $coloreNum == $jour) {
				$html .='aujourdhui';
			}
		}
		$html .='">'.$jour.'</td>';
	}
	$html .= 		'</tr>';
	
	$nbLignes = ceil((date('t', mktime(0, 0, 0, $month, 1, $year)) + $numero_jour1er+1)/ 7); // Calcul du nombre de lignes à afficher en fonction de la 1ère (surtout pour les mois a 31 jours)
	
	for($ligne = 1 ; $ligne < $nbLignes ; $ligne++) {
		$html .= '<tr>';
		for($colone = 0 ; $colone < 7 ; $colone++) {
			$jour++;
			if($jour <= date('t', mktime(0, 0, 0, $month, 1, $year)))	{
				// Ce jour possède un événement
				$date = date('Y-m-d', mktime(0, 0, 0, $month, $jour, $year));
				$eventBind = false;
				$html .= 		'<td data-events="';
				if(!empty($events)) {
					foreach ($events as $event) {
						if($date >= $event['debut'] AND $date <= $event['fin']) {
							$eventBind = true;
							$html .= $event['id'].' ';
						}
					}
				}
				if($eventBind || (isset($coloreNum) && $coloreNum == $jour)) {
					$html .= '" class="';
					if($eventBind) {
						$html .= 'jourEvent ';
					}
					if(isset($coloreNum) && $coloreNum == $jour) {
						$html .='aujourdhui';
					}
				}
				$html .='">'.$jour.'</td>';
			} else {
				$html .= '<td class="next-month">'.date('j', mktime(0, 0, 0, $month, $jour, $year)).'</td>';
			}
		}
		$html .= '</tr>';
	}
	$html .= "</tbody></table>";
	echo $html;
?>