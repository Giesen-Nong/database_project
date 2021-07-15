<?php
//使用会话内存储的变量值之前必须先开启会话
session_start();
//使用一个会话变量检查登录状态
if(isset($_SESSION['username']) and $_SESSION['permissions']==1){
    echo 'You are Logged as '.$_SESSION['username'].'<br/>';
    //点击“Log Out”,则转到logOut页面进行注销
    echo '<a href="logOut.php"> Log Out('.$_SESSION['username'].')</a>';
}
else{
    echo "<script> alert('权限不足'); </script>";
    echo "<meta http-equiv='Refresh' content='0;URL=index.php'>";
}
/**在已登录页面中，可以利用用户的session如$_SESSION['username']、
 * $_SESSION['user_id']对数据库进行查询，可以做好多好多事情*/
?>