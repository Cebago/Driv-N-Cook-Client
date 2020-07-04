<?php session_start();
include "header.php";
require "conf.inc.php";
require "functions.php";
if (isset($_GET["id"]) && isset($_GET["cle"])) {
    ?>
    </head>
    <body>
    <?php
    if (!empty($_GET["id"]) && !empty($_GET["cle"])) {
        $id = $_GET["id"];
        $token = $_GET["cle"];
    }
    $_SESSION["id"] = $id;
    $_SESSION["token"] = $token;
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT USERTOKEN.token FROM USER, USERTOKEN WHERE idUser = :id AND tokenType = 'Site' AND user = idUser");
    $queryPrepared->execute([
        ":id" => $id
    ]);
    $result = $queryPrepared->fetch();
    if ($result["token"] == $token) {
        ?>
        <div class="container">
            <div class="card-body">
                <form method="POST" action="verifyPassword.php">
                    <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
                        <div class="card card-login mx-auto mt-5 p-5">
                            <?php
                            if (isset($_SESSION["errors"])) {
                                echo "<div class='alert alert-danger'>";
                                foreach ($_SESSION["errors"] as $error) {
                                    echo "<li>" . $error;
                                }
                                echo "</div>";
                            }
                            unset($_SESSION["errors"]);
                            ?>
                            <h3>Réinitialiser le mot de passe</h3>
                            <p class="text-justify">Votre mot de passe doit contenir au moins un chiffre, une minuscule
                                et une majuscule et comprendre au moins 8 caractères.</p>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="password" class="form-control focus" placeholder="Nouveau mot de passe"
                                           required="required" autofocus="autofocus" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <input type="password" class="form-control focus"
                                           placeholder="Confirmation mot de passe" required="required"
                                           autofocus="autofocus" name="passwordConfirm">
                                </div>
                            </div>
                            <input class="btn btn-primary degrade btn-block pt-2 pb-2 " type="submit" value="Connexion">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        header("Location: forgotPassword");
    }
} else {
    header("Location: login");
}
?>