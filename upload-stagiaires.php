<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  demander();
} else {
  traiter();
}

function demander() {
  ?>
  <h1>Import de stagiaires</h1>
  <form enctype="multipart/form-data" action="" method="post">
    <!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- Le nom de l'élément input détermine le nom dans le tableau $_FILES -->
    Fichier csv : <input name="stagiaires" type="file" />
    <input type="submit" value="Envoyer le fichier" />
  </form>
  <?php
}

function traiter() {
  // Fichier journal
  $logPath = realpath("/logs/" . date("y-m-d_G-i-s") . ".log");
  $file = fopen($logPath, "w");
  // Colonnes requises
  $required = ['civilite', 'prenom', 'nom', 'adresse', 'code_postal', 'ville',
      'telephone', 'telephone2', 'email'];
  // Recuperer données
  $filename = str_replace("\\", "/", $_FILES["stagiaires"]['tmp_name']);
  $contents = file_get_contents($filename);
  // Coupe la chaine en morceaux
  $csv = explode("\r\n", $contents);
  $fields = explode(";", $csv[0]);
  for ($i = 0; $i < count($fields); $i++) {
    $fields[$i] = strtolower($fields[$i]);
  }
  // Verifier que les requis sont la
  $manquants = array_diff($required, $fields);
  if (count($manquants) > 0) {
    die("Colonnes requises manquantes : " . join(", ", $manquants));
  }

  try {
    $sql = "INSERT INTO personne(civilite, prenom, nom, adresse, code_postal, ville,
            telephone, telephone2, email, mot_passe)
            VALUES (:civilite, :prenom, :nom, :adresse, :code_postal, :ville,
            :telephone, :telephone2, :email, :mot_passe)";
    $db = getConnexion();
    $stmt = $db->prepare($sql);
    for ($i = 1; $i < count($csv); $i++) {
      print "<li>$csv[$i]</li>";
      if ($csv[$i] != "") {
        // Recupere sous forme d'un tableau associatif la ligne
        $line = array_combine($fields, explode(";", $csv[$i]));
        foreach ($required as $col) {
          $stmt->bindValue(":$col", $line[$col]);
        }
        // Mot de passe et date en dur
        $stmt->bindValue(":mot_passe", "");
        $ok = $stmt->execute();
        if ($ok) {
          print("<li>$i ok</li>");
        } else {
          $errorCode = $stmt->errorInfo()[1];
          if ($errorCode == 1062) {
            // Doublon (email)
            fwrite($file, "[doublon] $csv[$i]\n");
            print "<li>$i doublon</li>";
          } else {
            fwrite($file, "[$errorCode] $csv[$i]\n");
            print "<li>$i erreur SQL $errorCode</li>";
          }
        }
      }
    }
  } catch (PDOException $e) {
    print $e->getMessage();
  }
  fclose($file);
}

/** Fournit une connection à la base test, en UTF-8 */
function getConnexion() {
  $dsn = 'mysql:dbname=db524752934;host=localhost';
  $user = 'dbo524752934';
  $password = 'Greta2014';
  $bdd = new PDO($dsn, $user, $password);
  // Forcer la communication en utf-8
  $bdd->exec("SET character_set_client = 'utf8'");
  return $bdd;
}
?>
