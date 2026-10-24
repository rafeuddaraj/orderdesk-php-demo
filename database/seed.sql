-- OrderDesk demo data.
-- Test login for this demo app only (not a real account):
--   email:    admin@orderdesk.test
--   password: Od-MyCBHSyzPHQRrY
INSERT INTO users (name, email, password_hash, role) VALUES
    ('Admin', 'admin@orderdesk.test', '$2y$12$UPtBy76O0mEJJk5tWaXFWe/IlaXFQJbudsvrmFki7zTii2Du9IY7e', 'admin');

INSERT INTO orders (customer_name, product, amount, status, created_at) VALUES
    ('Rahim Uddin', 'Wireless Mouse', 850.00, 'delivered', '2026-10-02 10:15:00'),
    ('Nusrat Jahan', 'USB-C Charger', 1450.00, 'shipped', '2026-10-09 14:40:00'),
    ('Tanvir Ahmed', 'Mechanical Keyboard', 6200.00, 'pending', '2026-10-15 09:05:00'),
    ('Farzana Akter', 'Laptop Stand', 2300.00, 'pending', '2026-10-18 17:30:00');
