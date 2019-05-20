<?php
 //Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
 Access-Control-Allow-Methods, Authorization, X-Requested-with');


 include_once '../../config/db.php';
 include_once '../../model/task.php';

 // Instantiate BD & connect
$database = new Database();
$db = $database->connect();

 // Instantiate blog post 
$task = new Task($db); 


// GET raw task data
$data = json_decode(file_get_contents("php://input"));

$task->user_id = $data->user_id;
$task->task_name = $data->task_name;
$task->task_detial = $data->task_detial;

// Create task

if($task->create()) {
    echo json_encode(
        array('message' => 'Task Created' )
    );
} else {
    echo json_encode(
        array('message' => 'Task Not Created')
    );
}

