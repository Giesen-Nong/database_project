<?php
require_once '../connectvars.php';
session_start();
$id = $_POST['id'];
$score = $_POST['score'];
$c_name = $_POST['c_name'];
echo $c_name;
$db_table = $_POST['db_table'];
$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
mysqli_query($link,"set names 'utf8';");
$sql = mysqli_query($link,"select * from nongjs_course_05 where njs_courseName_05 = '$c_name';");
$row = mysqli_fetch_assoc($sql);
$c_no = $row['njs_courseNo_05'];
$term = $row['njs_courseOpenSemester_05'];
if(!$link){
    echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}
$sql = "INSERT INTO `$db_table`(njs_studentNo_05,njs_reportSemester_05,njs_courseNo_05,njs_reportScore_05) VALUES ('$id','$term','$c_no',$score)";
$query = mysqli_query($link,$sql);
if (!$query) {
    echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
$affected = mysqli_affected_rows($link);
if($affected!==1){
    echo "<script>alert('添加数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

}
echo "<script>alert('添加数据成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

?>