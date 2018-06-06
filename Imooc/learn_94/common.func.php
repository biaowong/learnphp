<?php

function alertMes($mes, $url)
{
    echo "<script type='text/javascript'>alert('{$mes}');location.href='{$url}';</script>";
}

function getExt($filename)
{
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * 获取唯一文件名称
 * @param  integer $length [description]
 * @return [type]          [description]
 */
function getUniqidName($length=10)
{
    return substr(md5(uniqid(microtime(true), true)), 0, $length);
}
