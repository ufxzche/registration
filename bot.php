<?php

require_once 'connect.php';
require_once 'function.php';
require_once 'api.php';

$status = getStatus($connect, $msgID);
$status = $status['status'];

if($text == '/start'){
    add_user($connect, $msgID, $old_id);
    
    setStatus($connect, $msgID, 1);
    $answer = "Enter your name:";
}
elseif($text && $status == 1){
    updateUser($connect, $msgID, 'first_name', $text);
    setStatus($connect, $msgID, 2);
    $answer = "Enter last name:";
}
elseif($text && $status == 2){
    updateUser($connect, $msgID, 'last_name', $text);
    setStatus($connect, $msgID, 3);
    $answer = "Your data:\n\nName: ".$get_user['first_name']."\nLast name: ".$get_user['last_name'];
}
else{
    $answer = '404';
}

bot('sendmessage', ['chat_id'=>$msgID, 'text'=>$answer]);
