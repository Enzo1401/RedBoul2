<?php
include("BDD/bdd.php");

$idProduct = $_GET['id'];

$deleteRequest = $bdd ->prepare('DELETE FROM produit WHERE id_produit = :id');

$deleteRequest ->bindParam(':id', $idProduct, PDO::PARAM_INT);

if($deleteRequest ->bindParam(':id', $idProduct, PDO::PARAM_INT))
{
    include 'header.php';
    //créer un message de succès
    echo '<div style="text-align: center; margin-top: 100px;">';
    echo '<h2>Votre produit a bien été supprimé !</h2>';
    echo '<a href="index.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #043464; color: white; text-decoration: none; border-radius: 5px;">Revenir à l accueil</a>';
    echo '</div>';
}
else
{
    include 'header.php';
    echo '<div style="text-align: center; margin-top: 20px;">';
    echo '<h2>Une erreur est survenue lors de la suppression du produit.</h2>';
    echo '<a href="index.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #f44336; color: white; text-decoration: none; border-radius: 5px;">Revenir à l accueil</a>';
    echo '</div>';
}

$deleteRequest ->execute()



?>
