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
