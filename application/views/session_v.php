<!DOCTYPE html>
<head> 
    <meta charset="utf-8">
    <title>Gestion des Intervenants</title>
    <link rel="stylesheet" type="text/css" href="/gestionmassy/items/css/allproject.css"/>
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
            padding: 4px;
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
    $this->load->view('navigation_v');
    ?>
    <main>
        <section>
            <header id = "intervenants">
            </header>
            <table id="Intervenants" >
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
                                <?php
                                $formateursDuModule = array();
                                if (array_key_exists($id_module, $formateursParModule)) {
                                    $formateursDuModule = $formateursParModule[$id_module];
                                }
                                foreach ($formateursDuModule as $id_formateur => $nom_formateur) {
                                    ?>
                                    <form method="POST">
                                        <input type="hidden" name="id_module" value="<?= $id_module ?>"/>
                                        <input type="hidden" name="id_formateur" value="<?= $id_formateur ?>"/>
                                        <button type="submit" name="action" value="supprimer">X</button>
                                        <?= $nom_formateur ?>
                                    </form>
                                    <?php
                                }
                                ?>
                                <form method = "POST">
                                    <?= form_dropdown('id_formateur', $formateurs); ?>
                                    <button type="submit" name="action" value="ajouter">+</button>
                                    <input type="hidden" name="id_module" value="<?= $id_module ?>"/>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>	
            </table>
        </section>
    </main>
</body>
</html>
