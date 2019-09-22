<?php
/**
*
*/
class Connection
{
	
	public static function make()
	{
		try{
			return $pdo = new PDO ('mysql:host=127.0.0.1;dbname=flashcard', 'root', '');
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
}
// DB_DATABASE= flashcard
                //new_seaech TABLE
                     // searchWord
					//  searchWordCount
					//  created_at
				// notalloud TABLE
					//notalloud
					//created_at
