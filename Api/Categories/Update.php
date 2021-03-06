<?php
    //headers
    header('Acces-Control-Allow-Origin = *');
    header('Content-Type = application/json');


    //include needed php classes
    include_once('../../Models/Category.php');
    include_once('../../Config/Database.php');
    include_once('../Authentication/Authenticate.php');

    //Authenticate
    $authenticate = new Authenticate();
    if(!$authenticate->verify()) {
        echo json_encode(array('message' => 'authentication failed'));
        return;
    }

    //initiate the database connection
    $db = new Database();
    $db = $db->connect();

    //Initiate modal class Category
    $category = new Category($db);

    //Get all input
    $data = json_decode(file_get_contents('php://input'));

    //store the data
    $category->id = $data->id;
    $category->name = $data->name;

    //Save the new category into database
    if ($category->update()) {
        echo json_encode(array('message'=> "Category has succesfully been updated"));
    }
    else {
        echo json_encode(array("message" => "Category not updated"));
    }
