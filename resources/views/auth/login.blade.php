<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>后台登录</title>
    <link rel="stylesheet" type="text/css" href="/static/admin/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/admin/css/login.css" />
</head>

<body>
<div class="m-login-bg">
    <div class="m-login">
        <h3>后台管理系统</h3>
        <div class="m-login-warp">
            <form class="layui-form" method="post" action="{{url('/login')}}">
                {{ csrf_field() }}
                <div class="layui-form-item">
                    <input type="text" value="{{ old('username') }}" name="username" required lay-verify="username" placeholder="用户名" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <input type="password" value="{{ old('password') }}" name="password" required lay-verify="password" placeholder="密码" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <input type="text" name="verity" lay-verify="verity" placeholder="验证码" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-inline">
                        <img class="verifyImg" onclick="this.src=this.src+'?c='+Math.random();" src="{{url('/verify')}}" />
                    </div>
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="layui-form-mid layui-word-aux" style="color: red;">{{ $error }}</div>
                        @endforeach
                    @endif

                </div>
                <div class="layui-form-item m-login-btn">
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="login">登录</button>
                    </div>
                    <div class="layui-inline">
                        <button type="reset" class="layui-btn layui-btn-primary">取消</button>
                    </div>
                </div>
            </form>
        </div>
        <p class="copyright">Copyright 2017-{{date("Y",time())}} by FZS</p>
    </div>
</div>
<script src="/static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
<script>
    layui.use(['form'], function() {
        var form = layui.form(),
            layer = layui.layer;
        form.verify({
            username: [/(.+){2,12}$/, '用户名必须2到12位'],
            password: [/(.+){6,12}$/, '密码必须6到12位'],
            verity: [/(.+){4}$/, '验证码必须是4位'],
        });
    });
</script>
</body>

</html>