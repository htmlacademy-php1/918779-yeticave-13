INSERT INTO categories
SET category_name = 'Доски и лыжи', category_code = 'bords';

INSERT INTO categories
SET category_name = 'Крепления', category_code = 'attachment';

INSERT INTO categories
SET category_name = 'Ботинки', category_code = 'boots';

INSERT INTO categories
SET category_name = 'Одежда', category_code = 'clothing';

INSERT INTO categories
SET category_name = 'Инструменты', category_code = 'tools';

INSERT INTO categories
SET category_name = 'Разное', category_code = 'other';

INSERT INTO users
SET email = 'ivanpetrov@mail.ru', user_name = 'Иван', user_password = 'TyeWq', contacts = 'г. Москва, Лубянка, д. 1';

INSERT INTO users
SET email = 'antonromanov@yandex.ru', user_name = 'Антон', user_password = 'QerWiy', contacts = 'тел. 8(900)452-56-34';


INSERT INTO lots
SET lot_name = '2014 Rossignol District Snowboard', photo ='/img/lot-1.jpg' price = 10999, data_expiration ='2021-09-10', category_id = 1;

INSERT INTO lots
SET lot_name = 'DC Ply Mens 2016/2017 Snowboard', photo ='/img/lot-2.jpg' price = 159999, data_expiration ='2021-09-11', category_id = 1;

INSERT INTO lots
SET lot_name = 'Крепления Union Contact Pro 2015 года размер L/XL', photo ='/img/lot-3.jpg' price = 8000, data_expiration ='2021-09-12', category_id = 2;

INSERT INTO lots
SET lot_name = 'Ботинки для сноуборда DC Mutiny Charocal', photo ='/img/lot-4.jpg' price = 10999, data_expiration ='2021-09-13', category_id = 3;

INSERT INTO lots
SET lot_name = 'Куртка для сноуборда DC Mutiny Charocal', photo ='/img/lot-5.jpg' price = 7500, data_expiration = '2021-09-14', category_id = 4;

INSERT INTO lots
SET lot_name = 'Маска Oakley Canopy', photo ='/img/lot-6.jpg' price = 5400, data_expiration = '2021-09-15', category_id = 6;

INSERT INTO bets
SET sum = 6000, user_id = 1, lot_id = 6;

INSERT INTO bets
SET sum = 8500, user_id = 2, lot_id = 6;

SELECT category_name FROM categories ORDER BY id ASC;

SELECT lots.lot_name, lots.price, lots.photo, categories.category_name
FROM lots JOIN categories ON lots.category_id=categories.id;

SELECT * FROM lots JOIN categories ON lots.category_id=categories.id
WHERE id = 6;

UPDATE lot_name FROM lots WHERE id = 6;

SELECT bets.date_bet, bets.price, lots.lot_name, users.user_name
FROM bets
JOIN lots ON bets.lot_id=lots.id
JOIN users ON bets.user_id=users.id
WHERE lots.id = 6
ORDER BY bets.date_bet ASC;
