<!DOCTYPE html>
<?php session_start();
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $cssUrl ?>"/>
        <title>Welcome to CodeIgniter</title>
    </head>
    <body>
        <main>
            <?php
            $this->load->view('header_v');
            ?>
            <?php
            $this->load->view('navigation_v');
            ?>
            <section id="section_welcome">
                <h1>Proposition de maquette</h1>
            </section>
            <footer>
                <p>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
            </footer>
        </main>
    </body>
</html>
