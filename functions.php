<?php
require_once "conf.inc.php";

function connectDB(){
    try{
        $pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME ,DBUSER,DBPWD);
        //Permet d'afficher les erreurs SQL
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(Exception $e){
        die("Erreur SQL : ".$e->getMessage());
    }
    return $pdo;
}

function getTranslate($text, $tabLang, $setLanguage){
    //si la value existe on traduit, sinon on laisse le texte pas défault
    if(array_key_exists($text,$tabLang) && array_key_exists( $setLanguage, $tabLang[$text]))
        echo $tabLang[$text][$setLanguage];
    else
        echo $text;

}

