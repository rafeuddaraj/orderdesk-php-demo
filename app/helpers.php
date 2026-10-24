<?php
// Small helpers used by the pages.

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($path)
{
    header('Location: ' . $path);
    exit;
}

function csrf_token()
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function check_csrf()
{
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(400);
        exit('Invalid form token. Please go back and try again.');
    }
}

function render_header($title)
{
    $user = current_user();
    echo '<!doctype html><html lang="en"><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . e($title) . ' · OrderDesk</title>';
    echo '<link rel="stylesheet" href="/assets/style.css"></head><body>';
    echo '<header class="bar"><a class="brand" href="/orders.php">OrderDesk</a>';
    if ($user) {
        echo '<nav><a href="/orders.php">Orders</a>';
        if ($user['role'] === 'admin') {
            echo '<a href="/status.php">Server Status</a>';
        }
        echo '<a href="/logout.php">Log out</a></nav>';
    }
    echo '</header><main>';
}

function render_footer()
{
    echo '</main></body></html>';
}
