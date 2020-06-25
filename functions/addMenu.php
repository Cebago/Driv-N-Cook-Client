<?php

require "../conf.inc.php";
require "../functions.php";
session_start();

if (isset($_GET["idMenu"])) {

    $idMenu = $_GET["idMenu"];
    $email = $_SESSION["email"];

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idCart, idUser FROM CART, USER WHERE USER.idUser = user AND emailAddress = :email ORDER BY idCart DESC;");
    $queryPrepared->execute([
        ":email" => $email
    ]);
    $result = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    $idCart = $result[0]["idCart"];
    $idUser = $result[0]["idUser"];


    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("INSERT INTO CARTMENU (cart,menu,quantity) VALUES (:cart,:menu,1) ON DUPLICATE KEY UPDATE quantity = quantity + 1;");
    $queryPrepared->execute([
        ":cart" => $idCart,
        ":menu" => $idMenu
    ]);

} else {
    echo "Erreur lors de la modification. Merci de réessayer";
}
