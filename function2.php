<?php
class QueryBuilder
{
	protected $pdo;
	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}
	public function selectAll($table)
	{
		$statement = $this->pdo->prepare("select * from {$table} ORDER BY searchWordCount DESC");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}
	
	public function insert($table, $searchString,$searchCount,$date)
	{
		$stmt =  $this->pdo->prepare("select * from {$table} WHERE searchWord = '$searchString'");
		$stmt->bindParam(1, $_GET['searchWord'], PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if( ! $row)
		{
			$newSearch = $this->pdo->prepare("INSERT INTO {$table}(searchWord, searchWordCount, created_at)
				VALUES ('$searchString','$searchCount','$date')");
			$newSearch->execute();
		}else{
			$update = $this->pdo->prepare("update new_search set searchWordCount= searchWordCount+1 where searchword = '$searchString'");
			$update->execute();
		}
	}
	public function insertArray($table,$searchArray, $searchCount,$date)
	{
		foreach ($searchArray as $value) {

			$stmt =  $this->pdo->prepare("select * from {$table} WHERE searchWord = '$value'");
			$stmt->bindParam(1, $_GET['searchWord'], PDO::PARAM_INT);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if( ! $row)
			{
				$newSearch = $this->pdo->prepare("INSERT INTO {$table}(searchWord, searchWordCount, created_at)
					VALUES ('$value','$searchCount','$date')");
				$newSearch->execute();
			}else{
				$update = $this->pdo->prepare("update new_search set searchWordCount= searchWordCount+1 where searchword = '$value'");
				$update->execute();
			}
		}



		
		
	}
}