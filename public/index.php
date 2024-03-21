<?php

require_once "../config.php";
require_once "../model/portailCountriesModel.php";


try {
    $db = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET . ";port=" . DB_PORT, DB_LOGIN, DB_PWD);
} catch (Exception $e) {
    die($e->getMessage());
}    

$countCountries = count(getCountries($db));


if (isset($_GET["sort"])){
    $sortBy = $_GET["sort"];
    $sortDir = $_GET["dir"];
    $itemsPer = $_GET['item'];
    $current = (int) ($_GET["pg"]);

  //  $countries = getCountries($db, $sortBy, $sortDir, $itemsPer); 
  $countries = getCountries($db, $sortBy, $sortDir, $itemsPer,$current);
}else {
  //  $countries = getCountries($db);
    $itemsPer = 100;
    $sortBy = "pays_nom";
    $sortDir = "ASC";
    $current = 1;
    $countries = getCountries($db, $sortBy, $sortDir, $itemsPer,$current);
}

$pageModel = paginationModel("./", PAGINATION_GET_NAME, $countCountries, $current, $itemsPer, $sortBy, $sortDir);



/*
$sortBy="iso";
$sortDir="ASC";
$itemsPer="10";
*/
// $countries = getCountries($db, $sortBy, $sortDir, $itemsPer);


$db = null;
include ('../view/mapsView.php');
