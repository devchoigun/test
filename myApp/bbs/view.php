<?
	//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!
	mysql_connect("localhost", "tuser", "tuser") or die (mysql_error());
	mysql_select_db("testdb");
	 
	$number = $_GET["number"];
	$page = $_GET["page"];
	//변수 설정합니다.
	$tablename="bbs"; //테이블 이름
	 
	//테이블에서 글을 가져옵니다.
	$query	= "select * from $tablename where number='$number'"; // 글 번호를 가지고 조회를 합니다.
	$result	= mysql_query($query) or die (mysql_error());
	$array	= mysql_fetch_array($result);
	 
	//백슬래쉬 제거, 특수문자 변환(HTML용), 개행(<br>)처리 등
	$array[name]		= stripslashes($array[name]);
	$array[subject]		= stripslashes($array[subject]);
	$array[memo]		= stripslashes($array[memo]);
	$array[subject]		= htmlspecialchars($array[subject]);
	//$array[memo]		= htmlspecialchars($array[memo]);
	$array[memo]		= nl2br($array[memo]);
	 
	// 조회수 카운터 증가
	$query = "update $tablename set count = count + 1 where number='$number'";
	mysql_query($query);
?>
<html>
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8>
<title>view</title>
<link href="/common/css/default.css" rel="stylesheet" type="text/css" />
<link href="/common/css/basic_board.css" rel="stylesheet" type="text/css" />
<link href="/common/css/button.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br/><br/>
<table summary="board" class="notice_view">
	<cption></cption>
	<colgroup>
		<col width="60px"/>
		<col />
		<col width="70px" />
		<col width="40px" />
	</colgroup>
	<tbody>
	<tr>
		<th>제목</th>
		<td colspan="3" class="title"><? echo $array[subject]; ?></td>
	</tr>
	<tr>
		<th>이름</th>
		<td><? echo $array[name]; ?></td>
		<th>조회수</th>
		<td><? echo $array[count]; ?></td>
	</tr>
	<tr>
		<td colspan="4"><? echo $array[memo]; ?></td>
	</tr>
</table>
<table summary="board" class="notice_noline">
	<tbody>
	<tr>
		<td class="left"><span class="button"><a href="list.php?page=<? echo $page; ?>">목록</a></span></td>
		<td class="right">
			<span class="button"><a href="modify.php?number=<? echo $number; ?>&page=<? echo $page; ?>">수정</a></span>
		 	&nbsp;<span class="button"><a href="delete.php?number=<? echo $number; ?>&page=<? echo $page; ?>">삭제</a></span>
		 </td>
	</tr>
	</tbody>
</table>
</body>
</html>