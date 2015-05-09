<!DOCTYPE html>
<?php
session_start();
foreach ($stagiaire as $infos_stagiaire) {
    $nom_stagiaire = $infos_stagiaire["nom_stagiaire"];
    $prenom_stagiaire = $infos_stagiaire["prenom_stagiaire"];
    $diplome = $infos_stagiaire["diplome"];
    $date_conseil = $infos_stagiaire["date_bilan"];
    $date_naissance = $infos_stagiaire["date_naissance"];
    $annee_diplome = $infos_stagiaire["annee"];
    $avis_proviseur = $infos_stagiaire["avis_proviseur"];
    $id_bilan = $infos_stagiaire["id_bilan"];
    $id_stagiaire = $infos_stagiaire["id_stagiaire"];
    $id_module = $infos_stagiaire["id_module"];
    $id_formateur = $infos_stagiaire["id_formateur"];
}
foreach ($moyennes as $moyenne) {
    $moyenne_stagiaire = $moyenne["moyenne_stagiaire"];
    $moyenne_classe = $moyenne["moyenne_classe"];
}
?>

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $cssUrl ?>"/>
        <title>Affichage d'un bulletin de notes</title>
    </head>
    <body>
        <main>
            <?php
            $this->load->view('header_v');
            ?>
            <?php
            $this->load->view('navigation_v');
            ?>
            <section id="section_bulletin">
                <header id = "bulletin">
                    <h1 id = "diplome">Diplome préparé <?php echo $diplome ?></h1>
                    <p id = "annee">Année : <?php echo $annee_diplome ?></p>
                    <p id = "nom">Prénom Nom : <?php echo $prenom_stagiaire . " " . $nom_stagiaire ?></p>
                    <p id = "date_conseil">Date du conseil de classe : <?php echo date_format(date_create($date_conseil), 'd-m-Y') ?></p>
                    <p id = "date">Date de naissance : <?php echo date_format(date_create($date_naissance), 'd-m-Y') ?> </p>
                </header>
                <table id = "notes">
                    <thead>
                        <tr>
                            <th id = 'matiere' rowspan="2">Matières</th>
                            <th id = 'enseignant' rowspan="2">Nom des enseignants</th>
                            <th id = 'stagiaire' rowspan="2">Moyennes du stagiaire</th>
                            <th colspan="3">Moyennes du groupe</th>
                            <th id = 'commentaire' rowspan="2">Commentaires</th>
                        </tr>
                        <tr>
                            <th class = 'moyenne'> - < </th>
                            <th class = 'moyenne'>Moyenne</th>
                            <th class = 'moyenne'> > + </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($stagiaire as $info) {
                            echo "<tr>";
                            echo "<td id='body_matiere'>$info[matiere]</td>";
                            echo "<td id='body_formateur'>$info[prenom_formateur] $info[nom_formateur]</td>";
                            echo "<td class='body_notes'>$info[moyenne]</td>";
                            echo "<td class='body_notes'>$info[min_classe]</td>";
                            echo "<td class='body_notes'>$info[moyenne_classe]</td>";
                            echo "<td class='body_notes'>$info[max_classe]</td>";
                            echo "<td><form method='POST'>
                                        <input type='hidden' name='id_formateur' value=$info[id_formateur]/>
                                        <input type='hidden' name='id_bilan' value=$info[id_bilan]/>
                                        <input type='hidden' name='id_module' value=$info[id_module]/>
                                        <input type='hidden' name='id_stagiaire' value=$info[id_stagiaire]/>
                                        <textarea id='ta_com' name='commentaire' rows='2' cols='100'>$info[avis_prof]</textarea><button id='bouton_com' type='submit' name='ligne_b'>Valider</button></form></td>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Moyenne générale</th>
                            <th><?php echo $moyenne_stagiaire ?></th>
                            <th></th>
                            <th><?php echo $moyenne_classe ?></th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
                <table id = "appreciation">
                    <thead>
                        <tr>
                            <th>Appréciation globale</th>
                        </tr>
                    </thead>
                    <tbody>
                    <form method="POST">
                        <input type="hidden" name="id_stagiaire" value="<?= $id_stagiaire ?>"/>
                        <input type="hidden" name="id_bilan" value="<?= $id_bilan ?>"/>
                        <tr>
                            <td>
                                <textarea id="ta_app" name="commentaire" rows="10" cols="100"><?= $avis_proviseur ?></textarea> 
                                <button id="bouton_app" type="submit" name="bulletin">Valider</button>
                            </td>
                        </tr>
                    </form>
                    </tbody>
                </table>
                <table id = "signature">
                    <thead>
                        <tr>
                            <th>Cachet et signature du responsable d'établissement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="bloc"></td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <footer>
                <p>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
            </footer>
        </main>
    </body>
</html>

