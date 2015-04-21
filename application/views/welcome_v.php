<!DOCTYPE html>
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
            <nav>
                <ul>
                    <li><a id="lienBilans" href="bilans">Conseils de classe</a></li>
                    <li><a id="lienEvaluations" href="evaluations">Evaluations</a></li>
                    <li><a id="lienBulletins" href="bulletins_notes">Bulletins de notes</a></li>
                </ul>
            </nav>

            <section id="corps">
                <h1>Proposition de maquette</h1>
            </section>>

            <footer class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</footer>
        </main>
    </body>
</html>
