<?php
 //Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Methods: DELETE');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
 Access-Control-Allow-Methods, Authorization, X-Requested-with');


 include_once '../../config/db.php';
 include_once '../../model/task.php';

 // Instantiate BD & connect
$database = new Database();
$db = $database->connect();

 // Instantiate blog post 
$task = new Task($db);
$task->task_id = isset($_GET['id']) ? $_GET['id'] : die();



// Create task

if($task->delete()) {
    echo json_encode(
        array('message' => 'Task  Deleted' )
    );
} else {
    echo json_encode(
        array('message' => 'Task Not Deleted')
    );
}

