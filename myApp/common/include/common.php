<?
// 1. 세션사용은 위한 초기화
session_start();

// 2. 사용자 정의 함수 include
include ("../config/lib.php");

// 3. DB 연결
$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);

// 4. head 부분 
?>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" colspan="3" style="font-zise:15px;font-weight:bold;">
        PHPer's Heaven 샘플 게시판
        </td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="font-size:12px;"><a href="./board_list.php">목록보기</a></td>
        <td align="center" valign="middle" style="font-size:12px;">
        <?
        // 5. 세션을 이용한 로그인 여부에 따른 링크
        if($_SESSION[user_id]){
        ?>
        <a href="./board_logout.php">로그아웃</a>
        <?}else{?>
        <a href="./board_login.php">로그인</a>
        <?}?>
        </td>
        <td align="center" valign="middle" style="font-size:12px;">
        <?
        // 6. 세션을 이용한 로그인 여부에 따른 링크
        if($_SESSION[user_id]){
        ?>
        <a href="./board_write.php">회원정보수정</a>
        <?}else{?>
        <a href="./board_register.php">회원가입</a>
        <?}?>
        </td>
    </tr>
</table>