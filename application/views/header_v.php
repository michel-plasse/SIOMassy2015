<header>
    <?php
    if (!isset($msgConnexion)) {
        $msgConnexion = "";
    }
    if (isset($_SESSION["user"])) {
        $url = base_url("connexion/fin");
        ?>
        <form id="FormDeconnexion" action="<?= $url ?>" method="post">
            <button type="submit" >Déconnecter
                <?= $_SESSION["user"]["email"] ?></button>
        </form>
        <?php
    } else {
        $url = base_url("connexion");
        ?>
        <form id="FormConnexion" action="<?= $url ?>" method="post">
            Email : <input type="text" name="email" value="<?= $this->input->post('email') ?>">
            Mot de passe : <input type="password" name="mdp">
            <button type="submit" name="connexion" >Connexion</button>
            <?= $msgConnexion ?>
        </form>
        <?php
    }
    ?>
    <img src = "items/images/banniere.jpg" alt = "LogoGreta"/>
</header>
