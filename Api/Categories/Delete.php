<?php
    //headers
    header('Acces-Control-Allow-Origin = *');
    header('Content-Type = application/json');

    //include needed php classes
    include_once('../../Models/Category.php');
    include_once('../../Config/Database.php');

    //initiate the database connection
    $db = new Database();
    $db = $db->connect();

    //Initiate modal class category
    $category = new Category($db);

    //check if id is in the url as a get request
    if(!isset($_GET['id'])) {
        echo json_encode(array('message' => 'You need to specify the id as a get request'));

        return;
    }

    //if id is set use it in the request
    $category->id = $_GET['id'];

    //Save the new category into database
    if ($category->delete()) {
        echo json_encode(array('message'=> "Category has succesfully been deleted"));
    }
    else {
        echo json_encode(array("message" => "Category not deleted"));
    }
