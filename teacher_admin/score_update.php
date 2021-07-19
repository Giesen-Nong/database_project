<?php
require_once '../connectvars.php';
session_start();
$id = $_GET['id'];
$score = $_GET['score'];
$c_name = $_GET['c_name'];
function update_user(){
    $id = $_POST['id'];
    $score = $_POST['score'];
    $c_name = $_POST['c_name'];

    $db_table = $_POST['db_table'];
    $link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($link,"set names 'utf8';");
    $sql = mysqli_query($link,"select njs_courseNo_05 from nongjs_course_05 where njs_courseName_05 = '$c_name';");
    $row = mysqli_fetch_assoc($sql);
    $c_no = $row['njs_courseNo_05'];
    if(!$link){
        echo "<script>alert('数据库连接失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }
    $sql = "UPDATE `$db_table` SET njs_reportScore_05='$score' where njs_studentNo_05='$id' and njs_courseNo_05='$c_no'";
    $query = mysqli_query($link,$sql);
    if (!$query) {
        echo "<script>alert('请输入有效信息!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
    }
    $affected = mysqli_affected_rows($link);
    if($affected!==1){
        echo "<script>alert('修改数据失败!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

    }

    echo "<script>alert('修改成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";

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
    <form method="post" action="score_update.php">
        <div class="form-group row">
            <label  class="col-sm-2 control-label">学号</label>
            <div class="col-sm-10">
                <input class="form-control" readonly="readonly" type="text" id="id" name="id" value="<?php echo $id; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 control-label">分数</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="score" name="score" value="<?php echo $score; ?>"/>
            </div>
        </div>
        <input type="text" style="display: none" name="c_name" value="<?php echo $c_name; ?>">
        <input type="text" style="display: none" name="db_table" value="nongjs_report_05">
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-block">保存</button>
        </div>
    </form>
</div>