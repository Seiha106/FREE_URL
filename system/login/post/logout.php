<?php
require_once("../../load_page.php");

session_start();

unset($_SESSION['user_data_id']);
unset($_SESSION['user_data_email']);
unset($_SESSION['user_data_permission']);

echo '<script>';
echo 'alert("로그아웃 완료");';
echo 'history.back();';
echo '</script>'; 