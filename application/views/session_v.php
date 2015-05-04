<!DOCTYPE html>
<?php
session_start();
foreach ($modules as $infos_modules) {
    $id_module = $infos_modules["id_modules"];
    $nom = $infos_modules["nom"];
}
?>
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
                        <tr>
                            <td> => <?php echo $nom_module ?></td>
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
                        <tr>
                              <td> => <?php echo $nom_module ?></td>                            
                            <td>
                                <?= form_dropdown('idFormateur', $formateurs); ?>
                                <button type="submit" name="supprimer">X</button>	
                                <button type="submit" name="ajouter">+</button>	
                            </td>
                        </tr>
                        <tr>
                            <td> => <?php echo $nom_module ?></td>
                            <td>
                                <?= form_dropdown('idFormateur', $formateurs); ?>
                                <button type="submit" name="supprimer">X</button>	
                                <button type="submit" name="ajouter">+</button>	
                            </td>
                        </tr>
                        <tr>
                            <td> => <?php echo $nom_module ?></td>
                            <td>
                                <?= form_dropdown('idFormateur', $formateurs); ?>
                                <button type="submit" name="supprimer">X</button>	
                                <button type="submit" name="ajouter">+</button>	
                            </td>
                        </tr>
                        <tr>
                           <td> => <?php echo $nom_module ?></td>
                            <td>
                                <?= form_dropdown('idFormateur', $formateurs); ?>
                                <button type="submit" name="supprimer">X</button>	
                                <button type="submit" name="ajouter">+</button>	
                            </td>
                        </tr>

                    </tbody>	

                </table>
                </form>

            </section>
        </main>
    </body>
</html>
