<?php
session_start();
require "../conf.inc.php";
require "../functions.php";

//$lang = $_POST["lang"];

$jsonFile = file_get_contents('../assets/traduction.json');
$jsonFile = json_decode($jsonFile, true);
$tabLang = $jsonFile['values'];
if (isset($_COOKIE['Lang'])) {
    $setLanguage = $_COOKIE['Lang'];
} else {
    setcookie("Lang", "fr_FR", time() + 86400, '/');
    $setLanguage = "fr_FR";
}

$truck = $_POST["truck"];

$pdo = connectDB();
$queryPrepared = $pdo->prepare("SELECT openDay FROM pa2a2drivncook.OPENDAYS WHERE truck = :truck GROUP BY openDay ORDER BY DAYOFWEEK(openDay)");
$queryPrepared->execute([
    ":truck" => $truck
]);
$day = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
$tmp = [];
for ($i = 0; $i < count($day); $i++) {
    $queryPrepared = $pdo->prepare("SELECT openDay, DATE_FORMAT(startHour,'%H:%i') as startHour, DATE_FORMAT(endHour,'%H:%i') as endHour FROM OPENDAYS WHERE truck = :truck AND openDay = :day ORDER BY hour(startHour)");
    $queryPrepared->execute([
        ":day" => $day[$i]["openDay"],
        ":truck" => $truck
    ]);
    $open = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
    $tmp = array_merge($tmp, $open);
    $tmp[$i]["openDay"] = getTranslate($tmp[$i]["openDay"], $tabLang, $setLanguage);
}

echo json_encode($tmp);