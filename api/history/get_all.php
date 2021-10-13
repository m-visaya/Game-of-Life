<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/History.php';

$database = new Database();
$db = $database->connect();

$history = new History($db);

$history->user_id = $_POST['user_id'];

$result = $history->get_history();
$num = $result->rowCount();

if ($num > 0) {
    $hist_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $hist_item = array(
            'task_name' => $task_name,
            'action' => $action,
            'user_id' => $user_id,
        );

        if(!isset($hist_arr[$date]))
        {
            $hist_arr[$date] = array();
        }

        array_push($hist_arr[$date], $hist_item);
    }

    echo json_encode(array_reverse($hist_arr));
} else {
    echo json_encode(false);
}
