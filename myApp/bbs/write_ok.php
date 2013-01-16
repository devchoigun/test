<?
	include "../config/lib.php";
	
	//입력폼(write.php)에서 전송된 내용을 변수에 담습니다.
	$name		= $_POST[name];
	$password	= $_POST[password];
	$title		= $_POST[title];
	$subject	= $_POST[ir1];
	$page		= $_POST[page];
	
	$tablename="board"; //테이블 이름
	
	//File upload
	$clear = array();
	$clear['tmp_name'] = $_FILES['attachFile']['tmp_name'];
	$clear['name'] = $_FILES['attachFile']['name'];
	$clear['size'] = $_FILES['attachFile']['size'];
	$clear['type'] = $_FILES['attachFile']['type'];
	$clear['error'] = $_FILES['attachFile']['error'];
	
	
	$filename = "";
	
	$valid_file_extensions = array("jpg", "jpeg", "gif", "png", "pdf", "doc", "xls");
	if( !empty($clear['name']) ){
		
		if( getbasename($clear['name']) != $clear['name'] ){
			echo "fatal error. forbidden file name <br />";
			exit;
		}
		
		if( $clear['error'] > 0 ){
			echo "error code = [".$clear['error']."]<br />";
		}
		
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
			alert("해당 파일의 종류는 업로드 할수 없습니다.", "");
		}
	}
	
	$ip = getenv("REMOTE_ADDR");
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	$query = sprintf("INSERT INTO %s (seq, upper_no, b_name, b_pass, b_title, b_subject, b_ip, regdate, reguser)
			VALUES( (SELECT ifnull(MAX(a.seq),0) + 1 FROM board a), (SELECT ifnull(MIN(a.upper_no),0) -1 FROM board a)
			, '%s', '%s', '%s', '%s', '%s', DATE_FORMAT(now(), '%%Y%%m%%d%%H%%i%%s'), '%s')"
			, $tablename, escape_data($name), escape_data($password), escape_data($title), escape_data($subject), $ip, escape_data($name));
	
	sql_query($query);
	if(mysql_affected_rows($connect)){
		alert("성공적으로 등록되었습니다", "list.php?page=$page");
	}else{
		alert("등록 실패 되었습니다", "");
	}
	
?>