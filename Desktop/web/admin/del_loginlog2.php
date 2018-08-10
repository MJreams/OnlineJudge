<head>
    <meta charset="utf-8"/>
</head>
<?php
$clas = $_POST['class'];
$host = '127.0.0.1';
$user = 'root';
//////
///modified by wwx on 2018/8/10
//////
$pass = 'hustoj1234@';
$database = 'jol';
$link = new mysqli($host, $user, $pass, $database);
//$sql = "delete from loginlog where time >Now()-CURTIME() and LEFT(user_id,10)='{$clas}'";
$sql = "delete from loginlog where time and LEFT(user_id,10)='{$clas}'";
if($clas!=null)
    $delsucc  =  mysqli_query($link, $sql);
if($delsucc>0)
{
    echo '<script>alert("Delete Success！");</script>';
}
$link->close();
