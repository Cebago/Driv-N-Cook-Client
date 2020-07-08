<?php
require_once "conf.inc.php";

function connectDB()
{
    try {
        $pdo = new PDO(DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPWD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
    return $pdo;
}

function createToken($email)
{
    $token = md5($email . "€monTokenDrivNCook£" . time() . uniqid());
    $token = substr($token, 0, rand(15, 20));
    return $token;
}

function login($email)
{
    $token = createToken($email);
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE USERTOKEN, USER SET USERTOKEN.token = :token WHERE user = idUser AND emailAddress = :email AND tokenType = 'Site' ;");
    $queryPrepared->execute([":token" => $token, ":email" => $email]);
    $_SESSION["token"] = $token;
    $_SESSION["email"] = $email;
}

/**
 * @return array
 */

function getTrucks()
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idTruck, truckName, truckPicture, categorie FROM TRUCK;");
    $queryPrepared->execute();
    return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param $idTruck
 * @return bool
 */
function isOpen($idTruck)
{
    $translateDay = [
        1 => "Lundi",
        2 => "Mardi",
        3 => "Mercredi",
        4 => "Jeudi",
        5 => "Vendredi",
        6 => "Samedi",
        7 => "Dimanche",
    ];
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT * FROM OPENDAYS WHERE openDay = :currentDay AND startHour < current_time() AND endHour > current_time() AND truck = :idTruck;");
    $queryPrepared->execute([":currentDay" => $translateDay[date("N")], ":idTruck" => $idTruck]);
    return !empty($queryPrepared->fetch());

}

/**
 * @return bool
 */
function isConnected()
{
    if (!empty($_SESSION["email"])
        && !empty($_SESSION["token"])) {
        $email = $_SESSION["email"];
        $token = $_SESSION["token"];
        //Vérification d'un correspondant en base de données
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT idUser FROM USER, USERTOKEN WHERE emailAddress = :email 
                                     AND USERTOKEN.token = :token 
                                     AND user = idUser 
                                     AND tokenType = 'Site'");
        $queryPrepared->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        if (!empty($queryPrepared->fetch())) {
            login($email);
            return true;
        }
    }
    session_destroy();
    return false;
}

function isActivated()
{
    if (!empty($_SESSION["email"]) && !empty($_SESSION["token"])) {
        $email = $_SESSION["email"];
        $token = $_SESSION["token"];
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT isActivated FROM USER, USERTOKEN WHERE emailAddress = :email 
                                          AND USERTOKEN.token = :token 
                                          AND user = idUser 
                                          AND tokenType = 'Site'");
        $queryPrepared->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        $isActivated = $queryPrepared->fetch();
        return $isActivated["isActivated"];
    }
    return false;
}

function isAdmin()
{
    if (!empty($_SESSION["email"]) && !empty($_SESSION["token"])) {
        $email = $_SESSION["email"];
        $token = $_SESSION["token"];
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT roleName FROM USER, SITEROLE, USERTOKEN WHERE emailAddress = :email 
                                                 AND USERTOKEN.token = :token 
                                                 AND user = idUser 
                                                 AND userRole = idRole
                                                 AND tokenType = 'Site'");
        $queryPrepared->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        $isAdmin = $queryPrepared->fetch();
        $isAdmin = $isAdmin["roleName"];
        if ($isAdmin == "Administrateur") {
            return true;
        }
        return false;
    }
}

function logout($email)
{
    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("UPDATE USER, USERTOKEN SET USERTOKEN.token = null WHERE emailAddress = :email 
                                                    AND idUser = user 
                                                    AND tokenType = 'Site'");
    $queryPrepared->execute([":email" => $email]);
}

/**
 * @param $text
 * @param $tabLang
 * @param $setLanguage
 */
function getTranslate($text, $tabLang, $setLanguage)
{
    //si la value existe on traduit, sinon on laisse le texte pas défault
    if (array_key_exists($text, $tabLang) && array_key_exists($setLanguage, $tabLang[$text]))
        echo $tabLang[$text][$setLanguage];
    else
        echo $text;
}

/**
 * @return bool|mixed
 */
function getUserInfos()
{
    if (!empty($_SESSION["email"]) && !empty($_SESSION["token"])) {
        $email = $_SESSION["email"];
        $token = $_SESSION["token"];
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT idUser, firstname, lastname, emailAddress FROM USER, USERTOKEN WHERE emailAddress = :email 
                                          AND USERTOKEN.token = :token 
                                          AND user = idUser 
                                          AND tokenType = 'Site'");
        $queryPrepared->execute([
            ":email" => $email,
            ":token" => $token
        ]);
        return $queryPrepared->fetch(PDO::FETCH_ASSOC);
    }
    return false;
}


function getEventsPreview(){

    $pdo = connectDB();
    $queryPrepared = $pdo->prepare("SELECT idEvent, truckName, eventDesc, eventImg, eventType, eventName, eventAddress, eventCity, eventPostalCode, eventBeginDate, eventEndDate, eventStartHour, eventEndHour FROM EVENTS, HOST, TRUCK WHERE event = idEvent AND truck = idTruck AND eventType = 'Dégustation' LIMIT 3");
    $queryPrepared->execute();
    return $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

}

function getMenuForHomePage(){

    $pdo = connectDB();

    $queryPrepared = $pdo->prepare("SELECT menuName, menuPrice, truck FROM MENUS ;");
    $queryPrepared->execute();
    return $getMenuName = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

}