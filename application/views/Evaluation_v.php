<html>
  <head>
    <title></title>
  </head>
  <body>
    <h1>Evaluation <?=$evaluation["nom_module"]?>
    du <?=$evaluation["date_effet"]?>,
    par <?=$evaluation["prenom_formateur"]?>
    <?=$evaluation["nom_formateur"]?>
    </h1>
    <table border = "1" cellspacing="0">
      <tr>
        <th>Stagiaire</th>
        <th>Note</th>
      </tr>
      <?php
      foreach ($notes as $ligne) {
        // Url de l'espace personnel du stagiaire
        $url = site_url("stagiaire/$ligne[id_stagiaire]");
        $nom = "$ligne[prenom] $ligne[nom]";
        ?>
        <tr>
          <td><a href="<?= $url ?>"></a><?=$nom?></td>
          <td><?= $ligne["note"] ?></td>
        </tr>
        <?php
      }
      ?>
  </body>
</html>