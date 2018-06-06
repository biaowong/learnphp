<?php
function readDirectory($path)
{
    $arr = array();
    // 打开指定目录
    $handle = opendir($path);
    // 读目录
    while (($item = readdir($handle)) !== false) {

        // .和..特殊目录
        if ($item!='.' && $item!='..') {

            if (is_file($path.'/'.$item)) {
                $arr['file'][] = $item;
            }

            if (is_dir($path.'/'.$item)) {
                $arr['dir'][] = $item;
            }
        }
    }
    // 关闭目录句柄
    closedir($handle);

    return $arr;
}

/**
 * 获取文件夹的大小
 */
function dirSize($path)
{
    $sum = 0;
    // global $sum;
    // 打开指定目录
    $handle = opendir($path);
    // 读目录
    while (($item = readdir($handle)) !== false) {

        // .和..特殊目录
        if ($item!='.' && $item!='..') {

            if (is_file($path.'/'.$item)) {
                $sum += filesize($path.'/'.$item);
            }

            if (is_dir($path.'/'.$item)) {
               $func = __FUNCTION__;
               $sum += $func($path.'/'.$item);
            }
        }
    }
    // 关闭目录句柄
    closedir($handle);

    return $sum;
}

function copyFolder($src, $dst)
{
    if (!file_exists($dst)) {
        mkdir($dst, 0777, true);
    }

    $handle = opendir($src);
    // 读目录
    while (($item = readdir($handle)) !== false) {

        // .和..特殊目录
        if ($item!='.' && $item!='..') {

            if (is_file($src.'/'.$item)) {
                copy($src.'/'.$item, $dst.'/'.$item);
            }

            if (is_dir($src.'/'.$item)) {
               $func = __FUNCTION__;
               $func($src.'/'.$item, $dst.'/'.$item);
            }
        }
    }
    // 关闭目录句柄
    closedir($handle);

    return '复制成功';
}

/**
 * 文件夹重命名
 * @param  string $oldname 原名称
 * @param  string $newname 新名称
 * @return string          提示文字
 */
function renameFolder($oldname, $newname)
{
    // 检测文件夹名称合法性
    if (checkFilename(basename($newname))) {

        if (!file_exists($newname)) {

            if (rename($oldname, $newname)) {
                $mes = '重命名成功';
            }
            else {
                $mes = '重命名失败';
            }
        }
        else {
            $mes = '存在同名文件夹';
        }
    }
    else {
        $mes = '非法文件夹名称';
    }

    return $mes;
}

/**
 * 剪切文件夹
 * @param  string $src 原路径
 * @param  string $dst 目标路径
 * @return string      状态说明
 */
function cutFolder($src, $dst)
{
    if (file_exists($dst)) {

        if (is_dir($dst)) {

            if (!file_exists($dst.'/'.basename($src))) {

                if (rename($src, $dst.'/'.basename($src))) {
                    $mes = '剪切成功';
                }
                else {
                    $mes = '剪切失败';
                }
            }
            else {
                $mes = '存在同名文件夹';
            }
        }
        else {
            $mes = '不是一个文件夹';
        }
    }
    else {
        $mes = '目标文件夹不存在';
    }

    return $mes;
}

/**
 * 删除文件夹
 * @param  string $path 路径
 * @return string       状态说明
 */
function delFolder($path)
{
    $handle = opendir($path);
    while (($item = readdir($handle)) !== false) {
        if ($item!='.' && $item!='..') {
            if (is_file($path.'/'.$item)) {
                unlink($path.'/'.$item);
            }
            if (is_dir($path.'/'.$item)) {
                $func = __FUNCTION__;
                $func($path.'/'.$item);
            }
        }
    }
    closedir($handle);
    rmdir($path);
    return '文件夹删除成功';
}
