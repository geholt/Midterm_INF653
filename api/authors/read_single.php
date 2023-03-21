<?php
	header('Content-Type: application/json');
	
	include_once '../../config/Database.php';
	include_once '../../models/Author.php';
	
	$database = new Database();
	$db = $database->connect();
	
	$authors = new Authors($db);
	
	$authors->id = isset($_GET['id']) ? $_GET['id'] : die();
	
	$authors->read_single();
	
	if ($authors->author != null) {
		$author_arr = array(
			'id' => $authors->id,
			'author' => $authors->author
		);
			
		echo json_encode($author_arr);
	} else {
		echo json_encode(
			array('message' => 'author_id Not Found')
		);
	}
?>