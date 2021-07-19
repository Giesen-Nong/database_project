<?php
//插入连接数据库的相关信息
require_once 'connectvars.php';
//开启一个会话
session_start();
$error_msg = "";
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['username'])){
    if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $user_username = mysqli_real_escape_string($dbc,trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));

        if(!empty($user_username)&&!empty($user_password)){
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query = "SELECT njs_UserNo_05,njs_UserLevel_05 FROM nongjs_user_05 WHERE njs_UserNo_05 = '$user_username' AND "."njs_UserPassword_05 = '$user_password'";
            //用用户名和密码进行查询
            $data = mysqli_query($dbc,$query);
            //若查到的记录正好为一条，则设置SESSION，同时进行页面重定向
            if(mysqli_num_rows($data)==1){
                $row = mysqli_fetch_array($data);
                $_SESSION['username']=$row['njs_UserNo_05'];
                $_SESSION['permissions'] =$row['njs_UserLevel_05'];
                if($_SESSION['permissions']==2){
                    $home_url = 'students_admin';
                    header('Location: '.$home_url);
                }
                elseif ($_SESSION['permissions']==1){
                    $home_url = 'teacher_admin';
                    header('Location: '.$home_url);
                }
                else{
                    $home_url = 'index.php';
                    header('Location: '.$home_url);
                }
            }else{//若查到的记录不对，则设置错误信息
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
    }
}else{//如果用户已经登录，则直接跳转到已经登录页面
    if($_SESSION['permissions']==2){
        $home_url = 'students_admin';
        header('Location: '.$home_url);
    }
    elseif ($_SESSION['permissions']==1){
        $home_url = 'teacher_admin.php';
        header('Location: '.$home_url);
    }
    else{
        $home_url = 'admin';
        header('Location: '.$home_url);
    }
}
?>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <meta name="keywords" content="Flat Dark Web Login Form Responsive Templates, Iphone Widget Template, Smartphone login forms,Login form, Widget Template, Responsive Templates, a Ipad 404 Templates, Flat Responsive Templates" />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <!--webfonts-->
    <link href='http://fonts.useso.com/css?family=PT+Sans:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.useso.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
    <!--//webfonts-->
    <script src="http://ajax.useso.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<script>$(document).ready(function(c) {
        $('.close').on('click', function(c){
            $('.login-form').fadeOut('slow', function(c){
                $('.login-form').remove();
            });
        });
    });
</script>
<!--SIGN UP-->
<h1>学生成绩查询系统</h1>
<!--通过$_SESSION['user_id']进行判断，如果用户未登录，则显示登录表单，让用户输入用户名和密码-->
    <!-- $_SERVER['PHP_SELF']代表用户提交表单时，调用自身php文件 -->
    <div class="login-form">
        <div class="close"> </div>
        <div class="head-info">
            <label class="lbl-1"> </label>
            <label class="lbl-2"> </label>
            <label class="lbl-3"> </label>
        </div>
        <div class="clear"> </div>
        <div class="avtar">
            <img src="images/avtar.png" />
        </div>
        <?php
        if(!isset($_SESSION['user_id'])){
            echo '<p class="error">'.$error_msg.'</p>';
            ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <input name="username" type="text" class="text" value="<?php if(!empty($user_username)) echo $user_username; ?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}" >
            <div class="key">
                <input name="password" type="password" value="PASSWORD" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
            </div>

            <div class="signin">
                <input name="submit" type="submit" value="Login" >
            </div>
        </form>
    <?php
}
?>
</body>
</html>