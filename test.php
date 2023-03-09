<?php require_once('Fonction.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!--  font -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!--  font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> <!--  font -->
    <link rel="stylesheet" href="style.css" /> <!--  route vers le fichier css-->
    <script src="date.js"></script> <!--  lien vers page fonction JS pour avoir la date -->
    <title>Meteo</title> <!--  Nom de la page dans le navigateur -->
    
</head>
<body>
    <div class="header">
        <div class="logo">Meteo.</div>
        <div class="date"><script>date();</script></div> <!--  fonction JS pour avoir la date en haut a droite-->
    </div>
    <div class="content">
        <div class="content1">
            <article>
                <div class="ville"><?php echo readdernierevaleur($db,'city','api') ; ?></div> <!--  fonction qui appel la derniere localisation  fournis par l'API-->
                <?php echo weather($db, 'weather', 'api') ; ?> <!--  fonction qui appel le dernier icone fournis par l'API-->
                <p class="temp"><?php echo readdernierevaleur($db,'temp','api') ; ?> °C</p> <!--  fonction qui appel la derniere temperature  fournis par l'API-->

            </article>
            <aside> <!-- Partie capteur -->
                <h2>Capteur n°1</h2>  <!--  nom du capteur -->
                <p>Temp interieur <?php echo readdernierevaleur($db,'temp','capteur');?> °C</p> <!--  fonction qui appel la derniere temperature fournis par le capteur-->
                <p>Humidité <?php echo readdernierevaleur($db,'humidite','capteur');?> %</p> <!--  fonction qui appel la derniere humidite fournis par le capteur-->
                <p>Pression <?php echo readdernierevaleur($db,'pression','capteur');?> hPa</p> <!--  fonction qui appel la derniere pression fournis par le capteur-->
            </aside>
        </div>

    </div>
    <section>
        <h2>Historique:</h2>
            <div class="test">
                <?php
                    $var = 0; // initialisation de la variable $var
                    for ($j = 1; $j <= 7; $j++) { // Boucle qui repete 7 fois le tableau en modifiant la date a chaque fois
                    $date = date('Y-m-d', time()-$var); // deterrmine la date dans l'historique // $var determine combien de seconde sont a retirer de la date
                    echo '<div class="datehist">' . formatdate($date) . '</div>';
                    echo historiquejour($db, $date); // appel fonction qui gere le tableau avec les données
                    $var += 86400; // ajoute 86400 seconde a la variable $var
                    }
                ?>
            </div>
        
    </section>
    
</body>
</html>