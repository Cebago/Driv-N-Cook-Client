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
                <h1>
                    <i>
                        <?php echo getTranslate("Mon profil", $tabLang, $setLanguage); ?>
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
        <h5 class="" id="seeProfile">
            <?php echo getTranslate("Consultation du profil", $tabLang, $setLanguage); ?>
        </h5>
    </div>
    <form class="col-md-11 mx-auto mt-3" action="./functions/updateProfile.php" method="POST">
        <div class="mt-5" id="profile"></div>
        <div class="col-md-11 mt-5 mx-auto" id="buttons">
            <button class="btn btn-primary ml-3 float-left" type="button" onclick="unlockForm()"><i
                        class="fas fa-unlock-alt"></i>&nbsp;
                <?php echo getTranslate("Débloquer le formulaire", $tabLang, $setLanguage); ?>
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
                            span.innerHTML = "<?php echo getTranslate('Numéro d\'utilisateur', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "emailAddress") {
                            span.innerHTML = "<?php echo getTranslate('Adresse mail', $tabLang, $setLanguage); ?>"
                        } else if (myJsonKeys[i] === "lastname") {
                            span.innerHTML = "<?php echo getTranslate('Nom', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "firstname") {
                            span.innerHTML = "<?php echo getTranslate('Prénom', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "createDate") {
                            span.innerHTML = "<?php echo getTranslate('Date de création du compte', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "postalCode") {
                            span.innerHTML = "<?php echo getTranslate('Code postal', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "phoneNumber") {
                            span.innerHTML = "<?php echo getTranslate('Numéro de téléphone', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "roleName") {
                            span.innerHTML = "<?php echo getTranslate('Votre rôle sur le site', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "address") {
                            span.innerHTML = "<?php echo getTranslate('Adresse', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "fidelityCard") {
                            span.innerHTML = "<?php echo getTranslate('Votre numéro de carte fidélité', $tabLang, $setLanguage); ?>";
                        } else if (myJsonKeys[i] === "city") {
                            span.innerHTML = "<?php echo getTranslate('Ville', $tabLang, $setLanguage); ?>";
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
                buttonValidation.innerHTML = '<i class="fas fa-check"></i>&nbsp;<?php echo getTranslate("Valider le formulaire", $tabLang, $setLanguage); ?>';
                buttonValidation.className = "btn btn-success float-right mr-3 btn-lg";
                buttonValidation.type = "submit";
                buttonValidation.id = "valid";

                cancelButton.innerHTML = '<i class="fas fa-times"></i>&nbsp;<?php echo getTranslate("Annuler le formulaire", $tabLang, $setLanguage); ?>';
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

<?php require "footer.php" ?>