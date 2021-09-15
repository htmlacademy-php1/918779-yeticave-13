/*Добавляет данные в базу данных*/

INSERT INTO categories (category_name, category_code) 
VALUES ('Доски и лыжи', 'boards'), ('Крепления', 'attachment'), ('Ботинки', 'boots'), ('Одежда', 'clothing'), ('Инструменты', 'tools'), ('Разное', 'other');

INSERT INTO users (email, user_name, user_password, contacts)
VALUE ('ivanpetrov@mail.ru', 'Иван', 'TyeWq', 'г. Москва, Лубянка, д. 1'), ('antonromanov@yandex.ru', 'Антон', 'QerWiy', 'тел. 8(900)452-56-34');


INSERT INTO lots (lot_name, user_description, photo, price, date_expiration, step, category_id)
VALUES
('2014 Rossignol District Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', '/img/lot-1.jpg', 10999, '2021-09-21', 500, 1),
('DC Ply Mens 2016/2017 Snowboard', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', '/img/lot-2.jpg', 159999, '2021-09-21', 500, 1),
('Крепления Union Contact Pro 2015 года размер L/XL', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', '/img/lot-3.jpg', 8000, '2021-09-21', 500, 2),
('Ботинки для сноуборда DC Mutiny Charocal', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', '/img/lot-4.jpg', 10999, '2021-09-16', 500, 3),
('Куртка для сноуборда DC Mutiny Charocal', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', '/img/lot-5.jpg', 7500, '2021-09-21', 500, 4),
('Маска Oakley Canopy', 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.', '/img/lot-6.jpg', 5400, '2021-09-21', 500, 6);

INSERT INTO bets (sum, user_id, lot_id, date_bet)
VALUES (6000, 1, 1, '2021-08-22'), (6500, 2, 1, '2021-08-23'), (7000, 1, 2, '2021-08-23'), (7500, 2, 2, '2021-08-23'), (8000, 1, 3, '2021-08-23'), (8500, 2, 3, '2021-08-23'), (9000, 1, 4, '2021-08-23'), (9500, 2, 4, '2021-08-23'), (10000, 1, 5, '2021-08-23'), (10500, 2, 5, '2021-08-23'), (11000, 1, 6, '2021-08-23'), (11500, 2, 6, '2021-08-23');

/*Получает все категории*/

SELECT category_name FROM categories ORDER BY id ASC;

/*Получает открытые лоты, в каждом получает название, цену, изображение, название категории*/

SELECT lots.lot_name, lots.price, lots.photo, categories.category_name, MAX(bets.sum) as current_price
FROM lots 
JOIN categories ON lots.category_id=categories.id
JOIN bets ON bets.lot_id=lots.id
WHERE lots.date_expiration > NOW()
GROUP BY lots.id;

/*Показывает лот по его ID и получает название категории, к которой принадлежит лот*/

SELECT * FROM lots JOIN categories ON lots.category_id=categories.id
WHERE categories.id = 6;

/*Обновляет названия лота по его идентификатору*/

UPDATE lots SET lot_name = 'Маска для сноуборда' WHERE id = 6;

/*Получает список ставок для лота по его ID с сортировкой по дате, начиная с самой последней*/

SELECT bets.date_bet, bets.sum, lots.lot_name, users.user_name
FROM bets 
JOIN lots ON bets.lot_id=lots.id 
JOIN users ON bets.user_id=users.id
WHERE lots.id = 6 ORDER BY bets.date_bet DESC;
