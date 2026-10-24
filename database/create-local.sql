-- Local development database for OrderDesk (run as the MySQL root user).
-- Replace the password with the one in your config.php.
CREATE DATABASE IF NOT EXISTS orderdesk CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'orderdesk'@'127.0.0.1' IDENTIFIED BY 'change-me';
CREATE USER IF NOT EXISTS 'orderdesk'@'localhost' IDENTIFIED BY 'change-me';
GRANT ALL PRIVILEGES ON orderdesk.* TO 'orderdesk'@'127.0.0.1';
GRANT ALL PRIVILEGES ON orderdesk.* TO 'orderdesk'@'localhost';
