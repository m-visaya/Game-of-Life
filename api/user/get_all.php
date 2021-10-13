<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    $database = new Database();
    $db = $database->connect();

    $user = new User($db);

    $result = $user->get_users();
    $num = $result->rowCount();

    if($num > 0) {
        $users_arr = array();
        $users_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_item = array(
                'id' => $id,
                'username' => $username,
                'password' => $password,
                'tasks' => $tasks,
                'stats' => $stats
            );

            array_push($users_arr['data'], $user_item);
        }

        echo json_encode($users_arr);

    }   else {
        echo json_encode(false);
    }