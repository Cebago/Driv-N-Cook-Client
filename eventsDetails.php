<?php
if (!isset($_GET) || empty($_GET)) {
    header("Location: events.php");
}
require 'functions.php';

$pdo = connectDB();
$queryPrepared = $pdo->prepare("SELECT idEvent, eventType, eventName, eventDesc, eventAddress, eventCity, eventPostalCode, 
       DATE_FORMAT(eventBeginDate, '%d/%m/%Y') as eventBeginDate, DATE_FORMAT(eventEndDate, '%d/%m/%Y') as eventEndDate, 
       DATE_FORMAT(eventStartHour, '%H:%i') as eventStartHour, DATE_FORMAT(eventEndHour, '%H:%i') as eventEndHour, eventImg FROM EVENTS WHERE idEvent = :id AND eventType = 'Dégustation'");
$queryPrepared->execute([":id" => $_GET["idEvent"]]);
$infos = $queryPrepared->fetch(PDO::FETCH_ASSOC);
if (empty($infos)) {
    header("Location: events.php");
}
require "navbar.php";
?>
    <!-- Banner Area Starts -->
    <section class="banner-area banner-area2 contact-bg text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <i>
                            <?php echo $infos["eventName"]; ?>
                        </i>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="update-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <img src="<?php echo $infos["eventImg"] ?>" alt="" class="img-fluid">
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <?php echo $infos["eventDesc"]; ?>
                        </div>
                        <div class="card-body">
                            <p>
                                <?php
                                echo getTranslate("Ouvert du", $tabLang, $setLanguage) . " " . $infos["eventBeginDate"] . " - " . $infos["eventStartHour"];
                                ?>
                            </p>
                            <p>
                                <?php
                                echo getTranslate("au", $tabLang, $setLanguage) . " " . $infos["eventBeginDate"] . " - " . $infos["eventStartHour"];
                                ?>
                            </p>
                        </div>
                        <div class="card-footer">
                            <?php
                            echo $infos["eventAddress"] . ", " . $infos["eventPostalCode"] . "&nbsp;" . $infos["eventCity"];
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php require 'footer.php'; ?>