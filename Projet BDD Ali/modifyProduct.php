<?php
include("header.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='style-modifyProduct.css'>
    <title>Modifier le produit</title>
</head>
<body>
        <?php
            $id = $_GET['id'];
        echo('<form action="fctnModifyProduct.php?id=' .$id . '" method="post" enctype="multipart/form-data" class="form">')
        ?>
            <div>
            </div>
            <div>
                <label for="nom">Nom du produit :</label>
                <input type="text" name="nom" id="nom" placeholder="Nouveau nom du produit">
            </div>
            <div>
                <label for="description">Description :</label>
                <textarea name="description" id="description" placeholder="Nouvelle description du produit"></textarea>
            </div>
            <div>
                <label for="prix">Prix :</label>
                <input type="number" name="prix" id="prix" placeholder="Nouveau prix" step="0.5">
            </div>
            <div>
                <label for="prix">Quantitée :</label>
                <input type="number" name="quantite" id="quantite" placeholder="Nouvelle quantitée" step="1">
            </div>
            <div>
                <label for="image">Nouvelle image du produit :</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>
            <div>
                <button type="submit" class="button-ajout" href="index.php">Modifier l'article</button>
            </div>
        </form>
</body>
</html>