<?php

    include('php/connect.php');
    include_once 'php/response.php';

    class SensorAPI{
  
        function getData(){

            $database = new Database();
            $con = $database->connect();
                
            $sensor = "light";
            $encode = array();

            $sql = "SELECT * FROM sensordata WHERE name = '".$sensor."'";

            $result = mysqli_query($con, $sql);
            while($row = $result->fetch_assoc()){
                $encode[] = $row;
            }

            $json_encoded = json_encode($encode);

            sendResponse(200, $json_encoded, 'application/json');
            return true;     
        }

        function setData(){

            $database = new Database();
            $con = $database->connect();
            
            if(isset($_POST["data"])){
                $data = $_POST["data"];
                $name = "light";
                $stmt = $con->prepare('INSERT INTO sensordata (data, name) VALUES (?,?)');
                $stmt->bind_param('ss', $data, $name);
                $stmt->execute();


                sendResponse(200, '');
                return true;
            }

            
            echo "not all set\n";
            sendResponse(400, 'invalid request');
            return false;
        }
    }

    $api = new SensorAPI;

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET': $request = &$_GET; $api->getData(); break;
        case 'POST': $request = &$_POST; $api->setData(); break;
        default: sendResponse(400, 'Invalid request');
    }
?>