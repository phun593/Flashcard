<?php



require 'database.php';

require 'function2.php';


$delete =  $_POST['delete'];// get 




$pdo = connection::make();  //make connection db

 



$db = new DeleteSearch($pdo); // make connection db and call the QueryBuildr class



$search2 = $db->selectTwenty('new_search'); // show the top 20 search

$searchInsert = $db->insert('new_search','notalloud',$delete);// add search to the not alloud list

$searchDelete = $db->delete('new_search','notalloud',$delete);// delete from the search from the new_search TABLE





require 'edit.php';





