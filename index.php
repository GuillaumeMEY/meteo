<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!--  font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!--  font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> <!--  font-->
    <link rel="stylesheet" href="style.css" /> <!--  css-->
    <script src="date.js"></script> <!--  lien vers page fonction JS pour avoir la date -->
    <title>Meteo</title>
    
</head>
<body>
    <div class="header">
        <div class="logo">Meteo.</div>
        <div class="date"><script>date();</script></div> <!--  fonction JS pour avoir la date -->
    </div>
    <div class="content">
        <div class="content1">
            <article> <!-- Partie APi weathermap ? ou bdd ? -->
                <div class="ville">Pau</div>
                <div class="imagejour"></div>
                <p class="temp">25 °C</p>

            </article>
            <aside> <!-- Partie capteur -->
                <h2>Capteur n°1</h2>
                <p>Temp interieur 27 °C</p> <!--  fonction a faire-->
                <p>Humidité 75%</p> <!--  fonction a faire-->
                <p>Pression 1005 hPa</p> <!--  fonction a faire-->
            </aside>
        </div>

    </div>
    <section>
        <h2>Historique:</h2>
        <div class="liste"> <!-- Liste historique -->
        
            <div class="artliste"> <!-- Faire une fonction/boucle pour la liste -->
                <h4>Jeudi 26 Janvier</h4>

                    <div class="ordre">
                        <div class="imagemeteo"> </div>
                        <div class="listep">
                            <p>Int 17 °C</p> <!--  fonction a faire-->
                            <p>Ext 25 °C</p> <!--  fonction a faire-->
                    </div>
                </div>
            </div>

            <!-- delete apres boucle  a partir de la -->
            <div class="artliste"> 
                <h4>Mercredi 24 Janvier</h4> 

                    <div class="ordre">
                        <div class="imagemeteo"> </div>
                        <div class="listep"> 
                            <p>Int 17 °C</p> 
                            <p>Ext 25 °C</p> 
                    </div>
                </div>
            </div>
            <div class="artliste">  
                <h4>Mardi 23 Janvier</h4> 

                    <div class="ordre">
                        <div class="imagemeteo"> </div> 
                        <div class="listep">
                            <p>Int 17 °C</p>
                            <p>Ext 25 °C</p>
                    </div>
                </div>
            </div>
            <div class="artliste"> 
                <h4>Lundi 22 Janvier</h4>

                    <div class="ordre"> 
                        <div class="imagemeteo">
                        <div class="listep"> 
                            <p>Int 17 °C</p>  
                            <p>Ext 25 °C</p> 
                    </div>
                </div>
            </div>
            <!-- delete jusque la -->


    </section>
    <div class="aboutus">About Us</div>
    
</body>
</html>