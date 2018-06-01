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
