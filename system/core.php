<?php
require_once("config.php");
require_once ("module.php");
error_reporting(E_ERROR | E_WARNING);

$keyword = htmlspecialchars($_GET['keyword']);

$find_data = find_short_url("keyword", $keyword);

if($find_data['keyword'] == $keyword){
    echo $find_data['url'];
    $add_clicks = $find_data['clicks'] + 1;

    if($_COOKIE[$keyword] !== "true"){
        setcookie(
            $keyword,
            "true",
            time() + (10 * 365 * 24 * 60 * 60)
          );
          update_short_url("keyword", $keyword, "clicks", $add_clicks);
    }

}else{
    echo "URL 데이터가 없습니다";
}