<?php
//读取文件
$file="ip/forbiden.txt";
$result=file($file);
/*
if($result){
    echo "读取文件成功！";
}else{
    echo "读取文件失败！";
}
*/
//获取ip
function get_IP() {
if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
$userip = getenv('HTTP_CLIENT_IP');
} elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
$userip = getenv('HTTP_X_FORWARDED_FOR');
} elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
$userip = getenv('REMOTE_ADDR');
} elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
$userip = $_SERVER['REMOTE_ADDR'];
}
return $userip;
}
//判断ip是不是被禁止
function result_ban_IP() {
    $ip = get_IP();
    //echo "您登陆的IP为：".$ip."<br />";
    $file="ip/forbiden.txt";
    $result=file($file);    //将文件读入数组
    //print_r($result);
    //echo "<br /> 文件读取完毕 <br />";
    $file_num=count($result);
    //echo "<br />";
    //echo "文件行数为：".$file_num."<br />";
    $temp=0;
    for($i=0;$i<$file_num;$i++)
    {
        //var_dump(trim($result[$i]));
        if(trim($result[$i])==$ip)
            $temp=1;
        }
        if($temp==1)
            return true;
        else
            return false;
}
//判断ip是不是允许登陆
function result_allow_IP() {
    $ip = get_IP();
    $file="ip/allowed.txt";
    $result=file($file);    //将文件读入数组
    $file_num=count($result);
    $temp=0;
    for($i=0;$i<$file_num;$i++)
    {
        if(trim($result[$i])==$ip)
            $temp=1;
    }
    if($temp==1)
        return true;
    else
        return false;
}
//判断是否是超级管理员
function is_admin($user)
{
    $sql = "SELECT `rightstr` FROM `privilege` WHERE user_id = '$user' and (rightstr = 'administrator' or rightstr = 'source_browser'  ) ";
    $res = pdo_query($sql);
    if(count($res)>0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

$p = get_IP();   //获取登陆的IP
$k = result_ban_IP();  //禁止的结果
//echo 'k:';var_dump($k);
$m = result_allow_IP();  //允许的结果
//echo 'm:';var_dump($m);
$isadmin = is_admin($user_id);//判断是否是管理员
$nologin = false;
//$nologin = true;
//白名单大于黑名单
if($k == true)
    $nologin = true;
if ($m == true)
    $nologin = false;

if($isadmin){
    echo "alert(\"Good Lucky To You!\");\n";
    header("Location:index.php");die();
}else{
    if ($nologin){
        //echo "<script language='javascript'>\n";
        echo "alert('you are forbiden to view this page!');\n";
        echo "history.go(-1);\n";
        //echo "</script>";

        session_destroy();
    }else{
        echo "alert(\"Good Lucky To You!\");\n";
        header("Location:index.php");
    }
}
/*
 * changed by lxg and wwx
 * 2018.08.09
 */

?>
