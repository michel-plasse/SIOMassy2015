<header>
    <?php
    $url = base_url("items/images/banniere.jpg");
    ?>
    <a href = "<?= base_url() ?>"><img src="<?= $url ?>" alt = "LogoGreta"/></a>
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
            <input type="text" name="email" placeholder="Email" value="<?= $this->input->post('email') ?>">
            <input type="password" name="mdp" placeholder="Mot de passe">
            <button type="submit" name="connexion" >Connexion</button>
            <?= $msgConnexion ?>
        </form>
        <?php
    }
    ?>
</header>
