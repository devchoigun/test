<?
	include "../config/lib.php";
	
	//입력폼(write.php)에서 전송된 내용을 변수에 담습니다.
	$name		= addslashes($_POST['name']);
	$password	= addslashes($_POST['password']);
	$email		= addslashes($_POST['email']);
	$homepage	= addslashes($_POST['homepage']);
	$subject	= addslashes($_POST['subject']);
	$memo		= addslashes($_POST['ir1']);
	
	//File upload
	$clear = array();
	$clear['tmp_name'] = $_FILES['attachFile']['tmp_name'];
	$clear['name'] = $_FILES['attachFile']['name'];
	$clear['size'] = $_FILES['attachFile']['size'];
	$clear['type'] = $_FILES['attachFile']['type'];
	$clear['error'] = $_FILES['attachFile']['error'];
	
	if( basename($clear['name']) != $clear['name'] ){
		echo "fatal error. forbidden file name <br />";
		exit;
	}
	
	if( $clear['error'] > 0 ){
		echo "error code = [".$clear['error']."]<br />";
	}
	
	$filename = "";
	
	$valid_file_extensions = array("jpg", "jpeg", "gif", "png", "pdf", "doc", "xls");
	
	// 3-2.imageKind 배열내에 $_FILES['upload']['type']에 해당되는 타입(문자열) 있는지 체크
	if ( isUploadFile($clear['name'], $valid_file_extensions) ) {
		$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/upload/';
		if( is_uploaded_file($clear['tmp_name'])){
			$filename = GetUniqFileName($clear['name'],$upload_dir);
			if( move_uploaded_file($clear['tmp_name'], "$upload_dir/".$clear['name']) ){
					
			}else{
				alert("파일 업로드 오류","");
			}
		}
	}else{
		alert("해당 파일의 종류는 업로드 할수 없습니다.","");
	}
	
	
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