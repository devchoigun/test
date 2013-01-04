<?
// 1. 공통 인클루드 파일
// include "./admin_head.php";

// 2. 모든 세션값을 빈값으로 
// $_SESSION[user_idx] = "";
$_SESSION[admin_id] = "";
$_SESSION[adimn_name] = "";
// $_SESSION[user_level] = "";

alert("로그아웃이 되었습니다.", "/admin/login/login.php");
?>