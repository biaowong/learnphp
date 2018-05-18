<?php
// 更新Cookie与设置Cookie一样 =_=!
// setcookie('username', 'wang', time()+3600);
// setcookie('username', 'biao', time()+3600);

// 过期Cookie
setcookie('username', '', time()-1);
