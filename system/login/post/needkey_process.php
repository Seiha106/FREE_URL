<?php
require_once("../../load_page.php");

$pw_key = htmlspecialchars($_POST['pw_key']);
$password = htmlspecialchars($_POST['password']);

$user_data = find_user("password", $pw_key);

if($user_data['password'] == $pw_key){
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    update_user_data("password", $pw_key, "password", $password_hash);
    update_user_data("password", $password_hash, "type", "normal");
    update_user_data("password", $password_hash, "vertify_email", "true");
    echo '<script>';
    echo 'alert("비밀번호를 변경했습니다");';
    echo 'window.location.href = "../index.php"';
    echo '</script>';
}else{
    echo '<script>';
    echo 'alert("키가 불일치합니다");';
    echo 'history.back();';
    echo '</script>';
}