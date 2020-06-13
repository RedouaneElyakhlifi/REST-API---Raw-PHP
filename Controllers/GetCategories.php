<?php
    //include needed php classes
    include_once('../Models/Category.php');
    include_once('../Config/Database.php');

    class GetCategories {
        public function readCategories() {

        //initiate database connection
        $db = new Database();
        $db = $db->connect();

        //initiate category modal
        $categories = new Category($db);

        //get all categories
        $result = $categories->read();

        //get count of rows from result
        $numberOfRows = $result->rowCount();

        //Do something with the result
        //check if any rows first
        if ($numberOfRows>0) {
            //if rows exist in result
            $category_arr = array();
            $category_arr['data'] = array();

            //loop the results
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                //extract the row so u can use the propperties as variables
                extract($row);

                //each category gets into his own array
                $category_item = array(
                    'id' => $id,
                    'name' => $name
                );

                //push the post array into data array
                array_push($category_arr['data'], $category_item);

            }

            //return array
            return($category_arr);
        }
        else {
            //no results
            return null;
        }

        }
    }