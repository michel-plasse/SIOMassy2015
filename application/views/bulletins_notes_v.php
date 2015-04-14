<html>
    <head>
        <link rel="stylesheet" type="text/css" href="items/css/allproject.css"/>
        <title>Liste des stagaires</title>
    </head>
    <body>
        <section>
            <header id = "liste_bilans" method = "POST">
                <h1>Liste des stagaires</h1>
            </header>
            <?php
            echo "<dl>";
            $idSession = 0;
            for ($i = 0; $i < count($stagiaires); $i++) {
                $row = $stagiaires[$i];
                if ($row["id_session"] != $idSession) {
                    $dt = "<dt>$row[nom_session]</dt>\n";
                    $idSession = $row["id_session"];
                } else {
                    $dt = "";
                }
                $id_personne = $row["id_personne"];
                $id_formation = $row["id_formation"];
                $personne = $row["prenom"] . " " . $row["nom"];
                $dd = "<dd><a href ='bulletin_notes/index/$id_personne/$id_formation'>- $personne</a></dd>";

                echo "$dt $dd";
            }
            ?>
        </section>
    </body>
</html>