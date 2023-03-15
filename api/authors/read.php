<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/post.php';

    // Instantiate DB & connect
    $database = new Database();

    $db = $database->connect(); //connect() located in Database.php

    // instantiate blog post object
    $post = new Post($db);

    //blog post query
    $result = $post->read();
    // get row count
    $num = $result->rowCount();

    //check if any posts
    if($num > 0){
        // post array
        $posts_arr = array();
        $posts_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row); //uses key's as variable like "title" "body"

            $post_item = array(
                'id' => $id,
                'author' => $author
            );

            // push to the "data"
            array_push($posts_arr['data'], $post_item);
        }

        //Turn to json & output
        echo json_encode($posts_arr);
    }else{
        // no posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }
