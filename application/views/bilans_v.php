<?php
//$errors = validation_errors();
$errors = "";
// Valeur du champ id depuis $_POST (fonction form_helper)
$id = set_value("id_session");
// Erreur associée au champ id
$idError = form_error("id_session");
// Valeur du champ date_effet depuis $_POST (fonction form_helper)
$date = set_value("date");
// Erreur associée au champ date_effet
$dateError = form_error("date");
?> 
﻿<html>
    <head>
        <link rel="stylesheet" type="text/css" href="items/css/allproject.css"/>
        <link rel="stylesheet" type="text/css" href="items/css/BeatPicker.min.css"/>
        <script type="text/javascript" src = "items/js/jquery.1.8.3.js"></script>
        <script type="text/javascript" src="items/js/BeatPicker.min.js"></script>
        <title>Liste des bilans/ Conseils de classe</title>
    </head>
    <body>
        <section>
            <header id = "liste_bilans" method = "POST">
                <h1>Listes des bilans/ Conseils de classe</h1>
            </header>
            <?php
            echo "<dl>";
            $idSession = 0;
            for ($i = 0; $i < count($bilans); $i++) {
                $row = $bilans[$i];
                if ($row["id_session"] != $idSession) {
                    $dt = "<dt>$row[nom_session]</dt>\n";
                    $idSession = $row["id_session"];
                    ?>
                    <form id="liste_session<?php echo $row['id_session'] ?>" method="POST">
                        <input type="hidden" name="id_session" value="<?php $idSession ?>"/>
                        <label id = "date"> Choisir la date d'un nouveau bilan :</label>
                        <input type = "text" name = "date" placeholder = "Date du bilan" data-beatpicker = "true" data-beatpicker-position = "['10','50']"
                               data-beatpicker-extra = "customOptions" data-beatpicker-format = "['YYYY','MM','DD'],separator:'-'"
                               data-beatpicker-module = "icon"/>
                        <script type="text/javascript">
                            customOptions = {
                                monthsFull: ["Janvier", "F\351vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao\373t", "Septembre", "Octobre", "Novembre", "D\351cembre"],
                                daysSimple: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
                            }
                        </script>
                        <?= $dateError ?>
                        <button type="submit">Valider</button>
                        <?php
                    } else {
                        $dt = "";
                    }
                    $id_bilan = $row["id_bilan"];
                    $date = date_format(date_create($row["date_effet"]), 'd-m-Y');
                    $dd = "<dd><a href ='bilans/get/$id_bilan'>- $date</a></dd>";

                    echo "$dt $dd";
                    ?>
                </form>
                <?php
            }
            ?>
        </section>
    </body>
</html>