<?php
 //Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: PUT');
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

$task->task_id = $data->task_id;
$task->task_status = $data->task_status;

// Create task

if($task->update_status()) {
    echo json_encode(
        array('message' => 'Task Status Updated' )
    );
} else {
    echo json_encode(
        array('message' => 'Task Status Not Updated')
    );
}

