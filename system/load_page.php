<?php
error_reporting(E_ERROR | E_WARNING);

require_once("config.php");
require_once ("module.php");

if($install_finished !== "true"){
    echo "시스템을 설치해야합니다<br>";
    echo "<a href=\"system/setup.php\">시스템설치 진행</a>";
    exit;
}

