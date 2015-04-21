<html>
    <head>
        <title>GestionIntervenants</title>
    </head>
    <body>
        <?= $this->load->views('header_v')?>
        <form action="" method="POST">
            <button type="submit" name="supprimer">Supprimer</button>
            <label id="formateur">Formateur : </label></th>
            <?= form_dropdown('idFormateur', $formateurs); ?>
            
        </form>
    </body>
</html>
