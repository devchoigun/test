<?
// 1. 공통 인클루드 파일
include ("../common/include/common.php");

// 2. 로그인한 회원은 뒤로 보내기
if($_SESSION[user_id]){
    ?>
    <script>
        alert("로그인 하신 상태입니다.");
        history.back();
    </script>
    <?
}
// 3. 입력 HTML 출력
?>
<script>
// 5.입력필드 검사함수
function member_save(){
    // 6.form 을 f 에 지정
    var f = document.registForm;

    // 7.입력폼 검사
    if(f.txtId.value == ""){
        // 8.값이 없으면 경고창으로 메세지 출력 후 함수 종료
        alert("아이디를 입력해 주세요.");
        return;
    }

    if(f.txtName.value == ""){
        alert("이름을 입력해 주세요.");
        return;
    }

    if(f.txtEMail.value == ""){
        alert("이메일을 입력해 주세요.");
        return;
    }

    if(f.txtPass.value == ""){
        alert("비밀번호를 입력해 주세요.");
        return;
    }

    if(f.txtPass.value != f.txtPass2.value){
        // 9.비밀번호와 확인이 서로 다르면 경고창으로 메세지 출력 후 함수 종료
        alert("비밀번호를 확인해 주세요.");
        return;
    }

    // 10.검사가 성공이면 form 을 submit 한다
    f.submit();

}
</script>
<br/>
<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" style="font-zise:15px;font-weight:bold;">회원가입</td>
    </tr>
</table>
<br/>
<form name="registForm" method="post" action="join_ok.php" style="margin:0px;">
<table style="width:1000px;height:50px;border:0px;">
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">아이디</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="text" name="txtId" style="width:380px;"></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">이름</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="text" name="txtName" style="width:380px;"></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">이메일</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="text" name="txtEMail" style="width:380px;"></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">비밀번호</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="password" name="txtPass" style="width:380px;"></td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="width:200px;height:50px;background-color:#CCCCCC;">비밀번호 확인</td>
        <td align="left" valign="middle" style="width:800px;height:50px;"><input type="password" name="txtPass2" style="width:380px;"></td>
    </tr>
    <!-- 4. 회원가입 버튼 클릭시 입력필드 검사 함수 member_save 실행 -->
    <tr>
        <td align="center" valign="middle" colspan="2"><input type="button" value=" 회원가입 " onClick="member_save();"></td>
    </tr>
</table>
</form>
