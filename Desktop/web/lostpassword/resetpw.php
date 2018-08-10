<?php
include_once("conn.php");

$token = stripslashes(trim($_POST['token']));
$email = stripslashes(trim($_POST['email']));
$userid = stripslashes(trim($_POST['userid']));

$sql = "SELECT user_id,password,getpasstime FROM `users` WHERE email=:email";
$stmt = $db->prepare($sql);
$stmt->execute(array(
    ':email' => $email
));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
    $mt = md5('as'.$row['user_id'] . $row['password'].'kl');
    if ($mt == $token) {
        if (time() - $row['getpasstime'] > 24 * 60 * 60) {
            $msg = '该链接已过期！';
        } else {
            //重置密码...
            $passwd = stripslashes(trim($_POST['passwd1']));

            $sql_update = "UPDATE `users` SET getpasstime=:getpasstime,password=:password WHERE user_id=:user_id AND email=:email";
            $stmt_update = $db->prepare($sql_update);
            $stmt_update->execute(array(
                ':email' => $email,
                ':user_id' => $row['user_id'],
                ':getpasstime' => '11111111',
                ':password'=> pwGen($passwd)
            ));
            $msg = '密码密码重置成功，请使用新密码登录';
        }
    } else {
        $msg = '无效的链接';
    }
} else {
    $msg = '错误的链接！';
}
echo $msg;
?>