<?php



require 'database.php';

require 'function.php';
require 'function2.php';

$searchString = filter_input(INPUT_POST, 'search');//input 
$searchCount = 1;
$searchArray = explode(" ",$searchString);
$date= date("Y-m-d h:i:s");


$pdo = connection::make();  //make connection db

 



$db = new QueryBuilder($pdo); // make connection db and call the QueryBuildr class


$search = $db->selectAll('new_search'); // get all record for the db
 // get all record for the db



// $notAlloud = $db->not('notalloud',$searchString,$date);

$searchSave = $db->insert('new_search','notalloud',$searchString, $searchCount,$date); // save search string 

$searchArray = $db->insertArray('new_search','notalloud',$searchArray, $searchCount,$date);// save search array.





require 'index.view.php';
