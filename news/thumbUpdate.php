<?php
/**
 * Created by PhpStorm.
 * User: 潘多拉
 * Date: 2018/8/8
 * Time: 19:40
 */

session_start();
$news_id = $_SESSION["news_id"];
include_once dirname(__FILE__) . "/../common/db.php";
$comment_id = $_GET["comment_id"];
$thumbup = $_GET["thumbup"];
$thumbdown = $_GET["thumbdown"];
$res = mysqli_query($con,"update comment set thumbup=$thumbup,thumbdown=$thumbdown where comment_id = $comment_id");
mysqli_close($con);
if(!$res){
    echo "数据传输出错！";die;
}
header("Refresh: 0.01;url=../frontEnd/detail.php?news_id=$news_id");
