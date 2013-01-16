<?
	include "../config/lib.php";

	$seq = $_GET["seq"];
	$page = $_GET["page"];
	 
	//변수 설정합니다.
	$tablename="board"; //테이블 이름
	 
	//테이블에서 글을 가져옵니다.
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	$query	= sprintf("SELECT seq, b_name, b_title, b_count, b_subject FROM %s WHERE seq = %u", $tablename, escape_data($seq));
	$data	= sql_fetch($query);
	 
	//백슬래쉬 제거, 특수문자 변환(HTML용), 개행(<br>)처리 등
	$data[b_name] = stripslashes($data[b_name]);
	$data[b_title] = stripslashes($data[b_title]);
	$data[b_subject] = stripslashes($data[b_subject]);
	 
	//$array[subject] = htmlspecialchars($array[subject]);
	//$array[memo] = htmlspecialchars($array[memo]);
	//$array[memo] = nl2br($array[memo]);
 
?>
<html>
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8>
<title>게시판</title>
<link href="/common/css/default.css" rel="stylesheet" type="text/css" />
<link href="/common/css/basic_board.css" rel="stylesheet" type="text/css" />
<link href="/common/css/button.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/common/smartEditor/js/HuskyEZCreator.js" charset="utf-8"></script>
<script language="javascript">
function check_submit() {
	oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
	if (document.myForm.name.value == "") {
		alert('이름을 입력하세요');
		document.myForm.name.focus();
		return;
	} else if (document.myForm.password.value == "") {
		alert('비밀번호를 입력해야 글을 수정하거나 삭제할 수 있습니다.');
		document.myForm.password.focus();
		return;
	} else if (document.myForm.title.value == "") {
		alert('제목을 입력하세요');
		document.myForm.title.focus();
		return;
	} else if (document.myForm.ir1.value == "") {
		alert('내용을 입력하세요');
		document.myForm.ir1.focus();
		return;
	} else {
		document.myForm.action = "modify_ok.php";
		document.myForm.submit();
	}
}
</script>
</head>
<body bgcolor=white>
<br>
<form name='myForm' method='post' >
<input type="hidden" name="page" value="<? echo $page; ?>">
<input type="hidden" name="seq" value="<? echo $seq; ?>">
<table class="notice_write">
	<cption></cption>
	<colgroup>
		<col width="100px"/>
		<col />
		<col width="100px" />
		<col width="150px" />
	</colgroup>
	<tbody>
	<tr>
		<th>이름</th>
		<td><input type="text" name="name" size="20" maxlength="20" value="<? echo $data[b_name] ?>" /></td>
		<th>비밀번호</th>
		<td><input type="password" name="password" size="20" maxlength="20"></td>
	</tr>
	<tr>
		<th>제목</th>
		<td colspan="3"><input type="text" name="title" size="87" maxlength="200" value="<? echo $data[b_title] ?>" /></td>
	</tr>
	<tr>
		<td colspan="4">
			<textarea name="ir1" id="ir1" rows="10" cols="100" style="width:700px; height:412px; display:none;"><? echo $data[b_subject] ?></textarea>
		</td>
	</tr>
	<tr>
		<th>File</th>
		<td colspan="3"><input type="file" name="attachFile"></td>
	</tr>
	</tbody>
	
</table>
<table summary="board" class="notice_noline">
	<tbody>
	<tr>
		<td class="left"><span class="button"><a href="list.php?page=<? echo $page ?>">목록</a></span></td>
		<td class="right"><span class="button"><a href="javascript:check_submit();">수정</a></span></td>
	</tr>
	</tbody>
</table>
</form>
<script type="text/javascript">
var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
	oAppRef: oEditors,
	elPlaceHolder: "ir1",
	sSkinURI: "/common/smartEditor/SmartEditor2Skin.html",	
	htParams : {bUseToolbar : true,
		fOnBeforeUnload : function(){
			
		}
	}, //boolean
	fOnAppLoad : function(){
		//예제 코드
		//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
	},
	fCreator: "createSEditor2"
});
</script>
</body>
</html>