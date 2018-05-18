<?php
header('content-type:text/html;charset=utf-8');
$table = "<table border='1' width=\"80%\">
<tr>
    <td>编号</td>
    <td>用户名</td>
    <td>描述</td>
</tr>
<tr>
    <td>1</td>
    <td>king</td>
    <td>He Said \"I'm Fine \" Thank You</td>
</tr>
</table>";
echo $table;

// heredoc
$username = 'queen';
$desc = 'This is good girl';
$tableEOF = <<<EOF
<table border='1' width="80%">
<tr>
    <td>编号</td>
    <td>用户名</td>
    <td>描述</td>
</tr>
<tr>
    <td>1</td>
    <td>king</td>
    <td>He Said "I'm Fine " Thank You</td>
</tr>
<tr>
    <td>2</td>
    <td>{$username}</td>
    <td>{$desc}</td>
</tr>
</table>
EOF;
echo $tableEOF;

echo <<<EOF
<h1>this is a test</h1>
EOF;
echo '<hr/>';
echo <<<"TEST"
<h2>Hello Imooc</h2>
TEST;

// nowdoc
echo '<hr/>';
$str = <<<'EOD'
    hello king <br/>
    {$username}
    a\nb\rcdef
EOD;
echo $str;
