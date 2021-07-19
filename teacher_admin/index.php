<?php
//使用会话内存储的变量值之前必须先开启会话
require_once '../connectvars.php';
$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_query($mysqli,"set names 'utf8';");
$sqls = mysqli_query($mysqli, 'select * from nongjs_student_05;');
session_start();
//使用一个会话变量检查登录状态
if(!isset($_SESSION['username']) and $_SESSION['permissions']!=2){
    echo "<script> alert('权限不足'); </script>";
    echo "<meta http-equiv='Refresh' content='0;URL=../index.php'>";
}
$user_id=$_SESSION['username'];
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$sql = "select * from nongjs_teacher_05 where njs_teacherNo_05 = '$user_id' ;";
$mysql = mysqli_query($mysqli, $sql);
$user = mysqli_fetch_assoc($mysql);
$user_name = $user['njs_teacherName_05'];
$sql_s = mysqli_query($mysqli, "SELECT njs_courseName_05,njs_className_05,njs_classNo_05 FROM nongjs_classcourseopen_05 where njs_teacherName_05 = '$user_name';");
/**在已登录页面中，可以利用用户的session如$_SESSION['username']、
 * $_SESSION['user_id']对数据库进行查询，可以做好多好多事情*/
?>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>管理员界面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/AyagawaSeirin/homepage@latest/mdui/css/mdui.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/index.css">
    <!-- <link rel="stylesheet" href="/assets/css/detaile.css"> -->
    <link rel="stylesheet" href="https://at.alicdn.com/t/font_1625701_q2422cy34wn.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        function f(){
            var text = $('input[type=text]').val();

            $('table tr').not(':first').hide().filter(':contains("'+text+'")').show();
        }

    </script>


</head>
<body class="mdui-theme-primary-pink mdui-theme-accent-pink">
<div id="rin-bg"></div>
<main id="rin-main">
    <div class="mdui-row">
        <div class="mdui-col-xs-12 mdui-col-md-2">
            <div class="rin-left">
                <div class="rin-logo">
                    <img src="../images/admin_logo.jpg">
                </div>
                <div class="rin-left-title"><?php echo $user['njs_teacherName_05']; ?></div>
                <div class="rin-left-title2">教师</div>
                <div class="rin-left-slogan"><a href="../logOut.php"> 退出登陆</a>   </div>

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href='#'  style="background-color: #28A9E0;"><span class="iconfont iconBlog"></span>任教信息</a>

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href='modify.php'><span class="iconfont iconwiki"></span>修改密码</a>
            </div>
        </div>
        <div class="mdui-col-xs-12 mdui-col-md-10">
            <div class="mdui-card rin-card"  style="overflow-y: scroll" >
                <div class="info_container">
                    <div class="container" id="container1">
                        <h1 class="text-center">任教信息</h1>
                        <form class="form-inline" role="form" style="margin-bottom: 3px">
                            <div class="form-group">
                                <label class="sr-only" for="name">名称</label>
                                <input type="text" class="form-control" id="name" placeholder="请输入要查询的信息">
                            </div>
                            <button type="button" class="btn btn-default" onclick="f();">搜索</button>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">授课课程</th>
                                <th class="text-center">授课班级</th>
                                <th class="text-center">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = mysqli_fetch_assoc($sql_s)): ?>
                                <tr class="text-center">
                                    <td><?php echo $row['njs_courseName_05']; ?></td>
                                    <td><?php echo $row['njs_className_05']; ?></td>

                                    <td>
                                        <a href="view.php?c_name=<?php echo $row['njs_courseName_05'];?>&class=<?php echo $row['njs_classNo_05'];?>" class="btn btn-danger">查看</a>
                                    </td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
</main>
<script src="https://cdn.jsdelivr.net/gh/AyagawaSeirin/homepage@latest/mdui/js/mdui.min.js"></script>
</body>
</html>
