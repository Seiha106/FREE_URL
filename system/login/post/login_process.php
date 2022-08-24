<?php
require_once("../../load_page.php");

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

if(login_user($email, $password)){
    $user_data = find_user("email", $email);
    if($user_data['vertify_email'] !== "true"){
        echo '<script>alert("이메일 인증이 필요합니다");</script>';
    }else{
        if($user_data['type'] == "normal"){
            session_start();
            $_SESSION['user_data_id'] = $user_data['id'];
            $_SESSION['user_data_email'] = $user_data['email'];
            $_SESSION['user_data_permission'] = $user_data['permission'];

            echo '<script>alert("로그인완료");</script>';
            echo '<script>window.location.href = "../../../index.php"</script>';
            exit;
        }else{
            echo '<script>alert("비밀번호를 변경해주세요");</script>';
            echo '<script>history.back();</script>';
            exit;
        }
    }
}else{
    echo '<script>';
    echo 'alert("이메일 또는 비밀번호가 불일치합니다");';
    echo 'history.back();';
    echo '</script>';
}