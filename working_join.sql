SELECT u.user_id, c.cart_items_id, p.product_id, p.product_name, p.product_stock, c.item_quantity FROM users AS u INNER JOIN cart_items AS c ON c.user_id = u.user_id INNER JOIN products AS p ON p.product_id = c.product_id;

SELECT u.user_id, c.cart_items_id, p.product_id, p.product_name, p.product_shortdesc, p.product_price, p.product_stock, c.item_quantity FROM users AS u INNER JOIN cart_items AS c ON c.user_id = u.user_id INNER JOIN products AS p ON p.product_id = c.product_id;

SELECT u.user_id, c.cart_items_id, p.product_id, p.product_name, p.product_imagepath, p.product_shortdesc, p.product_price, p.product_stock, c.item_quantity FROM users AS u INNER JOIN cart_items AS c ON c.user_id = u.user_id INNER JOIN products AS p ON p.product_id = c.product_id;

SELECT u.user_id, c.cart_items_id, p.product_id, p.product_name,p.product_imagepath, p.product_shortdesc, p.product_price, p.product_stock, sum(item_quantity) FROM users AS u INNER JOIN cart_items AS c ON c.user_id = u.user_id INNER JOIN products AS p ON p.product_id = c.product_id WHERE p.product_id = 4 AND u.user_id = 1;
