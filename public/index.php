<?php
require __DIR__ . '/../app/bootstrap.php';

redirect(current_user() ? '/orders.php' : '/login.php');
