DROP DATABASE IF EXISTS webstore;
CREATE DATABASE webstore;
USE webstore;

CREATE TABLE users
(
  username VARCHAR(20) NOT NULL,
  password VARCHAR(20) NOT NULL,
  userid INT NOT NULL,
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
  orderid VARCHAR(50) NOT NULL,
  orderstatus VARCHAR(50) NOT NULL,
  userid INT NOT NULL,
  PRIMARY KEY (orderid),
  FOREIGN KEY (userid) REFERENCES users(userid)
);

CREATE TABLE productorders
(
  productorderid VARCHAR(50) NOT NULL,
  orderquantity INT NOT NULL,
  productid INT NOT NULL,
  orderid VARCHAR(50),
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