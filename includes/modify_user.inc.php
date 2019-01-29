<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$erreur='';
		if(isset($_POST['id'])) {
			$id = addslashes($_POST['id']);
		}
		else {
			$id = addslashes($_SESSION['utilisateur']['id']);
		}
		if (isset($_FILES['avatar']) AND $_FILES['avatar']['name']!='') {
			$dossier = '/files/users/';
			$image = basename($_FILES['avatar']['name']);
			$path = $_SERVER['DOCUMENT_ROOT'].$dossier.$image;
			$taille_maxi = 1000000;
			$taille = filesize($_FILES['avatar']['tmp_name']);
			$extensions = array('.jpg', '.jpeg', '.png', '.gif');
			$extension = strrchr($_FILES['avatar']['name'], '.');
			if(!in_array($extension, $extensions)) { //Si l'extension n'est pas dans le tableau
			    $erreur .= 'Vous devez uploader un fichier de type jpg, jpeg, png ou gif ';
			}
			if($taille>$taille_maxi) {
			    $erreur .= 'Le fichier '.$image.' est trop volumineux ';
			}
			if ($erreur=='') {
				$image = strstr($image, '.', TRUE).$extension;
				$image = strtr($image, 
					'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			    $image = preg_replace('/([^.a-z0-9]+)/i', '_', $image);
			    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
			    	rename($path, $_SERVER['DOCUMENT_ROOT'].$dossier.$image);
			    	$modification = 'avatar';
			    	$value = $dossier.$image;
			    	$user_avatar = info_utilisateur($conn, $id)['avatar'];
			    	unlink($_SERVER['DOCUMENT_ROOT'].$user_avatar);
					modify_utilisateur($conn, $id, $modification, $value);
					$_SESSION['utilisateur']['avatar'] = $value;
			    }
			    else {
			    	$erreur .= 'Echec de l\'upload '.$path.' !';
			    }
			}
			else {
				echo $erreur;
			}
			header('Location: ../compte.php');
		}
		else {
			$modification = htmlspecialchars($_POST['modification']);
			$value = htmlspecialchars($_POST['value']);
			if ($modification=='mdp') {
				$value = hash('sha256', $value);
			}
			modify_utilisateur($conn, $id, $modification, $value);
			header('Location: ../compte.php');
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>