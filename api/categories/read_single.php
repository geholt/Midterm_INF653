<?php
	header('Content-Type: application/json');
	
	include_once '../../config/Database.php';
	include_once '../../models/Category.php';
	
	$database = new Database();
	$db = $database->connect();
	
	$categories = new Categories($db);
	
	$categories->id = isset($_GET['id']) ? $_GET['id'] : die();
	
	$categories->read_single();
	
	if ($categories->category != null) {
		$category_arr = array(
			'id' => $categories->id,
			'category' => $categories->category
		);			
		echo json_encode($category_arr);
	} else {
		echo json_encode(
			array('message' => 'category_id Not Found')
		);
	}
?>