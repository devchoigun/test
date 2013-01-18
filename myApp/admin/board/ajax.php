<?php
require_once('Datatables.php');
$datatables = new Datatables();  // for mysqli  =>  $datatables = new Datatables('mysqli');

// MYSQL configuration
$config = array(
		'username' => 'tuser',
		'password' => 'tuser',
		'database' => 'testdb',
		'hostname' => 'localhost');

$datatables->connect($config);

$datatables
->select('seq, title, name, count, DATE_FORMAT(regdate, \'%Y/%m/%d\') as regdate')
->from('bbs')
->edit_column('title', '<a href="modify.php?seq=$1">$2</a>', 'seq, title')
->add_column('delete', '<a href="javascript:fn_del(\'$1\')">삭제</a>', 'seq');

echo $datatables->generate();
?>

