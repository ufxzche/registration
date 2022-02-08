<?php

require_once 'token.php';

function bot($method,$datas=[]){
global $token;
    $url = "https://api.telegram.org/bot".$token."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

function add_user($connect, $chat_id, $old_id){
	$chat_id = trim($chat_id);

	if($chat_id == $old_id)
		return false;
	$t = "INSERT INTO users (user_id) VALUES ('%s')";
	$query = sprintf($t, mysqli_real_escape_string($connect, $chat_id));
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}

function get_user($connect, $chat_id){
	$query = sprintf("SELECT * FROM users WHERE user_id=%d", (int)$chat_id);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$get_user = mysqli_fetch_assoc($result);
	return $get_user;

}

function updateUser($connect, $chat_id, $col, $val){
    $sql = sprintf("UPDATE users SET $col='%s' WHERE user_id='$chat_id'", mysqli_real_escape_string($connect, $val));

    $result = mysqli_query($connect, $sql);
    if(!$result)
        die(mysqli_error($connect));
    return true;
}


function getStatus($connect, $chat_id){
    $sql = "SELECT * FROM users WHERE user_id='$chat_id'";

    $result = mysqli_query($connect, $sql);
    if(!$result)
        die(mysqli_error($connect));
    $status = mysqli_fetch_assoc($result);
    return $status;
}

function setStatus($connect, $chat_id, $status){
    $sql = "UPDATE users SET status=$status WHERE user_id=$chat_id";

    $result = mysqli_query($connect, $sql);
    if(!$result)
        die(mysqli_error($connect));
    $status = mysqli_fetch_assoc($result);
    return $status;
}