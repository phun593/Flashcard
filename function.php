<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashcard";


$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
$searchString = filter_input(INPUT_POST, 'search');//
$searchWord =  filter_input(INPUT_POST, 'search');
$searchCount = 1;
$searchWordArray = explode(" ",$searchWord);

//check to see if the record exists
$check="SELECT * FROM new_serch_srting WHERE searchString = '$searchString'";
$rs = mysqli_query($conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1)

	//if exists update count
{
	$update ="update new_serch_srting set searchCount= searchCount+1 where searchString = '$searchString'";
	mysqli_query($conn, $update);
}else{
	//if  dosen't exists insert ne record
	$sql = "INSERT INTO new_serch_srting(searchString, searchCount)
	VALUES ('$searchString','$searchCount')";

	if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
}
// Create connection

//get top search from DB
$conn = mysqli_connect($servername, $username, $password, $dbname);

$searchList ="SELECT id, searchString, searchCount  FROM  new_serch_srting";
	
if($result = mysqli_query($conn, $searchList)){
if(mysqli_num_rows($result) > 0){
echo "<table>";
	echo "<tr>";
		echo "<th>Top Search</th>";
		
	echo "</tr>";
	while($row = mysqli_fetch_array($result)){
	echo "<tr>";
		echo "<td>" . $row['searchString'] . "</td>";
		
	echo "</tr>";
	}
echo "</table>";
// Free result set
mysqli_free_result($result);
} else{
echo " Search found.";
}
} else{
echo "ERROR: Could not able to execute $sql. " . mysqli_error($searchList);
}

// Close connection
mysqli_close($conn);



$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
		$searchString = filter_input(INPUT_POST, 'search');
		$searchWord =  filter_input(INPUT_POST, 'search');
		$searchCount = 1;
		$searchWordArray = explode(" ",$searchWord);
	
foreach ($searchWordArray as $value) {
	
		# code...
		$sql = "INSERT into new_serch_word(searchWord, searchCount)
				VALUES ('$value', '$searchCount')";
}
		if (mysqli_query($conn, $sql)) {
				echo "New record created successfully ";
		} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
mysqli_close($conn);


?>