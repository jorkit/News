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
    <script type="text/javascript">
        //全选的功能
        function allcheck(){
            //先得到所有的checkbox
            var ck=document.getElementsByName("opt");//得到一组checkbox  相当于数组
            //循环这一组checkbox让每一个checkbox选中
            for(var i=0;i<ck.length;i++){
                var c=ck[i];//得到一个checkbox
                c.checked=true;//true代表选中
            }
        }

        //全不选
        function allnotcheck(){
            //先得到所有的checkbox
            var ck=document.getElementsByName("opt");//得到一组checkbox  相当于数组
            //循环这一组checkbox让每一个checkbox选中
            for(var i=0;i<ck.length;i++){
                var c=ck[i];//得到一个checkbox
                c.checked=false;//false代表不选
            }
        }
        //反选
        function backcheck(){//先得到所有的checkbox
            var ck=document.getElementsByName("opt");//得到一组checkbox  相当于数组
            //循环这一组checkbox让每一个checkbox选中
            for(var i=0;i<ck.length;i++){
                var c=ck[i];//得到一个checkbox
                if(c.checked==true){//如果当前的checkbox是选中的则不让其选中
                    ck[i].checked=false;
                }else{
                    ck[i].checked=true;
                }
            }
        }

        //批量删除
        function alldel(){
            var f=false;
            //得到要删除的主键id
            var arr=[];//用于存要删除的选中的id值

            var ck=document.getElementsByName("opt");//得到一组checkbox  相当于数组
            //循环这一组checkbox让每一个checkbox选中
            for(var i=0;i<ck.length;i++){
                if(ck[i].checked==true){//代表选中
                    arr.push(ck[i].value);
                    f=true;
                }
            }

            //alert(arr);
            //跳到删除的servlet里去
            if(f==true){
                if(confirm("您确认要删除吗？"))
                    location.href="../type/typeMultidel.php?ids="+arr;
            }else{
                alert("请至少选中一条进行批量删除");
            }
        }
    </script>
</head>
<body>
<?php
    include_once dirname(__FILE__) . "/../common/checkRole.php";
    include dirname(__FILE__) . "/../common/backstage_top.php";
    include dirname(__FILE__) . "/../common/backstage_left.php";
?>
    <div class="right">
        <div class="right-top">
            <span class="glyphicon glyphicon-home" aria-hidden="true" style="margin-left: 20px;margin-right: 5px"></span>首页
            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
            <span>类型管理</span>
        </div>
        <div class="right-search">
            <form action="searchFor.php" method="post">
                <label >关键字：</label>
                <input type="text" class="form-control" name="ssearch" placeholder="关键字">
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
        </div>
        <div class="right-content">
            <div class="right-content-top">
                <a href="typeAdd.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加</a>
                <a onclick="alldel();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>批量删除</a>
                <button class="btn btn-default btn-sm" onclick="allcheck()">全选</button>
                <button class="btn btn-default btn-sm" onclick="allnotcheck()">全不选</button>
                <button class="btn btn-default btn-sm" onclick="backcheck()">反选</button>
            </div>
            <div class="right-content-table">
                <table class="table table-bordered">
                    <thead>
                    <tr >
                        <th style="width: 4%;vertical-align: middle;"><input type="checkbox" onclick="backcheck()" name="opt1" style="width: 15px;height: 15px;"></th>
                        <th style="width: 5%;vertical-align: middle;">编号</th>
                        <th style="width: 5%;vertical-align: middle;">ID</th>
                        <th style="width: 10%;vertical-align: middle;">资讯类型</th>
                        <th style="width: 15%;vertical-align: middle;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include_once dirname(__FILE__) . "/../common/user_paging.php";
                    include_once dirname(__FILE__) . "/../common/db.php";
                    $countRes = mysqli_query($con,"select count(*) from newstype");
                    $row = mysqli_fetch_array($countRes);
                    $count = $row[0];
                    $res = mysqli_query($con,"select * from newstype limit $offset,$pagesize ");
                    mysqli_close($con);
                    if(!$res || !$countRes ){
                        die("网站维护中，请下次光临！");
                    }
                    while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
                  ?>
                        <tr>
                            <td style="vertical-align: middle;"><input type="checkbox" name="opt" value="<?php echo $row["type_id"]?>" style="width: 15px;height: 15px;"></td>
                            <td style="vertical-align: middle;"><?php echo $number+=1?></td>
                            <td style="vertical-align: middle;"><?php echo $row["type_id"]?></td>
                            <td style="vertical-align: middle;"><?php echo $row["type"]?></td>
                            <td style="vertical-align: middle;">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"><a href="typeEdit.php?type_id=<?php echo $row["type_id"]?>">编辑</a></span>
                                <span></span>
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"><a href="../type/typeDelete.php?type_id=<?php echo $row["type_id"]?>" onclick="javascript:return confirm('是否确认删除')">删除</a></span>
                            </td>
                        </tr>
                    <?php
                    } ?>
                    </tbody>
                </table>
                <nav class="navbar navbar-fixed-bottom" style="margin-bottom: 50px">
                    <br/>
                    <ul class="pager" >
                        <li><a href="typeList.php?pageindex=<?php echo $pageindex-1 < 0 ? 0 : $pageindex-1  ?>">上一页</a></li>
                        <li>共:<?php echo $count ?>条记录&nbsp第<?php $_SESSION["pageindex"]= $pageindex+1;echo $_SESSION["pageindex"]?>页&nbsp共<?php echo ceil($count/$pagesize)?>页</li>
                        <li><a href="typeList.php?pageindex=<?php echo $pageindex+1>=ceil($count/$pagesize) ? ceil($count/$pagesize)-1:$pageindex+1 ?>">下一页</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>