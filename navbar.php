<?php
require 'header.php';

require_once 'functions.php';

$jsonFile = file_get_contents('assets/traduction.json');
$jsonFile =  json_decode($jsonFile, true);
$headerTabLang = $jsonFile['header'];
$tabLang = $jsonFile['values'];
if(isset($_COOKIE['Lang'])){
    $setLanguage = $_COOKIE['Lang'];
}else{
    setcookie("Lang", "fr_FR", time() + 86400, '/');
    $setLanguage = "fr_FR";
}

?>


</head>
<body>

<!-- Preloader Starts -->
<div class="preloader">
    <div class="spinner"></div>
</div>
<!-- Preloader End -->

<!-- Header Area Starts -->
<div class="sticky-top ">
    <header class="header-area shadow-lg p-3 mb-5 bg-info rounded-pill">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="index.html"><img src="./img/logo.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="main-menu">
                        <ul>
                            <li class="active"><a href="index.html"><?php getTranslate("accueil", $tabLang, $setLanguage);?></a></li>
                            <li><a href="about.html"><?php getTranslate("nos camions", $tabLang, $setLanguage);?></a></li>
                            <li><a href="menu.html"><?php getTranslate("evenements", $tabLang, $setLanguage);?></a></li>
                            <li><a href="http://franchises.drivncook.fr"><?php getTranslate("rejoignez-nous", $tabLang, $setLanguage);?></a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon <?php echo $headerTabLang[$setLanguage]["icon"] ?>"> </span> <?php echo $headerTabLang[$setLanguage]["name"] ?></a>
                                <div class="dropdown-menu bg-info border-light" aria-labelledby="dropdown09">
                                    <?php
                                    foreach($headerTabLang as $key => $value){
                                        if($key != $setLanguage )
                                            echo "<a class=\"dropdown-item\" href=\"./functions/changeLanguage.php?lang=".$key."\" ><span class=\"flag-icon ".$value['icon']."\"> </span> ".$value['name']."</a>";
                                    } ?>


                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
<!-- Header Area End -->
