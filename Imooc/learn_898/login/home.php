<?php
    if (!isset($_COOKIE['username']) || !isset($_COOKIE['auth'])) {
        exit("<script>alert('请您先登录之后再访问');login.href='login.php';</script>");
    }
    // 校验用户登录凭证
    $auth = $_COOKIE['auth'];
    $resArr = explode(':', $auth);
    $userId = end($resArr);
    $link = mysqli_connect('localhost', 'root', 'root', '') or die('Connect Error!');
    mysqli_set_charset($link, 'utf8');
    mysqli_select_db($link, 'test') or die('Database Open Error!');
    $sql = "SELECT id, username, password FROM user WhERE id='{$userId}'";
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $password = $row['password'];
        $salt = 'king';
        $authStr = md5($username.$password.$salt);
        if ($authStr != $resArr[0]) {
            exit("<script>alert('请您先登录之后再访问');login.href='login.php';</script>");
        }

    }
    else {
        exit("<script>alert('请您先登录之后再访问');login.href='login.php';</script>");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>首页</title>
</head>
<body>
    <h1>测试首页</h1>
    <p>欢迎您，<?php echo $_COOKIE['username']; ?>登录！</p>
    <ul>
        <li>首页</li>
        <li>技术</li>
        <li>关于我们</li>
    </ul>
</body>
</html>
