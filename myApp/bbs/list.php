<?
	include "../config/lib.php";
	
	
	// 3.디비와 연결
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	 
	//게시판 목록보기에 필요한 각종 변수 초기값을 설정합니다.
	$tablename="board"; //테이블 이름
	
	
	if(get_magic_quotes_gpc()) {
		$page = stripslashes($_GET['page']);
	}else{
		$page = $_GET['page'];
	}
	
	
	if($page == ''){
		$page = 1; //페이지 번호가 없으면 1
	}
	$list_num = 10; //한 페이지에 보여줄 목록 갯수
	$page_num = 10; //한 화면에 보여줄 페이지 링크(묶음) 갯수
	$offset = $list_num*($page-1); //한 페이지의 시작 글 번호(listnum 수만큼 나누었을 때 시작하는 글의 번호)
	 
	//전체 글 수를 구합니다. (쿼리문을 사용하여 결과를 배열로 저장하는 일반적 인 방법)
	$query = sprintf("SELECT COUNT(seq) AS cnt FROM $tablename"); // SQL 쿼리문을 문자열 변수에 일단 저장하고
	$total_no = sql_total($query); //배열의 첫번째 요소의 값, 즉 테이블의 전체 글 수를 저장합니다.
	 
	//전체 페이지 수와 현재 글 번호를 구합니다.
	$total_page = ceil($total_no/$list_num); // 전체글수를 페이지당글수로 나눈 값의 올림 값을 구합니다.
	$cur_num = $total_no - $list_num*($page-1); //현재 글번호
	
	// 4. 페이지 출력 내용 만들기
	//$paging_str = paging($page, $page_row, $page_scale, $total_count);
	 
	//bbs테이블에서 목록을 가져옵니다. (위의 쿼리문 사용예와 비슷합니다 .)
	$query = sprintf("SELECT seq, b_name, b_title, b_count, %d FROM $tablename ORDER BY seq DESC LIMIT %d, %d",  "DATE_FORMAT(regdate, '%Y/%m/%d') as regdate", mysql_real_escape_string($offset,$connect), mysql_real_escape_string($list_num,$connect) ); // SQL 쿼리문
	
	echo $query;
	
	$result = mysql_query($query, $connect) or die (mysql_error()); // 쿼리문을 실행 결과
	//쿼리 결과를 하나씩 불러와 실제 HTML에 나타내는 것은 HTML 문 중간에 삽입합니다.
?>
<html>
<head>
<meta http-equiv=content-type content=text/html; charset=utf-8>
<title>news & notice</title>
<link href="/common/css/default.css" rel="stylesheet" type="text/css" />
<link href="/common/css/basic_board.css" rel="stylesheet" type="text/css" />
<link href="/common/css/button.css" rel="stylesheet" type="text/css" />
</head>
<body>
<br/><br/>
<table summary="board" class="notice">
	<cption></cption>
	<colgroup>
		<col width="40px"/>
		<col />
		<col width="80px" />
		<col width="80px" />
		<col width="40px" />
	</colgroup>
	<thead>
	<tr>
		<th scope="col">no</th>
		<th scope="col">title</th>
		<th scope="col">name</th>
		<th scope="col">date</th>
		<th scope="col">hit</th>
	</tr>
	</thead>
	<tbody>
	<?
	while ($array=mysql_fetch_array($result)) {
		echo "
	<tr>
		<td>$cur_num</td>
		<td class='title'><a href='view.php?number=$array[seq]&page=$page'>$array[b_title]</a></td>
		<td>$array[b_name]</td>
		<td>$array[regdate]</td>
		<td>$array[b_count]</td>
	</tr> ";
		$cur_num --;
	}
	?>
	</tbody>
</table>
<br/>
<? echo paging($page, $list_num, $page_num, $total_no, $tablename) ?>
     
 
<table summary="board" class="notice_noline">
	<tbody>
	<tr>
		<td class="right"><span class="button"><a href="write.php">글쓰기</a></span></td>
	</tr>
	</tbody>
</table>
</body>
</html>