<?
	include "../config/lib.php";

	$seq = $_GET["seq"];
	$page = $_GET["page"];
	//변수 설정합니다.
	$tablename="board"; //테이블 이름
	 
	//테이블에서 글을 가져옵니다.
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	$query	= sprintf("SELECT seq, b_name, b_title, b_count, b_subject FROM %s WHERE seq = %u", $tablename, escape_data($seq));
	$array	= sql_fetch($query);
	 
	//백슬래쉬 제거, 특수문자 변환(HTML용), 개행(<br>)처리 등
	$array[b_name]		= stripslashes($array[b_name]);
	$array[b_count]		= stripslashes($array[b_count]);
	$array[b_subject]	= stripslashes($array[b_subject]);
	$array[b_title]		= htmlspecialchars($array[b_title]);
	//$array[memo]		= htmlspecialchars($array[memo]);
	$array[b_subject]	= nl2br($array[b_subject]);
	 
	// 조회수 카운터 증가
	$query = sprintf("UPDATE %s SET b_count = b_count + 1 WHERE seq = %u", $tablename, escape_data($seq));
	sql_query($query);
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
		<td colspan="3" class="title"><? echo $array[b_title]; ?></td>
	</tr>
	<tr>
		<th>이름</th>
		<td><? echo $array[b_name]; ?></td>
		<th>조회수</th>
		<td><? echo $array[b_count]; ?></td>
	</tr>
	<tr>
		<td colspan="4"><? echo $array[b_subject]; ?></td>
	</tr>
</table>
<table summary="board" class="notice_noline">
	<tbody>
	<tr>
		<td class="left"><span class="button"><a href="list.php?page=<? echo $page; ?>">목록</a></span></td>
		<td class="right">
			<span class="button"><a href="modify.php?seq=<? echo $seq; ?>&page=<? echo $page; ?>">수정</a></span>
		 	&nbsp;<span class="button"><a href="delete.php?seq=<? echo $seq; ?>&page=<? echo $page; ?>">삭제</a></span>
		 	&nbsp;<span class="button"><a href="replay.php?seq=<? echo $seq; ?>&page=<? echo $page; ?>">답변</a></span>
		 </td>
	</tr>
	</tbody>
</table>
</body>
</html>