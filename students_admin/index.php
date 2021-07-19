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
$sql = "select * from nongjs_student_05 where njs_studentNo_05 = '$user_id' ;";
$mysql = mysqli_query($mysqli, $sql);
$user = mysqli_fetch_assoc($mysql);
/**在已登录页面中，可以利用用户的session如$_SESSION['username']、
 * $_SESSION['user_id']对数据库进行查询，可以做好多好多事情*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">

    <title>学生信息界面</title>
    <link rel="stylesheet" type="text/css" href="../css/FiraCode.css">
    <link rel="stylesheet" type="text/css" href="../css/nutssss.css">

    <script type="text/javascript">
        function send(i)
        {
            if (i==1)
            {document.form_c.action="show_score.php";}
            else
            {document.form_c.action="show_course.php";}
            document.form_c.submit();
        }
    </script>

</head>

<body>
    <div id="box">
        <div class="meBox">
            <div class="headPhoto"></div>
            <div class="meBox-title">
                <p><?php echo $user['njs_studentName_05']; ?></p>
                <div class="fg"></div>
            </div>
            <div class="meBox-text">
                <p>学号:<?php echo $user['njs_studentNo_05']; ?></p>
                <p>性别:<?php echo $user['njs_studentSex_05']; ?></p>
                <p>生源地:<?php echo $user['njs_area_05']; ?></p>
                <p>已修学分:<?php echo $user['njs_studentCredit_05']; ?></p>
                <form name="form_c" class="choose" method="post" action="#">
                    <label>成绩查询：</label>
                    <select name="term">
                        <option value="大一">大一</option>
                        <option value="大二">大二</option>
                        <option value="大三">大三</option>
                        <option value="大四">大四</option>
                    </select>
                <button class="login-button" type="button" onclick="send(1)">查询成绩</button>
                    <button class="login-button" type="button" onclick="send(0)">查询课程表</button>
                </form>
            </div>
            <!-- 两个按钮 -->
            <div class="meBox-Button">
                <a href="modify.php">修改密码</a>
                <a href="../logOut.php">退出登陆</a>
            </div>
        </div>

        <!-- 伪终端介绍 -->
        <div id="cmdBox">
            <!-- 第一个终端 -->
            <div class="cmd">
                <!-- 三个按钮 -->
                <div class="click">
                    <div class="red"></div>
                    <div class="yellow"></div>
                    <div class="green"></div>
                </div>
                <!-- 顶部标题 -->
                <div class="title">
                    <span>学生管理系统 - bash</span>
                </div>
                <!-- 终端内文字 -->
                <div class="cmdText">

                </div>
            </div>
        </div>
    </div>

    <!-- 页脚 -->
    <div id="footer">
        <p>© 数据库课设 | <a href="#"></a></p>
        <p>THEME MADE BY <a href="#">筱升</a></p>
    </div>
</body>

</html>
