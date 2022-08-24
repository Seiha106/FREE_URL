<?php
require_once("../../load_page.php");

$id = htmlspecialchars($_POST['id']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

if(!empty(find_user("id", $id))){
    echo '<script>';
    echo 'alert("아이디가 이미 존재합니다");';
    echo 'history.back();';
    echo '</script>';
    exit;
}

if(!empty(find_user("email", $email))){
    echo '<script>';
    echo 'alert("해당 이메일은 이미 가입되어있습니다");';
    echo 'history.back();';
    echo '</script>';
    exit;
}

register_user($id, $email, password_hash($password, PASSWORD_DEFAULT), "normal", "normal");

echo '<script>';
echo 'alert("회원가입 완료");';
echo 'history.back();';
echo '</script>';