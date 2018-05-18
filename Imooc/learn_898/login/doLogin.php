<?php
$username = $_POST['username'];
$password = md5($_POST['password']);
$autoLogin = $_POST['autoLogin'];

$link = mysqli_connect('localhost', 'root', 'root', '') or die('Connect Error!');
mysqli_set_charset($link, 'utf8');
mysqli_select_db($link, 'test') or die('Database Open Error!');
$username = mysqli_escape_string($link, $username);
$password = mysqli_escape_string($link, $password);
$sql = "SELECT id, username, password FROM user WHERE username='{$username}' && password='{$password}'";
// $sql = mysqli_escape_string($link, $sql);
$result = mysqli_query($link, $sql);
if ($result && mysqli_num_rows($result) == 1) {

    if ($autoLogin == 1) {
        $row = mysqli_fetch_assoc($result);
        setcookie('username', $username, strtotime('+7 days'));
        $salt = 'king';
        $auth = md5($username.$password.$salt).":".$row['id'];
        setcookie('auth', $auth, strtotime('+7 days'));
    }
    else {
        setcookie('username', $username);
    }
    exit("<script>alert('登录成功');location.href='home.php';</script>");
}
else {
    exit("<script>alert('登录失败');location.href='login.php';</script>");
}
