<?php
//$errors = validation_errors();
$errors = "";
// Valeur du champ id depuis $_POST (fonction form_helper)
$id = set_value("id_session");
// Erreur associée au champ id
$idError = form_error("id_session");
// Valeur du champ id depuis $_POST (fonction form_helper)
$date = set_value("date");
// Erreur associée au champ id
$dateError = form_error("date");
?> 
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="items/css/allproject.css"/>
        <link rel="stylesheet" type="text/css" href="items/css/BeatPicker.min.css"/>
        <script type="text/javascript" src = "items/js/jquery.1.8.3.js"></script>
        <script type="text/javascript" src="items/js/BeatPicker.min.js"></script>
        <title>Création d'un bilan/ Conseil de classe</title>
    </head>
    <body>
        <section>
            <header id = "creation_bilan" method = "POST">
                <h1>Création d'un bilan/ Conseil de classe</h1>
            </header>
            <form id="liste_session" method="POST">
                <label id = "session"> Choisir la session concernée :</label>
                <?= form_dropdown('id_session', $sessions); ?>
                <?= $idError ?>
                <label id = "date"> Choisir la date du bilan :</label>
                <input type="text" name="date" placeholder="Date du bilan" data-beatpicker="true" data-beatpicker-position="['10','50']"  
                       data-beatpicker-extra="customOptions" data-beatpicker-format="['YYYY','MM','DD'],separator:'/'" 
                       data-beatpicker-module="icon"/>
                       <?= $dateError ?>

                <script type="text/javascript">
                    customOptions = {
                        monthsFull: ["Janvier", "F\351vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao\373t", "Septembre", "Octobre", "Novembre", "D\351cembre"],
                        daysSimple: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
                    }
                </script>
                <button type="submit">Valider</button>
            </form>
        </section>
    </body>
</html>
