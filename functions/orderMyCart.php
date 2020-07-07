<?php
session_start();
require "../conf.inc.php";
require "../functions.php";

if (isConnected() && isActivated()) {
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idUser FROM USER WHERE emailAddress = :email");
    $queryPrepared->execute([":email" => $_SESSION["email"]]);
    $info = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $idUser = $info["idUser"];

    $cart = lastCart($_SESSION["email"]);

    $queryPrepared = $pdo->prepare("SELECT cartPrice FROM CART WHERE idCart = :cart");
    $queryPrepared->execute([":cart" => $cart]);
    $price = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $price = $price["cartPrice"];

    if (menusInCart($cart) != null) {
        $queryPrepared = $pdo->prepare("SELECT truck FROM MENUS, CART, CARTMENU WHERE cart = idCart AND menu = idMenu AND idCart = :cart");
        $queryPrepared->execute([
            ":cart" => $cart
        ]);
    } else {
        $queryPrepared = $pdo->prepare("SELECT truck FROM PRODUCTS, CART, CARTPRODUCT WHERE cart = idCart AND product = idProduct AND idCart = :cart");
        $queryPrepared->execute([
            ":cart" => $cart
        ]);
    }
    $truck = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $truck = $truck["truck"];

    $queryPrepared = $pdo->prepare("INSERT INTO ORDERS (orderPrice, orderType, truck, user) VALUES (:orderPrice, 'Commande client', :truck, :user)");
    $queryPrepared->execute([
        ":orderPrice" => $price,
        ":truck" => $truck,
        ":user" => $idUser
    ]);
    $order = $pdo->lastInsertId();
    $queryPrepared = $pdo->prepare("INSERT INTO ORDERSTATUS (orders, status) VALUES (:order, 3)");
    $queryPrepared->execute([
        ":order" => $order
    ]);
    $queryPrepared = $pdo->prepare("INSERT INTO ORDERSTATUS (orders, status) VALUES (:order, 27)");
    $queryPrepared->execute([
        ":order" => $order
    ]);

    $queryPrepared = $pdo->prepare("UPDATE CARTSTATUS SET status = 8 WHERE cart = :cart");
    $queryPrepared->execute([
        ":cart" => $cart
    ]);


    $queryPrepared = $pdo->prepare("INSERT INTO CART (cartPrice, cartType, user) VALUES (0, 'Commande client', :user)");
    $queryPrepared->execute([":user" => $idUser]);

    $newCart = $pdo->lastInsertId();
    $queryPrepared = $pdo->prepare("INSERT INTO CARTSTATUS (cart, status) VALUES (:cart, 9)");
    $queryPrepared->execute([":cart" => $newCart]);

    header("Location: ../orderHistory.php");
} else {
    header("Location: ../login.php");
}