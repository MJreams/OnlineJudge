<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<!--删除登陆日志 by wwx -->
<b>Delete loginlog</b>
<form action="del_loginlog.php" method="post">
    Num:<input type="text" name="num"  />
    <input type="submit" value="Delete"/>
</form>
<p>如：201458503217</p>
<form action="del_loginlog2.php" method="post" id="fm" >
    Class:<input type="text"   name="class" id="del" />
    <input type="submit"id="delbutton" value="Delete"/>
</form>
<p>如：2014585032(8位以上)</p>
<script type="text/javascript">
    $('#fm :input[type=submit]').attr("disabled", true);
    $('#del').bind("change keydown input propertychange",function () {

        var len = $(this).val().length;
        if(len>=8)
            $('#fm :input[type=submit]').removeAttr("disabled");
        else
            $('#fm :input[type=submit]').attr("disabled", true);
    });

</script>

</br><a class='btn btn-primary' href="writeIP.php" target="main"><b><?php echo "限定IP段-aaa"?></b></a>
<br/>
<br/>
<a class='btn btn-primar' href="new_delete_all_session.php" target="main"><b>删除当前时间之前的session</b></a>
<form action="new_delete_all_session.php" method="post">
    删除该时间之前的session: <input type="date" id="date" name="date"> <input type="time" id="time" name="time">
    提交: <input type="submit">
</form>

</body>
</html>

