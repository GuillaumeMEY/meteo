<?php

$db = new PDO('mysql:host=localhost;dbname=meteo;charset=utf8','root',''); // lien vers la BDD --- /!\ provisoire /!\ -----------


// Recherche les derniere valeur enregistré en fonction du type et de la source choisi ----  /!\ il faut que les données soit toute entré en memme temp /!\ 
function readdernierevaleur($db, $type, $source){
    $r = $db->query("SELECT value FROM meteo WHERE created_at = ( SELECT MAX( created_at ) FROM meteo) and type_enum  = '$type' and source_enum = '$source'");
    $recherche = $r->fetch(PDO::FETCH_OBJ); //  fait une recherche objet

    return $recherche->value; // une fois l'objet trouvé en recupere la valeur
}



function weather($db, $meteo, $source){
    $weather = readdernierevaleur($db, 'weather', 'api');
    
    switch ($weather) {
        case 'clear sky' :
            echo '<div class="imagejourclearsky"></div>';
            break;
        case 'few clouds' :
            echo '<div class="imagejoursuncloud"></div>';
            break;
        case 'scattered clouds' :
            echo '<div class="imagejourcloud"></div>';
            break;
        case 'broken clouds' :
            echo '<div class="imagejourcloud"></div>';
            break;
        case 'shower rain' :
            echo '<div class="imagejourrain"></div>';
            break;
        case 'rain' :
            echo '<div class="imagejourrain"></div>';
            break;

        case 'thunderstorm ' :
            echo '<div class="imagejourthunderstorm"></div>';
            break;

        case 'snow ' :
            echo '<div class="imagejoursnow"></div>';
            break;

        case 'mist' :
            echo '<div class="imagejourmist"></div>';
            break;
    }
}



?>