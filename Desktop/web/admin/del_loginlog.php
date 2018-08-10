
<head>
    <meta charset="utf-8"/>
</head>
<?php
$num = $_POST['num'];
$host = '127.0.0.1';
$user = 'root';
/////
//// by wwx on 2018/8/10
/////
$pass = 'hustoj1234@';
$database = 'jol';
$link = new mysqli($host, $user, $pass, $database);
$sql = "delete from loginlog where user_id='{$num}'";
if($num!=null)
    $delsucc  =  mysqli_query($link, $sql);
if($delsucc>0)
{
    echo '<script>alert("Delete Success！");</script>';
}
$link->close();
