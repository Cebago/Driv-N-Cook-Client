<?php
require "conf.inc.php";
require "functions.php";

if (isset($_POST["sender"]) && isset($_POST["subject"]) && !empty($_POST["destinataire"]) && !empty($_POST["message"]) ) {
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("INSERT INTO CONTACT(user, contactSubject, receiver, contactDescription) values(:sender, :subject, :destinataire, :message);");
    $queryPrepared->execute([":sender" => $_POST["sender"], ":subject" => $_POST["subject"],":destinataire" => $_POST["destinataire"],":message" => $_POST["message"],]);

    unset($_POST["sender"]);
    unset($_POST["subject"]);
    unset($_POST["destinataire"]);
    unset($_POST["message"]);
}