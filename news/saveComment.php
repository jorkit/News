<?php
/**
 * Created by PhpStorm.
 * User: 潘多拉
 * Date: 2018/8/4
 * Time: 23:16
 */
session_start();
$comment = $_POST["comment"];
$news_id = $_POST["news_id"];
$user_id = $_SESSION["user_id"];

include_once dirname(__FILE__) . "/../common/db.php";
$res = mysqli_query($con,"insert into comment (news_id,user_id,comment) values ($news_id,$user_id,'$comment')");
mysqli_close($con);
if(!$res){
    echo "评论失败！";
}
else{
    include_once dirname(__FILE__) . "/../frontEnd/jumping.php";
    header("Refresh: 1; url=../frontEnd/detail.php?news_id=$news_id");
}
