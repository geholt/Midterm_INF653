<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	
	include_once '../../config/Database.php';
	include_once '../../models/Author.php';

	$database = new Database();
	$db = $database->connect();
	
	$authors = new Authors($db);
		
	$data = json_decode(file_get_contents("php://input"));

	if(!isset($data->author)) {
		echo json_encode(
			array('message' => 'Missing Required Parameters')
		);
		exit();
	}
	
	$authors->author = $data->author;

	if($authors->create()) {
		echo json_encode(
			array('id'=>$authors->id, 'author'=>$authors->author)
		);
	} else {
		echo json_encode(
			array('message' => 'No Authors Found')
		);
	}
?>