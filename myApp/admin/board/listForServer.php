<?
	include "../../config/lib.php";
	
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	*/
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	*/
	$aColumns = array( "seq", "title", "name", "count", "regdate" );
	$aColumns2 = array( "seq", "title", "name", "count", "DATE_FORMAT(regdate, '%Y-%m-%d') as regdate" );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "seq";
	
	/* DB table to use */
	$sTable = "bbs";
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	* no need to edit below this line
	*/
	
	/*
	 * MySQL connection
	*/
	$connect = sql_connect($db_host, $db_user, $db_pass, $db_name);
	
	/*
	 * Paging
	*/
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ){
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	/*
	 * Ordering
	*/
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) ) {
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ) {
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ) {
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
	
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" ){
			$sOrder = "";
		}
	}
	
	
	/*
	 * Filtering
	* NOTE this does not match the built-in DataTables filtering which does it
	* word by word on any field. It's possible to do here, but concerned about efficiency
	* on very large tables, and MySQL's regex functionality is very limited
	*/
	$sWhere = "";
	if ( $_GET['sSearch'] != "" ) {
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ) {
			if ( $sWhere == "" ) {
				$sWhere = "WHERE ";
			} else {
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	
	
	/*
	 * SQL queries
	* Get data to display
	*/	
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	
	$rResult = sql_query($sQuery);
	
	/* Data set length after filtering */
	$sQuery = "SELECT FOUND_ROWS() AS cnt";
	$iFilteredTotal = sql_total($sQuery);
	
	/* Total data set length */
	$sQuery = sprintf("SELECT COUNT($sIndexColumn) AS cnt FROM $sTable");
	$iTotal = sql_total($sQuery);
	
	
	/*
	 * Output
	 */
	$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			//"sColumns" => $aColumns,
			"aaData" => array()
	);
	
	while ( $aRow = mysql_fetch_array( $rResult ) ) {
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ ) {
			//if ( $aColumns[$i] == "version" ) {
				/* Special output formatting for 'version' column */
			//	$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			//} else if ( $aColumns[$i] != ' ' ) {
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			//}
		}
		$output['aaData'][] = $row;
	}
	echo json_encode( $output );
	
?>