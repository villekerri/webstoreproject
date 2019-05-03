DROP DATABASE IF EXISTS webstore;
CREATE DATABASE webstore;
USE webstore;

CREATE TABLE users
(
  userid INT NOT NULL,
  username VARCHAR(20) NOT NULL,
  password VARCHAR(20) NOT NULL,
  address VARCHAR(50),
  PRIMARY KEY (userid)
);

CREATE TABLE products
(
  productid INT NOT NULL,
  productname VARCHAR(50) NOT NULL,
  producttype VARCHAR(50) NOT NULL,
  productprice FLOAT NOT NULL,
  productquantity INT NOT NULL,
  PRIMARY KEY (productid)
);

CREATE TABLE orders
(
  orderid INT NOT NULL,
  orderstatus VARCHAR(50) NOT NULL,
  userid INT NOT NULL,
  PRIMARY KEY (orderid),
  FOREIGN KEY (userid) REFERENCES users(userid)
);

CREATE TABLE productorders
(
  productorderid INT NOT NULL,
  orderquantity INT NOT NULL,
  productid INT NOT NULL,
  orderid INT,
  PRIMARY KEY (productorderid),
  FOREIGN KEY (productid) REFERENCES products(productid),
  FOREIGN KEY (orderid) REFERENCES orders(orderid)
);

CREATE TABLE user_card
(
  card INT NOT NULL,
  userid INT NOT NULL,
  PRIMARY KEY (card, userid),
  FOREIGN KEY (userid) REFERENCES users(userid)
);

INSERT INTO users (userid, username, password, address) VALUES
  (1, 'admin', 'admin', 'Myllypurontie 1, 00920 Helsinki'),
  (2, 'perus1', 'perus1', 'Vanha maantie 6, 02650 Espoo'),
  (3, 'perus2', 'perus2', 'Karaportti 2, 02610 Espoo');

INSERT INTO products (productid, productname, producttype, productprice, productquantity) VALUES
  (1, 'Hattu', 'Vaate', 23.45, 7),
  (2, 'Huivi', 'Vaate', 34.56, 12),
  (3, 'Parsakaali', 'Kasvis', 1.40, 35),
  (4, 'Porkkana', 'Kasvis', 0.30, 48);

INSERT INTO orders (orderid, orderstatus, userid) VALUES
  (1, 'Send', 2),
  (2, 'Shopping cart', 2),
  (3, 'Send', 3),
  (4, 'Shopping cart', 3);

INSERT INTO productorders (productorderid, orderquantity, productid, orderid) VALUES
  (1, 1, 1, 1),
  (2, 3, 1, 2),
  (3, 5, 4, 2),
  (4, 12, 4, 3),
  (5, 4, 3, 4);

INSERT INTO user_card (card, userid) VALUES
  (123456789, 2),
  (987654321, 3);