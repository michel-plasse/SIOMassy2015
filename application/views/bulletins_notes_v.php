<html>
    <head>
        <link rel="stylesheet" type="text/css" href="items/css/allproject.css"/>
        <title>Liste des stagaires</title>
    </head>
    <body>
        <section>
            <?php
            $this->load->view('header_v');
            ?>
            <header id = "liste_bilans" method = "POST">
                <h1>Liste des stagiaires</h1>
            </header>
            <?php
            echo "<ul>";
            $idSession = 0;
            for ($i = 0; $i < count($stagiaires); $i++) {
                $row = $stagiaires[$i];
                if ($row["id_session"] != $idSession) {
                    $li1 = "<li>$row[nom_session]</li>\n";
                    $idSession = $row["id_session"];
                } else {
                    $li1 = "";
                }
                $idBilan = 0;
                $id_stagiaire = $row["id_stagiaire"];
                $id_formation = $row["id_formation"];
                $id_bilan = $row["id_bilan"];
                $personne = $row["prenom"] . " " . $row["nom"];
                $li3 = "<li><a href ='bulletin_notes/index/$id_stagiaire/$id_formation/$id_bilan'>- $personne</a></li>";
                echo "$li1 $li3";
            }
            ?>
        </section>
    </body>
</html>