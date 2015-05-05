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
            $this->load->view('navigation_v');
            ?>
<!--            <nav id="nav_welcome">
                <ul>  
                    <li><a id="lienBilans" href="bilans">Conseils de classe</a></li>
                    <li><a id="lienEvaluations" href="evaluations">Evaluations</a></li>
                    <li><a id="lienBulletins" href="bulletins_notes">Bulletins de notes</a></li>
                    <li><a id="lienIntervenants" href="session">Gestion Intervenants</a></li>
                    <li><a id="lienCreerEval" href="creer_eval">Création d'une évaluation</a></li>
                </ul>
            </nav>-->
            <section id="section_welcome">
                <h1>Proposition de maquette</h1>
            </section>
            <footer>
                <p>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
            </footer>
        </main>
    </body>
</html>