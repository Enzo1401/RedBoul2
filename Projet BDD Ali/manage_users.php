<?php
include("header.php");
include("BDD/bdd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id_user = $_POST['id_user'];

    if ($action === 'update') {
        // Modifier le rôle de l'utilisateur
        $id_role = $_POST['id_role'];
        $stmt = $bdd->prepare("UPDATE users SET id_role = ? WHERE id_users = ?");
        $stmt->execute([$id_role, $id_user]);

        $_SESSION['message'] = "Le rôle de l'utilisateur a été mis à jour avec succès.";
    } elseif ($action === 'delete') {
        // Supprimer l'utilisateur
        $stmt = $bdd->prepare("DELETE FROM users WHERE id_users = ?");
        $stmt->execute([$id_user]);

        $_SESSION['message'] = "L'utilisateur a été supprimé avec succès.";
    }

    header("Location: hierarchie.php");
    exit;
}
?>
