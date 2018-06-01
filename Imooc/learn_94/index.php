<?php
require_once 'dir.func.php';
require_once 'file.func.php';
require_once 'common.func.php';

$path = 'file';
$path = @$_REQUEST['path']?$_REQUEST['path']:$path;
$act = @$_REQUEST['act'];
$filename = @$_REQUEST['filename'];
$info = readDirectory($path);
$redirect = "index.php?path={$path}";

if ($act == 'createFile') {
    // 创建文件
    $mes = createFile($path.'/'.$filename);
    alertMes($mes, $redirect);
}
elseif ($act == 'showContent') {
    // 查看文件内容
    $content = file_get_contents($filename);
    if (strlen($content)>0) {

        // echo "<textarea>{$content}</textarea>";
        // 高亮显示字符串中的PHP代码
        $newContent = highlight_string($content, true);
        // 高亮显示文件中的PHP代码
        // highlight_file($content);
        $str = <<<EOF
        <table width="80%" cellpadding="5" cellspacing="0" bgcolor="pink" align="center">
            <tr>
                <td>
                    {$newContent}
                </td>
            </tr>
        </table>
EOF;
        echo $str;
    }
    else {
        alertMes('文件没有内容，请编辑再查看！', $redirect);
    }
}
elseif ($act == 'editContent') {
    $content = file_get_contents($filename);
    $str = <<<EOF
    <form action='index.php?act=doEdit' method='post'>
        <textarea name='content' col='190' rows='10'>{$content}</textarea>
        <input type='hidden' name='filename' value='{$filename}'>
        <input type='submit' value='修改文件内容'>
    </form>
EOF;
    echo $str;
}
elseif ($act == 'doEdit') {
    // 修复文件内容
    $content = $_REQUEST['content'];
    if (file_put_contents($filename, $content)) {
        $mes = "文件修改成功";
    }
    else {
        $mes = '文件修改失败';
    }
    alertMes($mes, $redirect);
}
elseif ($act == 'renameFile') {
    // 重命名
    $str = <<<EOF
    <form action='index.php?act=doRename' method='post'>
        请填写新文件名：<input type='text' name='newname' placeholder='请填写新文件名'>
        <input type='hidden' name='filename' value="{$filename}">
        <input type='submit' value="重命名">
    </form>
EOF;
    echo $str;
}
elseif ($act == 'doRename') {
    // 重命名操作
    $newname = @$_REQUEST['newname'];
    $mes = renameFile($filename, $newname);
    alertMes($mes, $redirect);
}
else {

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>在线文件管理器</title>
    <link rel="stylesheet" type="text/css" href="cikonss.css">
    <link rel="stylesheet" href="jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css"  type="text/css"/>
    <style type="text/css">
        body,p,div,ul,ol,table,dl,dd,dt{
            margin:0;
            padding: 0;
        }
        a{
            text-decoration: none;
        }
        ul,li{
            list-style: none;
            float: left;
        }
        #top{
            width:100%;
            height:48px;
            margin:0 auto;
            background: #E2E2E2;
        }
        #navi a{
            display: block;
            width:48px;
            height: 48px;
        }
        #main{
            margin:0 auto;
            border:2px solid #ABCDEF;
        }
        .small{
            width:25px;
            height:25px;
            border:0;
    }
    </style>
</head>
<body>
<div id="showDetail" style="display: none;"><img src="" id="showImg"></div>
<h1>在线文件管理器</h1>
<div id="top">
    <ul id="navi">
        <li><a href="index.php" title="主目录"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-home"></span></span></a></li>
        <li><a href="#"  onclick="show('createFile')" title="新建文件" ><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-file"></span></span></a></li>
        <li><a href="#"  onclick="show('createFolder')" title="新建文件夹"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-folder"></span></span></a></li>
        <li><a href="#" onclick="show('uploadFile')"title="上传文件"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-upload"></span></span></a></li>
        <?php
        $back=($path=="file")?"file":dirname($path);
        ?>
        <li><a href="#" title="返回上级目录" onclick="goBack('<?php echo $back;?>')"><span style="margin-left: 8px; margin-top: 0px; top: 4px;" class="icon icon-small icon-square"><span class="icon-arrowLeft"></span></span></a></li>
    </ul>
</div>
<form action="index.php" method="post" enctype="multipart/form-data">
<table width="100%" border="1" cellpadding="5" cellspacing="0" bgcolor="#ABCDEF" align="center">
    <tr id="createFolder" style="display: none;">
        <td>请输入文件夹名称</td>
        <td>
            <input type="text" name="dirname">
            <input type="hidden" name="act" value="createFolder">
            <input type="submit" value="创建文件夹">
        </td>
    </tr>
    <tr id="createFile" style="display: none;">
        <td>请输入文件名称</td>
        <td>
            <input type="text" name="filename">
            <input type="hidden" name="path" value="<?php echo $path; ?>">
            <input type="hidden" name="act" value="createFile">
            <input type="submit" value="创建文件">
        </td>
    </tr>
    <tr id="uploadFile" style="display: none;">
        <td><input type="file" name="myFile">
            <input type="submit" name='act' value="上传文件">
        </td>
    </tr>
    <tr>
        <td>编号</td>
        <td>名称</td>
        <td>类型</td>
        <td>大小</td>
        <td>可读</td>
        <td>可写</td>
        <td>可执行</td>
        <td>创建时间</td>
        <td>修改时间</td>
        <td>访问时间</td>
        <td>操作</td>
    </tr>
<?php
if ($info['file']) {
    $i = 1;
    foreach ($info['file'] as $val) {
        $p = $path.'/'.$val;
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $val; ?></td>
        <td><?php $src=filetype($p) == 'file' ? 'file_ico.png' : 'folder_ioc.pnd'; ?><img src="images/<?php echo $src; ?>" alt="" title="类型"></td>
        <td><?php echo transByte(filesize($p)); ?></td>
        <td><?php $src = is_readable($p) ? 'correct_ico.png' : 'error_ico.png'; ?><img src="images/<?php echo $src; ?>" alt="" title=""></td>
        <td><?php $src = is_writable($p) ? 'correct_ico.png' : 'error_ico.png'; ?><img src="images/<?php echo $src; ?>" alt="" title=""></td>
        <td><?php $src = is_executable($p) ? 'correct_ico.png' : 'error_ico.png'; ?><img src="images/<?php echo $src; ?>" alt="" title=""></td>
        <td><?php echo date('Y-m-d H:i:s', filectime($p)); ?></td>
        <td><?php echo date('Y-m-d H:i:s', filemtime($p)); ?></td>
        <td><?php echo date('Y-m-d H:i:s', fileatime($p)); ?></td>
        <td>
        <?php
        $extArr = explode('.', $val);
        $ext = strtolower(end($extArr));
        $imageExt = array('gif', 'jpg', 'jpeg', 'png');
        if (in_array($ext, $imageExt)) {
        ?>
            <a href="#"  onclick="showDetail('<?php echo $val;?>','<?php echo $p;?>')"><img class="small" src="images/show_ico.png"  alt="" title="查看"/></a>|
        <?php
        }
        else {
        ?>
            <a href="index.php?act=showContent&path=<?php echo $path;?>&filename=<?php echo $p; ?>"><img src="images/show_ico.png" title="查看"></a>
        <?php
        }
        ?>
            <a href="index.php?act=editContent&path=<?php echo $path;?>&filename=<?php echo $p; ?>"><img src="images/edit_ico.png" title="编辑"></a>
            <a href="index.php?act=renameFile&path=<?php echo $path;?>&filename=<?php echo $p; ?>"><img src="images/rename_ico.png" title="重命名"></a>
            <a href="index.php?act=copyFile&path=<?php echo $path;?>&filename=<?php echo $p; ?>"><img src="images/copy_ico.png" title="复制"></a>
            <a href="index.php?act=moveFile&path=<?php echo $path;?>&filename=<?php echo $p; ?>"><img src="images/move_ico.png" title="移动"></a>
            <a href="index.php?act=delFile&path=<?php echo $path;?>&filename=<?php echo $p; ?>"><img src="images/del_ico.png" title="删除"></a>
            <a href="index.php?act=downFile&path=<?php echo $path;?>&filename=<?php echo $p; ?>"><img src="images/download_ico.png" title="下载"></a>
        </td>
    </tr>
<?php
        $i++;
    }
}
?>
</table>
</form>
<script src="jquery-ui/js/jquery-1.10.2.js"></script>
<script src="jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript">
    function show(dis) {
        document.getElementById(dis).style.display = "block";
    }

    function delFile(path, filename) {
        if (window.confirm('您确定要删除吗？删除之后无法恢复。')) {
            location.href = 'index.php?act=delFile&path='+path+'&filename='+filename;
        }
    }

    function showDetail(title, filename) {
        $('#showImg').attr('src', filename);
        $('#showDetail').dialog({
            height: "auto",
            width: "auto",
            position: {my: "center", at: "center",  collision:"fit"},
            modal: false,    // 是否模式对话框
            draggable: true, // 是否允许拖拽
            resizable: true, // 是否允许拖动
            title: title,    // 对话框标题
            show: "slide",
            hide: "explode"
        });
    }
</script>
</body>
</html>
