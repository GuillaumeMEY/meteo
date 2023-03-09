<?php

$db = new PDO('mysql:host=localhost;dbname=meteo;charset=utf8','root',''); // lien vers la BDD --- /!\ provisoire /!\ -----------



// Recherche les derniere valeur enregistré en fonction du type et de la source choisi ----  /!\ il faut que les données soit toute entré en memme temp /!\ 
function readdernierevaleur($db, $type, $source){
    $r = $db->query("SELECT valeur FROM meteo WHERE created_at = ( SELECT MAX( created_at ) FROM meteo) and type  = '$type' and source = '$source'");
    $recherche = $r->fetch(PDO::FETCH_OBJ); //  fait une recherche objet
    return $recherche->valeur; // Recupere la valeur
}

// Reccherche la derniere date entré dans la bdd
function readjour($db, $source){
    $r = $db->query("SELECT created_at FROM meteo WHERE created_at = ( SELECT MAX( created_at ) FROM meteo) and source = '$source'");
    $recherche = $r->fetch(PDO::FETCH_OBJ);
    return $recherche->created_at; // Recupere la derniere date entré dans la bdd
}

// Fonction qui attribu l'icone meteo fournie par l'api OWM
function weather($db, $meteo, $source){ 
    $weather = readdernierevaleur($db, 'weather', 'api'); // transforme la valeur weather de la bdd en variable
    
    switch ($weather) { // utilise la variable pour definir l'icone
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

// Fonction qui va chercher les données d'un type d'une journée defini par $date et le met dans un tableau
function readvaleursunjour($db, $date, $type, $source) {
    $r = $db->query("SELECT valeur FROM meteo WHERE created_at BETWEEN '$date 00:01' AND '$date 23:59' and type = '$type' and source = '$source'");
    $recherche = $r->fetchAll(PDO::FETCH_OBJ);
    $valeurs = array(); // creation du tableau
    foreach ($recherche as $objet) { // met dans le tableau chaque donnée grace au foreach
    $valeurs[] = $objet->valeur;
    }
    return $valeurs; // Retourne le tableau rempli
}

// fonction qui affiche l'historique d'un jour grace a sa date, fonction un peu trop grande ?
function historiquejour($db, $date){
    $temperatureapi = readvaleursunjour($db, $date, 'temp', 'api');
    $humiditeapi = readvaleursunjour($db, $date, 'humidite', 'api');
    $pressionapi = readvaleursunjour($db, $date, 'pression', 'api');
    $humiditecap = readvaleursunjour($db, $date, 'humidite', 'capteur');
    $temperaturecap = readvaleursunjour($db, $date, 'temp', 'capteur');
    $pressioncap = readvaleursunjour($db, $date, 'pression', 'capteur');
    echo "<table>
            <tbody>
                <tr>";
                    echo '<td>' . 'Heure' . '</td>';
                    for ($i = 1; $i <= 24; $i++) {
                        echo '<td>' . $i . '</td>';
                    }
    echo "      </tr>
                <tr>";
                    echo '<td>' . 'Température ( °C ) (OpenWeatherMap)' . '</td>';
                    foreach($temperatureapi as $tempapi){
                        echo '<td>' . $tempapi . '</td>';
                    }
    echo "      </tr>
                <tr>";
                    echo '<td>' . 'Humidite ( % ) (OpenWeatherMap)' . '</td>';
                    foreach($humiditeapi as $humapi){
                        echo '<td>' . $humapi . '</td>';
                    }
    echo "      </tr>
                <tr>";
                    echo '<td>' . 'Pression ( hPa ) (OpenWeatherMap)' . '</td>';
                    foreach($pressionapi as $presapi){
                        echo '<td>' . $presapi . '</td>';
                    }
    echo "      </tr>
                <tr>";
                    echo '<td>' . 'Température ( °C ) (Capteur)' . '</td>';
                    foreach($temperaturecap as $tempcap){
                        echo '<td>' . $tempcap . '</td>';
                    }
    echo "      </tr>
                <tr>";
                    echo '<td>' . 'Humidité ( % ) (Capteur)' . '</td>';
                    foreach($humiditecap as $humcap){
                        echo '<td>' . $humcap . '</td>';
                    }
    echo "      </tr>
                <tr>";
                    echo '<td>' . 'Pression ( hPa ) (Capteur)' . '</td>';
                    foreach($pressioncap as $prescap){
                        echo '<td>' . $prescap . '</td>';
                    }
    echo "      </tr>
            </tbody>
            <br>
        </table>";
}

function formatdate($date){
    setlocale(LC_TIME, 'FR.utf8'); // définir la locale française
    $date_fr = ucfirst(strftime('%A', strtotime($date))) . ' ' . date('j', strtotime($date)) . ' ' . strftime('%B', strtotime($date)); // formater la date dans le format désiré
    return $date_fr; // afficher la date formatée
    }

?>