<?
	include "../config/lib.php";
	 
	$seq = $_POST["seq"];
	$page = $_POST["page"];
	
	//수정폼(modify.php)에서 전송된 내용을 변수에 담습니다.
	$name		= $_POST[name];
	$password	= $_POST[password];
	$title		= $_POST[title];
	$subject	= $_POST[ir1];
	 
	$tablename="board"; //테이블 이름
	$ip = getenv("REMOTE_ADDR");
	 
	//비밀번호가 맞는지 확인
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	$query = sprintf("SELECT seq FROM %s WHERE seq=%u AND b_pass='%s'", $tablename, escape_data($seq), escape_data($password));
	$result = sql_query($query);
 
	if(mysql_num_rows($result)) {
		$query = sprintf("UPDATE %s SET b_name='%s', b_title='%s', b_subject='%s', upddate=DATE_FORMAT(now(), '%%Y%%m%%d%%H%%i%%s'), upduser='%s' WHERE seq=%u"
				, $tablename, escape_data($name), escape_data($title), escape_data($subject), escape_data($name), escape_data($seq));
		sql_query($query);
		alert("수정을 하였습니다.","list.php?page=$page");
	} else {
		alert("비밀번호가 틀립니다.","");
	}
?>