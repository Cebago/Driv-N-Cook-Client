<?php
session_start();
require "conf.inc.php";
require "functions.php";

if (isset($_SESSION["id"]) && isset($_SESSION["token"])) {


    if (count($_POST) == 2
        && !empty($_POST["password"])
        && !empty($_POST["passwordConfirm"])) {
        $pwd = $_POST["password"];
        $pwdConfirm = $_POST["passwordConfirm"];
        $id = $_SESSION["id"];
        $token = $_SESSION["token"];
        $error = false;
        $listOfErrors = [];
        //pwd : entre 8 caractères et 30
        //Majuscule, minuscules, chiffres
        if (strlen($pwd) < 8 || strlen($pwd) > 30
            || !preg_match("#[a-z]#", $pwd)
            || !preg_match("#[A-Z]#", $pwd)
            || !preg_match("#\d#", $pwd)) {
            $error = true;
            $listOfErrors[] = "Le mot de passe doit faire entre 8 et 30 caractères avec des minuscules, majuscules et chiffres";
        }

        //pwdConfirm : correspond à pwd
        if ($pwdConfirm != $pwd) {
            $error = true;
            $listOfErrors[] = "Le mot de passe de confirmation ne correspond pas";
        }

        if ($error) {
            unset($_POST["password"]);
            unset($_POST["passwordConfirm"]);
            $_SESSION["errors"] = $listOfErrors;
            $_SESSION["inputErrors"] = $_POST;
            //Rediriger sur newPassword.php
            $link = "https://" . $_SERVER["SERVER_NAME"] . "/newPassword?id=" . urlencode($id) . "&cle=" . urlencode($token);
            header("Location: " . $link);
        } else {
            $pdo = connectDB();
            $queryPrepared = $pdo->prepare("UPDATE USER, USERTOKEN SET pwd = :password WHERE idUser = :idUser 
                                             AND USERTOKEN.token = :token 
                                             AND user = idUser 
                                             AND tokenType = 'Site'");
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $queryPrepared->execute([
                ":password" => $pwd,
                ":idUser" => $id,
                ":token" => $token
            ]);
            $queryPrepared = $pdo->prepare("UPDATE USER, USERTOKEN SET USERTOKEN.token = null WHERE idUser = :idUser 
                                                    AND pwd = :password
                                                    AND idUser = user
                                                    AND tokenType = 'Site'");
            $queryPrepared->execute([
                ":idUser" => $id,
                ":password" => $pwd
            ]);
            header("Location: login.php");
        }
    } else {
        die("Tentative de Hack .... !!!!");
    }
} else {
    header("Location: login.php");
}

