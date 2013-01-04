<?
	//db 연결 부분입니다.
	mysql_connect("localhost", "tuser", "tuser") or die (mysql_error());
	mysql_select_db("testdb");
	 
	$number = $_POST["number"];
	$page = $_GET["page"];
	
	//수정폼(modify.php)에서 전송된 내용을 변수에 담습니다.
	$name		= addslashes($_REQUEST[name]);
	$password	= addslashes($_REQUEST[password]);
	$email		= addslashes($_REQUEST[email]);
	$homepage	= addslashes($_REQUEST[homepage]);
	$subject		= addslashes($_REQUEST[subject]);
	$memo		= addslashes($_REQUEST[memo]);
	 
	//디폴트 값이 필요한 변수에는 디폴트 값을 넣습니다.
	$tablename="bbs"; //테이블 이름
	$writetime = time();
	//$ip = getenv("REMOTE_ADDR");
	 
	//비밀번호가 맞는지 확인합니다.
	$sql = "select number from $tablename where number=$number and password='$password'";
	
	echo "sql = $sql";
	
	$result = mysql_query($sql) or die (mysql_error());
 
	if(mysql_num_rows($result)) {  //반환된 열이 있으면...
		//수정한 내용을 UPDATE합니다.
		$sql = "update $tablename set
		name='$name',email='$email',homepage='$homepage',
		subject='$subject',memo='$memo' where number=$number";
		mysql_query($sql) or die (mysql_error());
		$msg = "수정을 하였습니다.";
	
		echo " <html><head>
		<script name=javascript>
			if('$msg' != '') {
			self.window.alert('$msg');
			}
			location.href='list.php?page=$page';
		</script>
		</head>
		</html> ";
	
	} else {
		$msg = "비밀번호가 틀립니다.";
		echo " <html><head><meta http-equiv=content-type content=text/html; charset=utf-8>
		<script name=javascript>
			if('$msg' != '') {
			self.window.alert('$msg');
			}
			history.go(-1);
		</script>
		</head>
		</html> ";
	}
?>