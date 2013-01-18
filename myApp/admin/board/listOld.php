<?
	include "../../config/lib.php";
	
	//DB에 연결하는 부분입니다. 항상 반복되는 부분이니 꼭 암기!!!
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	 
	//게시판 목록보기에 필요한 각종 변수 초기값을 설정합니다.
	$tablename="bbs"; //테이블 이름
	
	if($page == '') $page = 1; //페이지 번호가 없으면 1
	$list_num = 10; //한 페이지에 보여줄 목록 갯수
	$page_num = 10; //한 화면에 보여줄 페이지 링크(묶음) 갯수
	$offset = $list_num*($page-1); //한 페이지의 시작 글 번호(listnum 수만큼 나누었을 때 시작하는 글의 번호)
	 
	//전체 글 수를 구합니다. (쿼리문을 사용하여 결과를 배열로 저장하는 일반적 인 방법)
	$query = sprintf("SELECT COUNT(seq) AS cnt FROM $tablename"); // SQL 쿼리문을 문자열 변수에 일단 저장하고
	$total_no = sql_total($query); //배열의 첫번째 요소의 값, 즉 테이블의 전체 글 수를 저장합니다.
	 
	//전체 페이지 수와 현재 글 번호를 구합니다.
	$total_page=ceil($total_no/$list_num); // 전체글수를 페이지당글수로 나눈 값의 올림 값을 구합니다.
	$cur_num=$total_no - $list_num*($page-1); //현재 글번호
	
	$paging_str = paging($page, $list_num, $page_num, $total_no, $tablename);
	 
	//bbs테이블에서 목록을 가져옵니다. (위의 쿼리문 사용예와 비슷합니다 .)
	$query="select seq, title, name, count, DATE_FORMAT(regdate, '%Y/%m/%d') as regdate from $tablename order by seq desc limit $offset, $list_num"; // SQL 쿼리문
	$result = mysql_query($query) or die (mysql_error()); // 쿼리문을 실행 결과
	//쿼리 결과를 하나씩 불러와 실제 HTML에 나타내는 것은 HTML 문 중간에 삽입합니다.
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
	
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="stylesheet" href="/admin/common/css/style.css?v=2">
	
	<!-- fluid 960 -->
	<link rel="stylesheet" type="text/css" href="/admin/common/css/text.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/admin/common/css/layout.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/admin/common/css/grid.css" media="screen" />
	<!-- superfish menu -->
	<link rel="stylesheet" type="text/css" href="/admin/common/css/superfish.css" media="screen" />
	<!-- dataTable css -->
	<link rel="stylesheet" href="/admin/common/css/demo_table_jui.css">

	<!-- //jqueryUI css -->
	<link type="text/css" href="/admin/common/css/custom-theme/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
	<!-- //jquery -->
	<script src="/admin/common/js/libs/jquery-1.5.1.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="/admin/common/js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<!-- //jqueryUI -->
	<script type="text/javascript" src="/admin/common/js/jquery-ui-1.8.13.custom.min.js"></script>
	<!-- dataTable -->
	<script src="/admin/common/js/jquery.dataTables.min.js"></script>
	
	<script language="javascript">
		function fn_del(param) {
			var frm = document.form;
			frm.number.value = param;
			if(confirm("삭제하시겠습니까")){
				frm.action = "delete_ok.php";
				frm.submit();
			}
		}

		function eventFired(){
			alert("custom event");
		}

		$(document).ready(function() {
			// dataTable
			var uTable = $('#gridTable').dataTable( {
				"bPaginate": true
				, "bLengthChange": true
				, "bFilter": false
				, "bSort": false
				, "bInfo": true
				, "bAutoWidth": false
				, "bJQueryUI": true
				, "sPaginationType": "full_numbers"
				, "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
				//, "aoColumnDefs": [{ "bVisible": false, "aTargets": [2] }]  //set hidden colums
				//, "sDom": '<"toolbar">frtip'
			} );
			
		}); 
		
		
		$(function(){
			
			
			/* Add events */
			$('#gridTable tbody tr').live('click', function () {
				var nTds = $('td', this);
				var seqNo = $(nTds[1]).text();
				alert(sGrade); 
			});

			//$("div.toolbar").html('<B>Custom tool bar! Text/images etc.</B>'); 
		});
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
						<table cellpadding="0" cellspacing="0" border="0" class="display" id="gridTable">
							<form name="form" method="post">
							<input type="hidden" name="number" value="" />
							<cption></cption>
							<colgroup>
								<col width="40px"/>
								<col width="40px"/>
								<col />
								<col width="100px" />
								<col width="60px" />
								<col width="150px" />
								<col width="60px" />
							</colgroup>
							<thead>
								<tr>
									<th>no</th>
									<th>seq</th>
									<th>title</th>
									<th>name</th>
									<th>hit</th>
									<th>date</th>
									<th>delete</th>
								</tr>
							</thead>
							<tbody>
								<?
								while ($array = mysql_fetch_array($result)) {
								echo "
								<tr class='odd gradeX'>
									<td>$cur_num</td>
									<td>$array[seq]</td>
									<td align='left'>$array[title]</td>
									<td>$array[name]</td>
									<td>$array[count]</td>
									<td>$array[regdate]</td>
									<td><input type='button' value='삭제' onclick='fn_del($array[seq])' ></td>
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