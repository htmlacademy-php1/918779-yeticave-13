CREATE DATABASE yeticave
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
user_registration DATETIME DEFAULT CURRENT_TIMESTAMP,
email VARCHAR(256) NOT NULL UNIQUE,
user_name VARCHAR(128) NOT NULL,
user_password VARCHAR(128) NOT NULL,
contacts TEXT
);

CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY,
category_name VARCHAR(128) NOT NULL UNIQUE,
category_code VARCHAR(128) NOT NULL UNIQUE
);

CREATE TABLE lots (
id INT AUTO_INCREMENT PRIMARY KEY,
create_datе DATETIME DEFAULT CURRENT_TIMESTAMP,
lot_name TEXT NOT NULL,
user_description TEXT NOT NULL,
photo TEXT,
price INT NOT NULL,
date_expiration DATETIME,
step INT NOT NULL,
user_id INT,
winner_id INT,
category_id INT,
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (winner_id) REFERENCES users(id),
FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE bets (
id INT AUTO_INCREMENT PRIMARY KEY,
date_bet DATETIME DEFAULT CURRENT_TIMESTAMP,
sum INT NOT NULL,
user_id INT,
lot_id INT,
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (lot_id) REFERENCES lots(id)
);

CREATE FULLTEXT INDEX yeticave_search ON lots(lot_name, user_description);
