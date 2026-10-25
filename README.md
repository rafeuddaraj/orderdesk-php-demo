# OrderDesk (demo app)

A small order management app in plain PHP, PDO and MySQL, used as the "existing production app" in the PHP2Shell video.

## Layout
- `public/`: the web root (document root). Only this folder is served.
- `.htaccess`: for shared hosting (Apache or LiteSpeed) where the document root cannot point at `public/`; it serves `public/` and blocks everything else.
- `app/`: application code, outside the web root.
- `config.php`: database credentials, outside the web root, never committed (copy `config.example.php`).
- `logs/php-error.log`: PHP warnings and deprecations (written by `app/bootstrap.php`).
- `sessions/`: PHP session files, kept with the app so a PHP version switch on the host keeps people logged in.
- `database/schema.sql`, `database/seed.sql`: tables and demo data (the seed holds the demo-only admin login; change that password on any server that is reachable from the internet).

## Run locally
```bash
mysql -u root < database/create-local.sql
mysql -u orderdesk -p orderdesk < database/schema.sql
mysql -u orderdesk -p orderdesk < database/seed.sql
php -S 127.0.0.1:8080 -t public
```
