<?php
require_once 'connectvars.php';
// 1. 判断是否是post提交
// 2. 处理表单传递过来的数据（不能为空!empty;这里我就先不做处理了）
// 3. 连接数据库并插入一条数据
// 4. 开始查询（insert into）
// 5. 判断是否查询成功
// 6. 判断是否插入成功`mysqli_affected_rows()`
// 7. 重定向
$student_tb='nongjs_student_05';
$teacher_tb='nongjs_teacher_05';
$course_tb='nongjs_course_05';
$major_tb='nongjs_major_05';
$class_tb='nongjs_class_05';
$user_tb='nongjs_user_05';
$ctc_tb='nongjs_classcoursetea_05';

//添加学生信息
function add_student(){
    $id = $_POST['user_id'];
    $name = $_POST['user_name'];
    $sex = $_POST['user_sex'];
    $age = $_POST['user_age'];
    $area = $_POST['user_area'];
    $credit= $_POST['user_credit'];
    $class = $_POST['user_class'];
    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "INSERT INTO `$db_table` (njs_studentNo_05,njs_studentName_05,njs_studentSex_05,njs_studentAge_05,njs_area_05,njs_studentCredit_05,njs_classNo_05) VALUES ('$id','$name','$sex',$age,'$area',$credit,'$class');";
    $query = mysqli_query($link,$sql);

    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('添加数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    echo "<script>alert('添加成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}

//添加教师信息
function add_teacher(){
    $id = $_POST['user_id'];
    $name = $_POST['user_name'];
    $sex = $_POST['user_sex'];
    $age = $_POST['user_age'];
    $title = $_POST['user_title'];
    $tel= $_POST['user_tel'];
    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "INSERT INTO `$db_table` (njs_teacherNo_05,njs_teacherName_05,njs_teacherSex_05,njs_teacherAge_05,njs_teacherTitle_05,njs_teacherTel_05)
 VALUES ('$id','$name','$sex',$age,'$title','$tel');";
    $query = mysqli_query($link,$sql);

    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('添加数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    echo "<script>alert('添加成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}

//添加课程信息
function add_course(){
    $id = $_POST['course_id'];
    $name = $_POST['course_name'];
    $teacher = $_POST['course_tea'];
    $term = $_POST['course_term'];
    $time = $_POST['course_time'];
    $c_method= $_POST['course_method'];
    $credit= $_POST['course_credit'];
    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "INSERT INTO `$db_table` (njs_courseNo_05,njs_courseName_05,njs_teacherName_05,njs_courseOpenSemester_05,njs_coursePeriod_05,njs_courseAssesMethod_05,njs_courseCredit_05)
 VALUES ('$id','$name','$teacher','$term',$time,'$c_method',$credit);";
    $query = mysqli_query($link,$sql);

    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('添加数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    echo "<script>alert('添加成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}

//添加专业信息
function add_major(){
    $id = $_POST['major_id'];
    $name = $_POST['major_name'];
    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "INSERT INTO `$db_table` (njs_majorNo_05,njs_majorName_05) VALUES ('$id','$name');";
    $query = mysqli_query($link,$sql);

    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('添加数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    echo "<script>alert('添加成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}

//添加班级信息
function add_class(){
    $id = $_POST['class_id'];
    $name = $_POST['class_name'];
    $m_id = $_POST['major_id'];
    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "INSERT INTO `$db_table` (njs_classNo_05,njs_className_05,njs_majorNo_05) VALUES ('$id','$name','$m_id');";
    $query = mysqli_query($link,$sql);

    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('添加数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    echo "<script>alert('添加成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}

//添加账号
function add_user(){
    $id = $_POST['username'];
    $name = $_POST['password'];
    $level = $_POST['userlevel'];
    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "INSERT INTO `$db_table` (njs_UserNo_05,njs_UserPassword_05,njs_UserLevel_05) VALUES ('$id','$name',$level);";
    echo $sql;
    $query = mysqli_query($link,$sql);

    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('添加数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    echo "<script>alert('添加成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}

//添加开课信息
function add_open_couse(){
    $id = $_POST['class_id'];
    $c_id =$_POST['course_id'];
    $t_id =$_POST['teacher_id'];
    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "INSERT INTO `$db_table` (njs_classNo_05,njs_courseNo_05,njs_teacherNo_05 ) VALUES ('$id','$c_id','$t_id');";
    $query = mysqli_query($link,$sql);

    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('添加数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    echo "<script>alert('添加成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}

if($_SERVER['REQUEST_METHOD']==='POST'){
    if ($_POST['db_table']==$student_tb){
        add_student();
    }
    elseif ($_POST['db_table']==$teacher_tb){
        add_teacher();
    }
    elseif ($_POST['db_table']==$course_tb){
        add_course();
    }
    elseif ($_POST['db_table']==$major_tb){
        add_major();
    }
    elseif ($_POST['db_table']==$class_tb){
        add_class();
    }
    elseif ($_POST['db_table']==$user_tb){
        add_user();
    }
    elseif ($_POST['db_table']==$ctc_tb){
        add_open_couse();
    }
}
?>
