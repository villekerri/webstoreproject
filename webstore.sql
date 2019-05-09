DROP DATABASE IF EXISTS webstore;
CREATE DATABASE webstore;
USE webstore;

CREATE TABLE users
(
  userid INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(32) NOT NULL,
  password VARCHAR(255) NOT NULL,
  address VARCHAR(50),
  PRIMARY KEY (userid)
);

CREATE TABLE products
(
  productid INT NOT NULL AUTO_INCREMENT,
  productname VARCHAR(50) NOT NULL,
  producttype VARCHAR(50) NOT NULL,
  productprice FLOAT NOT NULL,
  productquantity INT NOT NULL,
  PRIMARY KEY (productid)
);

CREATE TABLE orders
(
  orderid INT NOT NULL AUTO_INCREMENT,
  orderstatus VARCHAR(50) NOT NULL,
  userid INT NOT NULL,
  PRIMARY KEY (orderid),
  FOREIGN KEY (userid) REFERENCES users(userid)
);

CREATE TABLE productorders
(
  productorderid INT NOT NULL AUTO_INCREMENT,
  productid INT NOT NULL,
  orderquantity INT NOT NULL,
  orderid INT,
  PRIMARY KEY (productorderid),
  FOREIGN KEY (productid) REFERENCES products(productid),
  FOREIGN KEY (orderid) REFERENCES orders(orderid)
);

INSERT INTO users (username, password, address) VALUES
  ('admin', 'admin', 'Myllypurontie 1, 00920 Helsinki'),
  ('perus1', 'perus1', 'Vanha maantie 6, 02650 Espoo'),
  ('perus2', 'perus2', 'Karaportti 2, 02610 Espoo');

INSERT INTO products (productname, producttype, productprice, productquantity) VALUES
  ('Hattu', 'Vaate', 23.45, 7),
  ('Huivi', 'Vaate', 34.56, 12),
  ('Parsakaali', 'Kasvis', 1.40, 35),
  ('Porkkana', 'Kasvis', 0.30, 48);

INSERT INTO orders (orderstatus, userid) VALUES
  ('Send', 2),
  ('Shopping cart', 2),
  ('Send', 3),
  ('Shopping cart', 3);

INSERT INTO productorders (productid, orderquantity, orderid) VALUES
  (1, 1, 1),
  (1, 3, 2),
  (4, 5, 2),
  (4, 12, 3),
  (3, 4, 4);
