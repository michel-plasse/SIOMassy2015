<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?= $cssUrl ?>"/>
        <title>Welcome to CodeIgniter</title>
    </head>
    <body>
        <?php
        $this->load->view('header_v');
        ?>
        <!--
        <div id="menuGauche">
          </select>
        </div>
        -->

        <nav>
            <ul>
                <li><a id="lienBilans" href="bilans">Conseils de classe</a></li>
                <li><a id="lienEvaluations" href="evaluations">Evaluations</a></li>
                <li><a id="lienBulletins" href="bulletins_notes">Bulletins de notes</a></li>
            </ul>
        </nav>
        <!--      <div id="menuHaut">
                <a id="lienBilans" href="bilans">Conseils de classe</a>
                -
                <a id="lienEvaluations" href="evaluations">Evaluations</a>
               </div>-->
        <div id="corps">
            <h1>Proposition de maquette</h1>
        </div>


        <!--
         <div id="container">
             <h2>Liens provisoires</h2>
             <ul>
               <li><a href="bilans">Conseils de classe</a></li>
               <li><a href="creation_bilan">Créer un conseil de classe</a></li>
               <li><a href="creer_eval">Créer une évaluation</a></li>
             </ul>
    
             <hr/>
             <h1>Welcome to CodeIgniter!</h1>
    
             <div id="body">
               <p>The page you are looking at is being generated dynamically by CodeIgniter.</p>
    
               <p>If you would like to edit this page you'll find it located at:</p>
               <code>application/views/welcome_message.php</code>
    
               <p>The corresponding controller for this page is found at:</p>
               <code>application/controllers/welcome.php</code>
    
               <p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
             </div>
        -->
    </div>
    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

</body>
</html>
