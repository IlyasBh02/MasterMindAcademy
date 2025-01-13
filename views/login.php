<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');  // Si l'utilisateur est déjà connecté, redirige vers le tableau de bord
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données
    require_once 'config.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête pour récupérer l'utilisateur par email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Si l'utilisateur existe et que le mot de passe est correct
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];  // Enregistrer le rôle dans la session

        header('Location: dashboard.php');  // Redirection vers le tableau de bord
        exit();
    } else {
        $error = 'Email ou mot de passe incorrect';
    }
}
?>

<!-- Formulaire de connexion -->
<form action="login.php" method="POST">
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Mot de passe</label>
    <input type="password" name="password" required>
    <button type="submit">Se connecter</button>
    <?php if (isset($error)) echo '<p>'.$error.'</p>'; ?>
</form>
