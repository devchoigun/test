<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Admin</title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="stylesheet" href="/admin/common/css/style.css?v=2">
	
	<!-- fluid 960 -->
	<link rel="stylesheet" type="text/css" href="/admin/common/css/text.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/admin/common/css/layout.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/admin/common/css/grid.css" media="screen" />
	<!-- superfish menu -->
	<link rel="stylesheet" type="text/css" href="/admin/common/css/superfish.css" media="screen" />
	<link href="/common/css/button.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="/common/smartEditor/js/HuskyEZCreator.js" charset="utf-8"></script>
	<!-- //jquery -->
	<script src="/admin/common/js/libs/jquery-1.5.1.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="/admin/common/js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
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
			document.myForm.action = "write_ok.php";
			document.myForm.submit();
		}
	}
	</script>
</head>
<body>
<div class="container_16">
	<? include "../common/include/menu.php"; ?>
	<div id="main" role="main">
		<div id="content">
			<div class="grid_16">
				<div class="box">
					<div class="block" id="list">
					<table border=0 cellspacing=0 cellpadding=0 width=100%>
						<form name="myForm" method="post" enctype="multipart/form-data">
						<tr>
							<td width="100" align="right">이름</td>
							<td><input type="text" name="name" size="20" maxlength="20"></td>
							<td width="100" align="right">비밀번호</td>
							<td><input type="password" name="password" size="20" maxlength="20"></td>
						</tr>
						<tr>
							<td align="right">제목</td>
							<td colspan="3"><input type="text" name="title" size="87" maxlength="200"> </td>
						</tr>
						<tr>
							<td colspan="4"><textarea name="ir1" id="ir1" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea></td>
						</tr>
						<tr>
							<td>File</td>
							<td colspan="3"><input type="file" name="attachFile"></td>
						</tr>
						</form>
					</table>
					<table summary="board">
						<tbody>
						<tr>
							<td class="left"><span class="button"><a href="list.php?page=<? echo $page; ?>">목록</a></span></td>
							<td class="right"><span class="button"><a href="javascript:check_submit();">등록</a></span></td>
						</tr>
						</tbody>
					</table>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<div class="grid_16" id="site_info">
			<div class="box">
				<p>footer</p>
			</div>
		</div>
		<div class="clear"></div>
	</footer>
</div>
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