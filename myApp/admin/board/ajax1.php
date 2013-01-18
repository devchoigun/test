<?php
require_once('mysql.php');
$ar = new ActiveRecords();  // for mysqli  =>  $datatables = new Datatables('mysqli');

// MYSQL configuration
$config = array(
		'username' => 'tuser',
		'password' => 'tuser',
		'database' => 'testdb',
		'hostname' => 'localhost');

$seq = $_GET["seq"];
$seq = 1;
$aColumns = array( "seq", "title", "name", "count", "regdate" );

$aTables = array( "bbs");

$ar->connect($config);

$ar
->select($aColumns)
->from($aTables);

$result = $ar ->get();

while ( $aRow = mysql_fetch_array( $rResult ) ) {
	$row = array();
	for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
		echo $aRow[ $aColumns[$i] ]."<BR>";
	}
}


?>

