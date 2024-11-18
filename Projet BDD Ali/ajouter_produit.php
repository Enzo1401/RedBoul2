<?php
include("header.php");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Nouvel Article - REDBOUL</title>
    <link rel="stylesheet" href="style-ajout-produit.css"> <!-- Lien vers votre fichier CSS -->
</head>
<body>

    <main class="container">

        <form action="addProduct.php" method="post" enctype="multipart/form-data" class="form">
            <div>
                <label for="nom">Nom du produit :</label>
                <input type="text" name="nom" id="nom" placeholder="Entrez le nom du produit" required>
            </div>
            <div>
                <label for="description">Description :</label>
                <textarea name="description" id="description" placeholder="Entrez une description du produit" required></textarea>
            </div>
            <div>
                <label for="prix">Prix :</label>
                <input type="number" name="prix" id="prix" placeholder="Entrez le prix" required step="0.5">
            </div>
            <div>
                <label for="prix">Quantitée :</label>
                <input type="number" name="quantite" id="quantite" placeholder="Entrez la quantitée" required step="1">
            </div>
            <div>
                <label for="image">Image du produit :</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <div>
                <button type="submit" class="button-ajout" href="index.php">Ajouter l'article</button>
            </div>
        </form>
    </main>

</body>
</html>