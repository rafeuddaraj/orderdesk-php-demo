<?php
require __DIR__ . '/../app/bootstrap.php';
require APP_ROOT . '/app/server_info.php';

require_admin();

render_header('Server Status');
?>
<section class="card narrow">
    <h1>Server Status</h1>
    <p class="muted">The PHP that is serving this website right now.</p>
    <table class="kv">
        <?php foreach (server_status() as $label => $value): ?>
            <tr><th><?= e($label) ?></th><td><?= e($value) ?></td></tr>
        <?php endforeach; ?>
    </table>
</section>
<?php
render_footer();
