<?php

require_once 'token.php';
$link = 'https://api.telegram.org/bot' . $token;

$updates = file_get_contents('php://input');
$updates = json_decode($updates, TRUE);

$msgID = $updates['message']['chat']['id'];
$text = $updates['message']['text'];


$get_user = get_user($connect, $msgID);
$old_id = $get_user['user_id'];
