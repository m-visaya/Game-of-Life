<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    $database = new Database();
    $db = $database->connect();

    $user = new User($db);
    
    $user->id = $_POST['id'];
    $user->tasks = $_POST['tasks'];
    $user->stats = $_POST['stats'];
    $user->level = $_POST['level'];

    echo json_encode($user->update());
    