<?php
require_once '../connectvars.php';
$user = [''];
function get_id(){
    $db_table = $_GET['db_table'];
    if (empty($_GET['id'])) {
        echo "<script> alert('必须传入指定参数'); </script>";
        echo "<meta http-equiv='Refresh' content='0;URL=../admin/stu_info.php'>";
    }
    $id = $_GET['id'];
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_query($link, "set names 'utf8';");
    if (!$link) {
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $sql="select * from `$db_table` where njs_studentNo_05 = '$id' limit 1";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        echo "<script> alert('数据查询失败'); </script>";
        echo "<meta http-equiv='Refresh' content='0;URL=../admin/stu_info.php'>";    }
    global $user;
    $user = mysqli_fetch_assoc($query);
    if (!$user) {
        echo "<script> alert('找不到你要编辑的数据'); </script>";
        echo "<meta http-equiv='Refresh' content='0;URL=../admin/stu_info.php'>";    }
}

function update_student(){
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
    $sql = "UPDATE `$db_table` SET njs_studentNo_05='$id',njs_studentName_05='$name',njs_studentSex_05='$sex',
njs_studentAge_05=$age,njs_area_05='$area',njs_studentCredit_05=$credit,njs_classNo_05='$class' where njs_studentNo_05='$id'";
    $query = mysqli_query($link,$sql);
    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('修改数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }

    echo "<script> alert('修改成功'); </script>";
    echo "<meta http-equiv='Refresh' content='0;URL=../admin/stu_info.php'>";

}


if($_SERVER['REQUEST_METHOD']==='POST'){
    update_student();
}
elseif($_SERVER['REQUEST_METHOD']==='GET'){
    get_id();
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="container edit">
    <h4 class="alert alert-primary text-center">修改学生信息</h4>
    <form method="post" action="stu_update.php">
            <div class="form-group row">
                <label  class="col-sm-2 control-label">学号</label>
                <div class="col-sm-10">
                    <input class="form-control" readonly="readonly" type="text" id="user_id" name="user_id" value="<?php echo $user['njs_studentNo_05']; ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="user_name" name="user_name" value="<?php echo $user['njs_studentName_05']; ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-2 control-label">性别</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="user_sex" name="user_sex" value="<?php echo $user['njs_studentSex_05']; ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-2 control-label">年龄</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="user_age" name="user_age" value="<?php echo $user['njs_studentAge_05']; ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-2 control-label">生源地</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="user_area" name="user_area" value="<?php echo $user['njs_area_05']; ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-2 control-label">已修学分</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="user_credit" name="user_credit" value="<?php echo $user['njs_studentCredit_05']; ?>"/>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-2 control-label">班级</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" id="user_class" name="user_class" value="<?php echo $user['njs_classNo_05']; ?>"/>
                </div>
            </div>
            <input type="text" style="display: none" name="db_table" value="nongjs_student_05">
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-block">保存</button>
        </div>
    </form>
</div>