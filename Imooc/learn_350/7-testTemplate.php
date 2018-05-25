<?php
require 'show.php';
require 'template.class.php';
/**
// $pattern = '/'.preg_quote('{#');
// $pattern .= ' *\$([a-zA-Z_]\w*)';
// $pattern .= preg_quote('#}').'/';

// $subject = '测试：{#$test#}';
// $replacement = '<?php echo $$1; ?>';

// $subject = preg_replace($pattern, $replacement, $subject);
// show($subject);
*/

$baseDir = str_replace('\\', '/', dirname(__FILE__));
$temp = new Template($baseDir.'/source/', $baseDir.'/compiled/');
$temp->assign('pagetitle', '山寨版smarty');
$temp->assign('test', 'imooc测试');
$temp->getSourceTemplate('index');
$temp->compileTemplate();
$temp->display();
