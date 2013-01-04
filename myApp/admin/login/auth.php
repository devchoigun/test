<?
	session_start();

	if(!$_SESSION[user_id] || $_SESSION[user_level] < 9){
	    alert("어드민 아이디로 로그인하여 주시기 바랍니다.", "/admin/login/login.php");
	}
?>