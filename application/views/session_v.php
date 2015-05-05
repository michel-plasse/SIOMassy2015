<!DOCTYPE html>
<head> 
    <meta charset="utf-8">
    <title>Gestion des Intervenants</title>
    <link rel = "stylesheet" type = "text/css" href = "items/css/BeatPicker.min.css"/>
    <style>
        body
        {
            font-family: tahoma;	
        }
        h1
        {
            font-family: tahoma;
            text-align: center;
            color: black;	
        }
        table
        {
            border-collapse: collapse;
        }
        thead
        {
            text-align: center;
        }
        td, th, caption
        {
            border: 1px solid black;
        }
        button
        {
            float: right;
        }
    </style>
</head>
<body>
    <?php
    $this->load->view('header_v');
    ?>
    <main>
        <section>
            <header id = "intervenants">
                <a href = "index.php"><img alt="logo" src=""/></a>
            </header>
            <form method = "POST" id="formulaire_intervenants">
                <table id="Intervenants">
                    <caption>Gestion des Intervenants</caption>
                    <thead>
                    <th>Modules</th>
                    <th>Intervenants</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($modules as $id_module => $nom_module) {
                            ?>
                            <tr>
                                <td>  <?= $nom_module ?></td>
                                <td>
                                    <?= form_dropdown('idFormateur', $formateurs); ?>
                                    <button type="submit" name="supprimer">X</button>	
                                    <button type="submit" name="ajouter">+</button>
                                    <?php
                                    if (isset($_POST['ajouter'])) {
                                        echo $formateurs;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>	
                </table>
            </form>
        </section>
    </main>
</body>
</html>
