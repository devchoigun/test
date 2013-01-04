<?
	//db 연결 부분입니다.
	mysql_connect("localhost", "tuser", "tuser") or die (mysql_error());
	mysql_select_db("testdb");
	 
	//변수
	$number = $_POST["number"];
	
	$tablename="bbs"; //테이블 이름
	 
	//비밀번호가 맞는지 확인합니다.
	$sql = "delete from $tablename where number=$number";
	$result = mysql_query($sql) or die (mysql_error());
        $msg = "삭제하였습니다.";
 
//메시지를 출력하고 목록 페이지로 이동합니다.
echo "<html><head><meta http-equiv=content-type content=text/html; charset=utf-8>
	<script name=javascript>
		if('$msg' != '') {
			self.window.alert('$msg');
		}
		location.href='list.php?page=$page';
	</script>
	</head>
	</html>";
?>