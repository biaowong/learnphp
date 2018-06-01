<?php
$string = 'abcdefghigklmnopqrstuvwxyz';
$code = '';
for ($i=1; $i<=4; $i++) {
    $code .= '<span style="color:rgb('.mt_rand(0, 255).','.mt_rand(0, 255).','.mt_rand(0, 255).')">'.$string{mt_rand(0, strlen($string)-1)}.'<span>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册页面</title>
</head>
<body>
    <h1>注册页面</h1>
    <form method="post" action="doAction.php">
        <table border="1" cellpadding="0" cellspacing="0" bgcolor="#ABCDE" width="80%">
            <tr>
                <td align="right">用户名</td>
                <td><input type="text" name="username" id="" placeholder="请输入合法用户名...">用户名首字母以字母开始，并且长度6-10</td>
            </tr>
            <tr>
                <td align="right">密码</td>
                <td><input type="password" name="password" id="" placeholder="请输入密码...">密码不能为空，长度6-10</td>
            </tr>
            <tr>
                <td align="right">确认密码</td>
                <td><input type="password" name="password1" id="" placeholder="请输入确认密码..."></td>
            </tr>
            <tr>
                <td align="right">邮箱</td>
                <td><input type="text" name="email" id="" placeholder="请输入邮箱...">邮箱必须包含@</td>
            </tr>
            <tr>
                <td align="right">兴趣爱好</td>
                <td>
                    <input type="checkbox" name="fav[]" id="" value="php">PHP
                    <input type="checkbox" name="fav[]" id="" value="java">JAVA
                    <input type="checkbox" name="fav[]" id="" value="ios">iOS
                    <input type="checkbox" name="fav[]" id="" value="c">C语言
                    <input type="checkbox" name="fav[]" id="" value="c++">C++ <br/>
                    <input type="checkbox" name="fav[]" id="" value="swift">Swift
                    <input type="checkbox" name="fav[]" id="" value="meteor">Meteor
                    <input type="checkbox" name="fav[]" id="" value="node.js">NodeJS
                    <input type="checkbox" name="fav[]" id="" value="ionic">Ionic
                </td>
            </tr>
            <tr>
                <td align="right">验证码</td>
                <td>
                    <input type="text" name="verify"><?php echo $code; ?>
                    <input type="hidden" name="verify1" value="<?php echo strip_tags($code); ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="" value="注册"></td>
            </tr>
        </table>
    </form>
</body>
</html>
