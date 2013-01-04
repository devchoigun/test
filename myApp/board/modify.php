<?
	//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!
	mysql_connect("localhost", "tuser", "tuser") or die (mysql_error());
	mysql_select_db("testdb");
	 
	//변수 설정합니다.
	$tablename="bbs"; //테이블 이름
	
	$number = $_GET["number"];
	$page = $_GET["page"];
	 
	//테이블에서 글을 가져옵니다.
	$query = "select * from $tablename where number='$number'"; // 글 번호를 가지고 조회를 합니다.
	$result = mysql_query($query) or die (mysql_error());
	$array = mysql_fetch_array($result);
	 
	//백슬래쉬 제거, 특수문자 변환(HTML용), 개행(<br>)처리 등
	$array[name] = stripslashes($array[name]);
	$array[subject] = stripslashes($array[subject]);
	$array[memo] = stripslashes($array[memo]);
	 
	//$array[subject] = htmlspecialchars($array[subject]);
	//$array[memo] = htmlspecialchars($array[memo]);
	//$array[memo] = nl2br($array[memo]);
 
?>
 
<html>
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8>
<title>게시판</title>
<STYLE TYPE="text/css">
BODY,TD,SELECT,input,DIV,form,TEXTAREA,center,option,pre,blockquote {font-family:굴림;font-size:9pt;color:#555555;}
A:link    {color:black;text-decoration:none;}
A:visited {color:black;text-decoration:none;}
A:active  {color:black;text-decoration:none;}
A:hover  {color:gray;text-decoration:none;}
</STYLE>
<script language="javascript">
function check_submit() {
	if (document.myForm.name.value == "") {
		alert('이름을 입력하세요');
		document.myForm.name.focus();
		return;
	} else if (document.myForm.password.value == "") {
		alert('비밀번호를 입력해야 글을 수정하거나 삭제할 수 있습니다.');
		document.myForm.password.focus();
		return;
	} else if (document.myForm.subject.value == "") {
		alert('제목을 입력하세요');
		document.myForm.subject.focus();
		return;
	} else if (document.myForm.memo.value == "") {
		alert('내용을 입력하세요');
		document.myForm.memo.focus();
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
<input type=hidden name=page value='<? echo $page; ?>'>
<input type=hidden name=number value='<? echo $number; ?>'>
	<table border=0 cellspacing=1 cellpadding=0 width=670>
		<tr>
			<td align=center>
				<font color=green><b>글 수정 화면입니다.</b></font>
			</td>
		</tr>
	</table>
	<table border=0 bgcolor=#CCCCF>
		<tr>
			<td>
				<table border=0 width=670 cellspacing=0 cellpadding=0 bgcolor=#F0F0F0>
					<col width=100></col>
					<col width=></col>
					<tr>
						<td colspan=2>
							<table border=0 cellspacing=0 cellpadding=0 width=100%>
								<tr>
									<td width=100 align=right><b>이름&nbsp;</b></td>
									<td><input type=text name=name size=20  maxlength=20 value= '<? echo $array[name]; ?>'></td>                    
									<td width=100 align=right><b>비밀번호&nbsp;</b></td>
									<td><input type=password name=password  size=20  maxlength=20 value=''></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor=white height=1 colspan=2></td>
					</tr>
					<tr>
						<td align=right><b>전자우편&nbsp;</b></td>
						<td><input type=text name=email size=40  maxlength=200 value='<? echo $array[email]; ?>'> </td>
					</tr>
					<tr>
						<td bgcolor=white height=1 colspan=2></td>
					</tr>
					<tr>
						<td align=right><b>홈페이지&nbsp;</b></td>
						<td><input type=text name=homepage size=40  maxlength=200 value='<? echo $array[homepage]; ?>'> </td>
					</tr>
					<tr>
						<td bgcolor=white height=1 colspan=2></td>
					</tr>
					<tr>
						<td align=right><b>제목&nbsp;</b></td>
						<td><input type=text name=subject size=87  maxlength=200 value='<? echo $array[subject]; ?>'> </td>
					</tr>
					<tr><td bgcolor=white height=1 colspan=2></td></tr>
					<tr>
						<td align=right><b>내용&nbsp;</b></td>
						<td valign=top><textarea name=memo cols=85 rows=20> <? echo $array[memo]; ?> </textarea></td>
					</tr>
				</table>
				<br>
				<table border=0 width=670>
					<tr>
						<td>
							<center><a href="javascript:check_submit();">확인</a> &nbsp;&nbsp;<a href="list.php?page=<? echo $page ;  ?>">목록</a>
							</center>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
</body>
</html>