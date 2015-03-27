<html>
    <head>
        <link rel="stylesheet" type="text/css" href="items/css/allproject.css"/>
        <link rel="stylesheet" type="text/css" href="items/css/BeatPicker.min.css"/>
        <script type="text/javascript" src = "items/js/jquery.1.8.3.js"></script>
        <script type="text/javascript" src="items/js/BeatPicker.min.js"></script>
        <title>Création d'un bilan/ Conseil de classe</title>
    </head>
    <body>
        <section>
            <header id = "liste_bilans" method = "POST">
                <h1>Listes des bilans/ Conseils de classe</h1>
            </header>
            <ul>
                <?php 
                    foreach ($sessions as $session) {
                        echo "<li>$session[nom]</li>";
                    }
                ?>
            </ul>
        </section>
    </body>
</html>
