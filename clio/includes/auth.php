<?php
session_start();
require_once 'db.php';

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header("Location: " . BASE_URL . "login.php");
        exit();
    }
}

function login($username, $password)
{
    $db = Database::getInstance();
    $stmt = $db->prepare("SELECT id, username, password, role FROM users WHERE username = :username LIMIT 1");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        return true;
    }
    return false;
}

function registerUser($username, $email, $password, $role = 'student')
{
    $db = Database::getInstance();

    // Verificar si existe
    $stmt = $db->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
    $stmt->execute([':username' => $username, ':email' => $email]);
    if ($stmt->fetch()) {
        return "El usuario o correo ya existe.";
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $db->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashed_password,
            ':role' => $role
        ]);
        return true; // Éxito
    } catch (PDOException $e) {
        return "Error al registrar: " . $e->getMessage();
    }
}

function logout()
{
    session_destroy();
    header("Location: " . BASE_URL . "login.php");
    exit();
}
?>