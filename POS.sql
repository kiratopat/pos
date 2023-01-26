-- Created by Kiratipat sawangsisombat
-- RBAC [65013141]
-- Date: Fri Jan 24 11:00:00 2023
-- Description: Database for POS system
CREATE DATABASE pos CHARACTER SET utf8 COLLATE utf8_general_ci;
USE pos
CREATE TABLE File (
    file_id INT PRIMARY KEY AUTO_INCREMENT,
    path VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL
);
CREATE TABLE Product (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    file_id INT,
    FOREIGN KEY (file_id) REFERENCES File(file_id)
);
CREATE TABLE ProductType (
    product_type_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);
CREATE TABLE Employee (
    employee_id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    tel VARCHAR(10) NOT NULL,
    password VARCHAR(500) NOT NULL,
    role VARCHAR(255) NOT NULL,
    file_id INT,
    FOREIGN KEY (file_id) REFERENCES File(file_id)
);
CREATE TABLE Customer (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    tel VARCHAR(10) NOT NULL,
    birth DATE NOT NULL,
    gender VARCHAR(255) NOT NULL,
    point INT NOT NULL
);
CREATE TABLE Receipt (
    receipt_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    employee_id INT NOT NULL,
    discount DECIMAL(10, 2) NOT NULL,
    timestamp TIMESTAMP NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
    FOREIGN KEY (employee_id) REFERENCES Employee(employee_id)
);
CREATE TABLE ProductReceipt (
    product_receipt_id INT PRIMARY KEY AUTO_INCREMENT,
    receipt_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (receipt_id) REFERENCES Receipt(receipt_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);
CREATE TABLE Coupon (
    coupon_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    value DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL
);

-- insert seed
INSERT INTO File (path, type)
VALUES ('camera.jpg','image/jpg'),
       ('nike.jpg','image/jpg'),
       ('bag.jpg','image/jpg'),
       ('film.jpg','image/jpg'),
       ('jbl.jpg','image/jpg');
INSERT INTO Product (name, price, stock, file_id)
VALUES ('Camera', 10.99, 100,1),
       ('Nike', 15.99, 50,2),
       ('Bag', 20.99, 25,3),
       ('Film', 25.99, 10,4),
       ('JBL', 30.99, 5,5);
INSERT INTO ProductType (name)
VALUES ('Type 1'),
       ('Type 2'),
       ('Type 3'),
       ('Type 4'),
       ('Type 5');
INSERT INTO Employee (fname, lname, tel,password, role)
VALUES ('John', 'Doe', '1234567890', 'test', 'Manager'),
       ('Jane', 'Doe', '0987654321', 'test', 'Sales'),
       ('Bob', 'Smith', '1122334455', 'test', 'Cashier'),
       ('Sara', 'Johnson', '6677889900', 'test', 'Manager'),
       ('Mike', 'Williams', '3344112233', 'test', 'Sales');
INSERT INTO Customer (fname, lname, tel, birth, gender, point)
VALUES ('Jane', 'Smith', '1234567890', '1990-01-01', 'Female', 100),
       ('John', 'Doe', '0987654321', '1980-01-01', 'Male', 50),
       ('Bob', 'Johnson', '1122334455', '1970-01-01', 'Male', 25),
       ('Sara', 'Williams', '6677889900', '1960-01-01', 'Female', 10),
       ('Mike', 'Jones', '3344112233', '1950-01-01', 'Male', 5);
INSERT INTO Receipt (customer_id, employee_id, discount, timestamp)
VALUES (1, 1, 0.00, NOW()),
       (2, 2, 5.00, NOW()),
       (3, 3, 10.00, NOW()),
       (4, 4, 15.00, NOW()),
       (5, 5, 20.00, NOW());
INSERT INTO ProductReceipt (receipt_id, product_id, quantity, amount)
VALUES (1, 1, 1, 10.99),
       (1, 2, 2, 31.98),
       (2, 3, 3, 62.97),
       (3, 4, 4, 103.96),
       (4, 5, 5, 164.95);
INSERT INTO Coupon (name, value, stock)
VALUES
    ("SummerSale", 10.00, 100),
    ("FallDiscount", 15.00, 50),
    ("WinterPromo", 20.00, 75),
    ("SpringOffer", 25.00, 200);

