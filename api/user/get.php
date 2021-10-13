<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    

    $database = new Database();
    $db = $database->connect();

    $user = new User($db);
    
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->id = $_POST['id'];

    if ($user->get_user()) {
        $user_details = array(
            'id' => $user->id,
            'username' => $user->username,
            'tasks' => $user->tasks,
            'stats' => $user->stats,
            'level' => $user->level
        );
        echo(json_encode($user_details));
    }
    else {
        echo(json_encode(false));
    } 
 