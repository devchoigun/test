<html>
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8>
<title>글목록보기</title>
<STYLE TYPE=text/css>
BODY,TD,SELECT,input,DIV,form,TEXTAREA,center,option,pre,blockquote {font-family:굴림;font-size:9pt;color:#555555;}
A:link    {color:black;text-decoration:none;}
A:visited {color:black;text-decoration:none;}
A:active  {color:black;text-decoration:none;}
A:hover  {color:gray;text-decoration:none;}
</STYLE>
</head>
<script language="javascript">
	function fn_login() {
		var frm = document.form;
		frm.action = "login_ok.php";
		frm.submit();
	}
</script>
<body>
<form name="form" method="post">
<fieldset>
	<legend>로그인</legend>
	<label for="id">아이디</label> 
	<input type="text" name="txtUserId" id="txtUserId" title="아이디" />
	<label for="pass">비밀번호</label>
	<input type="password" name="txtPassword" id="txtPassword" title="비밀번호" />
<!-- 	<input type="checkbox" name="remember" id="remember"/> -->
<!-- 	<label for="remember"> 아이디저장</label> -->
	<input type="button" value="로그인" onclick="fn_login();"/>
</fieldset>
</form>
</body>
</html>