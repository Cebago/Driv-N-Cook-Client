<?php

require "../conf.inc.php";
require "../functions.php";
session_start();

if (isset($_GET["idMenu"])) {

    $idMenu = $_GET["idMenu"];

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE CARTMENU SET quantity = quantity+1 WHERE menu = :idMenu");
    $queryPrepared->execute([
        ":idMenu" => $idMenu
    ]);

} else {
    echo "Erreur lors de la modification. Merci de réessayer";
}
