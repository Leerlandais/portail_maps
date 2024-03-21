<?php
/*
function getCountries(PDO $db, $sortBy="pays_nom", $sortDir="ASC", $itemsPer=233): array {
$sortDir === "ASC" ? "DESC" : "ASC";

    $sql = "SELECT  pays_main.pays_nom, pays_main.iso, pays_main.pays_pop, area,
                    pays_cap.cap_nom, pays_cap.cap_popu, altitude,
                    pays_continent.cont_name
            FROM    pays_main
            JOIN    pays_cap ON pays_main.pays_id = pays_cap.cap_id
            JOIN    pays_rel_cont ON pays_main.pays_id = pays_rel_cont.rel_id
            JOIN    pays_continent ON pays_continent.cont_id = pays_rel_cont.cont_id
            ORDER BY $sortBy $sortDir 
            LIMIT   $itemsPer";       
     
    $stmt = $db->prepare($sql);
    
    try {
    
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    
    }catch (PDOException $e){
    
        error_log("Error getting messages: " . $e->getMessage());
        return false;
    
    }
}

*/

function paginationModel(string $url,
                        string $getName,
                        int $nbTotalItem,
                        int $currentPage=1,
                        int $nbByPage=10,
                        string $sortBy,
                        string $sortDir 
                        )
{

    if($nbTotalItem===0) return null;
    $sortie="";
    $nbPage = (int) ceil($nbTotalItem/$nbByPage);
   
    if($nbPage<2) return null;
    if($currentPage===1){
        $sortie.= "<< <";
    }elseif ($currentPage===2) {
        $sortie.= "<a href='$url'><<</a> <a href='$url'><</a>";
    }else{
        $sortie.= "<a href='$url'><<</a> <a href='$url?&$getName=".($currentPage-1)."&sort=$sortBy&dir=$sortDir&item=$nbByPage'><</a>";
    }
    for($i=1;$i<=$nbPage;$i++)
    {   
        if($i===$currentPage) $sortie.= " $i ";
        else if($i===1) $sortie.= " <a href='$url'>$i</a> ";
        else $sortie.= " <a href='$url?&$getName=$i&sort=$sortBy&dir=$sortDir&item=$nbByPage'>$i</a> ";
    }

    $sortie.= $currentPage === $nbPage ? "> >>" : "<a href='$url?&$getName=".($currentPage+1)."&sort=$sortBy&dir=$sortDir&item=$nbByPage'>></a> <a href='$url?&$getName=$nbPage&sort=$sortBy&dir=$sortDir&item=$nbByPage'>>></a>";

    return $sortie;
}


function getCountries(PDO $db,
                     string $sortBy="pays_nom", 
                     string $sortDir="ASC", 
                     int $itemsPer=233, 
                     int $currentPage=1
                     ) : array {

    $cleanedSort = htmlspecialchars(strip_tags(trim($sortBy)), ENT_QUOTES);
    $cleanedDir = htmlspecialchars(strip_tags(trim($sortDir)), ENT_QUOTES);
    $cleanedItems = htmlspecialchars(strip_tags(trim($itemsPer)), ENT_QUOTES);
    $cleanedPage = htmlspecialchars(strip_tags(trim($currentPage)), ENT_QUOTES);

    $offset = ($cleanedPage - 1) * $cleanedItems;
    $sql = "SELECT  pays_main.pays_nom, pays_main.iso, pays_main.pays_pop, area,
                    pays_cap.cap_nom, pays_cap.cap_popu, altitude,
                    pays_continent.cont_name
            FROM    pays_main
            JOIN    pays_cap ON pays_main.pays_id = pays_cap.cap_id
            JOIN    pays_rel_cont ON pays_main.pays_id = pays_rel_cont.rel_id
            JOIN    pays_continent ON pays_continent.cont_id = pays_rel_cont.cont_id
            ORDER BY $cleanedSort $cleanedDir 
            LIMIT   $offset, $cleanedItems";

    $stmt = $db->prepare($sql);
    
    try {
    
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    
    }catch (PDOException $e){
    
        error_log("Error getting countries: " . $e->getMessage());
        return false;
    
    }

}
