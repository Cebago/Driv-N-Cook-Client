<?php
session_start();
require "navbar.php" ?>
<body>

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
    <div class="container col-md-2 mx-auto">
        <a class="genric-btn primary circle mx-auto" href="{{LINK}}">
            <?php echo getTranslate("Changer mon mot de passe", $tabLang, $setLanguage); ?>
        </a>
    </div>
</section>
<!-- End Sample Area -->


<?php require "footer.php"; ?>