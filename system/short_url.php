<?php
require_once("config.php");
require_once ("module.php");

session_start();

$url = htmlspecialchars($_POST['url']);
$keyword = htmlspecialchars($_POST['keyword']);
$user_id = $_SESSION['user_data_id'];

if(empty($keyword)){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $rand_string = '';

    for ($i = 0; $i < "5"; $i++) {
        $rand_string .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    $keyword = $rand_string;
}


if(insert_short_url($url, $keyword, $user_id)){
    echo '<script>';
    echo 'alert("'.$keyword.'");';
    echo 'history.back();';
    echo '</script>';
}else{
    echo '<script>';
    echo 'alert("에러");';
    echo 'history.back();';
    echo '</script>';
}
