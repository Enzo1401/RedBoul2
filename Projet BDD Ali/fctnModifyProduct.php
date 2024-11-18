<?php
include("BDD/bdd.php");

$id = $_GET['id'];

if (!empty($_POST['nom']))
{
    $nom = $_POST['nom'];
    $updateProduct = $bdd ->prepare('UPDATE produit SET nom = :nom WHERE id_produit = :id');
    $updateProduct ->bindParam(":nom", $nom);
    $updateProduct ->bindParam(":id", $id, PDO::PARAM_INT);
    $updateProduct ->execute();
}

if (!empty($_POST['description']))
{
    $description = $_POST['description'];
    $updateProduct = $bdd ->prepare('UPDATE produit SET descriptions = :descriptions WHERE id_produit = :id');
    $updateProduct ->bindParam(":descriptions", $description);
    $updateProduct ->bindParam(":id", $id, PDO::PARAM_INT);
    $updateProduct ->execute();
}

if (!empty($_POST['prix']))
{
    $prix = $_POST['prix'];
    $updateProduct = $bdd ->prepare('UPDATE produit SET prix = :prix WHERE id_produit = :id');
    $updateProduct ->bindParam(":prix", $prix);
    $updateProduct ->bindParam(":id", $id, PDO::PARAM_INT);
    $updateProduct ->execute();
}

if (!empty($_POST['quantite']))
{
    $stock = $_POST['quantite'];
    $updateProduct = $bdd ->prepare('UPDATE produit SET stock = :stock WHERE id_produit = :id');
    $updateProduct ->bindParam(":stock", $stock);
    $updateProduct ->bindParam(":id", $id, PDO::PARAM_INT);
    $updateProduct ->execute();
}

if (!empty($_FILES['image']))
{
    $image = $_FILES['image']['name'];
    $image = "image/" . $image;
    $updateProduct = $bdd ->prepare('UPDATE produit SET images = :images WHERE id_produit = :id');
    $updateProduct ->bindParam(":images", $image);
    $updateProduct ->bindParam(":id", $id, PDO::PARAM_INT);
    $updateProduct ->execute();
}

?>