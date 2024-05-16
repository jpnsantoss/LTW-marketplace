CREATE TABLE users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT UNIQUE NOT NULL,
  hashed_password TEXT NOT NULL,
  full_name TEXT NOT NULL,
  email TEXT UNIQUE NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  hasRequested BOOLEAN DEFAULT 0
);

CREATE TABLE sellers (
  user_id INTEGER UNIQUE NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE admins (
  user_id INTEGER UNIQUE NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE items (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  category_id INTEGER NOT NULL,
  size_id INTEGER NOT NULL,
  condition_id TEXT NOT NULL,
  price INTEGER NOT NULL,
  brand TEXT NOT NULL,
  model TEXT NOT NULL,
  seller_id INTEGER NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  sold_at DATETIME DEFAULT NULL,
  FOREIGN KEY(category_id) REFERENCES categories(id),
  FOREIGN KEY(size_id) REFERENCES sizes(id),
  FOREIGN KEY(condition_id) REFERENCES conditions(id),
  FOREIGN KEY(seller_id) REFERENCES sellers(user_id)
);

CREATE TABLE categories (
  name TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id INTEGER PRIMARY KEY AUTOINCREMENT
);

CREATE TABLE sizes (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE conditions (
  name TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  id INTEGER PRIMARY KEY AUTOINCREMENT
);

CREATE TABLE images (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  url TEXT NOT NULL,
  item_id INTEGER NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(item_id) REFERENCES items(id)
);

CREATE TABLE transactions (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  seller_id INTEGER NOT NULL,
  buyer_id INTEGER NOT NULL,
  product_id INTEGER NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(seller_id) REFERENCES sellers(user_id),
  FOREIGN KEY(buyer_id) REFERENCES buyers(user_id),
  FOREIGN KEY(product_id) REFERENCES items(id)
);

CREATE TABLE wishlist (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  product_id INTEGER NOT NULL,
  added_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(user_id) REFERENCES buyers(user_id),
  FOREIGN KEY(product_id) REFERENCES items(id),
  UNIQUE(user_id, product_id)
);


CREATE TABLE cart (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  product_id INTEGER NOT NULL,
  added_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(user_id) REFERENCES buyers(user_id),
  FOREIGN KEY(product_id) REFERENCES items(id),
  UNIQUE(user_id, product_id)
);


CREATE TABLE messages (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  buyer_id INTEGER NOT NULL,
  product_id INTEGER NOT NULL,
  content TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(buyer_id) REFERENCES buyers(user_id),
  FOREIGN KEY(product_id) REFERENCES sellers(product_id)
);

CREATE INDEX items_index_0 ON items (category_id);
CREATE INDEX items_index_1 ON items (size_id);
CREATE INDEX items_index_2 ON items (condition_id);
CREATE INDEX items_index_3 ON items (price);
CREATE INDEX images_index_4 ON images (item_id);
CREATE INDEX transactions_index_5 ON transactions (seller_id);
CREATE INDEX transactions_index_6 ON transactions (buyer_id);
CREATE INDEX transactions_index_7 ON transactions (product_id);
CREATE INDEX transactions_index_8 ON transactions (seller_id, buyer_id);
CREATE INDEX wishlist_index_9 ON wishlist (user_id);
CREATE INDEX wishlist_index_10 ON wishlist (product_id);
CREATE INDEX messages_index_11 ON messages (buyer_id);
CREATE INDEX messages_index_12 ON messages (seller_id);
CREATE INDEX messages_index_13 ON messages (buyer_id, seller_id);
CREATE INDEX cart_index_14 ON cart (user_id);
CREATE INDEX cart_index_15 ON cart (product_id);

CREATE TRIGGER after_update_items_sold
  AFTER UPDATE ON items
  FOR EACH ROW
  WHEN NEW.sold_at IS NOT NULL
  BEGIN
    DELETE FROM wishlist WHERE wishlist.product_id = NEW.id;
    DELETE FROM cart WHERE cart.product_id = NEW.id;
END;