<?php
require_once 'connectvars.php';
$user = [''];
function get_id(){
    $db_table = $_GET['db_table'];
    if (empty($_GET['id'])) {
        echo "<script> alert('必须传入指定参数'); </script>";
        echo "<meta http-equiv='Refresh' content='0;URL=../admin/course_info.php'>";
    }
    $id = $_GET['id'];
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_query($link, "set names 'utf8';");
    if (!$link) {
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $sql="select * from `$db_table` where njs_courseNo_05 = '$id' limit 1";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "<script> alert('数据查询失败'); </script>";
        echo "<meta http-equiv='Refresh' content='0;URL=../admin/course_info.php'>";    }
    global $user;
    $user = mysqli_fetch_assoc($query);
    if (!$user) {
        echo "<script> alert('找不到你要编辑的数据'); </script>";
        echo "<meta http-equiv='Refresh' content='0;URL=../admin/course_info.php'>";    }
}

function update_course(){
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
    $sql = "UPDATE `$db_table` SET njs_courseNo_05='$id',njs_courseName_05='$name',njs_teacherName_05='$teacher',njs_courseOpenSemester_05='$term',njs_coursePeriod_05=$time,njs_courseAssesMethod_05='$c_method',njs_courseCredit_05=$credit where njs_courseNo_05='$id'";
    $query = mysqli_query($link,$sql);
    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('修改数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }

    echo "<script> alert('修改成功'); </script>";
    echo "<meta http-equiv='Refresh' content='0;URL=../admin/course_info.php'>";

}

if($_SERVER['REQUEST_METHOD']==='POST'){
    update_course();
}
elseif($_SERVER['REQUEST_METHOD']==='GET'){
    get_id();
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="container edit">
    <h4 class="alert alert-primary text-center">修改课程信息</h4>
    <form method="post" action="course_update.php">
        <div class="form-group row">
            <label  class="col-sm-2 control-label">课程编号</label>
            <div class="col-sm-10">
                <input class="form-control" readonly="readonly" type="text" id="course_id" name="course_id" value="<?php echo $user['njs_courseNo_05']; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 control-label">课程名称</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="course_name" name="course_name" value="<?php echo $user['njs_courseName_05']; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 control-label">授课教师</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="course_tea" name="course_tea" value="<?php echo $user['njs_teacherName_05']; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 control-label">开设学期</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="course_term" name="course_term" value="<?php echo $user['njs_courseOpenSemester_05']; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 control-label">学时</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="course_time" name="course_time" value="<?php echo $user['njs_coursePeriod_05']; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 control-label">考核方式</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="course_method" name="course_method" value="<?php echo $user['njs_courseAssesMethod_05']; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 control-label">学分</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="course_credit" name="course_credit" value="<?php echo $user['njs_courseCredit_05']; ?>"/>
            </div>
        </div>
        <input type="text" style="display: none" name="db_table" value="nongjs_course_05">
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-block">保存</button>
        </div>
    </form>
</div>