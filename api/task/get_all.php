<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Task.php';

    $database = new Database();
    $db = $database->connect();

    $task = new Task($db);

    $user_id = $_POST['user_id'];
    $pending = json_encode(array_map('intval', array_keys((array)$_POST['pending'])));
    $all = $_POST['all'];

    // $data = json_decode(file_get_contents("php://input"));
    // $user_id = $data->user_id;
    // $pending = json_encode(array_map('intval', array_keys((array)$data->pending)));
    // $all = $data->all;

    if($_POST['name']) {
        $task->name = "%".$_POST['name']."%";
        $result = $task->search_tasks($user_id, $pending);
    } else {
        $result = $task->get_tasks($user_id, $pending, $all);
    }
    
    $num = $result->rowCount();

    if($num > 0) {
        $health_tasks = array();
        $creativity_tasks = array();
        $productivity_tasks = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $task_item = array(
                'id' => $id,
                'name' => $name,
                'description' => $description,
                'category' => $category,
                'value' => $value,
                'creator' => $creator
            );

            switch ($category) {
                case "creativity":
                    array_push($creativity_tasks, $task_item);
                    break;
                case "productivity":
                    array_push($productivity_tasks, $task_item);
                    break;
                default:
                    array_push($health_tasks, $task_item);
                    break;
            }
        }

        $tasks_arr = array(
            'health_tasks' => $health_tasks,
            'creativity_tasks' => $creativity_tasks,
            'productivity_tasks' => $productivity_tasks
        );
        echo json_encode($tasks_arr);

    }   else {
        echo json_encode(false);
    }