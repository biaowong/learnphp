<?php
require 'show.php';
// preg_grep
$str = 'qwer{asdf}{1234]';
$str = preg_quote($str);

show($str);
