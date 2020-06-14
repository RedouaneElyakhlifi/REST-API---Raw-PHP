<?php
    //headers
    header('Acces-Control-Allow-Origin = *');
    header('Content-Type = application/json');
    header('Acces-Allow-Methods = POST');
    header('Acces-Control-Allow-Headers = Acces-Control-Allow-Headers, Content-Type, Acces-Control-Allow-Methods, X-Requested-With' );

    //include needed php classes
    include_once('../../Config/Database.php');
    include_once('../../Models/Post.php');
    include_once('../../Models/Category.php');

    //Initiate database connection
    $db = new Database();
    $db = $db->connect();

    //Initiate modal class Post
    $post = new Post($db);

    //Initiate modal class Category
    $category = new Category($db);
    

    //Get all form input
    $data = json_decode(file_get_contents('php://input'));

    //store the data
    $title = $data->title;
    $author = $data->author;
    $body = $data->body;
    $category_id = $data->category_id;

    //Save the new post into database
    if ($post->create($title, $author, $body, $category_id)) {
        echo json_encode(array('message'=> "post has succesfully been created"));
    }
    else {
        echo json_encode(array("message" => "Post not created"));
    }
    