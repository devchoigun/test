<?
	session_start();

	if(!$_SESSION[user_id] || $_SESSION[user_level] < 9){
	    alert("���� ���̵�� �α����Ͽ� �ֽñ� �ٶ��ϴ�.", "/admin/login/login.php");
	}
?>