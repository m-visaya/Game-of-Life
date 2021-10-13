<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/History.php';

$database = new Database();
$db = $database->connect();

$history = new History($db);

$history->task_name = $_POST['task_name'];
$history->action = $_POST['action'];
$history->user_id = $_POST['user_id'];

echo json_encode($history->create());
