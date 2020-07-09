<?php
require "conf.inc.php";
require "functions.php";
if (!isset($_GET["cle"], $_GET["id"])) {
    header("Location: login.php");
}
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

if ($result["token"] != $token) {
    unset($_SESSION["id"]);
    header("Location: forgotPassword.php");
}
require "header.php";
?>
    <body>
<?php
require "navbar.php";
?>

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 blog-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i>
                            <?php echo getTranslate("Réinitialiser le mot de passe", $tabLang, $setLanguage); ?>
                        </i>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- Start Sample Area -->
    <section class="sample-text-area section-padding4">
        <div class="card-body">
            <form method="POST" action="verifyPassword.php">
                <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
                    <div class="card card-login mx-auto mt-5 p-5">
                        <?php
                        if (isset($_SESSION["errors"])) {
                            echo "<div class='alert alert-danger'>";
                            foreach ($_SESSION["errors"] as $error) {
                                echo "<li>" . getTranslate($error, $tabLang, $setLanguage) . "</li>";
                            }
                            echo "</div>";
                        }
                        unset($_SESSION["errors"]);
                        ?>
                        <p class="text-justify">
                            <?php echo getTranslate("Le mot de passe doit faire entre 8 et 30 caractères avec des minuscules, majuscules et chiffres", $tabLang, $setLanguage); ?>
                        </p>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="password" class="form-control focus"
                                       placeholder="<?php echo getTranslate("Nouveau mot de passe", $tabLang, $setLanguage); ?>"
                                       required="required" autofocus="autofocus" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="password" class="form-control focus"
                                       placeholder="<?php echo getTranslate("Confirmation de mot de passe", $tabLang, $setLanguage); ?>"
                                       required="required"
                                       autofocus="autofocus" name="passwordConfirm">
                            </div>
                        </div>
                        <input class="btn btn-primary degrade btn-block pt-2 pb-2 " type="submit"
                               value="<?php echo getTranslate("Se connecter", $tabLang, $setLanguage); ?>">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- End Sample Area -->

<?php
require 'footer.php';
?>