<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {

		$nom = isset($_POST['nom_personnage']) ? htmlspecialchars($_POST['nom_personnage']) : NULL;
		$description = isset($_POST['description_perso']) ? nl2br(htmlspecialchars($_POST['description_perso'])) : NULL;
		$dossier = '/files/personnages/'.$nom.'/';
		$erreur = '';
		if (!is_dir($_SERVER['DOCUMENT_ROOT'].$dossier)) {
			mkdir($_SERVER['DOCUMENT_ROOT'].$dossier);
		}
		if (isset($_FILES['fiche_perso']) AND $_FILES['fiche_perso']['name']!='') {
			$fiche_perso = basename($_FILES['fiche_perso']['name']);
			$path_fiche = $_SERVER['DOCUMENT_ROOT'].$dossier.$fiche_perso;
			$taille_maxi_fiche = 500000;
			$taille_fiche = filesize($_FILES['fiche_perso']['tmp_name']);
			$extensions_fiche = array('.doc', '.docx', '.txt', '.text', '.pdf', '.odt');
			$extension_fiche = strrchr($_FILES['fiche_perso']['name'], '.');
			//Début des vérifications de sécurité...
			if(!in_array($extension_fiche, $extensions_fiche)) { //Si l'extension n'est pas dans le tableau
			    $erreur .= 'Vous devez uploader un fichier de type doc, docx, txt, text, pdf ou odt ; ';
			}
			if($taille_fiche>$taille_maxi_fiche) {
			    $erreur .= 'Le fichier '.$fiche_perso.' est trop volumineux ; ';
			}
		}
		if (isset($_FILES['image_perso']) AND $_FILES['image_perso']['name']!='') {
			$image_perso = basename($_FILES['image_perso']['name']);
			$pathToRegister_image = $dossier.$image_perso;
			$path_image = $_SERVER['DOCUMENT_ROOT'].$dossier.$image_perso;
			$taille_maxi_image = 1000000;
			$taille_image = filesize($_FILES['image_perso']['tmp_name']);
			$extensions_image = array('.jpg', '.jpeg', '.png', '.gif');
			$extension_image = strrchr($_FILES['image_perso']['name'], '.');
			//Début des vérifications de sécurité...
			if(!in_array($extension_image, $extensions_image)) { //Si l'extension n'est pas dans le tableau
			    $erreur .= 'Vous devez uploader un fichier de type jpg, jpeg, png ou gif ; ';
			}
			if($taille_image>$taille_maxi_image) {
			    $erreur .= 'Le fichier '.$image_perso.' est trop volumineux ; ';
			}
		}
		if($erreur == '') //S'il n'y a pas d'erreur, on upload
		{
			$id = $_SESSION['utilisateur']['id'];
			if ((!isset($_FILES['fiche_perso']) OR $_FILES['fiche_perso']['name']=='') AND (!isset($_FILES['image_perso']) OR $_FILES['image_perso']['name']=='')) {
				ajouter_personnage($conn, $id, $nom, $description, NULL, NULL);
				header('Location: ../personnage.php');
			}
			else {
				if (isset($_FILES['fiche_perso']) AND $_FILES['fiche_perso']['name']!='') {
					//On formate le nom du fichier ici...
					$fiche_perso = strstr($fiche_perso, '.', TRUE).$extension_fiche;
				    $fiche_perso = strtr($fiche_perso, 
				        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				    $fiche_perso = preg_replace('/([^.a-z0-9]+)/i', '_', $fiche_perso);
				    if(!move_uploaded_file($_FILES['fiche_perso']['tmp_name'], $path_fiche)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
				    {
				    	$erreur .= 'Echec de l\'upload '.$path_fiche.' !';
				        $pathToRegister_fiche = NULL;
				    }
				    else {
						rename($path_fiche, $_SERVER['DOCUMENT_ROOT'].$dossier.$fiche_perso);
						$pathToRegister_fiche = $dossier.$fiche_perso;
					}
				}
				if (isset($_FILES['image_perso']) AND $_FILES['image_perso']['name']!='') {
					//On formate le nom du fichier ici...
					$image_perso = strstr($image_perso, '.', TRUE).$extension_image;
				    $image_perso = strtr($image_perso, 
				        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				    $image_perso = preg_replace('/([^.a-z0-9]+)/i', '_', $image_perso);
				    if(!move_uploaded_file($_FILES['image_perso']['tmp_name'], $path_image)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
				    {
				    	$erreur .= 'Echec de l\'upload '.$path_image.' !';
				        $pathToRegister_image = NULL;
				    }
				    else {
						rename($path_image, $_SERVER['DOCUMENT_ROOT'].$dossier.$image_perso);
						$pathToRegister_image = $dossier.$image_perso;
					}
				}
				$_SESSION['erreur_upload'] = $erreur;
				if ($erreur == '') {
					ajouter_personnage($conn, $id, $nom, $description, $pathToRegister_image, $pathToRegister_fiche);
				}
				echo $erreur;
				header('Location: ../personnage.php');
			}
		}
		else {
			$_SESSION['erreur_upload'] = $erreur;
			echo $erreur;
			header('Location: ../personnage.php');
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
		header('Location: ../personnage.php');
	}
	$conn = NULL;
?>