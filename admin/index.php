<?php
//使用会话内存储的变量值之前必须先开启会话
require_once 'connectvars.php';
$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_query($mysqli,"set names 'utf8';");
$sqls = mysqli_query($mysqli, 'select * from nongjs_student_05;');
session_start();
//使用一个会话变量检查登录状态
if(!isset($_SESSION['username']) and $_SESSION['permissions']!=0){
    echo "<script> alert('权限不足'); </script>";
    echo "<meta http-equiv='Refresh' content='0;URL=index.php'>";
}
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
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
                <div class="rin-left-title"><?php echo $_SESSION['username']?></div>
                <div class="rin-left-title2">管理员</div>
                <div class="rin-left-slogan"><a href="../logOut.php"> 退出登陆</a>   </div>

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href='stu_info.php' ><span class="iconfont iconBlog"></span>学生信息</a>

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href='tea_info.php'"><span class="iconfont iconwiki"></span>教师信息</a>

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href="course_info.php"=><span class="iconfont iconrizhi"></span>课程信息</a>

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href="major_info.php"><span class="iconfont iconfriend"></span>专业信息</a>

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href="class_info.php"><span class="iconfont iconCommentenable"></span>班级信息</a>

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href="user_info.php""><span class="iconfont iconabout"></span>账户管理</a>
            </div>
        </div>
        <div class="mdui-col-xs-12 mdui-col-md-10">
            <div class="mdui-card rin-card" >
                <div class="info_container">

                </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/gh/AyagawaSeirin/homepage@latest/mdui/js/mdui.min.js"></script>
</body>
</html>
