<?php
/**
 * 转换字节大小
 * @param  int      $size   字节大小
 * @return string           数值+单位
 */
function transByte($size)
{
    // Bytes/Kb/Mb/Gb/Tb/Eb
    $arr = array('B', 'KB', 'MB', 'GB', 'TB', 'EB');
    $i = 0;
    while ($size >= 1024) {
        $size /= 1024;
        $i++;
    }
    return round($size, 2).$arr[$i];
}

function createFile($filename)
{
    // 验证文件名合法性
    // 是否包含 /,*,<>,?|
    $pattern = "/[\/,\*,<>,\?\|]/";
    if (!preg_match($pattern, basename($filename))) {

        // 当前文件夹是否存在同名文件
        if (!file_exists($filename)) {
            // 通过touch($filename)来创建
            if (touch($filename)) {
                return '创建成功';
            }
            else {
                return '创建失败';
            }
        }
        else {
            return '文件已存在，请重命名后创建';
        }
    }
    else {
        return '非法文件名';
    }

}

function renameFile($oldname, $newname)
{
    // 验证文件名合法性
    if (checkFilename($newname)) {

        $path = dirname($oldname);
        if (!file_exists($path.'/'.$newname)) {
            if (rename($oldname, $path.'/'.$newname)) {
                return '重命名成功';
            }
            else {
                return '重命名失败';
            }
        }
        else {
            return '存在同名文件，请重重新命名';
        }
    }
    else {
        return '非法文件名';
    }
}

// 检查文件名是否合法
function checkFilename($filename)
{
    $pattern = "/[\/,\*,<>,\?\|]/";
    if (preg_match($pattern, $filename)) {
        return false;
    }
    else {
        return true;
    }
}

/**
 * 删除文件
 */
function delFile($filename)
{
    if (unlink($filename)) {
        $mes = '文件删除成功';
    }
    else {
        $mes = '文件删除失败';
    }

    return $mes;
}

/**
 * 下载文件
 */
function downFile($filename)
{
    header('content-disposition:attachment;filename='.basename($filename));
    header('content-length:'.filesize($filename));
    readfile($filename);
}

function copyFile($filename, $dstname)
{
    if (file_exists($dstname)) {

        if (!file_exists($dstname.'/'.basename($filename))) {

            if (copy($filename, $dstname.'/'.basename($filename))) {
                $mes = '文件复制成功';
            }
            else {
                $mes = '文件复制失败';
            }
        }
        else {
            $mes = '存在同名文件';
        }
    }
    else {
        $mes = '目标目录不存在';
    }

    return $mes;
}

function cutFile($filename, $dstname)
{
    if (file_exists($dstname)) {

        if (!file_exists($dstname.'/'.basename($filename))) {

            if (rename($filename, $dstname.'/'.basename($filename))) {
                $mes = '文件剪切成功';
            }
            else {
                $mes = '文件剪切失败';
            }
        }
        else {
            $mes = '存在同名文件';
        }
    }
    else {
        $mes = '目标目录不存在';
    }

    return $mes;
}

function uploadFile($fileInfo, $path, $allwoExt = array('jpeg', 'jif', 'jpg', 'png', 'txt'), $maxSize=1048760)
{
    if ($fileInfo['error'] == UPLOAD_ERR_OK) {

        // 文件是否通过http post方式上传的
        if (is_uploaded_file($fileInfo['tmp_name'])) {
            // 上传文件的文件名，只允许上传jpeg, jpg, gif , txt
            ;
            $ext = getExt($fileInfo['name']);
            $uniqid = getUniqidName();
            $destination = $path.'/'.pathinfo($fileInfo['name'], PATHINFO_FILENAME).'_'.$uniqid.'.'.$ext;

            if (in_array($ext, $allwoExt)) {

                if ($fileInfo['size'] <= $maxSize) {
                    if (move_uploaded_file($fileInfo['tmp_name'], $destination)) {
                        $mes = '文件上传成功';
                    }
                    else {
                        $mes = '文件上传失败';
                    }
                }
            }
        }
        else {
            $mes = '文件不是通过HTTP POST方式上传的';
        }
    }
    else {
        switch ($fileInfo['error']) {
            case 1:
                $mes = '超过了配置文件的大小';
                break;
            case 2:
                $mes = '超过了表单允许接收数据的大小';
                break;
            case 3:
                $mes = '文件部分被上传';
                break;
            case 4:
                $mes = '没有文件被上传';
                break;
            default:
                $mes = '其他错误';
                break;
        }
    }

    return $mes;
}
