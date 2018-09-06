<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>类型管理</title>
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/List.css">
</head>
<body>
<?php
include dirname(__FILE__) . "/../common/backstage_top.php";
include dirname(__FILE__) . "/../common/backstage_left.php";
?>
    <div class="right">
    <div class="right-top">
        <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-left: 20px;margin-right: 5px"></span>首页
        <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
        <span>类型管理</span>
    </div>
    <div class="right-content">
        <div class="right-content-table">
            <table class="table table-bordered">
                <thead>
                <tr >
                    <th style="width: 4%;vertical-align: middle;"><input type="checkbox" name="opt1" style="width: 15px;height: 15px;"></th>
                    <th style="width: 5%;vertical-align: middle;">编号</th>
                    <th style="width: 5%;vertical-align: middle;">ID</th>
                    <th style="width: 10%;vertical-align: middle;">资讯类型</th>
                    <th style="width: 15%;vertical-align: middle;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                include_once dirname(__FILE__) . "/../common/db.php";
                $res = mysqli_query($con,"select * from newstype");
                mysqli_close($con);
                if(!$res){
                    die("网站维护中，请下次光临！");
                }
                while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) {
                    $str = $row["type"];
                    $find = $_POST["ssearch"];
                    $pos = "xx".strpos($str, $find);

                    // 注意这里使用的是 ===不能使用==
                    // 因为如果没有字符串 就返回false，如果这个字符串位于字符串的开始的地方，就会返回0为了区分0和false就必须使用等同操作符 === 或者 ！==

                    if ($pos>0) {

                        ?>
                        <tr>
                            <td style="vertical-align: middle;"><input type="checkbox" name="opt" value="1" style="width: 15px;height: 15px;"></td>
                            <td style="vertical-align: middle;"><?php echo $number += 1 ?></td>
                            <td style="vertical-align: middle;"><?php echo $row["type_id"] ?></td>
                            <td style="vertical-align: middle;"><?php echo $row["type"] ?></td>
                            <td style="vertical-align: middle;">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"><a
                                        href="typeEdit.php?type_id=<?php echo $row["type_id"] ?>">编辑</a></span>
                                <span></span>
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"><a
                                        href="../type/typeDelete.php?type_id=<?php echo $row["type_id"] ?>"
                                        onclick="javascript:return confirm('是否确认删除')">删除</a></span>
                            </td>
                        </tr>
                        <?php
                    }
                }?>
                </tbody>
            </table>
<!--            <nav class="navbar navbar-fixed-bottom" style="margin-bottom: 50px">-->
<!--                <br/>-->
<!--                <ul class="pager" >-->
<!--                    <li><a href="typeList.php?pageindex=--><?php //echo $pageindex-1 < 0 ? 0 : $pageindex-1  ?><!--">上一页</a></li>-->
<!--                    <li>共:--><?php //echo $count ?><!--条记录&nbsp第--><?php //$_SESSION["pageindex"]= $pageindex+1;echo $_SESSION["pageindex"]?><!--页&nbsp共--><?php //echo ceil($count/$pagesize)?><!--页</li>-->
<!--                    <li><a href="typeList.php?pageindex=--><?php //echo $pageindex+1>=ceil($count/$pagesize) ? ceil($count/$pagesize)-1:$pageindex+1 ?><!--">下一页</a></li>-->
<!--                </ul>-->
<!--            </nav>-->
        </div>
    </div>
</div>
</body>
</html>