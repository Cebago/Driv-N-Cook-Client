<?php

require "../conf.inc.php";
require "../functions.php";
session_start();

if (isset($_GET["product"]) && isset($_GET["cart"])) {
    $idCart = $_GET["cart"];
    $idProduct = $_GET["product"];
    $email = $_SESSION["email"];

    $pdo = connectDB();

    $queryPrepared = $pdo->prepare("SELECT truck, productPrice FROM PRODUCTS WHERE idProduct = :product;");
    $queryPrepared->execute([
        ":product" => $idProduct
    ]);
    $idTruck = $queryPrepared->fetch(PDO::FETCH_ASSOC);
    $price = $idTruck["productPrice"];

    $queryPrepared = $pdo->prepare("SELECT truck FROM CARTPRODUCT, PRODUCTS WHERE cart = :cart AND product = idProduct AND truck != :truck ;");
    $queryPrepared->execute([
        ":cart" => $idCart,
        ":truck" => $idTruck["truck"]
    ]);
    $productInCart = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

    $queryPrepared = $pdo->prepare("SELECT truck FROM CARTMENU, MENUS WHERE cart = :cart AND menu = idMenu AND truck != :truck ;");
    $queryPrepared->execute([
        ":cart" => $idCart,
        ":truck" => $idTruck["truck"]
    ]);
    $menuInCart = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($productInCart) || !empty($menuInCart)) {
        echo "Vous ne pouvez pas ajouter un produit provenant d'un autre camion";
    } else {
        $queryPrepared = $pdo->prepare("INSERT INTO CARTPRODUCT (cart, product, quantity) VALUES (:cart, :product, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1;");
        $queryPrepared->execute([
            ":cart" => $idCart,
            ":product" => $idProduct
        ]);

        $queryPrepared = $pdo->prepare("UPDATE CART SET cartPrice = cartPrice + :price WHERE idCart = :cart");
        $queryPrepared->execute([
            ":price" => $price,
            ":cart" => $idCart
        ]);
    }
} else {
    echo "Erreur lors de la modification. Merci de réessayer";
}
