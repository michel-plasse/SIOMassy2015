<html>
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
                } else {
                    $dt = "";
                }
                $id_bilan = $row["id_bilan"];
                $date = date_format(date_create($row["date_effet"]),'d-m-Y');
                $dd = "<dd><a href ='bilans/get/$id_bilan'>- $date</a></dd>";
                echo "$dt $dd";
            }
            ?>
        </section>
    </body>
</html>