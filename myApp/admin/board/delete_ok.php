<?
	include "../../config/lib.php";
	$seq = $_POST["seq"];
	$tablename="bbs";

	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	$query = sprintf("DELETE FROM %s WHERE seq=%u", $tablename, escape_data($seq));
	$result = sql_query($query);
	$json = array();
	if(mysql_affected_rows($connect)){
		array_push($json,"result","삭제완료");
	}else{
		array_push($json,"result","삭제실패");
	}
	echo json_encode($json);
?>