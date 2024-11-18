<?php
// Récupérer la base de données 
include("BDD/bdd.php");
include 'header.php';   

// Récupérer les variables de commande et d'info user
$name = $_POST['nom'];
$prenom = $_POST['prenom'];
$address = $_POST['adresse'];
$mail = $_POST['email'];
$password = $_POST['passwords'];
$id_role=1;

// Préparer les requêtes pour insérer les données
$user = $bdd->prepare('INSERT INTO users(nom, prenom, adresse, email, passwords, id_role) VALUES(?, ?, ?, ?, ?, ?)');

// En-tête HTML avec inclusion du fichier CSS
echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Confirmation de l'inscription</title>
    <link rel='stylesheet' href='style-sendCommande.css'>
</head>
<body>";

// Vérification et exécution des requêtes
if ($user->execute([$name, $prenom, $address, $mail, $password, $id_role])) {
    echo "<div class='order-message'>
               Merci pour votre inscription
              </div>
              <a href='index.php' class='btn-redirect'>Retour à l'accueil</a>";

} else {
    echo "<div class='order-message' style='background-color: #dc3545;'>
            Une erreur s'est produite durant votre inscription, merci de réessayer plus tard
          </div>";
}

echo "</body>
</html>";
?>