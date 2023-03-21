<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
	
	include_once '../../config/Database.php';
	include_once '../../models/Quote.php';

	$database = new Database();
	$db = $database->connect();
	
	$quotes = new Quotes($db);
		
	$data = json_decode(file_get_contents("php://input"));

	if(!isset($data->id) || !isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
		echo json_encode(
			array('message' => 'Missing Required Parameters')
		);
		exit();
	}
	
	$quotes->quote = $data->quote;
	$quotes->author_id = $data->author_id;
	$quotes->category_id = $data->category_id;
	
	if($quotes->create()) {
		echo json_encode(
			array('id'=>$quotes->id, 'quote'=>$quotes->quote, 'author_id'=>$quotes->author_id, 'category_id'=>$quotes->category_id)
		);
	} else {
		echo json_encode(
			array('message' => 'No Quotes Found')
		);
	}
?>