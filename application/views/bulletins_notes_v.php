<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $cssUrl ?>"/>
        <script type="text/javascript" src = "<?= $biblioJSUrl ?>"></script>
        <title>Liste des stagaires</title>
    </head>
    <body>
        <section>
            <?php
            $this->load->view('header_v');
            ?>
            <?php
            $this->load->view('navigation_v');
            ?>
            <header id = "liste_bilans" method = "POST">
                <h1>Liste des stagiaires</h1>
            </header>
            <form method = "GET" id="formulaire_bulletin" name="formulaire_bulletin" action = "javascript: afficherBulletin();">
                <label id="bilan">Conseil de classe : </label>
                <?= form_dropdown('id_bilan', $conseils); ?>
                <label id="stagiaire">Stagiaire : </label>
                <?= form_dropdown('id_stagiaire', $stagiaires); ?>
                <button type="submit">Valider</button>
                <input type ="hidden" name ="id_session" value ="$id_session"/>
            </form>
            <script>
                function afficherBulletin() {
                    var href = "/gestionmassy/bulletin_notes/index/"
                        + <?= $id_session ?> + "/"
                        + document.formulaire_bulletin.id_bilan.value + "/"
                        + document.formulaire_bulletin.id_stagiaire.value;
                   location.href = href;
                }
            </script>
        </section>
    </body>
</html>