<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>个人注册</title>


    <link rel="stylesheet" type="text/css" href="css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="css/pages-register.css" />
</head>

<body>
	<div class="register py-container ">
		<!--head-->
		<div class="logoArea">
			<a href="/" class="logo"></a>
		</div>
		<!--register-->
		<div class="registerArea">
			<h3>注册新用户<span class="go">我有账号，去<a href="login.html" target="_blank">登陆</a></span></h3>
			<div class="info">
				<form class="sui-form form-horizontal" action="{{ route('doregister') }}" method="POST">
				{{ csrf_field() }}
				@if ($errors->any())
					@foreach($errors->all() as $e)
						<li>{{$e}}</li>
					@endforeach
				@endif
					<div class="control-group">
						<label class="control-label">用户名：</label>
						<div class="controls">
							<input type="text" name="username" placeholder="请输入你的用户名" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">登录密码：</label>
						<div class="controls">
							<input type="password" name="password" placeholder="设置登录密码" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">确认密码：</label>
						<div class="controls">
							<input type="password" name="repassword" placeholder="再次确认密码" class="input-xfat input-xlarge">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">手机号：</label>
						<div class="controls">
							<input type="text" name="mobile" placeholder="请输入你的手机号" class="input-xfat input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="inputPassword" class="control-label">短信验证码：</label>
						<div class="controls">
							<input type="text" name="mobile_code" placeholder="短信验证码" class="input-xfat input-xlarge"> <input id="btn_send" type="button" value="发送验证码">
						</div>
					</div>
					
					<div class="control-group">
						<label for="inputPassword" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<div class="controls">
							<input type="checkbox" value="2" checked="" name="protocol"><span>同意协议并注册《品优购用户协议》</span>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"></label>
						<div class="controls btn-reg">
							<!-- <a class="sui-btn btn-block btn-xlarge btn-danger">完成注册</a> -->
							<input type="submit" class="sui-btn btn-block btn-xlarge btn-danger" value="完成注册">
						</div>
					</div>
				</form>
				<div class="clearfix"></div>
			</div>
		</div>
		<!--foot-->
		<div class="py-container copyright">
			<ul>
				<li>关于我们</li>
				<li>联系我们</li>
				<li>联系客服</li>
				<li>商家入驻</li>
				<li>营销中心</li>
				<li>手机品优购</li>
				<li>销售联盟</li>
				<li>品优购社区</li>
			</ul>
			<div class="address">地址：北京市昌平区建材城西路金燕龙办公楼一层 邮编：100096 电话：400-618-4000 传真：010-82935100</div>
			<div class="beian">京ICP备08001421号京公网安备110108007702
			</div>
		</div>
	</div>


<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/plugins/sui/sui.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-placeholder/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="js/pages/register.js"></script>
<script>
// $("#btn_send").click(function(){
// 		var mobile = $("input[name=mobile]").val();
// 		$.ajax({
// 			type:"GET",
// 			url:"{{ route('ajax-send-modbile-code') }}",
// 			data:{mobile:mobile},
// 			success:function(data){
// 				$("#btn_send").attr('disabled');
// 			}
// 		});
// 	});
var seconds=60;
    var si;  // 保存定时器

    $("#btn_send").click(function(){

        // 获取手机号码
        var mobile = $("input[name=mobile]").val();

        // 执行AJAX发到服务器
        $.ajax({
            type:"GET",     // GET方式
            url:"{{ route('ajax-send-modbile-code') }}",    // AJAX提交的地址
            data:{mobile:mobile},                           // 提交的参数（手机号码）
            success:function(data) {                        // AJAX成功之后执行的代码

                // 设置按钮失效
                $("#btn_send").attr('disabled',true);

                // 每1秒执行一次
                si = setInterval(function(){
                    seconds--;
                    if(seconds==0)
                    {
                        // 生效
                        $("#btn_send").attr('disabled',false);
                        seconds=60;
                        $("#btn_send").val("发送验证码");
                        // 关闭定时器
                        clearInterval( si );
                    }
                    else{
                        $("#btn_send").val("还剩："+(seconds));
                    }
                }, 1000);


            }
        });

    });
    </script>
</body>

</html>