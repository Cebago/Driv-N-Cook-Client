<?php
session_start();
require "conf.inc.php";
require "functions.php";


if (!isConnected())
    header("Location: login.php");

require("navbar.php");

$user = getUserInfos();
$trucks = getTrucks();

?>

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 contact-bg text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i><?php echo getTranslate("Contactez-nous", $tabLang, $setLanguage); ?></i></h1>

                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->
    <!-- Contact Form Starts -->
    <section class="contact-form section-padding3" style="margin-top: 30px;">
        <div class="container">
            <?php
            if (isset($_POST["sender"]) && isset($_POST["subject"]) && !empty($_POST["destinataire"]) && isset($_POST["message"])) {

                $pdo = connectDB();
                $queryPrepared = $pdo->prepare("INSERT INTO CONTACT(user, contactSubject, receiver, contactDescription) values(:sender, :subject, :destinataire, :message);");
                $queryPrepared->execute([
                    ":sender" => $_POST["sender"],
                    ":subject" => $_POST["subject"],
                    ":destinataire" => $_POST["destinataire"],
                    ":message" => $_POST["message"]]);

                unset($_POST["sender"]);
                unset($_POST["subject"]);
                unset($_POST["destinataire"]);
                unset($_POST["message"]);

                ?>
                <div class="row" id="thanksMessage">
                    <div class="col-md-5">
                        <div class="section-top">
                            <?php echo getTranslate("confirmContact1", $tabLang, $setLanguage); ?>
                            <p> <?php echo getTranslate("confirmContact2", $tabLang, $setLanguage); ?></p>

                        </div>
                    </div>
                </div>
                <?php
            } else if (isset($_POST["sender"]) && isset($_POST["subject"]) && isset($_POST["message"])) {

                $pdo = connectDB();
                $queryPrepared = $pdo->prepare("INSERT INTO CONTACT(user, contactSubject, contactDescription) values(:sender, :subject, :message);");
                $queryPrepared->execute([
                    ":sender" => $_POST["sender"],
                    ":subject" => $_POST["subject"],
                    ":message" => $_POST["message"]]);

                unset($_POST["sender"]);
                unset($_POST["subject"]);
                unset($_POST["message"]);

                ?>
                <div class="row" id="thanksMessage">
                    <div class="col-md-5">
                        <div class="section-top">
                            <?php echo getTranslate("confirmContact1 ", $tabLang, $setLanguage); ?>
                            <p> <?php echo getTranslate("confirmContact2", $tabLang, $setLanguage); ?></p>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="contact-us.php" id="formContact">
                            <div class="left">
                                <div class="form-row">
                                    <input type="text" name="sender" hidden value="<?php echo $user["idUser"] ?>"
                                           required>

                                    <div class="col-md-6">
                                        <input type="text" disabled value="<?php echo $user["firstname"] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" disabled value="<?php echo $user["lastname"] ?>" required>
                                    </div>
                                </div>
                                <input type="email" disabled value="<?php echo $user["emailAddress"] ?>" required>
                                <input type="text" name="subject"
                                       placeholder="<?php echo getTranslate("Sujet", $tabLang, $setLanguage); ?> *" required>

                                <select name="destinataire" class="custom-select">
                                    <option value=""><?php echo getTranslate("Administration", $tabLang, $setLanguage); ?></option>
                                    <?php
                                    foreach ($trucks as $truck) {
                                        if ($truck["idTruck"] == $_GET["idTruck"])
                                            echo '<option selected value="' . $truck["idTruck"] . '">' . $truck["truckName"] . '</option>';
                                        else
                                            echo '<option value="' . $truck["idTruck"] . '">' . $truck["truckName"] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="right">
                                <textarea name="message" cols="20" rows="10"
                                          placeholder="<?php getTranslate("Message", $tabLang, $setLanguage); ?>"
                                          required></textarea>
                            </div>
                            <button type="submit"
                                    class="template-btn"><?php echo getTranslate("Envoyer", $tabLang, $setLanguage); ?></button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- Contact Form End -->


<?php
include "footer.php";
?>