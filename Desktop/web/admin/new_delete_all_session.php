<?php
// Update By ljn 2018.4.19

//session保存的路径
$session_save_path ="/var/lib/php/sessions";

//查找 管理员用户的session_id ,避免管理员下线
session_start();
$admin_session =  "sess_".session_id();

//获取需要注销 data-time 之前的session
if (!empty($_POST['date'])&&!empty($_POST['time'])){
    //如果指定删除的日期
    $date =  $_POST['date'];
    $time = $_POST['time'];
    $date_time = $date." ".$time;
    $delete_time = strtotime($date_time);
}else if(empty($_POST['date'])&&empty($_POST['time'])){
    //如果删除当前时间之前的所有日期
    $delete_time =  strtotime('now');
}else{
    echo "<script>alert('输入日期有错误')</script>";
    exit();
}

delFileUnderDir($session_save_path,$admin_session,$delete_time);

function delFileUnderDir( $dirName ,$admin_session,$now ){
    /*
     * desc:session为文件形式，删除了session文件，即可完成下线功能
     * $dirName: session保存的路径
     * $admin_session: 管理员的session_id
     * $now = 需要删除now之前的session
     */
    if ( $handle = opendir( "$dirName" ) ) {
        while ( false !== ( $item = readdir( $handle ) ) ) {
            if ( $item != "." && $item != ".."&&$item!=$admin_session && filectime("$dirName/$item") < $now) {
                if ( is_dir( "$dirName/$item" ) ) {
                    //delFileUnderDir( "$dirName/$item" );
                } else {
                    if( unlink( "$dirName/$item" ) )echo " $item 下线成功\n";
                }
            }
        }
        closedir( $handle );
    }
}

