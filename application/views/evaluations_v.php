<html>
    <head>
        <title>Liste des évaluations</title>
        <link rel="stylesheet" type="text/css" href="/gestionmassy/items/css/allproject.css"/>
    </head>
    <body>
        <?php
        $this->load->view('header_v');
        $this->load->view('navigation_v');
        ?>
        <table border = "1" cellspacing="0">
            <tr>
                <th>Id</th>
                <th>Matière</th>
                <th>Date</th>
                <th>Formateur</th>
            </tr>
            <?php
            foreach ($evaluations as $ligne) {
                $url = "$urlGet/$ligne[id_evaluation]";
                $formateur = "$ligne[prenom_formateur] $ligne[nom_formateur]";
                ?>
                <tr>
                    <td><a href="<?= $url ?>"><?= $ligne["id_evaluation"] ?></a></td>
                    <td><a href="<?= $url ?>"><?= $ligne["nom_module"] ?></a></td>
                    <td><?= $ligne["date_effet"] ?></td>
                    <td><?= $formateur ?></td>
                </tr>
                <?php
            }
            ?>
    </body>
</html>