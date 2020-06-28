<?php

require('navbar.php');



if(!isConnected())
    header("Location: login.php");


$user = getUserInfos();
$trucks = getTrucks();

?>

    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 contact-bg text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1><i><?php getTranslate("Contactez-nous", $tabLang, $setLanguage);?></i></h1>

                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- Contact Form Starts -->

    <section class="contact-form section-padding3" style="margin-top: 30px;">
        <div class="container">
            <div class="row">
               <div class="col-lg-12">
                    <form action="#">
                        <div class="left">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <input type="text" disabled value="<?php echo $user["firstname"]?>" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" disabled value="<?php echo $user["lastname"]?>" required>
                                </div>
                            </div>
                            <input type="email" disabled value="<?php echo $user["emailAddress"]?>" required>
                            <input type="text" placeholder="<?php getTranslate("Sujet", $tabLang, $setLanguage);?> *" required>

                            <select class="custom-select">
                                <option value="0"><?php getTranslate("Administration", $tabLang, $setLanguage);?></option>
                                <?php
                                    foreach ($trucks as $truck){
                                        if($truck["idTruck"] == $_GET["idTruck"])
                                            echo '<option selected value="'.$truck["truckName"].'">'.$truck["truckName"].'</option>';
                                        else
                                            echo '<option value="'.$truck["truckName"].'">'.$truck["truckName"].'</option>';
                                    }
                                  ?>

                            </select>
                        </div>
                        <div class="right">
                            <textarea name="message" cols="20" rows="10" placeholder="<?php getTranslate("Message", $tabLang, $setLanguage);?>" required></textarea>
                        </div>
                        <button type="submit" class="template-btn"><?php getTranslate("Envoyer", $tabLang, $setLanguage);?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form End -->

<?php
include "footer.php";
?>