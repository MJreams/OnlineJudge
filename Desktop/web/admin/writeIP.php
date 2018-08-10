<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="b.css" />
		<title>调整IP</title>
	</head>
<body>
<div class="whole">
	<!--
		禁止的IP
    -->
<div class="leftframe">
	<form method="post" action="writeIP.php" name="IP1">
	禁止的IP:
	<input type="text" size="8" name="f1" value="202.194.119.">
	from
	<input type="text" size="1" name="f2">
	to	
	<input type="text" size="1" name="f3">
	<input type="submit" name="name1" value="开启">	
	<input type="submit" name="name2" size="2" value="删除所有禁止ip">
	<input type="submit" name="name3" size="2" value="显示所有">
    </form>
 <?php 
 error_reporting(0);
 //将IP段写入文件
 $fp=fopen("../ip/forbiden.txt","a+");


 for($j=$_POST['f2'];$j<=$_POST['f3'];$j++)
 {
     /*
      * 写入重复问题，待优化 LJN
      */
     $ip = $_POST['f1'].$j;
 	fwrite($fp,$ip);
    //fwrite($fp,$j);
    fwrite($fp,"\r\n"); 
 }
 fclose($fp);


 if (isset($_POST['f2']) && isset($_POST['f3'])) 
 {
 	 for($i=$_POST['f2'];$i<=$_POST['f3'];$i++)
 	 {
 	 	echo $_POST['f1'];
        echo $i;
        echo "</br>";
     }   
     echo "开启成功!";
 } 
?>

<?php
 if(isset($_POST['name2']))   //左边删除按钮
  {
  	//选择的文件
    $file="../ip/forbiden.txt";
    $k=fopen($file,'w');
    fclose($k);	
  }
  ?>
  
  <?php
 if(isset($_POST['name3']))    //左边显示按钮
  {
  	//选择的文件
    $path="../ip/forbiden.txt";
    $files_read=fopen($path,'r');
    $numOfline=0;
    $fl_data=array();
    while(!feof($files_read))
  {
    $fl_data[$numOfline]=fgets($files_read);
    $numOfline++;
  }
  for($i=1;Si<=$numOfline;$i++)
  {
      echo $fl_data[$i];
      echo "<br />";
  }
  fclose($files_read);
  }     
?>
</div>
<!--
	允许的IP
-->
<div class="rightframe">
	<form method="post" action="writeIP.php" name="IP2">
	 允许的IP:
    <input type="text" size="8" name="f4" value="202.194.119.">
    from
    <input type="text" size="1" name="f5">
    to
    <input type="text" size="1" name="f6">
	<input type="submit" name="submit" value="开启">
	<input type="submit" name="name4" size="2" value="删除">
	<input type="submit" name="name5" size="2" value="显示所有">
	</form>
<?php 
$fp=fopen("../ip/allowed.txt","a+");

for($j=$_POST['f5'];$j<=$_POST['f6'];$j++)
{
    $ip = $_POST['f1'].$j;
  fwrite($fp,$_POST['f4']);
  fwrite($fp,$ip);
  fwrite($fp,"\r\n"); 
}
fclose($fp);
if (isset($_POST['f5']) && isset($_POST['f6'])) 
{ 
 for($i=$_POST['f5'];$i<=$_POST['f6'];$i++)
  {
	  echo $_POST['f4'];
      echo $i;
      echo "</br>";
  }   
  echo "开启成功!";
} 
?>

<?php
 if(isset($_POST['name4']))   //右边删除按钮
  {
  	//选择的文件
    $file="../ip/allowed.txt";
    $k=fopen($file,'w');
    fclose($k);	
  }
?>

<?php
 if(isset($_POST['name5']))   //右边显示按钮
  {
  	//选择的文件
    $path="../ip/allowed.txt";
    $files_read=fopen($path,'r');
    $numOfline=0;
    $fl_data=array();
    while(!feof($files_read))
  {
    $fl_data[$numOfline]=fgets($files_read);
    $numOfline++;
  }
  for($i=1;Si<=$numOfline;$i++)
  {
      echo $fl_data[$i];
      echo "<br />";
  }
  fclose($files_read);
  }     
?>
</div>
</div>	
	</body>
</html>

