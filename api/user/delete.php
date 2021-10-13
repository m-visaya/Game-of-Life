<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    $database = new Database();
    $db = $database->connect();

    $user = new User($db);
    
    $user->id = $_POST['id'];

    echo  json_encode($user->delete());    
