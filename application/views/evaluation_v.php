<?php
$url = base_url("/evaluations/note");
?>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h1>Evaluation <?= $evaluation["nom_module"] ?>
            du <?= $evaluation["date_effet"] ?>,
            par <?= $evaluation["prenom_formateur"] ?>
            <?= $evaluation["nom_formateur"] ?>
        </h1>
        <form method="post" action="<?= $url ?>">
            <input type="hidden" name="id_evaluation" value="<?= $evaluation['id_evaluation']?>"/>
            <table border = "1" cellspacing="0">
                <tr>
                    <th>Stagiaire</th>
                    <th>Note</th>
                </tr>
                <?php
                $verif = TRUE;
                if ($verif == TRUE) {
                    foreach ($notes as $ligne) {
                        // Url de l'espace personnel du stagiaire
                        $url = site_url("stagiaire/$ligne[id_stagiaire]");
                        $nom = "$ligne[prenom] $ligne[nom]";
                        ?>

                        <tr>
                            <td><a href="<?= $url ?>"></a><?= $nom ?></td>
                            <td><?= $ligne["note"] ?></td>

                        </tr>
                        <?php
                    }
                }
                ?>
                <?php
                if ($verif == FALSE) {
                    foreach ($notes as $ligne) {
                        // Url de l'espace personnel du stagiaire
                        $nom = "$ligne[prenom] $ligne[nom]";
                        ?>

                        <tr>
                            <td><a href="<?= $url ?>"></a><?= $nom ?></td>
                            <td>
                                <input type='number' min='0' max='20' step='0.1' name='note[]' value="<?= $ligne['note'] ?>"/>
                                <input type="hidden" name="id_stagiaire[]" value="<?=$ligne['id_stagiaire'] ?>"/>
                            </td>


                            <?php
                        }
                    }
                    if ($verif == FALSE) {
                        ?>
                    <tr>               
                        <td colspan="3" style="text-align: center;">
                            <button type="submit">Valider</button>
                        </td>
                    </tr>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        
                    }
                }
                ?>
            </table>
        </form>
    </body>
</html>