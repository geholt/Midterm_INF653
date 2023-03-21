<?php	
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	require('../../config/Database.php');
	require('../../models/Quote.php');

	$database = new Database();
	$db = $database->connect();
	
	$quotes = new Quotes($db);
	
	$result = $quotes->display_quotes();
	
	$num = $result->rowCount();
	
	if ($num > 0) {
		$quote_arr = array();
		$quote_arr = array();
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			
			$quote_item = array(
				'id' => $id,
				'quote' => $quote,
				'author' => $author,
				'category' => $category
			);
			
			array_push($quote_arr, $quote_item);
		}
		
		echo json_encode($quote_arr);
	} else {
		echo json_encode(
			array('message' => 'No Quotes Found')
		);
	}
?>