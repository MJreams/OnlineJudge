<?php 
    require_once("./include/db_info.inc.php");	//一些设置类的全局变量
    require_once('./include/setlang.php');

    $vcode="";
    if(isset($_POST['vcode']))	$vcode=trim($_POST['vcode']);
    if($OJ_VCODE&&($vcode!= $_SESSION[$OJ_NAME.'_'."vcode"]||$vcode==""||$vcode==null) ){
		echo "<script language='javascript'>\n";
		echo "alert('Verify Code Wrong!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
    }
    $view_errors="";
	require_once("./include/login-".$OJ_LOGIN_MOD.".php");
    $user_id=$_POST['user_id'];
	$password=$_POST['password'];
   if (get_magic_quotes_gpc ()) {
        $user_id= stripslashes ( $user_id);
        $password= stripslashes ( $password);
   }
    $sql="SELECT `rightstr` FROM `privilege` WHERE `user_id`=?";
    $login=check_login($user_id,$password);
	echo "<script language='javascript'>\n";
    if ($login)
    {
		$_SESSION[$OJ_NAME.'_'.'user_id']=$login;
		$result=pdo_query($sql,$login);
		foreach ($result as $row)
			$_SESSION[$OJ_NAME.'_'.$row['rightstr']]=true;
        require_once("./allow_forbid_ip.php");//关于IP获取，单IP登录的函数by wwx 18/8/9
        //$get_ip = get_IP();		//获取当前ip
        //echo "alert(\"$get_ip\");\n";	//输出当前IP
		//$k = result_ban_IP();//禁止登陆IP的结果
		//echo 'k:';var_dump($k);
		//echo "<br>";

		if($OJ_NEED_LOGIN){
			echo "window.location.href='index.php';\n";
		}

		else {
            echo "history.go(-2);\n";
		}
		echo "</script>";
	}else{
		if($view_errors){
			require("template/".$OJ_TEMPLATE."/error.php");
		}else{	
			echo "<script language='javascript'>\n";
			echo "alert('UserName or Password Wrong!');\n";
			echo "history.go(-1);\n";
			echo "</script>";
		}
	}
?>
