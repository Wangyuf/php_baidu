<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>百度模拟登录</title>
</head>
<body>
    <form action="<?php echo U('Login/index');?>" method="post">
        name:<input type="text" name="username" value='xiaogangshagua'/><br />
        password:<input type="password" name="password" value='hadoop123'/><br />
        <input type="submit" value="登录">
    </form>
    <a href='<?php echo U('Login/testLogin');?>'>测试登录是否成功</a>
</body>
</html>