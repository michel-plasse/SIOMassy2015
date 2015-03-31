<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <style type="text/css">

      ::selection{ background-color: #E13300; color: white; }
      ::moz-selection{ background-color: #E13300; color: white; }
      ::webkit-selection{ background-color: #E13300; color: white; }

      body {
        background-color: #fff;
        margin: 40px;
        font: 13px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
      }

      a {
        color: #003399;
        background-color: transparent;
        font-weight: normal;
      }

      h1 {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 19px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
      }

      code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
      }

      #body{
        margin: 0 15px 0 15px;
      }

      p.footer{
        text-align: right;
        font-size: 11px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
      }

      #container{
        margin: 1em;
        border: 1px solid #D0D0D0;
        -webkit-box-shadow: 0 0 8px #D0D0D0;

      }
      #menuGauche {
        float: left;
        margin-right: 1em;
       }
      #menuHaut {
      }
      #corps {
        }
    </style>
  </head>
  <body>

    <div>
      <!--
      <div id="menuGauche">
        <?php
        $size = count($sessions);
        echo form_dropdown("idSession", $sessions, NULL, "size=$size");
        ?>
        </select>
      </div>
      -->
      <div id="menuHaut">
        <a id="lienBilans" href="bilans">Conseils de classe</a>
        -
        <a id="lienEvaluations" href="evaluations">Evaluations</a>
       </div>
      <div id="corps">
        <h1>Proposition de maquette</h1>
      </div>
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