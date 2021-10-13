<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Task.php';

    $database = new Database();
    $db = $database->connect();

    $task = new Task($db);

    // $data = json_decode(file_get_contents("php://input"));
    // $task->id = $data->id;

    $task->id = $_POST['id'];

    $task->get_task();

    $task_arr = array(
        'id' => $task->id,
        'name' => $task->name,
        'description' => $task->description,
        'category' => $task->category,
        'value' => $task->value,
        'creator' => $task->creator
    );

    echo(json_encode($task_arr));