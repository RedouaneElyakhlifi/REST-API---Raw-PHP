<?php
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
    $title = $_POST['title'];
    $author = $_POST['author'];
    $body = $_POST['body'];
    $categoryName = $_POST['category'];

    
    //Get the category
    $category = $category->findCategoryByName($categoryName);


    //Save the new post into database
    $post->write($title, $author, $body, $category['id']);
    