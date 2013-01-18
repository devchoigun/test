<?
	include "../../config/lib.php";
	 
	$seq = $_POST["seq"];
	$page = $_POST["page"];
	
	$title		= $_POST[title];
	$subject	= $_POST[ir1];
	 
	$tablename = "bbs"; //테이블 이름
	$ip = getenv("REMOTE_ADDR");

	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	$query = sprintf("SELECT seq FROM %s WHERE seq=%u", $tablename, escape_data($seq));
	$result = sql_query($query);

	if(mysql_num_rows($result)) {
		$query = sprintf("UPDATE %s SET title='%s', subject='%s' WHERE seq=%u"
				, $tablename, escape_data($title), escape_data($subject), escape_data($seq));
		sql_query($query);
		alert("수정완료","list.php?page=$page");
	} else {
		alert("수정실패","");
	}
?>