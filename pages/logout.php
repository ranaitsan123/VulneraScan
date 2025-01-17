<?php 
session_start();

// Détruire toutes les variables de session
$_SESSION = array();

// Régénérer l'identifiant de session
session_regenerate_id(true);

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion avec un message de déconnexion réussie
header("Location: index.php?logged_out=true");
exit();

?>
