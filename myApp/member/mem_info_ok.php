<?
// 1. 공통 인클루드 파일
include ("../common/include/common.php");

// 2. 로그인 안한 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    ?>
    <script>
        alert("로그인 하셔야 합니다.");
        location.replace("/login/login.php");
    </script>
    <?
}

// 3. 넘어온 변수 검사
if($_POST[txtPass] == ""){
    ?>
    <script>
        alert("비밀번호를 입력해 주세요.");
        history.back();
    </script>
    <?
    exit;
}

if($_POST[txtPass] != $_POST[txtPass2]){
    ?>
    <script>
        alert("비밀번호를 확인해 주세요.");
        history.back();
    </script>
    <?
    exit;
}


// 4. 회원정보 적기
$sql = sprintf("UPDATE member SET m_pass = '%s' WHERE m_id = '%s'", mysql_real_escape_string($_POST[txtPass]), $_SESSION[user_id]);
sql_query($sql);

// 8. 첫 페이지로 보내기
?>
<script>
alert("회원정보가 수정 되었습니다.");
location.replace("/board/list.php");
</script>