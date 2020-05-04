<?php
require 'header.php';

$jsonFile = file_get_contents('assets/traduction.json');

$tabLang =  json_decode($jsonFile, true);
$headerTabLang =a; 
echo $tabLang["header"]["fr_FR"]['name'];

?>