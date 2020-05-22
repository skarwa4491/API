<?php

header("Content-Type:application/json");
include('connection.php');

$request_type= $_SERVER['REQUEST_METHOD'];

switch($request_type){

	case "GET":
		
		getStudentData();	
		break;	

	case "POST":
		insertData();
		break;

	case "PUT":
		UpdateData();
		break;
	case "DELETE":
		
		deleteRecord();
		break;
	
		

}

function getStudentData(){

	global $conn;
	$result = mysqli_query($conn,"SELECT * FROM tbl_studentdetails ");
 
	if(mysqli_num_rows($result)>0)
	 {
		$data = array();
		 while($row = mysqli_fetch_assoc($result)){

			 $data[] = $row;
		  
	 }
	  
	 $result = ['data' => $data,  'responseCode' => 200];
	 echo json_encode($result);

	}
}

function insertData(){

	global $conn;
	
	$query = mysqli_query( $conn,"INSERT into tbl_studentdetails (firstname,lastname,age) VALUES ('".$_POST["firstname"]."','".	$_POST["lastname"]."','".$_POST["age"]."')");
	
	if($query == true){

		echo "data insterted successfully";
	}
	else{
		echo "issue with inserting";
	}
		

}
function UpdateData(){

	global $conn;
	parse_str(file_get_contents('php://input'), $_PUT);
	$fname=$_PUT["firstname"];
	$lname=$_PUT["lastname"];
	$age=$_PUT["age"];
	$id=$_PUT["id"];
	$querry = mysqli_query( $conn,"UPDATE tbl_studentdetails  set firstname='".$fname."',lastname='".$lname."',age='".$age."' where id ='".$id."'");
	if($querry==true){
	
		echo "Value Updated";
	}
	else{
		echo "Problem encountered";
	}
	
}

function deleteRecord(){

	global $conn;
	parse_str(file_get_contents('php://input'), $_DELETE);
	$id=$_DELETE["id"];
	$querry = mysqli_query( $conn,"DELETE from tbl_studentdetails where id ='".$id."'");
	
	if($querry==true){
	
		echo "record deleted";
	}
	else{
		echo "Problem encountered";
	}
	
	
}
?>
