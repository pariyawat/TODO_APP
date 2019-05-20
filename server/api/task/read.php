<?php
 //Headers
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');

 include_once '../../config/db.php';
 include_once '../../model/task.php';

 // Instantiate BD & connect
$database = new Database();
$db = $database->connect();

 // Instantiate blog post 
    $task = new Task($db);
    $task->user_id = isset($_GET['id']) ? $_GET['id'] : die();
    $result = $task->read();
    $num = $result->rowCount();

 if($num > 0){
     $tasks_arr = array();
    //  $tasks_arr['data'] = array();

     while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $task_item = array (
            'task_id'=> $task_id,
            'task_name'=> $task_name,
            'task_detial'=> $task_detial,
            'task_status'=> $task_status,
            'time_stamp'=> $time_stamp
        );

        array_push($tasks_arr, $task_item);
     }
     echo json_encode($tasks_arr);
 } else {
        array('message' => 'No Task Found');
 }