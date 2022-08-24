<?php
require_once("../../load_page.php");

$email = htmlspecialchars($_POST['email']);

$user_data = find_user("email", $email);
if($user_data['email'] == $email){
    $enc_date = encrypt(date("YmdH"));
    update_user_data("email", $email, "type", "change_pw_need_valid");
    reset_password_user("email", $email);
    echo '<script>';
    echo 'window.location.href = "need_pw_key.php?key='.$enc_date.'"';
    echo '</script>';
}else{
    echo '<script>';
    echo 'alert("계정정보가 없습니다");';
    echo 'history.back();';
    echo '</script>';
}