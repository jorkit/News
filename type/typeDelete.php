<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/18
 * Time: 10:53
 */
    include_once dirname(__FILE__) . "/../common/checkadmin.php";
    if(empty($_GET["type_id"])){
        echo "信息获取失败，<a href='../backstage/typeList.php'>请重试</a>";
        header("Refresh: 1; url=../backstage/typeList.php");
    }
    $id= $_GET["type_id"];
    $sql = "delete from newstype where type_id = $id";
    include_once dirname(__FILE__) . '/../common/db.php';
    $res = mysqli_query($con,$sql);
    mysqli_close($con);
    if($res){
        include dirname(__FILE__) . '/../frontEnd/jumping.php';
        header("Refresh: 1; url=../backstage/typeList.php");
    }else{
        echo "删除失败！请重试";
        header("Refresh: 1; url=../backstage/typeList.php");
    }
