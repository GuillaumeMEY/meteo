<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!--  font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!--  font-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"> <!--  font-->
    <link rel="stylesheet" href="style.css" /> <!--  css-->
    <script src="date.js"></script> <!--  lien vers page fonction JS pour avoir la date -->
    <title>Historique</title>

</head>
<body class="body2">
    <div class="header">
        <div class="logo">Meteo.</div>
        <div class="date"><script>date();</script></div>  <!--  fonction JS pour avoir la date -->

    </div>

    <div class="historique">
    <div class="villehistorique">Pau</div> <!--  fonction a faire-->
        <div class="listehistorique">

            <p class="phistorique">Jeudi 28 Janvier</p> <!--  boucle a faire-->
                <div class="deroulant"> 
                    <div class="tempexte">
                        <h3>Température exterieur</h3>
                        <p class="grp">Temp Max 27 °C</p> <!--  fonction a faire-->
                        <p class="grp">Temp Min 20 °C</p> <!--  fonction a faire-->
                        <p class="grp">Temp Moyenne 22°C</p> <!--  fonction a faire-->

                    </div>
                    <div class="pression">
                        <p class="grp1">Humidité Moyenne 50%</p> <!--  fonction a faire-->
                        <p class="grp1">Pression Moyenne 1005 hPa</p> <!--  fonction a faire-->
                    </div> 
                    <div class="tempinte">
                    <h3>Température Capteur</h3>
                        <p class="grp">Temp Max 27 °C</p> <!--  fonction a faire-->
                        <p class="grp">Temp Min 20 °C</p> <!--  fonction a faire-->
                        <p class="grp">Temp Moyenne 22°C</p> <!--  fonction a faire-->
                    
                    </div>


                    <button class="btn" id="btn">+</button>



                    <div class="grp2" id="grp2"> <!-- A masquer -->
                         <table>
                            <tr>
                                <th>Heure</th> <!--  fonction/boucle a faire-->
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th>12</th>
                                <th>13</th>
                                <th>14</th>
                                <th>15</th>
                                <th>16</th>
                                <th>17</th>
                                <th>18</th>
                                <th>19</th>
                                <th>20</th>
                                <th>21</th>
                                <th>22</th>
                                <th>23</th>
                                <th>24</th>

                            </tr>
                            <tr>
                                <td>Temp Int</td> <!--  fonction/boucle a faire-->
                                <td>28</td>
                                <td>28</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>28</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>

                            </tr>
                            <tr>
                                <td>Temp Ext</td> <!--  fonction/boucle a faire-->
                                <td>28</td>
                                <td>28</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>28</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                                <td>27</td>
                            </tr>
                            <tr>
                                <td>Humidité</td> <!--  fonction/boucle a faire-->
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>Pression</td> <!--  fonction/boucle a faire-->
                                <td>1057</td>
                                <td>1054</td>
                                <td>1005</td>
                                <td>0056</td>
                                <td>0000</td>
                                <td>1534</td>
                                <td>1278</td>
                                <td>1027</td>
                                <td>1028</td>
                                <td>2286</td>
                                <td>7675</td>
                                <td>5567</td>
                                <td>990</td>
                                <td>6500</td>
                                <td>6042</td>
                                <td>6350</td>
                                <td>3354</td>
                                <td>3754</td>
                                <td>6054</td>
                                <td>6340</td>
                                <td>6650</td>
                                <td>6550</td>
                                <td>5550</td>
                                <td>5555</td>
                            </tr>
                        </table>
                    </div>
                </div>
            <p class="phistorique">Jeudi 28 Janvier</p> <!-- delete apres boucle -->
            <p class="phistorique">Jeudi 28 Janvier</p> <!-- delete apres boucle -->
        </div>
    </div>
    <div class="aboutus">About Us</div>
    
    <script src="logic.js"></script>
</body>
</html>