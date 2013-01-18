<?php
	include "../../config/lib.php";
	
	// 3.디비와 연결
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	
	if(get_magic_quotes_gpc()) {
		$page = stripslashes($_GET[page]);
	}else{
		$page = $_GET[page];
	}
	
	if($page == ''){
		$page = 1; //페이지 번호가 없으면 1
	}
	$list_num = 10; //한 페이지에 보여줄 목록 갯수
	$page_num = 10; //한 화면에 보여줄 페이지 링크(묶음) 갯수
	$offset = $list_num*($page-1); //한 페이지의 시작 글 번호(listnum 수만큼 나누었을 때 시작하는 글의 번호)
	
	$query = "SELECT COUNT(adminid) AS cnt FROM admin";
	$total_no = sql_total($query); //배열의 첫번째 요소의 값, 즉 테이블의 전체 글 수를 저장합니다.
	
	$total_page = ceil($total_no/$list_num); // 전체글수를 페이지당글수로 나눈 값의 올림 값을 구합니다.
	$cur_num = $total_no - $list_num*($page-1); //현재 글번호
	
	$paging_str = paging($page, $list_num, $page_num, $total_no, $tablename);
	 
	$query = sprintf("SELECT adminid, name, password FROM admin ORDER BY adminid LIMIT %u, %u", escape_data($offset), escape_data($list_num) );
	$result = sql_query($query);
?>
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
	
	<link rel="stylesheet" href="/admin/common/css/style.css?v=2">
	<!-- fluid 960 -->
	<link rel="stylesheet" type="text/css" href="/admin/common/css/text.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/admin/common/css/layout.css" media="screen" />
	<!-- superfish menu -->
	<link rel="stylesheet" type="text/css" href="/admin/common/css/superfish.css" media="screen" />
	<!-- //jquery -->
	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> -->
	<script src="js/libs/jquery-1.5.1.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="/admin/common/js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
</head>
<body>
	<div class="container_16">
		<? include "../common/include/menu.php"; ?>
		<div id="main" role="main">
			<div class="clear"></div>
			<div class="grid_16">
				<div class="box">
					<div class="block" id="list">					
					<table cellpadding="0" cellspacing="0" border="0" class="display">
						<thead>
							<tr>
								<th>No</th>
								<th>ID</th>
								<th>Name</th>
								<th>Password</th>
							</tr>
						</thead>
						<tfoot>
							<tr >
								<th colspan="6"><? echo $page ?> page of <? echo $total_page ?> pages / total count [<? echo $total_no ?>] </th>
							</tr>
						</tfoot>
						<tbody>
							<?
							while ($array = mysql_fetch_array($result)) {
								echo "
							<tr class='odd gradeX'>
								<td>$cur_num</td>
								<td>$array[adminid]</td>
								<td>$array[name]</td>
								<td>$array[password]</td>
							</tr> ";
								$cur_num --;
							}
							?>
						</tbody>
					</table>
					</div>
				</div>				
				<div class="clear"></div>
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
</body>
</html>