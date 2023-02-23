<?php

$db = new PDO('mysql:host=localhost;dbname=meteo;charset=utf8','root',''); // lien vers la BDD --- /!\ provisoire /!\ -----------


// Recherche les derniere valeur enregistré en fonction du type et de la source choisi ----  /!\ il faut que les données soit toute entré en memme temp /!\ 
function readdernieretempapi($db, $type, $source){
    $r = $db->query("SELECT valeur FROM meteo WHERE date = ( SELECT MAX( date) FROM meteo) and type = '$type' and source = '$source'");
    $recherche = $r->fetch(PDO::FETCH_OBJ); //  fait une recherche objet

    return $recherche->valeur; // une fois l'objet trouvé en recupere la valeur
}

?>