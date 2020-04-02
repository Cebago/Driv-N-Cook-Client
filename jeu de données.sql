
INSERT INTO TRUCK (truckManufacturers, truckModel, licensePlate, km) VALUES ('Mercedes', 'New Actros','AA-777-AA', 12);
INSERT INTO TRUCK (truckManufacturers, truckModel, licensePlate, km) VALUES ('Renault', 'Proof','BB-888-BB', 500);
INSERT INTO TRUCK (truckManufacturers, truckModel, licensePlate, km) VALUES ('Ford', 'Mustang','CC-111-CC', 12);
INSERT INTO TRUCK (truckManufacturers, truckModel, licensePlate, km) VALUES ('Volvo', 'Bullet','775 EBJ 75', 12);

INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Lundi', '08:00', '17:00', 1);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mardi', '08:00', '17:00', 1);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mercredi', '08:00', '17:00', 1);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Jeudi', '08:00', '17:00', 1);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Vendredi', '08:00', '17:00', 1);

INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Samedi', '08:00', '17:00', 2);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mardi', '08:00', '17:00', 2);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mercredi', '08:00', '17:00', 2);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Jeudi', '08:00', '17:00', 2);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Vendredi', '08:00', '17:00', 2);

INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Samedi', '08:00', '17:00', 3);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Dimanche', '08:00', '17:00', 3);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mercredi', '08:00', '17:00', 3);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Jeudi', '08:00', '17:00', 3);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Vendredi', '08:00', '17:00', 3);

INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Lundi', '08:00', '17:00', 4);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Dimanche', '08:00', '17:00', 4);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mercredi', '08:00', '17:00', 4);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Samedi', '08:00', '17:00', 4);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Vendredi', '08:00', '17:00', 4);

INSERT INTO INGREDIENTS(ingredientName, ingredientCategory) VALUES ('Tomate', 'Fruit');
INSERT INTO INGREDIENTS(ingredientName, ingredientCategory) VALUES ('Pomme de terre', 'Féculent');
INSERT INTO INGREDIENTS(ingredientName, ingredientCategory) VALUES ('Steak haché', 'Viande');
INSERT INTO INGREDIENTS(ingredientName, ingredientCategory) VALUES ('Pomme', 'Fruit');
INSERT INTO INGREDIENTS(ingredientName, ingredientCategory) VALUES ('Carotte', 'Légume');
INSERT INTO INGREDIENTS(ingredientName, ingredientCategory) VALUES ('Coca-Cola', 'Boisson');

INSERT INTO WAREHOUSES(warehouseName, warehouseCity, warehouseAddress, warehousePostalCode, warehouseType)
VALUES ('Créteil', 'Créteil', '2 rue Maréchal', 94000, 'Entrepôt');
INSERT INTO WAREHOUSES(warehouseName, warehouseType)
VALUES ('Stock du camion', 'Camion');

INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (1, 1, 30, 2);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (1, 2, 15, 35);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (1, 3, 100, 20);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (1, 4, 250, 22);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (1, 5, 5, 78);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (1, 6, 250, 130);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (2, 1, 30, 2);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (2, 2, 15, 35);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (2, 3, 100, 20);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (2, 4, 250, 22);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (2, 5, 5, 78);
INSERT INTO STORE(warehouse, ingredient, quantity, price) VALUES (2, 6, 250, 130);

INSERT INTO TRUCKWAREHOUSE (truck, warehouse) VALUES (1, 2);

INSERT INTO PRODUCTS(productName, productPrice, truck) VALUES ('Canette de coca', 150, 1);
INSERT INTO PRODUCTS(productName, productPrice, truck) VALUES ('Salade de légume', 550, 1);

INSERT INTO COMPOSE(ingredient, product, quantity) VALUES (1, 2, 4);
INSERT INTO COMPOSE(ingredient, product, quantity) VALUES (2, 2, 2);
INSERT INTO COMPOSE(ingredient, product, quantity) VALUES (5, 2, 3);

INSERT INTO CART(cartPrice, cartType) VALUES (700, 'Commande client');

INSERT INTO CARTPRODUCT(cart, product, quantity) VALUES (1, 1, 1);
INSERT INTO CARTPRODUCT(cart, product, quantity) VALUES (1, 2, 1);

INSERT INTO ORDERS(orderPrice, orderInvoice, orderType, truck, user) VALUES (700, '/var/www/html/invoices/1.pdf', 'Commande client', 1, 1);

INSERT INTO TRANSACTION(price, user, orders) VALUES (700, 1, 1);
