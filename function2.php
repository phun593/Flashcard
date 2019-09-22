<?php
class DeleteSearch
{
	protected $pdo;
	public function __construct($pdo)// make connection whe any function ic called in QueryBuilder  class
	{
		$this->pdo = $pdo;
	}
	public function selectTwenty($table)
	{
		$statement = $this->pdo->prepare("select * from {$table} ORDER BY searchWordCount DESC  LIMIT 20");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}
	public function insert($table,$table2, $searchDelete){
		$searchDelete =str_replace("'", "\'",$searchDelete);
		$stmt =  $this->pdo->prepare("select * from {$table2} WHERE notalloud ='$searchDelete'");
		
		//if  dosen't exists insert new record
		$stmt->bindParam(1, $_GET['notalloud'], PDO::PARAM_INT);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$row) {
			$stm = $this->pdo->prepare("INSERT INTO {$table2}(notalloud)
				VALUES ('$searchDelete')");
			$stm->execute();
		}else{
			
		}
		
	}
	public function delete($table,$table2, $searchDelete){
		
		$searchDelete =str_replace("'", "\'",$searchDelete);
		$stmt =  $this->pdo->prepare("delete from {$table} WHERE searchWord ='$searchDelete'");
		$stmt->execute();
		
	}
}