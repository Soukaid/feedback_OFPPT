<?php
session_start();
require_once 'config/database.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $remember = isset($_POST['remember']);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            if ($remember) {
                setcookie('user_login', $user['id'], time() + (86400 * 30), '/');
            }

            header('Location: dashboard.php');
            exit();
        } else {
            header('Location: connexion.html?error=1');
            exit();
        }
    }
} catch(PDOException $e) {
    error_log("Login error: " . $e->getMessage());
    header('Location: connexion.html?error=2');
    exit();
}
?>