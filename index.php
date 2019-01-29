<?php

include_once('./conf/web.php');

$url = $_SERVER['REQUEST_URI'];
$liste = explode('/', $url);


/*foreach ($liste as $i => $j){
    echo($i." => ".$j."<br/>");
}*/


$page = "accueil.php";
if (sizeof($liste) > FIRST_DATA_URL) {
    switch ($liste[FIRST_DATA_URL]) {
        case "accueil":
            $page = "accueil.php";
            break;
        case "univers":
            $page = "univers.php";
            break;
        case "jeux":
            $page = "univers.php";
            break;
        case "contact":
            $page = "contact.php";
            break;
        case "quete":
            $page = "quete.php";
            break;
        case "espace-membre":
            if (sizeof($liste) == FIRST_DATA_URL+2) {
                switch ($liste[FIRST_DATA_URL+1]) {
                    case "":
                        $page = "espace_membre.php";
                        break;
                    case "inscription":
                        $page = "inscription.php";
                        break;
                }
            }
            else {
                $page = "accueil.php";
            }
            break;
        default:
            $page = "accueil.php";
            break;
    }
}

include($page);
?>