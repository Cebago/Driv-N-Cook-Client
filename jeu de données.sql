
INSERT INTO TRUCK (truckManufacturers, truckModel, truckName, licensePlate, km) VALUES ('Mercedes', 'New Actros', 'Chez Toni','AA-777-AA', 12);
INSERT INTO TRUCK (truckManufacturers, truckModel, truckName, licensePlate, km) VALUES ('Renault', 'Proof', 'Au paradis du fromage', 'BB-888-BB', 500);
INSERT INTO TRUCK (truckManufacturers, truckModel, truckName, licensePlate, km) VALUES ('Ford', 'Mustang', 'Vegan d\'un jour', 'CC-111-CC', 12);
INSERT INTO TRUCK (truckManufacturers, truckModel, truckName, licensePlate, km) VALUES ('Volvo', 'Bullet', 'Le patron', '775 EBJ 75', 12);

INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Lundi', '08:00', '17:00', 1);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mardi', '08:00', '17:00', 1);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mercredi', '08:00', '17:00', 1);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Jeudi', '08:00', '17:00', 1);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Vendredi', '08:00', '17:00', 1);


INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mardi', '08:00', '17:00', 2);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mercredi', '08:00', '17:00', 2);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Jeudi', '08:00', '17:00', 2);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Vendredi', '08:00', '17:00', 2);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Samedi', '08:00', '17:00', 2);


INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mercredi', '08:00', '17:00', 3);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Jeudi', '08:00', '17:00', 3);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Vendredi', '08:00', '17:00', 3);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Samedi', '08:00', '17:00', 3);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Dimanche', '08:00', '17:00', 3);

INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Lundi', '08:00', '17:00', 4);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Mercredi', '08:00', '17:00', 4);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Vendredi', '08:00', '17:00', 4);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Samedi', '08:00', '17:00', 4);
INSERT INTO OPENDAYS(openDay, startHour, endHour, truck) VALUES ('Dimanche', '08:00', '17:00', 4);


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
INSERT INTO WAREHOUSES(warehouseName, warehouseCity, warehouseAddress, warehousePostalCode, warehouseType)
VALUES ('Livry', 'Livry', '2 rue ESGI', 93500, 'Entrepôt');
INSERT INTO WAREHOUSES(warehouseName, warehouseType)
VALUES ('Stock du camion', 'Camion');

INSERT INTO TRUCKWAREHOUSE(warehouse, truck) VALUES (1, 1);
INSERT INTO TRUCKWAREHOUSE(warehouse, truck) VALUES (1, 2);
INSERT INTO TRUCKWAREHOUSE(warehouse, truck) VALUES (3, 3);
INSERT INTO TRUCKWAREHOUSE(warehouse, truck) VALUES (3, 4);


INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (1, 1, 1, 0.20);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (1, 2, 1, 0.35);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (1, 3, 1, 0.80);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (1, 4, 1, 0.26);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (1, 5, 1, 0.75);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (1, 6, 1, 1.20);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (2, 1, 1, 0.35);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (2, 2, 1, 0.40);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (2, 3, 1, 0.26);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (2, 4, 1, 0.35);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (2, 5, 1, 0.95);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (2, 6, 1, 1.30);

INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (3, 1, 1, 0.20);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (3, 2, 1, 0.35);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (3, 3, 1, 0.80);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (3, 4, 1, 0.26);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (3, 5, 1, 0.75);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (3, 6, 1, 1.20);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (4, 1, 1, 0.35);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (4, 2, 1, 0.40);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (4, 3, 1, 0.26);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (4, 4, 1, 0.35);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (4, 5, 1, 0.95);
INSERT INTO STORE(warehouse, ingredient, available, price) VALUES (4, 6, 1, 1.30);

INSERT INTO TRUCKWAREHOUSE (truck, warehouse) VALUES (1, 2);

INSERT INTO PRODUCTS(productName, productPrice, truck) VALUES ('Canette de coca', 1.50, 1);
INSERT INTO PRODUCTS(productName, productPrice, truck) VALUES ('Salade de légume', 5.50, 1);

INSERT INTO COMPOSE(ingredient, product) VALUES (1, 2);
INSERT INTO COMPOSE(ingredient, product) VALUES (2, 2);
INSERT INTO COMPOSE(ingredient, product) VALUES (5, 2);

INSERT INTO CART(cartPrice, cartType) VALUES (7.00, 'Commande client');
INSERT INTO CART(cartPrice, cartType) VALUES (27.50, 'Commande client');
INSERT INTO CART(cartPrice, cartType) VALUES (30.50, 'Commande client');
INSERT INTO CART(cartPrice, cartType) VALUES (77.00, 'Commande client');

INSERT INTO CARTPRODUCT(cart, product, quantity) VALUES (1, 1, 1);
INSERT INTO CARTPRODUCT(cart, product, quantity) VALUES (1, 2, 1);

INSERT INTO CARTPRODUCT(cart, product, quantity) VALUES (2, 2, 5);
INSERT INTO CARTPRODUCT(cart, product, quantity) VALUES (3, 1, 2);
INSERT INTO CARTPRODUCT(cart, product, quantity) VALUES (3, 2, 5);
INSERT INTO CARTPRODUCT(cart, product, quantity) VALUES (4, 2, 14);

INSERT INTO ORDERS(orderPrice, orderInvoice, orderType, truck, user) VALUES (7.00, '/var/www/html/invoices/1.pdf', 'Commande Fracnhisé', 1, 1);
INSERT INTO ORDERS(orderPrice, orderInvoice, orderType, truck, user) VALUES (27.50, '/var/www/html/invoices/2.pdf', 'Commande client', 2, 1);
INSERT INTO ORDERS(orderPrice, orderInvoice, orderType, truck, user) VALUES (30.50, '/var/www/html/invoices/3.pdf', 'Commande client', 3, 1);
INSERT INTO ORDERS(orderPrice, orderInvoice, orderType, truck, user) VALUES (77.00, '/var/www/html/invoices/4.pdf', 'Commande client', 4, 1);

INSERT INTO TRANSACTION(price, user, orders) VALUES (7.00, 1, 1);
INSERT INTO TRANSACTION(price, user, orders) VALUES (27.50, 1, 2);
INSERT INTO TRANSACTION(price, user, orders) VALUES (30.50, 1, 2);
INSERT INTO TRANSACTION(price, user, orders) VALUES (77.00, 1, 4);

INSERT INTO CARTINGREDIENT(cart, ingredient, quantity) VALUES (1, 1, 7);
INSERT INTO CARTINGREDIENT(cart, ingredient, quantity) VALUES (1, 2, 8);
INSERT INTO CARTINGREDIENT(cart, ingredient, quantity) VALUES (1, 3, 9);
INSERT INTO CARTINGREDIENT(cart, ingredient, quantity) VALUES (1, 4, 10);