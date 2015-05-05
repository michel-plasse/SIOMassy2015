<!DOCTYPE html>

<?php
session_start();
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

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $cssUrl ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= $cssBPUrl ?>"/>
        <script type="text/javascript" src = "<?= $biblioJSUrl ?>"></script>
        <script type="text/javascript" src="<?= $jsBPUrl ?>"></script>
        <title>Liste des conseils de classe</title>
    </head>
    <body>
        <main>
            <?php
            $this->load->view('header_v');
            ?>
            <?php
            $this->load->view('navigation_v');
            ?>
            <section id="section_bilans">
                <header id = "liste_bilans" method = "POST">
                    <h1>Listes des conseils de classe</h1>
                </header>
                <?php
                echo "<dl>";
                $id_session = 0;
                ?>
                <script type="text/javascript">
                    customOptions = {
                        monthsFull: ["Janvier", "F\351vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao\373t", "Septembre", "Octobre", "Novembre", "D\351cembre"],
                        daysSimple: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
                    }
                </script>
                <?php
                for ($i = 0; $i < count($bilans); $i++) {
                    $row = $bilans[$i];
                    if ($row["id_session"] != $id_session) {
                        $dt = "<dt>$row[nom_session]</dt>\n";
                        $id_session = $row["id_session"];
                        ?>
                        <form id="liste_session<?php echo $row['id_session'] ?>" method="POST" style="display: inline;">
                            <input type="hidden" name="id_session" value="<?= $id_session ?>"/>
                            (<label id = "date"> Date :</label>
                            <input type = "text" name = "date" placeholder = "Date du bilan" data-beatpicker = "true" data-beatpicker-position = "['10','50']"
                                   data-beatpicker-extra = "customOptions" data-beatpicker-format = "['YYYY','MM','DD'],separator:'-'"
                                   data-beatpicker-module = "icon"/>
                                   <?= $dateError ?>
                            <button type="submit">Ajouter</button>)
                        </form>
                        <?php
                    } else {
                        $dt = "";
                    }
                    $id_bilan = $row["id_bilan"];
                    $date = date_format(date_create($row["date_effet"]), 'd-m-Y');
                    $dd = "<dd><a href ='bilans/get/$id_bilan'>- $date</a></dd>";

                    echo "$dt $dd";
                    ?>
                    <?php
                }
                ?>
            </section>
            <footer>
                <p>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
            </footer>
        </main>
    </body>
</html>