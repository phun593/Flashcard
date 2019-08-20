<?php



require 'database.php';

require 'function2.php';

$searchString = filter_input(INPUT_POST, 'search');//input 
$searchCount = 1;
$searchArray = explode(" ",$searchString);
$date= date("Y-m-d h:i:s");
 
$pdo = connection::make();  //make connection db

$db = new QueryBuilder($pdo); // call the QueryBuildr class

$search = $db->selectAll('new_search');





$searchSave = $db->insert('new_search',$searchString, $searchCount,$date);

$searchArray = $db->insertArray('new_search',$searchArray, $searchCount,$date);



require 'index.view.php';