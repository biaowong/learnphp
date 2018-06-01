<?php
header('content-type:text/html;charset=utf-8');
// 接收数据
$username  = $_POST['username'];
$password  = $_POST['password'];
$password1 = $_POST['password1'];
$email     = $_POST['email'];
$fav       = $_POST['fav'];
$verify    = $_POST['verify'];
$verify    = trim(strtolower($verify));
$verify1   = $_POST['verify1'];

$redirectUrl = '<a href="reg.php">重新注册</a>';
// 检测用户名合法性
$char = $username{0};
$char = substr($username, 0, 1);
$ascii = ord($char);
// 检测ASCII是否在65-90(A-Z)或97-122(a-z)之间
if (!(($ascii>=65 && $ascii<=90) || ($ascii>=97 && $ascii<=122))) {
    exit('用户名首字母不是以字母开始<br/>'.$redirectUrl);
}
// 检测用户名长度
$userLen = strlen($username);
if ($userLen<6 || $userLen>10) {
    exit('用户名长度不符合规则<br/>'.$redirectUrl);
}

// 检测密码
$pwdLen = strlen($password);
if ($pwdLen == 0) {
    exit('密码不能为空<br/>'.$redirectUrl);
}
if ($pwdLen<6 || $pwdLen>10) {
    exit('密码长度不符合规则<br/>'.$redirectUrl);
}
if ($password !== $password1) {
    exit('两次密码不一致<br/>'.$redirectUrl);
}
if (strcmp($password, $password1) !== 0) {
    exit('两次密码不一致<br/>'.$redirectUrl);
}

// 检测邮箱的合法性
if (strpos($email, '@') == false) {
    exit('非法邮箱<br/>'.$redirectUrl);
}

// 检测验证码是否规范
if ($verify != $verify1) {
    exit('验证码错误<br/>'.$redirectUrl);
}

if (!empty($fav)) {
    $favstr = join(', ', $fav);
}

echo '恭喜您，注册成功，用户信息如下：<br/>';
$userinfo = <<<EOF
<table border='1' cellspacing='0' cellpadding='0' width='80%' bgcolor='#ABDCEF'>
    <tr>
        <td>用户名</td>
        <td>密码</td>
        <td>邮箱</td>
        <td>兴趣爱好</td>
    </tr>
    <tr>
        <td>{$username}</td>
        <td>{$password}</td>
        <td>{$email}</td>
        <td>{$favstr}</td>
    </tr>
</table>
EOF;
echo $userinfo;


