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

			var aTrs = oTable.fnGetNodes();
			for ( var i=0 ; i<aTrs.length ; i++ )
			{
			         if(jQuery('input:checked', aTrs[i]).val()){
			              oTable.fnDeleteRow(aTrs[i]);
			     }
			}
		}


		$(document).ready(function() {
			// dataTable
			var uTable = $('#gridTable').dataTable( {
				"bProcessing": true
				, "bPaginate": true //페이징 기능 사용 여부
				, "sPaginationType": "full_numbers"
				, "bLengthChange" : true //페이지 갯수 보이기 안보이기
				, "bFilter": false	//상단 검색기능 false : 사용안함, true : 사용, default : true
				, "bAutoWidth": false // false : 자동 조절, true : 고정 , default : true
				//, "bInfo": false // [하단 현재페이지, 총 카운트 등 정보] false : 안씀, true : 씀 , default : true
				, "bSort": true
				, "bJQueryUI": true
				, "bServerSide": true
				, "sAjaxSource": "ajax.php"
            			, "aoColumnDefs": [
            			                   { "sTitle": "seq", "sName": "seq", "asSorting": [ "desc" ], "sWidth": "40px", "aTargets": [ 0 ]},
            			                   { "sTitle": "title", "sName": "title", "aTargets": [ 1 ] , "sDefaultContent": "Edit" ,"bSortable": false},
            			                   { "sTitle": "name", "sName": "name", "sWidth": "100px", "aTargets": [ 2 ]  ,"bSortable": false},
            			                   { "sTitle": "hit", "sName": "count",  "sWidth": "40px", "aTargets": [ 3 ]  ,"bSortable": false},
            			                   { "sTitle": "regdate", "sName": "regdate",  "sWidth": "80px", "aTargets": [ 4 ]  ,"bSortable": false, "sClass": "center"}, //, "sType ":"date" , string, numeric , default html
            			                   { "sTitle": "delete", "sName": "delete",  "sWidth": "60px", "aTargets": [ 5 ]  ,"bSortable": false, "sClass": "center"}
            			                 ]
            			, "iDisplayLength": 10 //초기 페이지 갯수 설정
            			//, "iDisplayStart": 10
            			//, "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            			    //return iStart +" to "+ iEnd;
            			//  }
			  	, "oLanguage": {
				        "sEmptyTable": "No data available in table"
				       , "sLoadingRecords": "Please wait - loading..."
				       , "sZeroRecords": "No records to display" 
				    }
			    /*
			  	, "oTableTools": {
		                	"sRowSelect": "multi",
		                	"aButtons": [
		                    		{"sExtends": "ajax", "sButtonText":"Delete", "sAjaxUrl": "/dataTable/deleteMDR"}
		                		]
		            	}
        			*/
			} );
			
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
						    <tbody>
						      <tr>
						        <td>loading...</td>
						      </tr>
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