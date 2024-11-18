<?php
// Récupérer la base de données 
include("BDD/bdd.php");
include 'header.php';   

// Récupérer les variables de commande et d'info user
$product = $_POST['produit'];
$quantite = $_POST['quantite'];
$name = $_POST['nom'];
$prenom = $_POST['prenom'];
$address = $_POST['adresse'];
$mail = $_POST['email'];
$commentaireClient = $_POST['message'];
$date = date("Y-m-d");

// Préparer les requêtes pour insérer les données
$sendCommande = $bdd->prepare('INSERT INTO commandes(id_produit, quantite, date_commande, commentaire) VALUES(?, ?, ?, ?)');
$stockUser = $bdd->prepare('INSERT INTO users(nom, prenom, adresse, email) VALUES(?, ?, ?, ?)');

// En-tête HTML avec inclusion du fichier CSS
echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Confirmation de Commande</title>
    <link rel='stylesheet' href='style-sendCommande.css'>
</head>
<body>";

// Vérification et exécution des requêtes
if ($stockUser->execute([$name, $prenom, $address, $mail])) {
    if ($sendCommande->execute([$product, $quantite, $date, $commentaireClient])) {
        // Message de confirmation et bouton de redirection
        echo "<div class='order-message'>
                Votre commande a bien été prise en compte
              </div>
              <a href='index.php' class='btn-redirect'>Retour à l'accueil</a>";
    } else {
        echo "<div class='order-message' style='background-color: #dc3545;'>
                Une erreur s'est produite durant la validation de votre commande, merci de réessayer plus tard
              </div>";
    }
} else {
    echo "<div class='order-message' style='background-color: #dc3545;'>
            Une erreur s'est produite durant la validation de votre commande, merci de réessayer plus tard
          </div>";
}

echo "</body>
</html>";
?>
