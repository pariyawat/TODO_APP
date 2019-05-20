<?php

class Task {
    //db stuff
    private $conn;


    //Task properties
    public $task_id;
    public $user_id;
    public $task_name;
    public $task_detial;
    public $task_status;
    public $time_stamp;

    //constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Task

    public function read()
    {
        //Create query
        $query = 'SELECT task_id, task_name, task_detial,task_status,time_stamp 
        FROM task  WHERE user_id = ? ORDER BY time_stamp DESC';

            // prepare statement
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->user_id);

    // Execute query
    $stmt->execute();
    return $stmt;
    }

    //create task

    public function create()
    {
        $query = 'INSERT INTO task
            SET user_id = :user_id,
            task_name = :task_name,
            task_detial = :task_detial
        ';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->user_id  = htmlspecialchars(strip_tags($this->user_id));
        $this->task_name  = htmlspecialchars(strip_tags($this->task_name));
        $this->task_detial  = htmlspecialchars(strip_tags($this->task_detial));


        //Bind data
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':task_name', $this->task_name);
        $stmt->bindParam(':task_detial', $this->task_detial);

        //execute

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function update()
    {
        $query = '
        UPDATE task SET
        task_name = :task_name,
        task_detial = :task_detial,
        time_stamp = NOW()
        WHERE task_id = :task_id;
        ';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->task_id  = htmlspecialchars(strip_tags($this->task_id));
        $this->task_name  = htmlspecialchars(strip_tags($this->task_name));
        $this->task_detial  = htmlspecialchars(strip_tags($this->task_detial));



        //Bind data
        $stmt->bindParam(':task_id', $this->task_id);
        $stmt->bindParam(':task_name', $this->task_name);
        $stmt->bindParam(':task_detial', $this->task_detial);
        //execute

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function update_status()
    {
        $query = '
        UPDATE task SET
        task_status = :task_status,
        time_stamp = NOW()
        WHERE task_id = :task_id;
        ';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->task_id  = htmlspecialchars(strip_tags($this->task_id));
        $this->task_status  = htmlspecialchars(strip_tags($this->task_status));



        //Bind data
        $stmt->bindParam(':task_id', $this->task_id);
        $stmt->bindParam(':task_status', $this->task_status);
        //execute

        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $query = '
        DELETE FROM task
        WHERE task_id = ?;
        ';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->task_id);


        
        //execute
        if($stmt->execute()) {
            return true;
        }

        printf("Error: %s. \n", $stmt->error);
        return false;
    }




}