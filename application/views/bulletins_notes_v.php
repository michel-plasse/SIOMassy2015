<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $cssUrl ?>"/>
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
//            echo "<ul>";
//            $id_session = 0;
//            for ($i = 0; $i < count($stagiaires); $i++) {
//                $row = $stagiaires[$i];
//                // chgt de session
//                if ($row["id_session"] != $id_session) {
//                    $id_session = $row["id_session"];
//                    echo "<li>$row[nom_session]\n";
//                    $id_bilan = 0;
//                }
//                // chgt de bilan
//                if ($row["id_bilan"] != $id_bilan) {
//                    echo ($id_bilan == 0) ? "<ul>" : "</ul></li>";
//                    $id_bilan = $row["id_bilan"];
//                    echo "<li>". date_format(date_create($row["date_effet"]), 'd-m-Y');
//                }
////
////                $id_stagiaire = $row["id_stagiaire"];
////                $personne = $row["prenom"] . " " . $row["nom"];
////                echo "<li><a href ='bulletin_notes/index/$id_session/$id_bilan/$id_stagiaire'>- $personne</a></li>";
//            }
            $bilans = array();
            foreach ($stagiaires as $stagiaire) {
                $bilan = array("date" => $stagiaire["date_effet"], "id_bilan" => $stagiaire["id_bilan"]);
                if (!isset($bilans[$bilan])) {
                    $bilans[$bilan] = array();
                }
                $bilans[$bilan] = array("id_stagiaire" => $stagiaire["id_stagiaire"], "prenom" => $stagiaire["prenom"],
                                         "nom" => $stagiaire["nom"]);
            }
            
            ?>
        </section>
    </body>
</html>