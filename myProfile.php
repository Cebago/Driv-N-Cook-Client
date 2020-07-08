<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <?php
    session_start();
    require "conf.inc.php";
    require "functions.php";

    if (!isConnected() || !isActivated()) {
        header("Location: login.php");
    }

    require "header.php" ?>
<body>
<?php
require "navbar.php";
?>

<!-- Banner Area Starts -->
<section class="banner-area banner-area2 blog-page text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><i>Mon profil</i></h1>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- Start Sample Area -->
<section class="sample-text-area section-padding4">
    <div class="col-md-11 mx-auto mt-5">
        <h5 class="" id="seeProfile">Consulation du profil</h5>
    </div>
    <form class="col-md-11 mx-auto mt-3" action="./functions/updateProfile.php" method="POST">
        <div class="mt-5" id="profile"></div>
        <div class="col-md-11 mt-5 mx-auto" id="buttons">
            <button class="btn btn-primary ml-3 float-left" type="button" onclick="unlockForm()"><i
                        class="fas fa-unlock-alt"></i>&nbsp;Débloquer le formulaire
            </button>
        </div>
    </form>
    <script>
        function getProfileDetails() {
            const profile = document.getElementById('profile');

            const request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    //console.log(request.responseText);
                    let myJson = JSON.parse(request.responseText);
                    let myJsonKeys = Object.keys(myJson[0])
                    for (let i = 0; i < myJsonKeys.length; i++) {
                        let pdiv = document.createElement("div");
                        let cdiv = document.createElement("div");
                        let span = document.createElement("span");
                        let input = document.createElement("input");

                        pdiv.className = "input-group flex-nowrap mt-2";
                        cdiv.className = "input-group-prepend";
                        span.id = myJsonKeys[i];
                        span.className = "input-group-text";

                        if (myJsonKeys[i] === "idUser") {
                            span.innerHTML = "Numéro d'utilisateur";
                        } else if (myJsonKeys[i] === "emailAddress") {
                            span.innerHTML = "Adresse email";
                        } else if (myJsonKeys[i] === "lastname") {
                            span.innerHTML = "Nom de famille";
                        } else if (myJsonKeys[i] === "firstname") {
                            span.innerHTML = "Prénom";
                        } else if (myJsonKeys[i] === "createDate") {
                            span.innerHTML = "Date de création du compte";
                        } else if (myJsonKeys[i] === "postalCode") {
                            span.innerHTML = "Code postal";
                        } else if (myJsonKeys[i] === "phoneNumber") {
                            span.innerHTML = "Numéro de téléphone";
                        } else if (myJsonKeys[i] === "roleName") {
                            span.innerHTML = "Votre rôle sur le site";
                        } else if (myJsonKeys[i] === "address") {
                            span.innerHTML = "Adresse";
                        } else if (myJsonKeys[i] === "fidelityCard") {
                            span.innerHTML = "Votre numéro de carte fidélité";
                        } else if (myJsonKeys[i] === "city") {
                            span.innerHTML = "Ville";
                        }

                        cdiv.appendChild(span);
                        pdiv.appendChild(cdiv);
                        input.id = myJsonKeys[i];
                        input.name = myJsonKeys[i];
                        input.className = "form-control";
                        input.placeholder = myJsonKeys[i];
                        input.value = myJson[0][myJsonKeys[i]];
                        input.setAttribute("readonly", "readonly");
                        input.setAttribute("required", "true");
                        pdiv.appendChild(input);
                        profile.appendChild(pdiv);
                    }
                }
            };
            request.open('GET', 'functions/profilDetails.php');
            request.send();
        }

        window.onload = getProfileDetails;

        function unlockForm() {
            const input = document.getElementsByClassName('form-control');
            for (let i = 0; i < input.length; i++) {
                if (input[i].id !== "idUser"
                    && input[i].id !== "fidelityCard"
                    && input[i].id !== "roleName"
                    && input[i].id !== "createDate"
                    && input[i].id !== "emailAddress") {
                    input[i].removeAttribute('readonly');
                }
            }
            createFormButton();
        }

        function createFormButton() {
            const valid = document.getElementById('valid');
            const cancel = document.getElementById('cancel');
            if (valid === null && cancel === null) {
                const buttonDiv = document.getElementById('buttons');
                const buttonValidation = document.createElement('button');
                const cancelButton = document.createElement('a');
                buttonValidation.innerHTML = '<i class="fas fa-check"></i>&nbsp;Valider le formulaire';
                buttonValidation.className = "btn btn-success float-right mr-3 btn-lg";
                buttonValidation.type = "submit";
                buttonValidation.id = "valid";

                cancelButton.innerHTML = '<i class="fas fa-times"></i>&nbsp;Annuler le formulaire';
                cancelButton.className = "btn btn-danger float-right mr-3 btn-lg";
                cancelButton.href = "./myProfile.php"
                cancelButton.type = "button";
                cancelButton.id = "cancel";

                buttonDiv.appendChild(buttonValidation);
                buttonDiv.appendChild(cancelButton);
            }
        }

    </script>
</section>
<!-- End Sample Area -->

<!-- Footer Area Starts -->
<footer class="footer-area">
    <div class="footer-widget section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-widget single-widget1">
                        <a href="index.html"><img src="assets/images/logo/logo2.png" alt=""></a>
                        <p class="mt-3">Which morning fourth great won't is to fly bearing man. Called unto shall seed,
                            deep, herb set seed land divide after over first creeping. First creature set upon stars
                            deep male gathered said she'd an image spirit our</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-widget single-widget2 my-5 my-md-0">
                        <h5 class="mb-4">contact us</h5>
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="info-text">
                                <p>1234 Some St San Francisco, CA 94102, US 1.800.123.4567 </p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="info-text">
                                <p>(123) 456 78 90</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="info-text">
                                <p>support@axiomthemes.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-widget single-widget3">
                        <h5 class="mb-4">opening hours</h5>
                        <p>Monday ...................... Closed</p>
                        <p>Tue-Fri .............. 10 am - 12 pm</p>
                        <p>Sat-Sun ............... 8 am - 11 pm</p>
                        <p>Holidays ............. 10 am - 12 pm</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                        <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                    class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                                                                        target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="social-icons">
                        <ul>
                            <li class="no-margin">Follow Us</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->
<?php require "footer.php" ?>