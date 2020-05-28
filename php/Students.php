<?php

header("Content-Type:application/json");
require('connection.php');

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
	$response_file=fopen("response.json","w+") or die("file not created");
	$result = mysqli_query($conn,"SELECT * FROM tbl_studentdetails ");
 
	if(mysqli_num_rows($result)>0)
	 {
		$data = array();
		 while($row = mysqli_fetch_assoc($result)){

			 $data[] = $row;
		  
	 }
	  
	 $result = ['data' => $data,  'responseCode' => 200];
	 echo json_encode($result);
	 fwrite($response_file,json_encode($result));
	 fclose($response_file);
	 
	}
}

function insertData(){
	
	global $conn;
	require("connection.php");

	$data_to_be_inserted = file_get_contents('php://input');

	$array_to_be_inserted=json_decode($data_to_be_inserted,true);

	$query = mysqli_query( $conn,"INSERT into tbl_studentdetails (firstname,lastname,age) VALUES ('".	$array_to_be_inserted["firstname"]."','".$array_to_be_inserted["lastname"]."','".$array_to_be_inserted["age"]."')");

	if($query == true){

		echo "data insterted successfully";
	}
	else{
		echo "issue with inserting";
	}

		

}
function UpdateData(){

	
	global $conn;

	require("connection.php");
	$data_to_be_updated = file_get_contents("php://input");

	$data_array = json_decode($data_to_be_updated,true);

	$querry = mysqli_query( $conn,"UPDATE tbl_studentdetails  set firstname='".$data_array['firstname']."',lastname='".$data_array['lastname']."',age='".$data_array['age']."' where id ='".$data_array['id']."'");

	if($querry == true){
		
		echo "Data Updated";

	}
	else
	{
		echo "error encountered";

	}
}

function deleteRecord(){

	global $conn;
	require("connection.php");
	$data_to_be_deleted = file_get_contents("php://input");

	$data_array = json_decode($data_to_be_deleted,true);

	$querry = mysqli_query( $conn,"DELETE from tbl_studentdetails where id ='".$data_array['id']."'");
	
	if($querry==true){
	
		echo "record deleted";
	}
	else{
		echo "Problem encountered";
	}
	
	
}
?>
