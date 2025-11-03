create Table Person (
    person_id INT AUTO_INCREMENT PRIMARY KEY,
    person_name VARCHAR(100) NOT NULL
);

create Table Food (
    food_id INT AUTO_INCREMENT PRIMARY KEY,
    food_name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    current_price DECIMAL(6,2) NOT NULL
);

create Table Orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    person_id INT NOT NULL,
    status ENUM('paid', 'unpaid') DEFAULT 'unpaid',
    FOREIGN KEY (person_id) REFERENCES PERSON(person_id)
);

create Table Order_Items (
    order_items_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    food_id INT NOT NULL,
    quantity INT NOT NULL CHECK (quantity > 0),
    price_each DECIMAL(6,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (food_id) REFERENCES FOOD(food_id)
);