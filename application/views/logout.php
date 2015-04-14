<?php

// On démarre la session
session_start ();

// On détruit les variables de la session
session_unset ();

// On détruit la session
session_destroy ();

// On redirige le visiteur vers la page d'accueil

header ('location: welcome_message.php');
?>