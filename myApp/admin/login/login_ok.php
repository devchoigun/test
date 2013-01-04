<?
	session_start();
	
	include "../../config/lib.php";
	
	//db 연결 부분입니다.
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	 
	//변수
	$id = $_POST[txtUserId];
	$password = addslashes($_POST[txtPassword]);
	
	// 4. 같은 아이디가 있는지 검사
	$chk_sql = "select adminid, name, password from admin where adminid = '".trim($id)."'";
	$chk_result = sql_query($chk_sql);
	$chk_data = mysql_fetch_array($chk_result);
	
	// 5. 아이디가 존재 하는 경우
	if($chk_data[adminid]){
	
		// 5. 입력된 비밀번호와 저장된 비밀번호가 같은지 비교해서
		if($password == $chk_data[password]){
			// 6. 비밀번호가 같으면 세션값 부여 후 이동
			$_SESSION[admin_id] = $chk_data[adminid];
			$_SESSION[adimn_name] = $chk_data[name];
// 			$_SESSION[user_level] = $chk_data[m_level];
	
			alert("환영합니다.", "/admin/index.php");
		}else{
			// 7. 비밀번호가 다르면
			alert("비밀번호가 다릅니다.");
		}
	}else{
		// 8. 아이디가 존재하지 않으면
		alert("존재하지 않는 회원입니다.");
	}
 
// //메시지를 출력하고 목록 페이지로 이동합니다.
// echo "<html><head><meta http-equiv=content-type content=text/html; charset=utf-8>
// 	<script name=javascript>
// 		location.href='/admin/index.php';
// 	</script>
// 	</head>
// 	</html>";
?>