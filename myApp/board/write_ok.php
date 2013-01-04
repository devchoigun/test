<?
	include "../config/lib.php";
	
	//입력폼(write.php)에서 전송된 내용을 변수에 담습니다.
	$name		= addslashes($_POST['name']);
	$password	= addslashes($_POST['password']);
	$email		= addslashes($_POST['email']);
	$homepage	= addslashes($_POST['homepage']);
	$subject		= addslashes($_POST['subject']);
	$memo		= addslashes($_POST['memo']);
	
	//디폴트 값이 필요한 변수에는 디폴트 값을 넣습니다.
	$writetime = time();
	$ip = getenv("REMOTE_ADDR");
	$count = 0;
	
	//SQL 명령을 이용해 입력받은 내용과 디폴트값 등을 MySQL에 입력(insert)합니다.
	
	$sql = "insert into bbs(name, password, email, homepage, subject, memo, count, ip, writetime) values('$name', '$password', '$email', '$hompage', '$subject', '$memo', $count, '$ip', $writetime)";
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	mysql_query($sql, $connect) or die (mysql_error());
	$msg = "성공적으로 등록되었습니다";
echo "
<html>
<head>
<script name=javascript>
	if('$msg' != '') {
		self.window.alert('$msg');
	}
	location.href='list.php?';
</script>
</head>
</html>
";
?>