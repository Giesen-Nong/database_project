<?php
//使用会话内存储的变量值之前必须先开启会话
require_once '../connectvars.php';
$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_query($mysqli,"set names 'utf8';");
session_start();
//使用一个会话变量检查登录状态
if(!isset($_SESSION['username']) and $_SESSION['permissions']!=2){
    echo "<script> alert('权限不足'); </script>";
    echo "<meta http-equiv='Refresh' content='0;URL=index.php'>";
}
$sql_name = 'rankScoreForTeacher';
$user_id=$_SESSION['username'];
$c_name = $_GET['c_name'];
$class = $_GET['class'];
$year_sql =mysqli_query($mysqli, "select left('$class',4) as year;");
$year_query = mysqli_fetch_assoc($year_sql);
$year = $year_query['year'];
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$sql = "select * from nongjs_teacher_05 where njs_teacherNo_05 = '$user_id' ;";
$mysql = mysqli_query($mysqli, $sql);
$user = mysqli_fetch_assoc($mysql);
$user_name = $user['njs_teacherName_05'];
$sql = "call $sql_name('$c_name','$year');";
$sql_s = mysqli_query($mysqli, "call $sql_name('$c_name','$year','$class');");
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

                <a class="mdui-btn mdui-btn-raised rin-btn rin-btn-blue rin-btn-left mdui-text-capitalize" href='index.php'  style="background-color: #28A9E0;"><span class="iconfont iconBlog"></span>任教信息</a>

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
                                <th class="text-center">学号</th>
                                <th class="text-center">姓名</th>
                                <th class="text-center">课程名称</th>
                                <th class="text-center">成绩</th>
                                <th class="text-center">年纪排名</th>
                                <th class="text-center">操作</th>
                            </tr>
                            </thead>
                            <?php while ($row = mysqli_fetch_assoc($sql_s)): ?>
                                <tr class="text-center">
                                    <td><?php echo $row['njs_studentNo_05']; ?></td>
                                    <td><?php echo $row['njs_studentName_05']; ?></td>
                                    <td><?php echo $row['njs_courseName_05']; ?></td>
                                    <td><?php echo $row['njs_reportScore_05']; ?></td>
                                    <td><?php echo $row['njs_rank_05']; ?></td>
                                    <td>
                                        <a href="score_update.php?id=<?php echo $row['njs_studentNo_05'];?>&c_name=<?php echo $row['njs_courseName_05'];?>&score=<?php echo $row['njs_reportScore_05'];?>" class="btn btn-danger">修改成绩</a>
                                    </td>
                                </tr>
                            <?php endwhile;?>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#add_user">添加学生成绩</button>
                        <!-- 模态框（Modal） -->
                        <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">添加学生成绩</h4>
                                    </div>
                                    <?php
                                    require_once 'connectvars.php';
                                    $mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                                    $sql = "select * from nongjs_student_05 where njs_classNo_05='$class'";
                                    $sql_s = mysqli_query($mysqli, $sql);
                                    ?>
                                    <?php while ($row = mysqli_fetch_assoc($sql_s)): ?>
                                    <div >
                                        <form id="form_data" class="form-horizontal" role="form" method="post" action="add_score.php">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td><?php echo $name=$row['njs_studentNo_05']; ?></td>
                                                            <input style="display: none" type="text" name="id[]" value="<?php echo $row['njs_studentNo_05']; ?>">
                                                            <td><?php echo $row['njs_studentName_05']; ?></td>
                                                            <?php
                                                            $sql = "select * from nongjs_report_05 where njs_studentNo_05='$name'";
                                                            $sql_a = mysqli_query($mysqli, $sql);
                                                            $row_a = mysqli_fetch_assoc($sql_a);
                                                            ?>
                                                            <input type="text" style="display: none" value="<?php echo $row_a['njs_reportScore_05']; ?>" name="old_score[]">
                                                            <td>成绩：<input type="text" id="score" value="<?php echo $row_a['njs_reportScore_05']; ?>" name="score[]"/></td>
                                                        </tr>
                                                    </table>
                                    <?php endwhile;?>
                                            <input type="text" style="display: none" name="c_name" value="<?php echo $c_name; ?>">
                                            <input type="text" style="display: none" name="db_table" value="nongjs_report_05">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                                                </button>
                                                <button type="submit" onclick="add_info()" class="btn btn-primary">
                                                    提交更改
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
</main>
<script src="https://cdn.jsdelivr.net/gh/AyagawaSeirin/homepage@latest/mdui/js/mdui.min.js"></script>
</body>
</html>
