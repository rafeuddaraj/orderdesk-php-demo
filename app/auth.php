<?php
// Login, logout, and page guards.

function current_user()
{
    return $_SESSION['user'] ?? null;
}

function attempt_login(PDO $db, $email, $password)
{
    $stmt = $db->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password_hash'])) {
        return false;
    }

    session_regenerate_id(true);
    unset($user['password_hash']);
    $_SESSION['user'] = $user;
    return true;
}

function require_login()
{
    if (!current_user()) {
        redirect('/login.php');
    }
}

function require_admin()
{
    require_login();
    if (current_user()['role'] !== 'admin') {
        http_response_code(403);
        exit('Only admins can see this page.');
    }
}
