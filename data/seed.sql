-- Seed the categories table with clothes categories
INSERT INTO categories (name) VALUES 
('Tops'), 
('Dresses'), 
('Trousers'), 
('Skirts'), 
('Shoes'), 
('Bags'), 
('Accessories');

-- Seed the sizes table with Vinted sizes
INSERT INTO sizes (name) VALUES 
('XS'), 
('S'), 
('M'), 
('L'), 
('XL'), 
('XXL'), 
('XXXL');

-- Seed the conditions table with Vinted conditions
INSERT INTO conditions (name) VALUES 
('New with tags'), 
('New without tags'), 
('Good'), 
('Satisfactory'), 
('Very good');

-- Seed the users table with an admin user
INSERT INTO users (username, hashed_password, full_name, email) 
VALUES 
('admin', '$2y$10$Z4LuEiEmjrbVyBRbniAW4eyuv5xg1vGbGxY.Blhyyy0xLwGBZQETu', 'Admin', 'admin@email.com');

-- Add the user to the admins table
INSERT INTO admins (user_id) SELECT last_insert_rowid();

-- Add the user to the sellers table
INSERT INTO sellers (user_id) SELECT last_insert_rowid();