<?php
	require_once('bdd_connect.php');
	require_once('fonctions.php');
	secure_session_start();
	try {
		$mail = htmlspecialchars($_POST['adresse_mail']);
		$id = checkMail($conn, $mail);
		if($id != NULL) {

			$code = substr(md5(rand()), 0, 5);

			$to      = $mail;
		    $subject = 'Récupération du compte - Ludisep';
		    $message = "Bonjour !"."\r\n".
		    			"\r\n".
		    			"Ce mail a été envoyé automatiquement suite à une demande de récupération de compte."."\r\n".
		    			"Si vous avez reçu ce mail sans avoir fait cette demande, merci de ne pas en tenir compte."."\r\n".
		    			"\r\n".
		    			"Code : ".$code."\r\n".
		    			"\r\n".
		    			"Saisissez ce code dans le champ de confirmation sur la page du site Ludisep pour réinitialiser vos informations de compte.";
		    $headers =  'From: ludisep.isep@gmail.com' . "\r\n" .
     					'Reply-To: ludisep.isep@gmail.com' . "\r\n";

			//$message = wordwrap($message, 70, '\r\n');

		    if(mail($to, $subject, $message, $headers)) {
		    	$_SESSION['infos_oubliees']['id'] = $id;
		    	$_SESSION['infos_oubliees']['code'] = $code;
		    	header('Location: ../recuperation.php');
		    }
		}
		else {
			$_SESSION['erreur_recup'] = "Aucune adresse mail correspondant à ".$mail." n'a été trouvée.";
			header('Location: ../informations_oubliees.php');
		}
	}
	catch(PDOException $e) {
		echo ($e->getMessage());
	}
	$conn = NULL;
?>