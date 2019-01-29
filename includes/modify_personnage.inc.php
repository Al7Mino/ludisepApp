<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$id = addslashes($_POST['id_perso']);
		$personnage = recup_info_personnage($conn, $id);
		$nom = $personnage['nom'];
		$erreur = '';
		if (isset($_POST['modif_visible'])) {
			$modification = 'ficheVisible';
			$value = !$personnage['visible'];
			modify_personnage($conn, $id, $modification, $value);
		}
		if (isset($_POST['modif_description'])) {
			$modification = 'description';
			$value = nl2br(htmlspecialchars($_POST['modif_description']));
			modify_personnage($conn, $id, $modification, $value);
		}
		if (isset($_FILES['modif_image']) AND $_FILES['modif_image']['name']!='') {
			$modification = 'imagePath';

			$dossier = '/files/personnages/'.$nom.'/';
			if (!is_dir($_SERVER['DOCUMENT_ROOT'].$dossier)) {
				mkdir($_SERVER['DOCUMENT_ROOT'].$dossier);
			}
			$image_perso = basename($_FILES['modif_image']['name']);
			
			$path = $_SERVER['DOCUMENT_ROOT'].$dossier.$image_perso;
			$taille_maxi = 1000000;
			$taille = filesize($_FILES['modif_image']['tmp_name']);
			$extensions = array('.jpg', '.jpeg', '.png', '.gif');
			$extension = strrchr($_FILES['modif_image']['name'], '.');
			if(!in_array($extension, $extensions)) { 
			    $erreur .= 'Vous devez uploader un fichier de type jpg, jpeg, png, gif ; ';
			}
			if($taille>$taille_maxi) {
			    $erreur .= 'Le fichier '.$image_perso.' est trop volumineux ; ';
			}
			if ($erreur=='') {
				$image_perso = strstr($image_perso, '.', TRUE).$extension;
				$image_perso = strtr($image_perso, 
				    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$image_perso = preg_replace('/([^.a-z0-9]+)/i', '_', $image_perso);
				if(!move_uploaded_file($_FILES['modif_image']['tmp_name'], $path)) {
				    $erreur .= 'Echec de l\'upload '.$path.' !';
				    $value = NULL;
				    $_SESSION['erreur_upload'] = $erreur;
					header('Location: ../personnage.php');
				}
				else {
					rename($path, $_SERVER['DOCUMENT_ROOT'].$dossier.$image_perso);
					$value = $dossier.$image_perso;
					unlink($_SERVER['DOCUMENT_ROOT'].'/'.$personnage['image']);
					modify_personnage($conn, $id, $modification, $value);
				}
			}
		}
		if (isset($_FILES['modif_fiche']) AND $_FILES['modif_fiche']['name']!='') {
			$modification = 'fichePath';

			$dossier = '/files/personnages/'.$nom.'/';
			if (!is_dir($_SERVER['DOCUMENT_ROOT'].$dossier)) {
				mkdir($_SERVER['DOCUMENT_ROOT'].$dossier);
			}
			$fiche_perso = basename($_FILES['modif_fiche']['name']);
			
			$path = $_SERVER['DOCUMENT_ROOT'].$dossier.$fiche_perso;
			$taille_maxi = 500000;
			$taille = filesize($_FILES['modif_fiche']['tmp_name']);
			$extensions = array('.doc', '.docx', '.txt', '.text', '.pdf', '.odt');
			$extension = strrchr($_FILES['modif_fiche']['name'], '.');
			if(!in_array($extension, $extensions)) { 
			    $erreur .= 'Vous devez uploader un fichier de type doc, docx, txt, text, pdf ou odt ; ';
			}
			if($taille>$taille_maxi) {
			    $erreur .= 'Le fichier '.$fiche_perso.' est trop volumineux ; ';
			}
			if ($erreur=='') {
				$fiche_perso = strstr($fiche_perso, '.', TRUE).$extension;
				$fiche_perso = strtr($fiche_perso, 
				    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$fiche_perso = preg_replace('/([^.a-z0-9]+)/i', '_', $fiche_perso);
				if(!move_uploaded_file($_FILES['modif_fiche']['tmp_name'], $path)) {
				    $erreur .= 'Echec de l\'upload '.$path.' !';
				    $value = NULL;
				    $_SESSION['erreur_upload'] = $erreur;
					header('Location: ../personnage.php');
				}
				else {
					rename($path, $_SERVER['DOCUMENT_ROOT'].$dossier.$fiche_perso);
					$value = $dossier.$fiche_perso;
					unlink($_SERVER['DOCUMENT_ROOT'].'/'.$personnage['fiche']);
					modify_personnage($conn, $id, $modification, $value);
				}
			}
		}
		if (isset($_POST['modif_nom'])) {
			$modification = 'nom';
			$value = htmlspecialchars($_POST['modif_nom']);
			$dossier = '/files/personnages/'.$value.'/';
			if (!is_dir($_SERVER['DOCUMENT_ROOT'].$dossier)) {
				mkdir($_SERVER['DOCUMENT_ROOT'].$dossier);
			}
			$image = basename($_SERVER['DOCUMENT_ROOT'].$personnage['image']);
			$fiche = basename($_SERVER['DOCUMENT_ROOT'].$personnage['fiche']);
			if(rename($_SERVER['DOCUMENT_ROOT'].$personnage['image'], $_SERVER['DOCUMENT_ROOT'].$dossier.$image)) {
				modify_personnage($conn, $id, 'imagePath', $dossier.$image);
			}
			if(rename($_SERVER['DOCUMENT_ROOT'].$personnage['fiche'], $_SERVER['DOCUMENT_ROOT'].$dossier.$fiche)) {
				modify_personnage($conn, $id, 'fichePath', $dossier.$fiche);
			}
			rmdir(dirname($_SERVER['DOCUMENT_ROOT'].$personnage['image']));
			modify_personnage($conn, $id, $modification, $value);
		}
		$_SESSION['erreur_upload'] = $erreur;
		header('Location: ../personnage.php');
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>