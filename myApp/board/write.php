<html> 
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8>
<title>게시판</title>
<STYLE TYPE="text/css">
BODY,TD,SELECT,input,DIV,form,TEXTAREA,center,option  {font-family:굴림;font-size:9pt;color:#555555;}
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
		document.myForm.action = "write_ok.php";
		document.myForm.submit();
	}
}
</script>
</head>
<body bgcolor=white>
<br>
<form name="myForm" method="post" enctype="multipart/form-data">
<table border=0 cellspacing=1 cellpadding=0 width=670>
	<tr>
		<td align=center><font color=green><b>글 쓰기 화면입니다.</b></font></td>
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
								<td width=100 align=right><b>이름 </b></td>
								<td><input type="text" name="name" size=20  maxlength=20></td>
								<td width=100 align=right><b>비밀번호 </b></td>
								<td><input type="password" name="password"  size=20  maxlength=20></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor=white height=1 colspan=2></td>
				</tr>
				<tr>
					<td align=right><b>전자우편 </b></td>
					<td> <input type="text" name="email" size=40  maxlength=200> </td>
				</tr>
				<tr><td bgcolor=white height=1 colspan=2></td></tr>
				<tr>
					<td align=right><b>홈페이지 </b></td>
					<td> <input type="text" name="homepage" size=40  maxlength=200> </td>
				</tr>
				<tr>
					<td bgcolor=white height=1 colspan=2></td>
				</tr>
				<tr>
					<td align=right><b>제목 </b></td>
					<td> <input type="text" name="subject" size=87  maxlength=200> </td>
				</tr>
				<tr>
					<td bgcolor=white height=1 colspan=2></td>
				</tr>
				<tr>
					<td align=right><b>내용 </b></td>
					<td valign=top>
					<textarea name="memo" cols=85 rows=20></textarea>
					</td>
				</tr>
				<tr>
					<td align=right><b>File </b></td>
					<td valign=top><input type="file" name="attachFile"></td>
				</tr>
				
			</table>
			<br>
			<table border=0 width=670>
				<tr>
					<td>
						<center>
							<a href="javascript:check_submit();">확인</a>   
							<a href=# onclick=history.back()>리스트</a>
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