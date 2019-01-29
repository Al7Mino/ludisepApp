<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	try {
		$puces = recup_puces($conn);
		if (!empty($puces)) {
			foreach ($puces as $puce) {
				$id = $puce['id'];
				$nom = $puce['nom'];
				$attribution = $puce['perso'];
				$info = $puce['info'];
				echo('<div id="puce-'.$id.'" class="puce border">');
				if($attribution==NULL) {
					echo('<p class="libre">Disponible</p>');
				}
				else {
					$perso = recup_info_personnage($conn, $attribution)['nom'];
					echo('<p class="indisponible">Possédée par '.$perso.'</p>');
				}

				echo('<h2>'.$nom.'</h2>
					<p class="info-puce">'.$info.'</p>');

				$sorts = recup_sorts($conn, $id);
				foreach ($sorts as $sort) {
					$id_sort = $sort['id'];
					$nom_sort = $sort['sort_nom'];
		            $type1 = $sort['type1'];
		            $type2 = $sort['type2'];
		            $bonus = $sort['bonus'];
		            $pe = $sort['pe'];
		            $charge = $sort['charge'];
		            $description = $sort['description'];
		            $type = $type1.' '.$type2;
		            echo('<div id="sort-'.$id_sort.'" class="puce-sort">
		            		<div>
		            			<h4>'.$nom_sort.' : <span>('.$type);
		            if ($bonus!=NULL and $bonus!='') {
		            		echo('<span> '.$bonus.'</span>');
		            }
		            	echo(')</span></h4>
		            			<p class="cout">'.$pe.' PE');
		            if($charge!=NULL and $charge!=0) {
		            		echo(', '.$charge.' charge</p>');
		            }
		            else {
		            		echo "</p>";
		            }
					echo('</div>
						<p>'.$description.'</p>
						</div>');
		            
				}
				echo ('</div>');
			}
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>