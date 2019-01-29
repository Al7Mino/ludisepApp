<?php
	function getAllEvents($conn) {
		$requete=$conn->query('SELECT * FROM evenement');
        $events = array();
        $i=0;
        while($data = $requete->fetch()) {
            $events[$i]['id'] = $data['Evn_Id'];
            $events[$i]['debut'] = $data['Evn_date_debut'];
            $events[$i]['fin'] = $data['Evn_date_fin'];
            $events[$i]['titre'] = $data['Evn_titre'];
            $events[$i]['contenu'] = $data['Evn_contenu'];
            $i++;
        }
        $requete->closeCursor();
        return $events;
    }

	function getEventsDate($conn, $mois, $annee) {
		$requete=$conn->prepare('SELECT * FROM evenement WHERE MONTH(Evn_date_debut)=? AND YEAR(Evn_date_debut)=?');
        $requete->execute(array($mois, $annee));
        $events = array();
        $i=0;
        while($data = $requete->fetch()) {
            $events[$i]['id'] = $data['Evn_Id'];
            $events[$i]['debut'] = $data['Evn_date_debut'];
            $events[$i]['fin'] = $data['Evn_date_fin'];
            $events[$i]['titre'] = $data['Evn_titre'];
            $events[$i]['contenu'] = $data['Evn_contenu'];
            $i++;
        }
        $requete->closeCursor();
        return $events;
    }

    function getEvent($conn, $id) {
		$requete=$conn->prepare('SELECT * FROM evenement WHERE Evn_Id=?');
        $requete->execute(array($id));
        $data = $requete->fetch();

        $event['id'] = $data['Evn_Id'];
        $event['debut'] = $data['Evn_date_debut'];
        $event['fin'] = $data['Evn_date_fin'];
        $event['titre'] = $data['Evn_titre'];
        $event['contenu'] = $data['Evn_contenu'];

        $requete->closeCursor();
        return $event;
    }

    function ajouter_event($conn, $titre, $date_debut, $date_fin, $contenu) {
    	$requete=$conn->prepare('INSERT INTO evenement(Evn_titre, Evn_date_debut, Evn_date_fin, Evn_contenu) VALUES(?, ?, ?, ?)');
        $requete->execute(array($titre, $date_debut, $date_fin, $contenu));
        $requete->closeCursor();
    }

    function modify_event($conn, $id, $modification, $value) {
        $requete=$conn->prepare('UPDATE evenement SET Evn_'.$modification.'=? WHERE Evn_Id=?');
        $requete->execute(array($value, $id));
        $requete->closeCursor();
    }

    function supprimer_event($conn, $id) {
        $requete=$conn->prepare('DELETE FROM evenement WHERE Evn_Id=?');
        $requete->execute(array($id));
        $requete->closeCursor();
    }
?>