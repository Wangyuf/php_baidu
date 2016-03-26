<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>百度模拟登录</title>
</head>
<body>
    <form action="<?php echo U('Login/testLogin');?>" method="post">
        name:<input type="text" name="username" value='xiaogangshagua'/><br />
        <input type="submit" value="测试">
    </form>
    <a href='<?php echo U('Login/index');?>'>登录</a>
</body>
</html>