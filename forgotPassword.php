<?php
session_start();
include "header.php";
require 'conf.inc.php';
require 'functions.php';

?>
    </head>
    <body>
<div class="container pt-5">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-login mx-auto mt-5 p-5">
            <div class="card-body">
                <?php
                if (isset($_SESSION["errors"])) {
                    echo "<div class='alert alert-danger'>";
                    foreach ($_SESSION["errors"] as $error) {
                        echo "<li>" . $error;
                    }
                    echo "</div>";
                } elseif (isset($_SESSION["success"])) {
                    echo "<div class='alert alert-success'>";
                    foreach ($_SESSION["success"] as $success) {
                        echo "<li>" . $success;
                    }
                    echo "</div>";
                }
                ?>
                <form method="POST" action="verifyEmail.php">
                    <div class="form-group">
                        Merci de saisir votre adresse email:
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control focus" placeholder="Adresse mail"
                                   required="required" autofocus="autofocus" name="inputEmail">
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary degrade btn-block pt-2 pb-2 " type="submit" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?>