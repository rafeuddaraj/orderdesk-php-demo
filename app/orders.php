<?php
// Order queries.

function find_orders(PDO $db, ?string $status = null)
{
    if ($status === null) {
        return $db->query('SELECT * FROM orders ORDER BY created_at DESC')->fetchAll();
    }

    $stmt = $db->prepare('SELECT * FROM orders WHERE status = ? ORDER BY created_at DESC');
    $stmt->execute([$status]);
    return $stmt->fetchAll();
}

function add_order(PDO $db, $customer, $product, $amount)
{
    $stmt = $db->prepare('INSERT INTO orders (customer_name, product, amount) VALUES (?, ?, ?)');
    $stmt->execute([$customer, $product, $amount]);
}
