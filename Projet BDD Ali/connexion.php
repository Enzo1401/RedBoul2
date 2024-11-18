<?php
include("header.php");
include("BDD/bdd.php");
session_start(); // Démarre une session pour gérer l'authentification

// Vérifie si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    // Si l'utilisateur est connecté, affiche un message et un bouton de déconnexion
    echo "<link rel='stylesheet' href='style-connexion.css'>";
    echo "<div class='connected-container'>";
    echo "<p>Vous êtes déjà connecté.</p>";
    echo "<form method='post' action='deconnexion.php'>
            <button type='submit' class='btn'>Déconnexion</button>
        </form>";
    echo "</div>";
} else {
    // Vérifie si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer l'email et le mot de passe envoyés par l'utilisateur
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Préparer une requête pour vérifier si l'utilisateur existe avec cet email et ce mot de passe
        $stmt = $bdd->prepare("SELECT * FROM users WHERE email = ? AND passwords = ?");
        $stmt->execute([$email, $password]);
        $user = $stmt->fetch();

        // Vérifie si un utilisateur a été trouvé
        if ($user) {
            // Si les informations d'identification sont correctes, stocke l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id_users'];
            $_SESSION['user_role'] = $user['id_role'];
            
            // Redirige vers la page d'accueil ou une autre page autorisée
            header("Location: index.php");
            exit;
        } else {
            // Si les informations sont incorrectes, message d'erreur
            $error = "Adresse e-mail ou mot de passe incorrect.";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="fr"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="style-connexion.css">
    </head>
    <body>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
        <form method="post" action="">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Connexion</button>
        </form>
    </body>
    </html>

    <?php
}
?>