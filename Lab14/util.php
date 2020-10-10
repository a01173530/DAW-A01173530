<?php  
function conectDb(){
	$servername= "localhost";
	$username= "root";
	$password="";
	$dbname= "dbname";
	
	$con= mysqli_connect($servername, $username, $password, $dbname);

	//check connection
	if(!$con){
		die("Connection failed: ". mysqli_connect_error());
	}

	return $con;
}

function closeDb($mysql){
	mysqli_close($mysql);

}

function getFruits(){
	
	$conn= conectDb();
	
	$sql= "SELECT name, units, quantity, price, country FROM Fruit";
	
	$result= mysqli_query($conn, $sql);
	
	closeDb($conn);

	return $result;

}


function getFruitsByName($fruit_name){
	$conn =conectDb();

	$sql ="SELECT name, units, quantity, price, country FROM Fruit WHERE price <= '".$cheap_price."'";


}





?>