<?php
require_once '../connectvars.php';
$student_tb='nongjs_student_05';
$teacher_tb='nongjs_teacher_05';
$course_tb='nongjs_course_05';
$major_tb='nongjs_major_05';
$class_tb='nongjs_class_05';
$user_tb='nongjs_user_05';
$ctc_tb='nongjs_classcoursetea_05';
$db_table = $_GET['db_table'];
$c_name = $_GET['c_name'];
// 1. 接收传递过来的id
    if(empty($_GET['id'])){
        exit('<h1>连接数据库失败</h1>');
    }
    $id = $_GET['id'];
// 2. 连接数据库
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
// 3. 删除该条数据
    if ($db_table==$teacher_tb){
        $sql="delete from `$db_table` where njs_teacherNo_05 = '$id'";
    }
    elseif ($db_table==$student_tb){
        $sql="delete from `$db_table` where njs_studentNo_05 = '$id'";
    }
    elseif ($db_table==$course_tb){
        $sql="delete from `$db_table` where njs_courseNo_05 = '$id'";
    }
    elseif ($db_table==$major_tb){
        $sql="delete from `$db_table` where njs_majorNo_05 = '$id'";
    }
    elseif ($db_table==$class_tb){
        $sql="delete from `$db_table` where njs_classNo_05 = '$id'";
    }
    elseif ($db_table==$user_tb){
        $sql="delete from `$db_table` where njs_UserNo_05 = '$id'";
    }
    elseif ($db_table==$ctc_tb){
        $sql_f =mysqli_query($link,"select * from nongjs_course_05 where njs_courseName_05='$c_name';");
        $row = mysqli_fetch_assoc($sql_f);
        $c_id = $row['njs_courseNo_05'];
        $sql="delete from `$db_table` where njs_classNo_05 = '$id' and njs_courseNo_05='$c_id' ";
    }
    $query = mysqli_query($link,$sql);
// 4. 查询失败的处理
    if (!$query) {
        echo "<script>alert('删除失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
// 5. 受影响的行数
    $affected_rows = mysqli_affected_rows($link);
// 6. 删除失败
    if ($affected_rows <= 0) {
        echo "<script>alert('删除失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
echo "<script>alert('删除成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

