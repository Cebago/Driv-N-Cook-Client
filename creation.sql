DROP DATABASE IF EXISTS pa2a2drivncook;

CREATE DATABASE pa2a2drivncook;
USE pa2a2drivncook;

CREATE TABLE SITEROLE(
    idRole INTEGER PRIMARY KEY AUTO_INCREMENT,
    roleName VARCHAR(60)
);
CREATE TABLE FIDELITY(
    idFidelity INTEGER PRIMARY KEY AUTO_INCREMENT,
    points INTEGER DEFAULT 0
);
CREATE TABLE USER(
    idUser INTEGER PRIMARY KEY AUTO_INCREMENT,
    lastname VARCHAR(100),
    firstname VARCHAR(100),
    emailAddress VARCHAR(200),
    phoneNumber CHAR(10),
    pwd CHAR(60),
    token CHAR(60),
    createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    isActivated TINYINT(1) DEFAULT 0,
    address VARCHAR(150),
    postalCode VARCHAR(6),
    licenseNumber VARCHAR(15),
    userRole INTEGER,
    FOREIGN KEY (userRole) REFERENCES SITEROLE(idRole),
    fidelityCard INTEGER,
    FOREIGN KEY (fidelityCard) REFERENCES FIDELITY(idFidelity)
    
);
CREATE TABLE STATUS(
    idStatus INTEGER PRIMARY KEY AUTO_INCREMENT,
    statusName VARCHAR(60),
    statusDescription VARCHAR(60),
    statusType VARCHAR(60)
);
CREATE TABLE EVENTS(
    idEvent INTEGER PRIMARY KEY AUTO_INCREMENT,
    eventType VARCHAR(60),
    eventName VARCHAR(60),
    eventAddress VARCHAR(100),
    eventCity VARCHAR(60),
    eventPostalCode VARCHAR(6),
    eventBeginDate DATE,
    eventEndDate DATE,
    eventStartHour TIME,
    eventEndHour TIME
);
CREATE TABLE EVENTSTATUS(
    event INTEGER,
    status INTEGER,
    PRIMARY KEY(event, status),
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event) REFERENCES EVENTS(idEvent),
    FOREIGN KEY (status) REFERENCES STATUS(idStatus)
);
CREATE TABLE WAREHOUSES(
    idWarehouse INTEGER PRIMARY KEY AUTO_INCREMENT,
    warehouseName VARCHAR(60),
    warehouseCity VARCHAR(60),
    warehouseAddress VARCHAR(100),
    warehousePostalCode VARCHAR(6),
    lat FLOAT,
    lng FLOAT,
    warehouseType VARCHAR(100)
);
CREATE TABLE TRUCK(
    idTruck INTEGER PRIMARY KEY AUTO_INCREMENT,
    truckManufacturers VARCHAR(100),
    truckModel VARCHAR(100),
    licensePlate VARCHAR(10),
    km INTEGER,
    createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user INTEGER,
    FOREIGN KEY (user) REFERENCES USER(idUser)
);
CREATE TABLE OPENDAYS(
    idOpen INTEGER PRIMARY KEY AUTO_INCREMENT,
    openDay VARCHAR(60),
    startHour TIME,
    endHour TIME,
    truck INTEGER,
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck)
);
CREATE TABLE TRUCKSTATUS(
    truck INTEGER,
    status INTEGER,
    PRIMARY KEY(truck, status),
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck),
    FOREIGN KEY (status) REFERENCES STATUS(idStatus)
);
CREATE TABLE TRUCKWAREHOUSE(
    truck INTEGER,
    warehouse INTEGER,
    PRIMARY KEY (truck, warehouse),
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck),
    FOREIGN KEY (warehouse) REFERENCES WAREHOUSES(idWarehouse)
);
CREATE TABLE HOST(
    event INTEGER NOT NULL,
    truck INTEGER NOT NULL,
    PRIMARY KEY(event, truck),
    FOREIGN KEY (event) REFERENCES EVENTS(idEvent),
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck)
);
CREATE TABLE MAINTENANCE(
    idMaintenance INTEGER PRIMARY KEY AUTO_INCREMENT,
    maintenanceName VARCHAR(60),
    maintenancePrice DOUBLE,
    maintenanceDate DATE,
    km INTEGER,
    truck INTEGER NOT NULL,
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck)
);
CREATE TABLE ORDERS(
    idOrder INTEGER PRIMARY KEY AUTO_INCREMENT,
    orderPrice DOUBLE,
    orderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    orderInvoice VARCHAR(150),
    orderType VARCHAR(100),
    truck INTEGER NOT NULL,
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck),
    user INTEGER NOT NULL,
    FOREIGN KEY (user) REFERENCES USER(idUser)
);
CREATE TABLE ORDERSTATUS(
    orders INTEGER,
    status INTEGER,
    PRIMARY KEY(orders, status),
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (orders) REFERENCES ORDERS(idOrder),
    FOREIGN KEY (status) REFERENCES STATUS(idStatus)    
);
CREATE TABLE MENUS(
    idMenu INTEGER PRIMARY KEY AUTO_INCREMENT,
    menuName VARCHAR(60),
    menuPrice DOUBLE,
    truck INTEGER,
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck)
);
CREATE TABLE MENUSSTATUS(
    menus INTEGER,
    status INTEGER,
    PRIMARY KEY(menus, status),
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (menus) REFERENCES MENUS(idMenu),
    FOREIGN KEY (status) REFERENCES STATUS(idStatus)    
);
CREATE TABLE INGREDIENTS(
    idIngredient INTEGER PRIMARY KEY AUTO_INCREMENT,
    ingredientName VARCHAR(60),
    ingredientCategory VARCHAR(60),
    ingredientImage VARCHAR(100)
);
CREATE TABLE CONTACT(
    idContact INTEGER PRIMARY KEY AUTO_INCREMENT,
    contactSubject VARCHAR(60),
    contactDescription TEXT,
    createDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user INTEGER,
    FOREIGN KEY (user) REFERENCES USER(idUser)
);
CREATE TABLE STORE(
    warehouse INTEGER,
    ingredient INTEGER,
    PRIMARY KEY (warehouse, ingredient),
    available TINYINT(1),
    price DOUBLE,
    FOREIGN KEY (warehouse) REFERENCES WAREHOUSES(idWarehouse),
    FOREIGN KEY (ingredient) REFERENCES INGREDIENTS(idIngredient)
);
CREATE TABLE CART(
    idCart INTEGER PRIMARY KEY AUTO_INCREMENT,
    cartPrice DOUBLE,
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cartType VARCHAR(60),
    user INTEGER,
    FOREIGN KEY (user) REFERENCES USER(idUser)
);
CREATE TABLE PRODUCTS(
    idProduct INTEGER PRIMARY KEY AUTO_INCREMENT,
    productName VARCHAR(60),
    productPrice DOUBLE,
    truck INTEGER,
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck)
);
CREATE TABLE PRODUCTSTATUS(
    product INTEGER,
    status INTEGER,
    PRIMARY KEY(product, status),
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product) REFERENCES PRODUCTS(idProduct),
    FOREIGN KEY (status) REFERENCES STATUS(idStatus)
);
CREATE TABLE CARTPRODUCT(
    cart INTEGER,
    product INTEGER,
    PRIMARY KEY(cart, product),
    quantity INTEGER,
    FOREIGN KEY (cart) REFERENCES CART(idCart),
    FOREIGN KEY (product) REFERENCES PRODUCTS(idProduct)
);
CREATE TABLE CARTINGREDIENT(
    cart INTEGER,
    ingredient INTEGER,
    PRIMARY KEY (cart, ingredient),
    quantity INTEGER,
    FOREIGN KEY (cart) REFERENCES CART(idCart),
    FOREIGN KEY (ingredient) REFERENCES INGREDIENTS(idIngredient)
);
CREATE TABLE CARTSTATUS(
    cart INTEGER,
    status INTEGER,
    PRIMARY KEY(cart, status),
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cart) REFERENCES CART(idCart),
    FOREIGN KEY (status) REFERENCES STATUS(idStatus)
);
CREATE TABLE CARTMENU(
    cart INTEGER,
    menu INTEGER,
    PRIMARY KEY (cart, menu),
    quantity INTEGER,
    FOREIGN KEY (cart) REFERENCES CART(idCart),
    FOREIGN KEY (menu) REFERENCES MENUS(idMenu)
);
CREATE TABLE TRANSACTION(
    idTransaction INTEGER PRIMARY KEY AUTO_INCREMENT,
    transactionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    price DOUBLE,
    user INTEGER,
    FOREIGN KEY (user) REFERENCES USER(idUser),
    orders INTEGER,
    FOREIGN KEY (orders) REFERENCES ORDERS(idOrder)
);
CREATE TABLE SOLDIN(
    menu INTEGER,
    product INTEGER,
    PRIMARY KEY (menu, product),
    FOREIGN KEY (menu) REFERENCES MENUS(idMenu),
    FOREIGN KEY (product) REFERENCES PRODUCTS(idProduct)
);
CREATE TABLE COMPOSE(
    ingredient INTEGER,
    product INTEGER,
    PRIMARY KEY (ingredient, product),
    FOREIGN KEY (ingredient) REFERENCES INGREDIENTS(idIngredient),
    FOREIGN KEY (product) REFERENCES PRODUCTS(idProduct)
);
CREATE TABLE LOCATION(
	idLocation INTEGER PRIMARY KEY AUTO_INCREMENT,
    lat FLOAT,
    lng FLOAT,
    truck INTEGER,
    FOREIGN KEY (truck) REFERENCES TRUCK(idTruck)
);

USE pa2a2drivncook;
INSERT INTO SITEROLE(roleName) VALUES ('Client');
INSERT INTO SITEROLE(roleName) VALUES ('Franchisé');
INSERT INTO SITEROLE(roleName) VALUES ('Administrateur');

INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Payée","La commande a été payée","Commande");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("En cours","La commande est en cours","Commande");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("En attente de paiement","La commande est en attente de paiement","Commande");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Récupérée","La commande a été récupérée","Commande");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Refusée","Le paiement de la commande a été refusé","Commande");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Validé","Le paiement de la commande a été validé","Paiement");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Refusé","Le paiement de la commande a été refusé","Paiement");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Finalisé","Le panier est validé","Panier");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("En cours","Le panier est en cours d'édition","Panier");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("En maintenance","Le camion est en maintenance","Camion");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("A l'entrepôt","Le camion n'est assigné à personne","Camion");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Fermé","Le camion n'est pas disponible","Camion");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Vendu","Le camion ne fait plus partie des effectifs","Camion");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Ouvert","Le camion est disponible","Camion");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Programmé","L'évènement est programmé","Evènements");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Passé","L'évènement est passé","Evènements");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Annulé","L'évènement est annulé","Evènements");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("En cours","L'évènement est en cours","Evènements");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Disponible","Le produit est disponible","Produit");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Indisponible","Le produit est indisponible","Produit");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("En cours d'édition","Le produit est en cours d'édition","Produit");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Disponible","Le menu est disponible","Menu");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("Indisponible","Le menu est indisponible","Menu");
INSERT INTO STATUS (statusName, statusDescription, statusType) VALUES ("En cours d'édition","Le menu est en cours d'édition","Menu");

