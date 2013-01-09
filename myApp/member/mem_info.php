<?
// 1. 공통 인클루드 파일 
include ("../common/include/common.php");

// 2. 로그인 안한 회원은 로그인 페이지로 보내기
if(!$_SESSION[user_id]){
    ?>
    <script>
        alert("로그인 하셔야 합니다.");
        location.replace("board_login.php");
    </script>
    <?
}
// 3. 입력 HTML 출력
?>
<script>
// 5.입력필드 검사함수
function member_save(){
    // 6.form 을 f 에 지정
    var f = document.modifyForm;

    // 7.입력폼 검사

    if(f.txtPass.value == ""){
        alert("비밀번호를 입력해 주세요.");
        return false;
    }

    if(f.txtPass.value != f.txtPass2.value){
        // 8.비밀번호와 확인이 서로 다르면 경고창으로 메세지 출력 후 함수 종료
        alert("비밀번호를 확인해 주세요.");
        return false;
    }

    // 10.검사가 성공이면 form 을 submit 한다
    f.submit();

}
</script>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">회원 정보 수정</td>
    </tr>
</table>
<br/>
<form name="modifyForm" method="post" action="/member/mem_info_ok.php" style="margin:0px;">
<table style="width:1000px;height:50px;border:0px;">
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">비밀번호</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="password" name="txtPass" style="width:380px;"></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">비밀번호 확인</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="password" name="txtPass2" style="width:380px;"></td>
    </tr>
    <!-- 4. 정보수정 버튼 클릭시 입력필드 검사 함수 member_save 실행 -->
    <tr>
        <td align="center" valign="middle" colspan="2"><input type="button" value=" 정보수정 " onClick="member_save();"></td>
    </tr>
</table>
</form>
