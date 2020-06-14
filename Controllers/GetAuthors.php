<?php
    //include needed php classes
    include_once('../Models/Post.php');
    include_once('../Config/Database.php');

    class GetAuthors {
        public function readAuthors() {

        //initiate database connection
        $db = new Database();
        $db = $db->connect();

        //initiate category modal
        $post = new Post($db);
        
        //get all categories
        $result = $post->read();

        //get count of rows from result
        $numberOfRows = $result->rowCount();

        //Do something with the result
        //check if any rows first
        if ($numberOfRows>0) {
            //if rows exist in result
            $author_arr = array();
            $author_arr['data'] = array();

            //a simple counter to add to array
            $counter = 0;

            //loop the results
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                //extract the row so u can use the propperties as variables
                extract($row);


                //add the author array into data array
                array_push($author_arr['data'], $author);

                //increment the counter for the next position in your array
                $counter = $counter+1;

            }

            //return array with no duplicate authors
            return(array_unique($author_arr['data']));
        }
        else {
            //no results
            return null;
        }

        }
    }