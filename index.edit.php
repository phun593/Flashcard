<?php



require 'database.php';

require 'function2.php';


$delete =  $_POST['delete'];





$pdo = connection::make();  //make connection db

 



$db = new DeleteSearch($pdo); // make connection db and call the QueryBuildr class



$search2 = $db->selectTwenty('new_search');

$searchInsert = $db->insert('new_search','notalloud',$delete);

$searchDelete = $db->delete('new_search','notalloud',$delete);





require 'edit.php';





