<?php

require "../conf.inc.php";
require "../functions.php";
session_start();


if (isset($_GET["cart"], $_GET["product"])){

    $cart = $_GET["cart"];
    $product = $_GET["product"];

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE CARTPRODUCT SET quantity = quantity-1 WHERE cart = :cart AND product = :product");
    $queryPrepared->execute([
        ":cart" => $cart,
        ":product" => $product
    ]);

}else{
    echo "Erreur lors de la modification. Merci de réessayer";
}