CREATE DATABASE IF NOT EXISTS restaurant_db;

use restaurant_db;

CREATE TABLE
    Person (
        person_id INT AUTO_INCREMENT PRIMARY KEY,
        person_name VARCHAR(100) NOT NULL
    );

CREATE TABLE
    Food (
        food_id INT AUTO_INCREMENT PRIMARY KEY,
        food_name VARCHAR(100) NOT NULL,
        category VARCHAR(50),
        current_price DECIMAL(6, 2) NOT NULL,
        calories INT NOT NULL
    );

INSERT INTO
    Food (food_name, category, current_price, calories)
VALUES
    ('Hamburger', 'entree', 10.99, 900),
    ('New York Strip', 'entree', 19.99, 1100),
    ('Salad', 'entree', 8.99, 350),
    ('Chicken Strips', 'entree', 9.99, 600);

CREATE TABLE
    Orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        person_id INT NOT NULL,
        status ENUM ('paid', 'unpaid') DEFAULT 'unpaid',
        FOREIGN KEY (person_id) REFERENCES PERSON (person_id)
    );

CREATE TABLE
    Order_Items (
        order_items_id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        food_id INT NOT NULL,
        quantity INT NOT NULL CHECK (quantity > 0),
        price_each DECIMAL(6, 2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES Orders (order_id),
        FOREIGN KEY (food_id) REFERENCES FOOD (food_id)
    );