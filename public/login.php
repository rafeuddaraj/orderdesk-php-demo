<?php
require __DIR__ . '/../app/bootstrap.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    if (attempt_login($db, trim($_POST['email'] ?? ''), $_POST['password'] ?? '')) {
        redirect('/orders.php');
    }
    $error = 'Email or password is incorrect.';
}

render_header('Log in');
?>
<section class="card narrow">
    <h1>Log in</h1>
    <?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
    <form method="post">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <label>Email <input type="email" name="email" required autofocus></label>
        <label>Password <input type="password" name="password" required></label>
        <button type="submit">Log in</button>
    </form>
</section>
<?php
render_footer();
