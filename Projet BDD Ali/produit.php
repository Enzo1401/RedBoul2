<?php
include 'header.php';
include 'BDD/bdd.php';

session_start();

echo "<body class='body1'>";
echo "<link rel='stylesheet' href='style-index.css'>";

// Récupère les produits
$produits = $bdd->query("SELECT * FROM produit")->fetchAll();

// Vérifie si l'utilisateur est connecté et récupère son rôle
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1;

echo "<main class='container'>";
echo "<h1 class='title-product'>Nos Produits</h1>";

// Si l'utilisateur est admin, affiche le bouton pour ajouter un produit
if ($isAdmin) {
    echo "<div class='add-product'>";
    echo "<a href='ajouter_produit.php' class='button-ajout'>Ajouter un nouvel article</a>";
    echo "</div>";
}

echo "<div class='product-grid'>";

foreach ($produits as $produit) {
    echo "
    <div class='product-card'>
        <img src='" . $produit['images'] . "' alt='" . $produit['nom'] . "' class='product-image'>
        <h2 class='product-name'>" . $produit['nom'] . "</h2>
        <p class='product-description'>" . $produit['descriptions'] . "</p>
        <p class='product-price'>" . $produit['prix'] . " €</p>
        <div class='product-actions'>";

    if ($isAdmin) {
        echo "<a href='modifyProduct.php?id=" . $produit['id_produit'] . "' class='btn btn-edit'>Modifier</a>";
        echo "<a href='deleteProduct.php?id=" . $produit['id_produit'] . "' class='btn btn-delete'>Supprimer</a>";
    }

    echo "</div>
    </div>";
}

echo "</div>";
echo "</main>";
?>
 




