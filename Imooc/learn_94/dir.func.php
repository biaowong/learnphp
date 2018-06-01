<?php
function readDirectory($path)
{
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
