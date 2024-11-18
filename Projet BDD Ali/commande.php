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
    <title>Commander un produit</title>

    <link rel="stylesheet" href="style-commande.css">
</head>
<body>

    <form action="sendCommande.php" method="post" class="form">
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
            <label for="produit">Sélectionnez un produit :</label>
                <select name="produit" id="produit" required>
                    <?php
                    foreach ($produits as $produit) {
                        echo '<option value="' . $produit['id_produit'] . '">' . $produit['nom'] . '</option>';
                    }
                    ?>
                </select>
            <br>
        </div>
        
        <div>
            <label for="quantite">Quantité :</label>
            <input type="number" name="quantite" id="quantite" placeholder="Entrez la quantité" min="1" value="1" required>
        </div>

        <div>
             <textarea name="message" placeholder="Ecrivez-nous"></textarea>
        </div>
        <div>
            <button type="submit" class="button">Commander</button>
        </div>
    </form>
</body>
</html>