<?php
    require_once('bdd_connect.php');
    require_once('fonctions.php');
    secure_session_start();
    try {
        $id_puce = htmlspecialchars($_POST['id_puce']);
        $sort = htmlspecialchars($_POST['sort']);
        $type1 = htmlspecialchars($_POST['type1']);
        $type2 = htmlspecialchars($_POST['type2']);
        $bonus = htmlspecialchars($_POST['bonus']);
        $pe = htmlspecialchars($_POST['pe']);
        $charge = htmlspecialchars($_POST['charge']);
        $description = nl2br(htmlspecialchars($_POST['description']));
        ajouter_sort($conn, $id_puce, $sort, $type1, $type2, $bonus, $pe, $charge, $description);
    }
    catch(PDOException $e) {
        echo ($e->getMessage());
    }
    $conn = NULL;
?>