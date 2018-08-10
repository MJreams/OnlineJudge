<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ytu-hustoj密码找回"/>
    <meta name="description" content="ytu-hustoj密码找回"/>
    <title>hustoj密码找回</title>
    <link rel="stylesheet" type="text/css" href="./main.css"/>
    <style type="text/css">
        .demo {
            width: 400px;
            margin: 60px auto 0 auto;
            min-height: 250px;
        }

        .demo h3 {
            line-height: 24px;
            text-align: center;
            color: #360;
            font-size: 16px
        }

        .demo p {
            line-height: 30px;
            padding: 4px
        }

        .demo p span {
            margin-left: 6px;
            color: #f30
        }

        .input {
            width: 240px;
            height: 24px;
            padding: 2px;
            line-height: 24px;
            border: 1px solid #999
        }

        .btn {
            position: relative;
            overflow: hidden;
            display: inline-block;
            *display: inline;
            padding: 4px 20px 4px;
            font-size: 16px;
            line-height: 20px;
            *line-height: 22px;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            background-color: #5bb75b;
            border: 1px solid #cccccc;
            border-color: #e6e6e6 #e6e6e6 #bfbfbf;
            border-bottom-color: #b3b3b3;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }
    </style>
    <script type="text/javascript" src="./jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        function getQueryVariable(variable)
        {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                var pair = vars[i].split("=");
                if(pair[0] == variable){return pair[1];}
            }
            return(false);
        }
        $(function () {
            $("#sub_btn").click(function () {
                var passwd2 = $("#passwd2").val();
                var passwd1 = $("#passwd1").val();
                var userid = getQueryVariable("userid");
                var email = getQueryVariable("email");
                var token = getQueryVariable("token");
                if (passwd1.length < 4) {
                    $("#pw1").html("密码过短");
                } else {
                    if (!(passwd2 == passwd1)) {
                        $("#pw2").html("两次密码不一致");
                    } else {
                        $("#sub_btn").attr("disabled", "disabled").val('密码修改中...').css("cursor", "default");
                        $.post("resetpw.php", {passwd1: passwd1,userid:userid,email:email,token:token}, function (msg) {
                            $(".demo").html("<h2>" + msg + "</h2>");
                        });
                    }
                }

            });
        })
    </script>
</head>

<body>
<div id="header">

</div>

<div id="main">
    <h1 style="text-align: center;margin-top: 40px;font-size: 40px">
        密码找回
    </h1>
    <div class="demo">
        <!--<p>用户可以通过邮箱找回密码</p>-->
        <p><strong>输入新密码：</strong></p>
        <p><input type="text" class="input" name="passwd1" id="passwd1"><span id="pw1"></span></p>
        <p><strong>确认新密码</strong></p>
        <p><input type="text" class="input" name="passwd2" id="passwd2"><span id="pw2"></span></p>
        <p><input type="button" class="btn" id="sub_btn" value="确 定"></p>
    </div>
</div>

<div id="footer">
</div>
</body>
</html>
