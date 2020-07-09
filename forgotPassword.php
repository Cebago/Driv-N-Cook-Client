<?php
session_start();
require "header.php";
?>
    <body>
<?php require "navbar.php" ?>

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 blog-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i>
                            <?php echo getTranslate("Mot de passe oublié", $tabLang, $setLanguage); ?>
                        </i>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- Start Sample Area -->
    <section class="sample-text-area section-padding4">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-login mx-auto mt-5 p-3">
                <div class="card-body">
                    <?php
                    if (isset($_SESSION["errors"])) {
                        echo "<div class='alert alert-danger'>";
                        foreach ($_SESSION["errors"] as $error) {
                            echo "<li>" . getTranslate($error, $tabLang, $setLanguage);
                        }
                        echo "</div>";
                    } elseif (isset($_SESSION["success"])) {
                        echo "<div class='alert alert-success'>";
                        foreach ($_SESSION["success"] as $success) {
                            echo "<li>" . getTranslate($success, $tabLang, $setLanguage);
                        }
                        echo "</div>";
                    }
                    ?>
                    <form method="POST" action="verifyEmail.php">
                        <div class="form-group">
                            <?php echo getTranslate("Merci de saisir votre adresse", $tabLang, $setLanguage); ?>:
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control focus"
                                       placeholder="<?php echo getTranslate("Adresse mail", $tabLang, $setLanguage); ?>"
                                       required="required" autofocus="autofocus" name="inputEmail">
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="template-btn template-btn2 mt-4 pt-2 pb-2" type="submit"
                                   value="<?php echo getTranslate("Envoyer", $tabLang, $setLanguage); ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Sample Area -->

<?php
require 'footer.php';
?>