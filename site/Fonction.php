<?php

$db = new PDO('mysql:host=localhost;dbname=weather;charset=utf8','cesi','cesi'); // lien vers la BDD --- /!\ provisoire /!\ -----------



// Recherche les derniere valeur enregistré en fonction du type et de la source choisi ----  /!\ il faut que les données soit toute entré en memme temp /!\ 
function readDerniereValeur($db, $type, $source){
    $r = $db->query("SELECT valeur FROM measures WHERE created_at = ( SELECT MAX( created_at ) FROM measures) and type  = '$type' and source = '$source'");
    $recherche = $r->fetch(PDO::FETCH_OBJ); //  fait une recherche objet
    return $recherche->valeur; // Recupere la valeur
}


// Fonction qui attribu l'icone meteo fournie par l'api OWM
function weather($db, $meteo, $source){ 
    $weather = readDerniereValeur($db, 'weather', 'api'); // transforme la valeur weather de la bdd en variable // a netooyer
    
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
function readValeursUnJour($db, $date, $type, $source) {
    $r = $db->query("SELECT value FROM measures WHERE created_at BETWEEN '$date 00:01' AND '$date 23:59' and type = '$type' and source = '$source'"); // Selectionne les données
    $recherche = $r->fetchAll(PDO::FETCH_OBJ);
    $valeurs = array(); // creation du tableau
    foreach ($recherche as $objet) { // met dans le tableau chaque donnée grace au foreach
    $valeurs[] = $objet->valeur;
    }
    return $valeurs; // Retourne le tableau rempli
}


// fonction qui affiche l'historique d'un jour grace a sa date, fonction un peu trop grande ?
function historiqueJour($db, $date){
    $temperatureapi = readValeursUnJour($db, $date, 'temp', 'api'); // Recupere chaque tableau de valeur demandé
    $humiditeapi = readValeursUnJour($db, $date, 'humidite', 'api'); // Recupere chaque tableau de valeur demandé
    $pressionapi = readValeursUnJour($db, $date, 'pression', 'api'); // Recupere chaque tableau de valeur demandé
    $humiditecap = readValeursUnJour($db, $date, 'humidite', 'sensor'); // Recupere chaque tableau de valeur demandé
    $temperaturecap = readValeursUnJour($db, $date, 'temp', 'sensor'); // Recupere chaque tableau de valeur demandé
    $pressioncap = readValeursUnJour($db, $date, 'pression', 'sensor'); // Recupere chaque tableau de valeur demandé

    // Genere un tableau et chaque foreach le rempli grace au fonction readValeursUnJour qui sont juste au dessu
    echo "<table>
            <tbody>
                <tr>";
                    echo '<td>' . 'Heure de la journée' . '</td>'; // genere une suite de chiffre de 1 a 24 qui representent les heures de la journée
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

// Change le format de la date /!\ Verifier si elle est deprecated
function formatDate($date){
    setlocale(LC_TIME, 'FR.utf8'); // définir la locale française
    $date_fr = ucfirst(strftime('%A', strtotime($date))) . ' ' . date('j', strtotime($date)) . ' ' . strftime('%B', strtotime($date)); // formater la date dans le format désiré
    return $date_fr; // afficher la date formatée
    }

?>