<?php
class QueryBuilder
{
	protected $pdo;
	public function __construct($pdo)// make connection whe any function ic called in QueryBuilder  class
	{
		$this->pdo = $pdo;
	}
	public function selectAll($table)
	{
		$statement = $this->pdo->prepare("select * from {$table} ORDER BY searchWordCount DESC  LIMIT 5");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}


	public function not($table,$searchString,$date){
		$newSearch = $this->pdo->prepare("INSERT INTO {$table}(notalloud)
					VALUES ('$searchString')");//if  dosen't exists insert new record
		$newSearch->execute();
	}
	
	public function insert($table,$table2, $searchString,$searchCount,$date)
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST'){


			$searchString =str_replace("'", "\'",$searchString);
			$stmt =  $this->pdo->prepare("select * from {$table2} WHERE notalloud ='$searchString'");
			$stmt->bindParam(1, $_GET['notalloud'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if( ! $row){
				$stmt =  $this->pdo->prepare("select * from {$table} WHERE searchWord ='$searchString'");
				$stmt->bindParam(1, $_GET['searchWord'], PDO::PARAM_INT);
				$stmt->execute();
				$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
				if (!$row2) {
					$newSearch = $this->pdo->prepare("INSERT INTO {$table}(searchWord, searchWordCount, created_at)
						VALUES ('$searchString','$searchCount','$date')");//if  dosen't exists insert new record
					$newSearch->execute();
				}else{
					
					$update = $this->pdo->prepare("update new_search set searchWordCount= searchWordCount+1 where searchword = '$searchString'");
					$update->execute();//if exists update count
						# code...
				}

				
			}
			
			
		}
		
	}
	
	public function insertArray($table, $table2,$searchArray, $searchCount,$date)
	{


		foreach ($searchArray as $value) {
			$stmt =  $this->pdo->prepare("select * from {$table2} WHERE notalloud ='$value'");
			$stmt->bindParam(1, $_GET['notalloud'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if( ! $row)
			{
				$stmt =  $this->pdo->prepare("select * from {$table} WHERE searchWord ='$value'");
				$stmt->bindParam(1, $_GET['searchWord'], PDO::PARAM_INT);
				$stmt->execute();
				$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
				if (!$row2) {
					$newSearch = $this->pdo->prepare("INSERT INTO {$table}(searchWord, searchWordCount, created_at)
						VALUES ('$value','$searchCount','$date')");//if  dosen't exists insert new record
					$newSearch->execute();
				}else{
					
					$update = $this->pdo->prepare("update new_search set searchWordCount= searchWordCount+1 where searchword = '$value'");
					$update->execute();//if exists update count
						# code...
				}

				
			}
			
			
		}
	}
}