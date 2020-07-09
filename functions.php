<?php
require_once "conf.inc.php";

/**
 * @return PDO
 */
function connectDB()
{
    try {
        $pdo = new PDO(DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
    return $pdo;
}

/**
 * @param $email
 * @return false|string
 */
function createToken($email)
{
    $token = md5($email . "€monTokenDrivNCook£" . time() . uniqid());
    $token = substr($token, 0, rand(15, 20));
    return $token;
}

/**
 * @param $email
 */
function login($email)
{
    $token = createToken($email);
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE USERTOKEN, USER SET USERTOKEN.token = :token WHERE user = idUser AND emailAddress = :email AND tokenType = 'Site' ;");
    $queryPrepared->execute([":token" => $token, ":email" => $email]);
    $_SESSION["token"] = $token;
    $_SESSION["email"] = $email;
}

/**
 * @return array
 */

function getTrucks()
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idTruck, truckName, truckPicture, categorie FROM TRUCK;");
    $queryPrepared->execute();
    return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param $idTruck
 * @return bool
 */
function isOpen($idTruck)
{
    $translateDay = [
        1 => "Lundi",
        2 => "Mardi",
        3 => "Mercredi",
        4 => "Jeudi",
        5 => "Vendredi",
        6 => "Samedi",
        7 => "Dimanche",
    ];
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT * FROM OPENDAYS WHERE openDay = :currentDay AND startHour < current_time() AND endHour > current_time() AND truck = :idTruck;");
    $queryPrepared->execute([":currentDay" => $translateDay[date("N")], ":idTruck" => $idTruck]);
    return !empty($queryPrepared->fetch());

}

/**
 * @return bool
 */
function isConnected()
{
    if (!empty($_SESSION["email"])
        && !empty($_SESSION["token"])) {
        $email = $_SESSION["email"];
        $token = $_SESSION["token"];
        //Vérification d'un correspondant en base de données
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT idUser FROM USER, USERTOKEN WHERE emailAddress = :email 
                                     AND USERTOKEN.token = :token 
                                     AND user = idUser 
                                     AND tokenType = 'Site'");
        $queryPrepared->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        if (!empty($queryPrepared->fetch())) {
            login($email);
            return true;
        }
    }
    //session_destroy();
    return false;
}

/**
 * @return bool
 */
function isActivated()
{
    if (!empty($_SESSION["email"]) && !empty($_SESSION["token"])) {
        $email = $_SESSION["email"];
        $token = $_SESSION["token"];
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT isActivated FROM USER, USERTOKEN WHERE emailAddress = :email 
                                          AND USERTOKEN.token = :token 
                                          AND user = idUser 
                                          AND tokenType = 'Site'");
        $queryPrepared->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        $isActivated = $queryPrepared->fetch();
        return $isActivated["isActivated"];
    }
    return false;
}

/**
 * @return bool
 */
function isClient()
{
    if (!empty($_SESSION["email"]) && !empty($_SESSION["token"])) {
        $email = $_SESSION["email"];
        $token = $_SESSION["token"];
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT roleName FROM USER, SITEROLE, USERTOKEN WHERE emailAddress = :email 
                                                 AND USERTOKEN.token = :token 
                                                 AND user = idUser 
                                                 AND userRole = idRole
                                                 AND tokenType = 'Site'");
        $queryPrepared->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        $isAdmin = $queryPrepared->fetch();
        $isAdmin = $isAdmin["roleName"];
        if ($isAdmin == "Client") {
            return true;
        }
        return false;
    }
}

/**
 * @param $email
 */
function logout($email)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE USER, USERTOKEN SET USERTOKEN.token = null WHERE emailAddress = :email 
                                                    AND idUser = user 
                                                    AND tokenType = 'Site'");
    $queryPrepared->execute([":email" => $email]);
}

/**
 * @param $text
 * @param $tabLang
 * @param $setLanguage
 * @return mixed
 */
function getTranslate($text, $tabLang, $setLanguage)
{
    //si la value existe on traduit, sinon on laisse le texte pas défault
    if (array_key_exists($text, $tabLang) && array_key_exists($setLanguage, $tabLang[$text]))
        return $tabLang[$text][$setLanguage];
    else
        return $text;
}

/**
 * @param $email
 * @return mixed
 */
function lastCart($email)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idCart FROM USER, CART WHERE user = idUser AND emailAddress = :email ORDER BY idCart DESC LIMIT 1");
    $queryPrepared->execute([":email" => $email]);
    $idCart = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    return $idCart["idCart"];
}

/**
 * @param $idMenu
 * @return mixed|null
 */
function getStatusOfMenu($idMenu)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT status FROM MENUSSTATUS WHERE menus = :menu");
    $queryPrepared->execute([":menu" => $idMenu]);
    $status = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    if (empty($status)) {
        return null;
    }
    return $status["status"];
}

/**
 * @param $idProduct
 * @return mixed|null
 */
function getStatusOfProduct($idProduct)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT status FROM PRODUCTSTATUS WHERE product = :product");
    $queryPrepared->execute([":product" => $idProduct]);
    $status = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    if (empty($status)) {
        return null;
    }
    return $status["status"];
}

/**
 * @param $idTruck
 * @return array|null
 */
function allProductsFromTruck($idTruck)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idProduct, productName, productPrice FROM PRODUCTS WHERE truck = :truck");
    $queryPrepared->execute([":truck" => $idTruck]);
    $products = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    if (empty($products)) {
        return null;
    }
    return $products;
}

/**
 * @param $idTruck
 * @return array|null
 */
function allMenuFromTruck($idTruck)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idMenu, menuName, menuPrice, menuImage FROM MENUS WHERE truck = :truck");
    $queryPrepared->execute([":truck" => $idTruck]);
    $menus = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    if (empty($menus)) {
        return null;
    }
    return $menus;
}

/**
 * @param $idMenu
 * @param $idTruck
 * @return array|null
 */
function getProductsOfMenu($idMenu, $idTruck)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idProduct, productName, productPrice FROM PRODUCTS, SOLDIN WHERE product = idProduct AND menu = :menu AND truck = :truck");
    $queryPrepared->execute([
        ":menu" => $idMenu,
        ":truck" => $idTruck
    ]);
    $menus = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    if (empty($menus)) {
        return null;
    }
    return $menus;
}

/**
 * @param $idProduct
 * @return array|null
 */
function ingredientsFromProduct($idProduct)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idIngredient, ingredientName FROM INGREDIENTS, COMPOSE WHERE ingredient = idIngredient AND product = :product");
    $queryPrepared->execute([":product" => $idProduct]);
    $menus = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    if (empty($menus)) {
        return null;
    }
    return $menus;
}

function availableInTruck($idIngredient, $idTruck)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idWarehouse FROM WAREHOUSES, TRUCKWAREHOUSE WHERE idWarehouse = warehouse AND warehouseType = 'Camion' AND truck = :truck");
    $queryPrepared->execute([":truck" => $idTruck]);
    $warehouse = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $warehouse = $warehouse["idWarehouse"];

    $queryPrepared = $pdo->prepare("SELECT available FROM STORE WHERE warehouse = :warehouse AND ingredient = :ingredient");
    $queryPrepared->execute([
        ":warehouse" => $warehouse,
        ":ingredient" => $idIngredient
    ]);
    $available = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $available = $available["available"];
    return $available;
}

/**
 * @param $idCart
 * @return array|null
 */
function menusInCart($idCart)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idMenu, menuImage, menuName, menuPrice, truck, quantity FROM CARTMENU, MENUS WHERE menu = idMenu AND cart = :cart");
    $queryPrepared->execute([":cart" => $idCart]);
    $menus = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    if (empty($menus)) {
        return null;
    }
    return $menus;
}

/**
 * @param $idCart
 * @return array|null
 */
function productsInCart($idCart)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idProduct, productPrice, productName, quantity, truck FROM PRODUCTS, CARTPRODUCT WHERE cart = :cart AND idProduct = product");
    $queryPrepared->execute([":cart" => $idCart]);
    $menus = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    if (empty($menus)) {
        return null;
    }
    return $menus;
}

/**
 * @param $email
 * @return array|null
 */
function ordersOfUser($email)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idOrder, orderPrice, orderDate, truck, user, cart FROM ORDERS, USER WHERE  user = idUser AND orderType = 'Commande client' AND emailAddress = :email");
    $queryPrepared->execute([":email" => $email]);
    $orders = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    if (empty($orders)) {
        return null;
    }
    return $orders;
}

function statusOfOrder($idOrder)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT statusName FROM STATUS, ORDERSTATUS WHERE idStatus = status AND orders = :order");
    $queryPrepared->execute([":order" => $idOrder]);
    $status = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    if (empty($status)) {
        return null;
    }
    return $status;
}

/**
 * @return bool|mixed
 */
function getUserInfos()
{
    if (!empty($_SESSION["email"]) && !empty($_SESSION["token"])) {
        $email = $_SESSION["email"];
        $token = $_SESSION["token"];
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT idUser, firstname, lastname, emailAddress FROM USER, USERTOKEN WHERE emailAddress = :email 
                                          AND USERTOKEN.token = :token 
                                          AND user = idUser 
                                          AND tokenType = 'Site'");
        $queryPrepared->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        return $queryPrepared->fetch(PDO::FETCH_ASSOC);
    }
    return false;
}


function getEventsPreview()
{

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idEvent, truckName, eventDesc, eventImg, eventType, eventName, eventAddress, eventCity, eventPostalCode, eventBeginDate, eventEndDate, eventStartHour, eventEndHour FROM EVENTS, HOST, TRUCK WHERE event = idEvent AND truck = idTruck AND eventType = 'Dégustation' LIMIT 3");
    $queryPrepared->execute();
    return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

}

function getMenuForHomePage()
{

    $pdo = connectDB();

    $queryPrepared = $pdo->prepare("SELECT menuName, menuPrice, truck FROM MENUS ;");
    $queryPrepared->execute();
    return $getMenuName = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

}