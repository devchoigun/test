<?
	include "../config/lib.php";
	 
	//변수
	$page = $_POST[page];
	$seq = $_POST[seq];
	$password = $_POST[password];
	
	$tablename="board"; //테이블 이름
	 
	//비밀번호가 맞는지 확인합니다.
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	$query = sprintf("SELECT seq FROM %s WHERE seq=%u AND b_pass='%s'", $tablename, escape_data($seq), escape_data($password));
	$result = sql_query($query);
	 
	if(mysql_num_rows($result)) {
	        $sql = "delete from $tablename where number=$number";
	        $query = sprintf("DELETE FROM %s WHERE seq=%u", $tablename, escape_data($seq));
	        sql_query($query);
	        
	        alert("삭제하였습니다.","list.php?page=$page");
	}else{
		alert("비밀번호가 틀립니다.","");
	}
?>