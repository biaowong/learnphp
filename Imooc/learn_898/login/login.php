<!DOCTYPE html>
<html>
<head>
    <title>登录页面</title>
</head>
<body>
    <h1>登录页面</h1>
    <?php echo md5('king'); ?>
    <form method="post" action="doLogin.php">
        <lable>用户名：</lable><input type="text" name="username" id="username">
        <lable>密&nbsp;&nbsp;码：</lable><input type="password" name="password" id="password">
        <input type="checkbox" name="autoLogin" id="autoLogin" value="1">
        <button type="submit">立即登录</button>
    </form>

</body>
</html>
