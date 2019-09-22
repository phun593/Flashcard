<?php
class QueryBuilder
{
	protected $pdo;
	public function __construct($pdo)// make connection whe any function ic called in QueryBuilder  class
	{
		$this->pdo = $pdo;
	}
	public function selectAll($table) // select the top 5 search 
	{
		$statement = $this->pdo->prepare("select * from {$table} ORDER BY searchWordCount DESC  LIMIT 5");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}



	
	public function insert($table,$table2, $searchString,$searchCount,$date) // add new search
	{

		if ($_SERVER['REQUEST_METHOD'] === 'POST'){

			// check if the search in the not alloud list 
			$searchString =str_replace("'", "\'",$searchString);
			$stmt =  $this->pdo->prepare("select * from {$table2} WHERE notalloud ='$searchString'");
			$stmt->bindParam(1, $_GET['notalloud'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if( ! $row){
				//if it's alloud  then check if the search is allready in new_search table 
				$stmt =  $this->pdo->prepare("select * from {$table} WHERE searchWord ='$searchString'");
				$stmt->bindParam(1, $_GET['searchWord'], PDO::PARAM_INT);
				$stmt->execute();
				$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
				if (!$row2) {
					//if search doesn't exist then creat a new search record
					$newSearch = $this->pdo->prepare("INSERT INTO {$table}(searchWord, searchWordCount, created_at)
						VALUES ('$searchString','$searchCount','$date')");//if  dosen't exists insert new record
					$newSearch->execute();
				}else{
					// if search exist the add one to the searchWordCount table
					$update = $this->pdo->prepare("update new_search set searchWordCount= searchWordCount+1 where searchword = '$searchString'");
					$update->execute();
						# code...
				}

				
			}
			
			
		}
		
	}
	
	public function insertArray($table, $table2,$searchArray, $searchCount,$date)
	{


		foreach ($searchArray as $value) {
			// check if the search in the not alloud list 

			$stmt =  $this->pdo->prepare("select * from {$table2} WHERE notalloud ='$value'");
			$stmt->bindParam(1, $_GET['notalloud'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if( ! $row)
			{
				//if it's alloud  then check if the search is allready in new_search table 
				$stmt =  $this->pdo->prepare("select * from {$table} WHERE searchWord ='$value'");
				$stmt->bindParam(1, $_GET['searchWord'], PDO::PARAM_INT);
				$stmt->execute();
				$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
				if (!$row2) {
					//if search doesn't exist then creat a new search record
					$newSearch = $this->pdo->prepare("INSERT INTO {$table}(searchWord, searchWordCount, created_at)
						VALUES ('$value','$searchCount','$date')");
					$newSearch->execute();
				}else{
					// if search exist the add one to the searchWordCount table
					$update = $this->pdo->prepare("update new_search set searchWordCount= searchWordCount+1 where searchword = '$value'");
					$update->execute();
						# code...
				}

				
			}
			
			
		}
	}
}