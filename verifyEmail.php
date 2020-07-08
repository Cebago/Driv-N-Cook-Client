<?php
session_start();

require "conf.inc.php";
require "functions.php";

if (isset($_POST["inputEmail"])) {
    if (count($_POST) == 1
        && !empty($_POST["inputEmail"])) {

        $error = false;
        $listOfErrors = [];
        $success = false;
        $listOfSuccess = [];

        $email = strtolower(trim($_POST["inputEmail"]));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $listOfErrors[] = "L'email n'est pas valide";
        }
        if (!$error) {
            $pdo = connectDB();
            $queryPrepared = $pdo->prepare("SELECT idUser FROM USER WHERE emailAddress = :email");
            $queryPrepared->execute([":email" => $email]);
            $result = $queryPrepared->fetch();
            $id = $result["idUser"];
            if (empty($result)) {
                $error = true;
                $listOfErrors[] = "Aucun compte trouvé";
            } else {
                $success = true;
                $listOfSuccess[] = "Un email vous a été envoyé pour réinitialiser votre mot de passe";

                $token = createToken($email);
                $queryPrepared = $pdo->prepare("UPDATE USER, USERTOKEN SET USERTOKEN.token = :token WHERE emailAddress = :email 
                                                 AND idUser = :id
                                                 AND idUser = user
                                                 AND tokenType = 'Site'");
                $queryPrepared->execute([
                    ":token" => $token,
                    ":email" => $email,
                    ":id" => $id
                ]);
                $admin = ($_SERVER["SERVER_ADMIN"]);
                $destination = $email;
                $domaineAddresse = substr($admin, strpos($admin, '@') + 1, strlen($admin));
                $header = "From: no-reply@" . $domaineAddresse . "\n";
                $header .= "X-Sender: <no-reply@" . $domaineAddresse . "\n";
                $header .= "X-Mailer: PHP\n";
                $header .= "Return-Path: <no-reply@" . $domaineAddresse . "\n";
                $header .= "Content-Type: text/html; charset=iso-8859-1\n";
                $subject = "Réinitialisation de votre mot de passe";
                $link = "https://" . $admin . "/newPassword.php?id=" . $id . "&cle=" . $token;
                $html = file_get_contents("./mail.php");
                $html = str_replace("{{LINK}}", $link, $html);
                mail($destination, $subject, $html, $header);
            }
            if (!$error) {
                unset($_POST["inputEmail"]);
                $_SESSION["success"] = $listOfSuccess;
                header("Location: forgotPassword.php");
            } else {
                unset($_POST["inputEmail"]);
                $_SESSION["errors"] = $listOfErrors;
                header("Location: forgotPassword.php");
            }
        }
    } else {
        die("Tentative de Hack .... !!!!");
    }
} else {
    header("Location: login.php");
}