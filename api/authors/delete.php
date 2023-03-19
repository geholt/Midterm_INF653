<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	
	include_once '../../config/database.php';
	include_once '../../models/Author.php';

	$database = new Database();
	$db = $database->connect();
	
	$authors = new Authors($db);
		
	$data = json_decode(file_get_contents("php://input"));
	$authors->id = $data->id;
	
	if($authors->delete()) {
		echo json_encode(
			array('id'=>$authors->id)
		);
	} else {
		echo json_encode(
			array('message' => 'No Quotes Found')
		);
	}
?>