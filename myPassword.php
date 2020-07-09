<?php
session_start();
require "conf.inc.php";
require "functions.php";

if (!isConnected() || !isActivated() || !isClient()) {
    header("Location: login.php");
}

require "navbar.php";
?>

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 blog-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i>
                            <?php echo getTranslate("Changer mon mot de passe", $tabLang, $setLanguage); ?>
                        </i>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- Start Sample Area -->
    <section class="sample-text-area section-padding4">
        <div class="col-md-11 mx-auto mt-5">
            <div class="mt-5">
                <div>
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
                </div>
                <form class="col-md-11 mx-auto mt-5" action="./functions/updatePassword.php" method="POST">
                    <div class="input-group flex-nowrap mt-1 col-md-5 mx-auto">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <?php echo getTranslate("Ancien mot de passe", $tabLang, $setLanguage); ?>
                            </span>
                        </div>
                        <input class="form-control" type="password" name="oldPassword"
                               placeholder="<?php echo getTranslate("Ancien mot de passe", $tabLang, $setLanguage); ?>"
                               required>
                    </div>
                    <div class="input-group flex-nowrap mt-1 col-md-5 mx-auto">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <?php echo getTranslate("Nouveau mot de passe", $tabLang, $setLanguage); ?>
                            </span>
                        </div>
                        <input class="form-control" type="password"
                               placeholder="<?php echo getTranslate("Nouveau mot de passe", $tabLang, $setLanguage); ?>"
                               name="newPassword" required>
                    </div>
                    <div class="input-group flex-nowrap mt-1 col-md-5 mx-auto">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <?php echo getTranslate("Confirmation de mot de passe", $tabLang, $setLanguage); ?>
                            </span>
                        </div>
                        <input class="form-control" type="password"
                               placeholder="<?php echo getTranslate("Confirmation de mot de passe", $tabLang, $setLanguage); ?>"
                               name="confirm" required>
                    </div>
                    <div class="mt-5 col-md-2 mx-auto">
                        <button class="btn btn-warning"
                                type="submit"><?php echo getTranslate("Changer mon mot de passe", $tabLang, $setLanguage); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Sample Area -->
<?php
require "footer.php";
?>