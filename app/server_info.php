<?php
// What the running PHP says about itself, for the admin-only Server Status page.

function php_build_date()
{
    ob_start();
    phpinfo(INFO_GENERAL);
    $info = strip_tags(ob_get_clean());

    if (preg_match('/Build Date\s*(?:=>\s*)?([A-Z][a-z]{2}\s+\d{1,2}\s+\d{4}(?:\s+\d{2}:\d{2}:\d{2})?)/', $info, $m)) {
        return $m[1];
    }
    return 'unknown';
}

function server_status()
{
    return [
        'PHP version' => PHP_VERSION,
        'Build date' => php_build_date(),
        'Server API' => php_sapi_name(),
        'Process ID' => getmypid(),
        'Checked at' => gmdate('Y-m-d H:i:s') . ' UTC',
    ];
}
