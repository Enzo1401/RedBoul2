<?php
include("header.php");
include("BDD/bdd.php");

// Récupère tous les utilisateurs
$stmt = $bdd->query("
    SELECT u.id_users, u.nom, u.prenom, u.email, r.role_name, r.id_role 
    FROM users u
    JOIN role r ON u.id_role = r.id_role
");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupère tous les rôles disponibles
$stmtRoles = $bdd->query("SELECT * FROM role");
$roles = $stmtRoles->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="style-hierarchie.css">
</head>
<body>
    <h1 class="hierarchie-title">Gestion des utilisateurs</h1>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <form method="POST" action="manage_users.php">
                        <td><?= htmlspecialchars($user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['prenom']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <select name="id_role">
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?= $role['id_role'] ?>" <?= $user['id_role'] == $role['id_role'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($role['role_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <!-- Modifier le rôle -->
                            <input type="hidden" name="id_user" value="<?= $user['id_users'] ?>">
                            <button type="submit" name="action" class="update" value="update">Modifier le rôle</button>
                            <!-- Supprimer l'utilisateur -->
                            <button type="submit" name="action" class="delete" value="delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
