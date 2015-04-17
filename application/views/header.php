<header>
  <?php
  if (isset($_SESSION["email"])) {
    $url = base_url("connexion/fin");
    ?>
    <form id="FormDeconnexion" action="<?= $url ?>" method="post">
      <button type="submit" >Déconnecter
        <?= $_SESSION["email"] ?></button>
    </form>
    <?php
  } else {
    ?>
    <form id="FormConnexion" action="" method="post">
      Email : <input type="text" name="email">
      Mot de passe : <input type="password" name="mdp">
      <button type="submit" name="connexion" >Connexion</button>
      <?= $msgConnexion ?>
    </form>
    <?php
  }
  ?>
  <img src = "items/images/banniere.jpg" alt = "LogoGreta"/>
</header>
