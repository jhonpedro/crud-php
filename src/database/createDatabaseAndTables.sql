DROP DATABASE crud_products;
CREATE DATABASE crud_products;
USE crud_products;

CREATE TABLE purchases (
  id INT(6) AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE products (
  id INT(6) AUTO_INCREMENT,
  purchase_id INT(6) NOT NULL,
  name VARCHAR(70) NOT NULL,
  price FLOAT NOT NULL,
  distributor VARCHAR(40) NOT NULL,
  expiration_date VARCHAR(40) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (purchase_id) REFERENCES purchases(id)
);
