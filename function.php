<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashcard3";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


$searchString = filter_input(INPUT_POST, 'search');

$searchCount = 1;
$searchWordArray = explode(" ",$searchString);

// check to see if the record exists
$check="SELECT * FROM new_search WHERE searchWord = '$searchString'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);

if($data[0] > 1)
	//if exists update count
{
	$update ="update new_search set searchWordCount= searchWordCount+1 where searchword = '$searchString'";
	mysqli_query($conn, $update);

	
}else{
	//if  dosen't exists insert ne record
	$sql = "INSERT INTO new_search(searchWord, searchWordCount)
	VALUES ('$searchString','$searchCount')";
	if (mysqli_query($conn, $sql)) {
		
		
		
		
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
	
}
	
foreach ($searchWordArray as $value) {
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$check2 ="SELECT * FROM new_search WHERE searchWord = '$value'";
	$rs2 = mysqli_query($conn,$check2);
	$data2 = mysqli_fetch_array($rs2, MYSQLI_NUM);
	if($data2[0] > 1)
				//if exists update count
	{
		$update ="update new_search set searchWordCount= searchWordCount+1 where searchword = '$value'";
		mysqli_query($conn, $update);
	}else{
				//if  dosen't exists insert ne record
		$sql = "INSERT INTO new_search(searchWord, searchWordCount)
		VALUES ('$value','$searchCount')";
		if (mysqli_query($conn, $sql)) {
			header("location: index.php");      //<== ASSUMES index.php IS THE MAIN FILE.
			
			
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
	}
}
$conn = mysqli_connect($servername, $username, $password, $dbname);
$searchList ="SELECT id, searchWord, searchWordCount  FROM  new_search ORDER BY searchWordCount DESC ";
if($result = mysqli_query($conn, $searchList)){
	if(mysqli_num_rows($result) > 0){
		echo "<table>";
				echo "<tr>";
						echo "<th>Top Search</th>";
				echo "</tr>";
				while($row = mysqli_fetch_array($result)){
					echo "<tr>";
							echo "<td>" . $row['searchWord'] . "</td>";
					echo "</tr>";
				}
		echo "</table>";
// Free result set
		mysqli_free_result($result);
	} else{
		header("location: index.php");      //<== ASSUMES index.php IS THE MAIN FILE.
		exit;
		
	}
} else{
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($searchList);
}
// Close connection
mysqli_close($conn);
?>