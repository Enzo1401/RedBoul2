<?php
include("header.php");
?>

<?php
include("BDD/bdd.php");
$produits = $bdd->query("SELECT * FROM produit")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>

    <link rel="stylesheet" href="style-commande.css">
</head>
<body>

    <form action="sendInscription.php" method="post" class="form">
        <div>
            <label for="nom"></label>
            <input type="text" name="nom" id="nom" placeholder="Entrez votre nom" required>
        </div>
        <div>
            <label for="prenom"></label>
            <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom" required>
        </div>
        <div>
            <label for="adresse"></label>
            <input type="text" name="adresse" id="adresse" placeholder="Entrez votre adresse" required>
        </div>
        <div>
            <label for="email"></label>
            <input type="email" name="email" id="email" placeholder="Entrez votre adresse mail" required>
        </div>
        <div>
            <label for="passwords"></label>
            <input type="text" name="passwords" id="passwords" placeholder="Entrez votre mot de passe" required>
        </div>
        <div>
            <button type="submit" class="button">Valider</button>
        </div>
    </form>
</body>
</html>