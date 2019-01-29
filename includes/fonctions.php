<?php
    //Session sécurisée
    function secure_session_start() {
        // Cette variable empêche Javascript d’accéder à l’id de session
        $httponly = true;
        // Force la session à n’utiliser que les cookies
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            //header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
            exit();
        }
        // Récupère les paramètres actuels de cookies
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"],
            $cookieParams["path"], 
            $cookieParams["domain"], 
            false,
            $httponly);
        session_start();            // Démarre la session PHP 
        session_regenerate_id();    // Génère une nouvelle session et efface la précédente
    }

    function verif_connexion(){
        if (!isset($_SESSION['utilisateur'])) {
            $verification=0;
            header("Location: ./espace_membre.php");
        }
        else {
            $verification = $_SESSION['utilisateur']['role'];
        }
        return $verification;
    }

    function in_multiarrays($firstArray, $secondArray, $key, $n, $m) {
        if ($key=='' AND $m==1) {
            return in_array($firstArray, $secondArray);
        }
        else if ($n==1 AND $m==1) {
            return in_array($firstArray[$key], $secondArray);
        }
        else if ($n==1 AND $m!=1) {
            foreach ($secondArray as $value) {
                if(in_multiarrays($firstArray, $value, $key, $n, $m-1)) {
                    return true;
                }
            }
        }
        else {
            foreach ($firstArray as $value) {
                if(in_multiarrays($value, $secondArray, $key, $n-1, $m)) {
                    return true;
                }
            }
        }
        return false;
    }

/** Fonctions de récupérations ou de modifications des données rôles **/
    function all_roles($conn) {
        $requete=$conn->query('SELECT * FROM role_utilisateur');
        $i=0;
        while($data = $requete->fetch()) {
            $roles[$i]['id'] = $data['Rol_Id'];
            $roles[$i]['nom'] = $data['Rol_role'];
            $i++;
        }
        $requete->closeCursor();
        return $roles;
    }

/** Fonctions de récupérations ou de modifications des données utilisateurs **/
    function connexion_utilisateur($conn, $login, $mdp) {
    	$trouve = '';
    	$requete=$conn->query('SELECT * FROM utilisateur');
    	while($data = $requete->fetch()) {
    		if(($data['Utl_login'] == $login OR $data['Utl_mail'] == $login) AND $data['Utl_mdp'] == $mdp) {
    			$trouve = $data['Utl_login'];
    			break;
    		}
    	}
    	$requete->closeCursor();
    	return $trouve;
    }

    function recup_utilisateur($conn, $login, $mdp) {
        $requete=$conn->prepare('SELECT Utl_Id, Utl_prenom, Utl_nom, Utl_avatar, Utl_role FROM utilisateur WHERE Utl_login=? AND Utl_mdp=?');
        $requete->execute(array($login, $mdp));
        $data=$requete->fetch();
        $utilisateur['id'] = $data['Utl_Id'];
        $utilisateur['prenom'] = $data['Utl_prenom'];
        $utilisateur['nom'] = $data['Utl_nom'];
        $utilisateur['avatar'] = $data['Utl_avatar'];
        $utilisateur['role'] = $data['Utl_role'];
        if (is_null($utilisateur['avatar'])) {
            $utilisateur['avatar']='img/default-avatar.png';
        }
        $requete->closeCursor();
        return $utilisateur;
    }

    function info_utilisateur($conn, $id) {
        $requete=$conn->prepare('SELECT Utl_login, Utl_nom, Utl_prenom, Utl_mail, Rol_Id, Rol_role, Utl_avatar FROM utilisateur JOIN role_utilisateur ON Utl_role=Rol_Id WHERE Utl_Id=?');
        $requete->execute(array($id));
        $data=$requete->fetch();
        $utilisateur['login'] = $data['Utl_login'];
        $utilisateur['nom'] = $data['Utl_nom'];
        $utilisateur['prenom'] = $data['Utl_prenom'];
        $utilisateur['mail'] = $data['Utl_mail'];
        $utilisateur['role_id'] = $data['Rol_Id'];
        $utilisateur['role'] = $data['Rol_role'];
        $utilisateur['avatar'] = $data['Utl_avatar'];
        if (is_null($utilisateur['avatar'])) {
            $utilisateur['avatar']='img/default-avatar.png';
        }
        $requete->closeCursor();
        return $utilisateur;
    }

    function all_utilisateur($conn) {
        $requete=$conn->query('SELECT Utl_Id, Utl_nom, Utl_prenom, Rol_Id, Rol_role, Utl_avatar FROM utilisateur JOIN role_utilisateur ON Utl_role=Rol_Id ORDER BY Utl_role DESC');
        $i=0;
        while($data = $requete->fetch()) {
            $utilisateurs[$i]['id'] = $data['Utl_Id'];
            $utilisateurs[$i]['nom'] = $data['Utl_nom'];
            $utilisateurs[$i]['prenom'] = $data['Utl_prenom'];
            $utilisateurs[$i]['role_id'] = $data['Rol_Id'];
            $utilisateurs[$i]['role'] = $data['Rol_role'];
            $utilisateurs[$i]['avatar'] = $data['Utl_avatar'];
            if (is_null($utilisateurs[$i]['avatar'])) {
                $utilisateurs[$i]['avatar']='img/default-avatar.png';
            }
            $i++;
        }
        $requete->closeCursor();
        return $utilisateurs;
    }

    function modify_utilisateur($conn, $id, $modification, $value) {
        $requete=$conn->prepare('UPDATE utilisateur SET Utl_'.$modification.'=? WHERE Utl_Id=?');
        $requete->execute(array($value, $id));
        $requete->closeCursor();
    }

    function inscription($conn, $prenom, $nom, $login, $mdp, $mail, $role) {
        $requete=$conn->prepare('INSERT INTO utilisateur(Utl_prenom, Utl_nom, Utl_login, Utl_mdp, Utl_mail, Utl_role) VALUES(?, ?, ?, ?, ?, ?)');
        $requete->execute(array($prenom, $nom, $login, $mdp, $mail, $role));
        $requete->closeCursor();
    }

    function checkMail($conn, $mail) {
        $requete=$conn->prepare('SELECT Utl_Id FROM utilisateur WHERE Utl_mail=?');
        $requete->execute(array($mail));
        $data=$requete->fetch();
        $utilisateur_id = $data['Utl_Id'];
        $requete->closeCursor();
        return $utilisateur_id;
    }

/** Fonctions de récupérations ou de modifications des données des personnages **/

    function ajouter_personnage($conn, $id_utilisateur, $nom, $description, $image, $fiche) {
        $requete=$conn->prepare('INSERT INTO personnage(Per_Utl_Id, Per_nom, Per_description, Per_imagePath, Per_fichePath) VALUES(?, ?, ?, ?, ?)');
        $requete->execute(array($id_utilisateur, $nom, $description, $image, $fiche));
        $requete->closeCursor();
    }

    function supprimer_personnage($conn, $id) {
        $requete=$conn->prepare('DELETE FROM personnage WHERE Per_Id=?');
        $requete->execute(array($id));
        $requete->closeCursor();
    }

    function recup_personnages($conn, $id_utilisateur) {
        $requete=$conn->prepare('SELECT Per_Id, Per_nom, Per_description, Per_imagePath, Per_fichePath, Per_ficheVisible FROM personnage WHERE Per_Utl_Id=?');
        $requete->execute(array($id_utilisateur));
        $i = 0;
        $personnages = array();
        while($data = $requete->fetch()) {
            $personnages[$i]['id'] = $data['Per_Id'];
            $personnages[$i]['nom'] = $data['Per_nom'];
            $personnages[$i]['description'] = $data['Per_description'];
            $personnages[$i]['image'] = $data['Per_imagePath'];
            $personnages[$i]['fiche'] = $data['Per_fichePath'];
            $personnages[$i]['visible'] = $data['Per_ficheVisible'];
            $i++;
        }
        $requete->closeCursor();
        return $personnages;
    }

    function recup_info_personnage($conn, $id) {
        $requete=$conn->prepare('SELECT Per_Utl_Id, Per_nom, Per_description, Per_imagePath, Per_fichePath, Per_ficheVisible FROM personnage WHERE Per_Id=?');
        $requete->execute(array($id));
        $data = $requete->fetch();
        $personnage['id_utilisateur'] = $data['Per_Utl_Id'];
        $personnage['nom'] = $data['Per_nom'];
        $personnage['description'] = $data['Per_description'];
        $personnage['image'] = $data['Per_imagePath'];
        $personnage['fiche'] = $data['Per_fichePath'];
        $personnage['visible'] = $data['Per_ficheVisible'];
        $requete->closeCursor();
        return $personnage;
    }

    function modify_personnage($conn, $id, $modification, $value) {
        $requete=$conn->prepare('UPDATE personnage SET Per_'.$modification.'=? WHERE Per_Id=?');
        $requete->execute(array($value, $id));
        $requete->closeCursor();
    }

/** Fonctions de récupérations ou de modifications des données des quêtes **/

    function recup_quetes($conn) {
        $requete=$conn->query('SELECT * FROM quete');
        $i = 0;
        while($data = $requete->fetch()) {
            $quetes[$i]['id'] = $data['Qst_Id'];
            $quetes[$i]['titre'] = $data['Qst_titre'];
            $quetes[$i]['description'] = $data['Qst_description'];
            $quetes[$i]['etat'] = $data['Qst_etat'];
            $quetes[$i]['auteur'] = $data['Qst_auteur'];
            $i++;
        }
        $requete->closeCursor();
        return $quetes;
    }

    function recup_etats($conn) {
        $requete=$conn->query('SELECT * FROM liste_etat');
        $i = 0;
        while($data = $requete->fetch()) {
            $etats[$i]['id'] = $data['Lse_Id'];
            $etats[$i]['etat'] = $data['Lse_etat'];
            $i++;
        }
        return $etats;
    }

    function modify_quete($conn, $id, $modification, $value) {
        $requete=$conn->prepare('UPDATE quete SET Qst_'.$modification.'=? WHERE Qst_Id=?');
        $requete->execute(array($value, $id));
        $requete->closeCursor();
    }

    function ajouter_quete($conn, $titre, $description, $etat, $auteur) {
        $requete=$conn->prepare('INSERT INTO quete(Qst_titre, Qst_description, Qst_etat, Qst_auteur) VALUES(?, ?, ?, ?)');
        $requete->execute(array($titre, $description, $etat, $auteur));
        $requete->closeCursor();
    }

    function supprimer_quete($conn, $id) {
        $requete=$conn->prepare('DELETE FROM quete WHERE Qst_Id=?');
        $requete->execute(array($id));
        $requete->closeCursor();
    }

/** Fonctions de récupérations ou de modifications des données des inscriptions aux quêtes **/

    function recup_id_inscrits($conn, $id) {
        $requete=$conn->prepare('SELECT Isn_Per_Id FROM inscription WHERE Isn_Qst_Id=?');
        $requete->execute(array($id));
        $i = 0;
        $inscrits = array();
        while($data = $requete->fetch()) {
            $inscrits[$i]['id'] = $data['Isn_Per_Id'];
            $i++;
        }
        $requete->closeCursor();
        return $inscrits;
    }

    function recup_all_inscrits($conn) {
        $requete=$conn->query('SELECT DISTINCT Per_Utl_Id FROM personnage JOIN (SELECT Isn_Per_Id FROM inscription JOIN quete ON Isn_Qst_Id=Qst_Id WHERE Qst_etat=2) AS i ON Per_Id=i.Isn_Per_Id');
        $joueurs = $requete->fetchAll();
        $requete->closeCursor();
        return $joueurs;
    }

    function recup_id_inscription($conn, $id_perso) {
        $requete=$conn->prepare('SELECT Isn_Id FROM inscription JOIN quete ON Isn_Qst_Id=Qst_Id WHERE Qst_etat=2 AND Isn_Per_Id=?');
        $requete->execute(array($id_perso));
        $data = $requete->fetch();
        $id = $data['Isn_Id'];
        $requete->closeCursor();
        return $id;
    }

    function desinscription_quete($conn, $id_perso) {
        $id_inscription = recup_id_inscription($conn, $id_perso);
        $requete=$conn->prepare('DELETE FROM inscription WHERE Isn_Id=?');
        $requete->execute(array($id_inscription));
        $requete->closeCursor();
    }

    function inscription_quete($conn, $id_perso, $id_quete) {
        $requete=$conn->prepare('INSERT INTO inscription(Isn_Per_Id, Isn_Qst_Id) VALUES(?, ?)');
        $requete->execute(array($id_perso, $id_quete));
        $requete->closeCursor();
    }

    function supprimer_inscription($conn, $id_perso, $id_quete) {
        if (!is_null($id_perso) AND !is_null($id_quete)) {
            $requete=$conn->prepare('DELETE FROM inscription WHERE Isn_Per_Id=? AND Isn_Qst_Id=?');
            $requete->execute(array($id_perso, $id_quete));
        }
        else if (!is_null($id_perso)) {
            $requete=$conn->prepare('DELETE FROM inscription WHERE Isn_Per_Id=?');
            $requete->execute(array($id_perso));
        }
        else {
            $requete=$conn->prepare('DELETE FROM inscription WHERE Isn_Per_Id=?');
            $requete->execute(array($id_quete));
        }
        $requete->closeCursor();
    }

/** Fonctions de récupérations ou de modifications des données des puces **/

    function recup_puces($conn) {
        $requete=$conn->query('SELECT * FROM puce');
        $i = 0;
        while($data = $requete->fetch()) {
            $puces[$i]['id'] = $data['Puc_Id'];
            $puces[$i]['nom'] = $data['Puc_nom'];
            $puces[$i]['perso'] = $data['Puc_Per_Id'];
            $puces[$i]['info'] = $data['Puc_info'];
            $i++;
        }
        $requete->closeCursor();
        return $puces;
    }

    function recup_id_puce($conn, $nom) {
        $requete=$conn->prepare('SELECT Puc_Id FROM puce WHERE Puc_nom=?');
        $requete->execute(array($nom));
        $data = $requete->fetch();
        $id = $data['Puc_Id'];
        $requete->closeCursor();
        return $id;
    }

    function recup_sorts($conn, $id) {
        $requete = $conn->prepare('SELECT * FROM sort WHERE Srt_Puc_Id=?');
        $requete->execute(array($id));
        $i=0;
        while($data = $requete->fetch()) {
            $sorts[$i]['id'] = $data['Srt_Id'];
            $sorts[$i]['sort_nom'] = $data['Srt_nom'];
            $sorts[$i]['type1'] = $data['Srt_type1'];
            $sorts[$i]['type2'] = $data['Srt_type2'];
            $sorts[$i]['bonus'] = $data['Srt_type_bonus'];
            $sorts[$i]['pe'] = $data['Srt_pe'];
            $sorts[$i]['charge'] = $data['Srt_charge'];
            $sorts[$i]['description'] = $data['Srt_description'];
            $i++;
        }
        $requete->closeCursor();
        return $sorts;
    }

    function recup_nombre_attribution($conn, $id_perso) {
        $requete=$conn->prepare('SELECT COUNT(Puc_Id) AS number FROM puce WHERE Puc_Per_Id=?');
        $requete->execute(array($id_perso));
        $data = $requete->fetch();
        $number = $data['number'];
        $requete->closeCursor();
        return $number;
    }

    function recup_attribution($conn, $id_puce) {
        $requete=$conn->prepare('SELECT Puc_Per_Id FROM puce WHERE Puc_Id=?');
        $requete->execute(array($id_puce));
        $data = $requete->fetch();
        $perso = $data['Puc_Per_Id'];
        $requete->closeCursor();
        return $perso;
    }

    function ajouter_puce($conn, $nom, $info) {
        $requete=$conn->prepare('INSERT INTO puce(Puc_nom, Puc_info) VALUES(?, ?)');
        $requete->execute(array($nom, $info));
        $requete->closeCursor();
    }

     function ajouter_sort($conn, $id_puce, $nom_sort, $type1, $type2, $bonus, $pe, $charge, $description) {
        $requete=$conn->prepare('INSERT INTO sort(Srt_Puc_Id, Srt_nom, Srt_type1, Srt_type2, Srt_type_bonus, Srt_pe, Srt_charge, Srt_description) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $requete->execute(array($id_puce, $nom_sort, $type1, $type2, $bonus, $pe, $charge, $description));
        $requete->closeCursor();
    }

    function supprimer_puce($conn, $id) {
        $requete=$conn->prepare('DELETE FROM puce WHERE Puc_Id=?');
        $requete->execute(array($id));
        $requete->closeCursor();
    }

    function supprimer_sort($conn, $id) {
        $requete=$conn->prepare('DELETE FROM sort WHERE Srt_Id=?');
        $requete->execute(array($id));
        $requete->closeCursor();
    }

    function modify_puce($conn, $id, $modification, $value) {
        $requete=$conn->prepare('UPDATE puce SET Puc_'.$modification.'=? WHERE Puc_Id=?');
        $requete->execute(array($value, $id));
        $requete->closeCursor();
    }
    function modify_sort($conn, $id, $modification, $value) {
        $requete=$conn->prepare('UPDATE sort SET Srt_'.$modification.'=? WHERE Srt_Id=?');
        $requete->execute(array($value, $id));
        $requete->closeCursor();
    }

    function attribution_puce($conn, $id_perso, $id_puce) {
        $requete=$conn->prepare('UPDATE puce SET Puc_Per_Id=? WHERE Puc_Id=?');
        $requete->execute(array($id_perso, $id_puce));
        $requete->closeCursor();
    }
    function retirer_puce($conn, $id_puce) {
        $requete=$conn->prepare('UPDATE puce SET Puc_Per_Id=NULL WHERE Puc_Id=?');
        $requete->execute(array($id_puce));
        $requete->closeCursor();
    }

?>