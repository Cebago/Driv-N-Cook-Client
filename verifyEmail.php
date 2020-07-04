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
                //TODO ENVOYER LE MAIL AVEC LIEN DE REDIRECTION VERS NEWPASSWORD
            }
            if (!$error) {
                unset($_POST["inputEmail"]);
                $_SESSION["success"] = $listOfSuccess;
                header("Location: forgotPassword");
            } else {
                unset($_POST["inputEmail"]);
                $_SESSION["errors"] = $listOfErrors;
                header("Location: forgotPassword");
            }
        }
    } else {
        die("Tentative de Hack .... !!!!");
    }
} else {
    header("Location: login");
}