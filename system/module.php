<?php
function encrypt($text){
    require("config.php");
    $enc = urlencode(base64_encode(openssl_encrypt($text, 'aes-256-cbc', $encrypt_key, OPENSSL_RAW_DATA,  chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0))));
    if(empty($enc)){ return 'blank';}else{ return $enc; }
}

function decrypt($text){
    require("config.php");
    $dec = openssl_decrypt(base64_decode(urldecode($text)), 'aes-256-cbc', $encrypt_key, OPENSSL_RAW_DATA, chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0));
    if(empty($dec)){ return 'blank'; }else{ return $dec; }
}

function register_user($id, $email, $password, $type, $permission){
    if(empty($id) || empty($email) || empty($password) || empty($type) || empty($permission)){ return false; }
    require("config.php");
    $date = date("Y-m-d H:i:s");
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $vertify_code = '';
    for ($i = 0; $i < "30"; $i++) {
        $vertify_code .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    $query = "INSERT INTO `user` (`id`, `email`, `register_date`, `password`, `type`, `permission`, `vertify_email`) 
    VALUES ('$id', '$email', '$date', '$hash_password', 'type', 'permission', '$vertify_code');";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    return true;
}

function vertify_email($id, $vertify_code){
    if(empty($id) or empty($vertify_code)) { return false;}
    require("config.php");
    $query = "SELECT * FROM `user` WHERE `id` LIKE '$id'";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    $row = mysqli_fetch_array($result);
    $user_vertify_status = $row['vertify_code'];

    if($user_vertify_status !== "true"){
        if($row['vertify_email'] == $vertify_code){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function find_user($head, $data){
    if(empty($data) or empty($head)){ return false; }
    require("config.php");
    $query = "SELECT * FROM `user` WHERE `$head` LIKE '$data'";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function login_user($email, $pw){
    if(empty($email) or empty($pw)){ return false; }
    require("config.php");
    $query = "SELECT * FROM `user` WHERE `email` LIKE '$email'";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    $row = mysqli_fetch_array($result);
    $user_email = $row['email'];
    $user_pw = $row['password'];
    if(password_verify($pw, $user_pw)){
        if($row['type' == "normal"]){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function update_user_data($find_column, $match_data, $column, $data){
    if(empty($find_column) or empty($match_data) or empty($column) or empty($data)) { return false; }
    require("config.php");
    $query = "UPDATE `user` SET `$column` = '$data' WHERE `user`.`$find_column` = '$match_data';";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    return true;
}

function reset_password_user($find_column, $match_data){
    if(empty($find_column) or empty($match_data)) { return false; }
    require("config.php");
    $query = "SELECT * FROM `user` WHERE `$find_column` LIKE '$match_data'";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    $row = mysqli_fetch_array($result);
    $to_email = $row['email'];

    include('PHPMailer/PHPMailerAutoload.php');

    $query = "UPDATE `user` SET `type` = 'chang_pw' WHERE `user`.`$find_column` = '$match_data';";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $rand_string = '';

    for ($i = 0; $i < "30"; $i++) {
        $rand_string .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    
    $query = "UPDATE `user` SET `password` = '$rand_string' WHERE `user`.`$find_column` = '$match_data';";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);

    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPSecure = "ssl";
    $mail->SMTPAuth = true; 
    $mail->Host = $mail_smtp; 
    $mail->Port = 465; 
    $mail->Username = $mail_username;
    $mail->Password = $mail_password; 
    $mail->CharSet = 'UTF-8';
    $mail->From = $mail_from;
    $mail->FromName = "시스템";
    $mail->Subject = "비밀번호 변경코드";
    $mail->msgHTML("$rand_string");
    $mail->addAddress($to_email);
    if($cc) $mail->addCC($cc);
    if($bcc) $mail->addBCC($bcc);
    $mail->send();

    return true;
}

function check_passwordkey($id, $key){
    if(empty($id) or empty($key)) return false;
    require("config.php");
    $query = "SELECT * FROM `user` WHERE `id` LIKE '$id'";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    $row = mysqli_fetch_array($result);
    $to_email = $row['email'];
    $to_type = $row['type'];

    if($to_type == "chang_pw"){
        if($row['password'] == $key){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}

function insert_short_url($url, $keyword, $user){
    require("config.php");
    $date = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $query = "INSERT INTO `short_url` (`id`, `date`, `url`, `keyword`, `user`, `ip`, `agent`, `clicks`) 
    VALUES (NULL, '$date', '$url', '$keyword', '$user', '$ip', '$agent', '0');";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    return true;
}

function find_short_url($find_column, $find_data){
    if(empty($find_column) or empty($find_data)){ return false; }
    require("config.php");
    $query = "SELECT * FROM `short_url` WHERE `$find_column` LIKE '$find_data'";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    $row = mysqli_fetch_array($result);
    return $row;
}

function update_short_url($find_column, $match_data, $column, $data){
    if(empty($find_column) or empty($match_data) or empty($column) or empty($data)) { return false; }
    require("config.php");
    $query = "UPDATE `short_url` SET `$column` = '$data' WHERE `short_url`.`$find_column` = '$match_data';";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    return true;
}

function delete_short_url($find_column, $find_data){
    if(empty($find_column) or empty($find_data)){ return false; }
    require("config.php");
    $query = "DELETE FROM `short_url` WHERE `$find_column` LIKE '$find_data'";
    $result = mysqli_query(mysqli_connect($db_address, $db_id, $db_password, $db_name), $query);
    return true;
}