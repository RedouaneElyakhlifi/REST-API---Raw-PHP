<?php
    //include needed php classes
    include_once('../../Api/Posts/Read.php');
    include_once('../../Config/Database.php');
    include_once('../../Api/Call/CallAPI.php');

    class ReadController {
        public function read() {
            //initiate api call class
            $apiCall = new CallAPI();

            //set options variables
            $method = 'GET';
            $curl = 'localhost/RESTAPI-RAWPHP/Api/Posts/read.php';
            $data = null;

            $result = $apiCall->call($method, $curl, $data);

            echo json_decode($result);
        }
    }