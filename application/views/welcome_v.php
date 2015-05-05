<?php 
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="/gestionmassy/items/css/allproject.css"/>
        <title>Gestion du Greta de Massy</title>
    </head>
    <body>
        <main>
            <?php
            $this->load->view('header_v');
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
