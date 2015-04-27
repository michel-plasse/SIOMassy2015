<html>
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
	
	background-color: #6d7feb;
	
	}
	td, th, caption
    {
    border: 1px solid black;
	}
	button
	{
	float: right;
	font: bold;
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
                <table id="Intervenants">
                    <caption>Gestion des Intervenants</caption>
                    <thead>
                    <th>Modules</th>

                    <th>Intervenants</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Français</td>
                            <td>
                                <form action="" method="post" >
                                    <button type="submit" name="ajouter" >+</button>	
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>Maths</td>
                            <td>
                                <form action="" method="post">
                                    <button type="submit" name="ajouter" >+</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>Economie-Droit</td>
                            <td>
                                <form action="" method="post">
                                    <button type="submit" name="ajouter" >+</button>

                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>Anglais</td>
                            <td>
                                <form action="" method="post">
                                    <button type="submit" name="ajouter">+</button>

                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>SLAM</td>
                            <td>
                                <form action="" method="post">
                                    <button type="submit" name="ajouter" >+</button>

                                </form>
                            </td>
                        </tr>

                    </tbody>	

                </table>

            </section>
        </main>
    </body>
</html>
