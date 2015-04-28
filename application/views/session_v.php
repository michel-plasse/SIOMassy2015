<html>
    <head> 
        <meta charset="utf-8">
        <title>Gestion des Intervenants</title>
        <link rel = "stylesheet" type = "text/css" href = "items/css/BeatPicker.min.css"/>
        <script type="text/javascript">
            function ajouterLigne()
            {
                var tableau = document.getElementById("tableau");

                var ligne = tableau.insertRow(-1);//on a ajouté une ligne

                var colonne1 = ligne.insertCell(0);//on a une ajouté une cellule
                colonne1.innerHTML += document.getElementById("titre").value;//on y met le contenu de titre

                var colonne2 = ligne.insertCell(1);//on ajoute la seconde cellule
                colonne2.innerHTML += document.getElementById("auteur").value;

            }
        </script>
        <script type="text/javascript">
            function supprimerLigne(num)
            {
                document.getElementById("tableau").deleteRow(num);
            }
        </script>

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
                                <input type="text" name="listeDeroul"/>

                                <button type="submit" name="supprimer" onclick="supprimerLigne(this.parentNode.rowIndex);">X</button>	
                                <button type="submit" name="ajouter" onclick="ajouterLigne();">+</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Maths</td>
                            <td>
                                <input type="text" name="listeDeroul"/>
                                <button type="submit" name="supprimer" onclick="supprimerLigne(this.parentNode.rowIndex);">X</button>	
                                <button type="submit" name="ajouter" onclick="ajouterLigne();">+</button>	
                            </td>
                        </tr>
                        <tr>
                            <td>Economie-Droit</td>
                            <td>
                                <input type="text" name="listeDeroul"/>
                                <button type="submit" name="supprimer" onclick="supprimerLigne(this.parentNode.rowIndex);">X</button>	
                                <button type="submit" name="ajouter" onclick="ajouterLigne();">+</button>	
                            </td>
                        </tr>
                        <tr>
                            <td>Anglais</td>
                            <td>
                                <input type="text" name="listeDeroul"/>
                                <button type="submit" name="supprimer" onclick="supprimerLigne(this.parentNode.rowIndex);">X</button>	
                                <button type="submit" name="ajouter" onclick="ajouterLigne();">+</button>	
                            </td>
                        </tr>
                        <tr>
                            <td>SLAM</td>
                            <td>
                                <input type="text" name="listeDeroul"/>
                                <button type="submit" name="supprimer" onclick="supprimerLigne(this.parentNode.rowIndex);">X</button>	
                                <button type="submit" name="ajouter" onclick="ajouterLigne();">+</button>	
                            </td>
                        </tr>

                    </tbody>	

                </table>

            </section>
        </main>
    </body>
</html>
