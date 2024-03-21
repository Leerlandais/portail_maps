<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>World Info</title>
</head>
<?php

?>
<body class="countryBody">

    <h2>Project completed entirely on the 16/03/2024</h2>
    <h3>All work is based entirely on classes given by Pierre Sandron and Michael Pitz</h3>
    <a href="https://leerlandais.com"><h6>HOME</h6></a>
    <div class="pageMover">
        <?php 
$sort_order = isset($_GET['sort']) && $_GET['dir'] == 'DESC' ? 'ASC' : 'DESC';

if (isset($_GET["item"])) {
    $cleanedItems = htmlspecialchars(strip_tags(trim($_GET["item"])), ENT_QUOTES);
    
    $itemPer = $cleanedItems;
}else {
    $itemPer = 233;
}  ?>
<div class="pageSort">
    <h4>Select Amount to Display</h4>
    <div class="sortLink">
        <a href="?pg=1&sort=<?=$sortBy?>&dir=<?=$sort_order?>&item=10">10 </a><a href="?pg=1&sort=<?=$sortBy?>&dir=<?=$sort_order?>&item=25"> 25 </a><a href="?pg=1&sort=<?=$sortBy?>&dir=<?=$sort_order?>&item=50"> 50 </a><a href="?pg=1&sort=<?=$sortBy?>&dir=<?=$sort_order?>&item=100"> 100 </a><a href="?pg=1&sort=<?=$sortBy?>&dir=<?=$sort_order?>&item=233"> All</a>
    </div>
</div>
<div class="pageLink">
<?= $pageModel;?>
</div>
<h4>Click a title to change sort order</h4>
</div>
<table class="countryTable">
    <th class="countryInfo"><a href="?pg=1&sort=pays_nom&dir=<?=$sort_order?>&item=<?=$itemPer?>">Name</a></th>
    <th class="countryInfo"><a href="?pg=1&sort=iso&dir=<?=$sort_order?>&item=<?=$itemPer?>">ISO Code</a></th>
    <th class="countryInfo"><a href="?pg=1&sort=pays_pop&dir=<?=$sort_order?>&item=<?=$itemPer?>">Population</a></th>
    <th class="countryInfo"><a href="?pg=1&sort=area&dir=<?=$sort_order?>&item=<?=$itemPer?>">Area</a></th>
    <th class="countryInfo"><a href="?pg=1&sort=cap_nom&dir=<?=$sort_order?>&item=<?=$itemPer?>">Capital</a></th>
    <th class="countryInfo"><a href="?pg=1&sort=cap_popu&dir=<?=$sort_order?>&item=<?=$itemPer?>">Population of Capital</a></th>
    <th class="countryInfo"><a href="?pg=1&sort=altitude&dir=<?=$sort_order?>&item=<?=$itemPer?>">Altitude of Capital</a></th>
    <th class="countryInfo">Flag</th>

<?php
    foreach($countries as $country) :
        ?>
        <tr class="countryRow">
            <td class="countryCol"><?= $country['pays_nom'] ?></td>
            <td class="countryCol"><?= $country["iso"] ?></td>
            <td class="countryCol"><?= $country["pays_pop"] ?></td>
            <td class="countryCol"><?= $country["area"] ?></td>
            <td class="countryCol"><?= $country["cap_nom"] ?></td>
            <td class="countryCol"><?= $country["cap_popu"] ?></td>
            <td class="countryCol"><?= $country["altitude"] ?></td>
            <td class="countryCol"><img src="images/svg/<?= strtolower($country['iso']); ?>.svg"></td>
        </tr>
<?php
    endforeach;
?>
</table>
</body>
</html>