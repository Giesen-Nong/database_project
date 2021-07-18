<?php
require_once 'connectvars.php';
session_start();
function update_user(){
    $id = $_SESSION['username'];
    $name = $_POST['password'];
    $level = $_POST['userlevel'];
    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "UPDATE `$db_table` SET njs_UserPassword_05='$name',njs_UserLevel_05=$level where njs_UserNo_05='$id'";
    $query = mysqli_query($link,$sql);
    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('修改数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }

    echo "<script> alert('修改成功'); </script>";
    echo "<meta http-equiv='Refresh' content='0;URL=../logOut.php'>";

}

if($_SERVER['REQUEST_METHOD']==='POST'){
    update_user();
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class="container edit">
    <h4 class="alert alert-primary text-center">修改账户信息</h4>
    <form method="post" action="modify.php">
        <div class="form-group row">
            <label  class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input class="form-control" readonly="readonly" type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input class="form-control" type="password" id="password" name="password" value=""/>
            </div>
        </div>
        <input type="text" style="display: none" name="userlevel" value="1">
        <input type="text" style="display: none" name="db_table" value="nongjs_user_05">
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-block">保存</button>
        </div>
    </form>
</div>