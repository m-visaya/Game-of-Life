<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Task.php';

    $database = new Database();
    $db = $database->connect();

    $task = new Task($db);

    $task->name = $_POST['name'];
    $task->description = $_POST['description'];
    $task->category = $_POST['category'];
    $task->value = $_POST['value'];
    $task->creator = $_POST['creator'];

    echo json_encode($task->create());