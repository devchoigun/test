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
	<link rel="stylesheet" href="common/css/style.css?v=2">
	<!-- fluid 960 -->
	<link rel="stylesheet" type="text/css" href="common/css/text.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="common/css/layout.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="common/css/grid.css" media="screen" />
	<!-- superfish menu -->
	<link rel="stylesheet" type="text/css" href="common/css/superfish.css" media="screen" />
	<!-- tags css -->
	<link rel="stylesheet" href="common/css/jquery.tagsinput.css">
	<!-- treeview css -->
	<link rel="stylesheet" href="common/css/jquery.treeview.css">
	<!-- dataTable css -->
	<link rel="stylesheet" href="common/css/demo_table_jui.css">


	<!-- fluid GS -->
	<link rel="stylesheet" type="text/css" href="common/css/fluid.gs.css" media="screen" />
	<!--[if lt IE 8 ]>
	<link rel="stylesheet" type="text/css" href="css/fluid.gs.lt_ie8.css" media="screen" />
	<![endif]-->

	<!-- //jqueryUI css -->
	<link type="text/css" href="common/css/custom-theme/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
	
	<!-- //jquery -->
	<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> -->
	<script src="js/libs/jquery-1.5.1.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="common/js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<!-- //jqueryUI -->
	<script type="text/javascript" src="common/js/jquery-ui-1.8.13.custom.min.js"></script>
	<script type="text/javascript" src="common/js/jquery-fluid16.js"></script>
	<script src="common/js/plugins.js"></script>
	<script src="common/js/script.js"></script>
	
	<!-- //xoxco tags plugin https://github.com/xoxco/jQuery-Tags-Input -->
	<script src="common/js/jquery.tagsinput.min.js"></script>
	<link rel="stylesheet" href="common/css/jquery.tagsinput.css">
	
	<!--[if lt IE 7 ]>
	<script src="js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
	<!-- modernizr -->
	<script src="common/js/libs/modernizr-1.7.min.js"></script>
	
	<!-- superfish menu and needed js for menu -->
	<script src="common/js/superfish.js"></script>
	<script src="common/js/supersubs.js"></script>
	<script src="common/js/hoverIntent.js"></script>

	<!-- treeview -->
	<script src="common/js/jquery.treeview.js"></script>
	
	<!-- dataTable -->
	<script src="common/js/jquery.dataTables.min.js"></script>


	<script type="text/javascript">
		$(function(){

			
			//treeview for inner menus
			$("#browser").treeview({
				toggle: function() {
					console.log("%s was toggled.", $(this).find(">span").text());
				}
			});
			
			// menu superfish
			$('#navigationTop').superfish();
			
			// tags
			$("#tags_input").tagsInput();
			
			// dataTable
			var uTable = $('#example').dataTable( {
				"sScrollY": 200,
				"bJQueryUI": true,
				"sPaginationType": "full_numbers"
			} );
			$(window).bind('resize', function () {
				uTable.fnAdjustColumnSizing();
			} );
			

			// Accordion
			$("#accordion").accordion({ header: "h3" });

			// Accordion2
			$("#accordion2").accordion({ header: "h3" });

			// Tabs
			$('#tabs').tabs();


			// Dialog			
			$('#dialog').dialog({
				autoOpen: false,
				width: 600,
				buttons: {
					"Ok": function() { 
						$(this).dialog("close"); 
					}, 
					"Cancel": function() { 
						$(this).dialog("close"); 
					} 
				}
			});
			
			// Dialog Link
			$('#dialog_link').click(function(){
				$('#dialog').dialog('open');
				return false;
			});

			// Datepicker
			$('#datepicker').datepicker({
				inline: true
			});
			
			// Slider
			$('#slider').slider({
				range: true,
				values: [17, 67]
			});
			
			// Progressbar
			$("#progressbar").progressbar({
				value: 20 
			});
			
			//hover states on the static widgets
			$('#dialog_link, ul#icons li').hover(
				function() { $(this).addClass('ui-state-hover'); }, 
				function() { $(this).removeClass('ui-state-hover'); }
			);
			
		});
	</script>

</head>
<body>
	<div class="container_16">
		<header>
			<div class="grid_16">
					<a href="#">ADMIN</a>
			</div>
			<div class="clear"></div>
			<div class="grid_16">
				<ul class="sf-menu" id="navigationTop">
					<li class="selected">
						<a href="index.html">user manage</a>
						<ul>
							<li><a href="#">admin user</a></li>
							<li><a href="/admin/member/mem_list.php">site user</a></li>
						</ul>
					</li>
					<li>
						<a href="#">board manage</a>
						<ul>
							<li><a href="#">news & notice</a></li>
							<li><a href="#">board</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</header>
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