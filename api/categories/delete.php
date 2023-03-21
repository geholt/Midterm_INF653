<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	
	include_once '../../config/Database.php';
	include_once '../../models/Category.php';

	$database = new Database();
	$db = $database->connect();
	
	$categories = new Categories($db);
		
	$data = json_decode(file_get_contents("php://input"));
	$categories->id = $data->id;

	if($categories->delete()) {
		echo json_encode(
			array('id'=>$categories->id)
		);
	} else {
		echo json_encode(
			array('message' => 'No Quotes Found')
		);
	}
?>