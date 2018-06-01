<?php
// 不会对值进行urlencode()编码
setrawcookie('test1', 'test1', time()+3600);
