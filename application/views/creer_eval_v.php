<html>
    <head>
        <title>Création d'une évaluation</title>
        <link rel="stylesheet" type="text/css" href="<?= $cssUrl ?>"/>
        <link rel = "stylesheet" type = "text/css" href = "<?= $cssBPUrl ?>"/>
        <script type="text/javascript" src = "<?= $biblioJSUrl ?>"></script>
        <script type = "text/javascript" src = "<?= $jsBPUrl ?>"></script>
    </head>

    <body>
        <section>
            <?php
            $this->load->view('header_v');
            $this->load->view('navigation_v');
            ?>
            <header id = "creation_evaluation" method = "POST">
                <h1>Création d'une évaluation</h1>
            </header>

            <form method = "POST" id="formulaire_evaluation">
                <table border="0">
                    <tr>
                        <th><label id = "session"> Session : </label></th>
                        <td><?= form_dropdown('idSession', $sessions); ?></td>
                    </tr>
                    <tr>
                        <th><label id="module">Discipline : </label></th>
                        <td><?= form_dropdown('idModule', $modules); ?></td>
                    </tr>
                    <tr>
                        <th><label id="formateur">Formateur : </label></th>
                        <td><?= form_dropdown('idFormateur', $formateurs); ?></td>
                    </tr>
                    <tr>
                        <th><label id = "date">Date : </label></th>
                        <td><input type="text" name="dateevaluation" placeholder="Date de l'évaluation" data-beatpicker="true" data-beatpicker-position="['10','50']"  data-beatpicker-extra="customOptions" data-beatpicker-format="['YYYY','MM','DD'],separator:'-'" data-beatpicker-module="icon"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" name="insert_eval">Valider</button>
                            <button type="reset">Réinitialiser</button>
                        </td>
                    </tr>
                </table>
            </form>
            <script type="text/javascript">
                customOptions = {
                    monthsFull: ["Janvier", "F\351vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao\373t", "Septembre", "Octobre", "Novembre", "D\351cembre"],
                    daysSimple: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
                }
            </script>
        </section>
    </body>
</html>
