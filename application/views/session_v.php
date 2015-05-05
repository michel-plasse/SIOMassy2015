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
            </header>

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
                                <form method = "POST" id="formulaire_intervenants">
                                    <?= form_dropdown('id_formateur', $formateurs); ?>
                                    <button type="submit" name="action" value="supprimer">X</button>	
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
