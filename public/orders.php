<?php
require __DIR__ . '/../app/bootstrap.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $customer = trim($_POST['customer'] ?? '');
    $product = trim($_POST['product'] ?? '');
    $amount = (float) ($_POST['amount'] ?? 0);
    if ($customer !== '' && $product !== '' && $amount > 0) {
        add_order($db, $customer, $product, $amount);
    }
    redirect('/orders.php');
}

$statuses = ['pending', 'shipped', 'delivered'];
$filter = in_array($_GET['status'] ?? '', $statuses, true) ? $_GET['status'] : null;
$orders = find_orders($db, $filter);

render_header('Orders');
?>
<section class="card">
    <div class="row">
        <h1>Orders</h1>
        <div class="filters">
            <a href="/orders.php" class="<?= $filter === null ? 'active' : '' ?>">All</a>
            <?php foreach ($statuses as $s): ?>
                <a href="/orders.php?status=<?= e($s) ?>" class="<?= $filter === $s ? 'active' : '' ?>"><?= e(ucfirst($s)) ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <table>
        <thead><tr><th>#</th><th>Customer</th><th>Product</th><th>Amount (৳)</th><th>Status</th><th>Date</th></tr></thead>
        <tbody>
        <?php foreach ($orders as $o): ?>
            <tr>
                <td><?= e($o['id']) ?></td>
                <td><?= e($o['customer_name']) ?></td>
                <td><?= e($o['product']) ?></td>
                <td><?= e(number_format($o['amount'], 2)) ?></td>
                <td><span class="badge <?= e($o['status']) ?>"><?= e($o['status']) ?></span></td>
                <td><?= e(date('d M Y', strtotime($o['created_at']))) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section class="card">
    <h2>New order</h2>
    <form method="post" class="inline">
        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
        <label>Customer <input name="customer" required></label>
        <label>Product <input name="product" required></label>
        <label>Amount <input name="amount" type="number" step="0.01" min="0.01" required></label>
        <button type="submit">Add order</button>
    </form>
</section>
<?php
render_footer();
