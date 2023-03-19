<?php	
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	include_once '../../config/database.php';
	include_once '../../models/Author.php';
	
	$database = new Database();
	$db = $database->connect();
	
	$authors = new Authors($db);
	
	$result = $authors->display_authors();
	
	$num = $result->rowCount();
	
	if ($num > 0) {
		$author_arr = array();
		$author_arr = array();
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			
			$author_item = array(
				'id' => $id,
				'author' => $author
			);
			
			array_push($author_arr, $author_item);
		}
		
		echo json_encode($author_arr);
	} else {
		echo json_encode(
			array('message' => 'No Authors Found')
		);
	}
?>