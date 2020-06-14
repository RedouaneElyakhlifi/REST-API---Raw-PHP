<?php
    //headers
    header('Acces-Control-Allow-Origin = *');
    header('Content-Type = application/json');

    //include needed php classes
    include_once('../../Models/Post.php');
    include_once('../../Config/Database.php');

    //initiate the database connection
    $db = new Database();
    $db = $db->connect();

    //Initiate modal class post
    $post = new Post($db);

    //Get id to delete
    $data = json_decode(file_get_contents('php://input'));

    //store the data
    $post->id = $data->id;

    //Save the new post into database
    if ($post->delete()) {
        echo json_encode(array('message'=> "Post has succesfully been deleted"));
    }
    else {
        echo json_encode(array("message" => "Post not deleted"));
    }
