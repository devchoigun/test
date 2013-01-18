<?

// 1. DB 관련 변수 정리
$db_host = "localhost";
$db_user = "tuser";
$db_pass = "tuser";
$db_name = "testdb";

// 2. DB 접속 및 데이터 베이스 선택 사용자 함수
function sql_connect($db_host, $db_user, $db_pass, $db_name){
	$result = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($db_name) or die(mysql_error());
	return $result;
}

// 3. 갯수 구하는 사용자 함수
function sql_total($sql){
	global $connect;
	$result_total = mysql_query($sql, $connect);
	$data_total = mysql_fetch_array($result_total);
	$total_count = $data_total[cnt];
	return $total_count;
}

function sql_query($sql){
	global $connect;
// 	echo "sql = $sql";
	$result = @mysql_query($sql, $connect) or die("<p>$sql<p>" . mysql_errno() . " : " .  mysql_error() . "<p>error file : $_SERVER[PHP_SELF]");
	return $result;
}

// 쿼리를 실행한 후 결과값에서 한행을 구하는 함수
function sql_fetch($sql, $error=TRUE){
	$result = sql_query($sql, $error);
	$row = mysql_fetch_array($result);
	return $row;
}

// 쿼리를 실행 한 후 결과값의 목록을 배열로 구하는 함수
function sql_list($sql){
	$sql_q = sql_query($sql);
	$sql_list = array();
	while($sql_r = mysql_fetch_array($sql_q)){
		$sql_list[]= $sql_r;
	}

	return $sql_list;
}

function escape_data($data){ // START function
	global $connect; // connection
	if (get_magic_quotes_gpc()){
		$data = stripslashes($data);
	}
	return mysql_real_escape_string ($data, $connect);
} // END function




// 경고창 띄우고 이동시키는 함수
function alert($msg='', $url=''){
	if (!$msg) $msg = '올바른 방법으로 이용해 주십시오.';
	echo "<script language='javascript'>alert('$msg');";
	echo "</script>";
	if($url){
		goto_url($url);
	}else{
		echo "<script language='javascript'>history.back();";
		echo "</script>";
	}
	exit;
}

// 페이지 이동시키는 함수
function goto_url($url){
    echo "<script language='JavaScript'> location.replace('$url'); </script>";
    exit;
}

// 접근 권한 체크하는 함수 $this_level = 허용레벨
function check_level($this_level){
	if($_SERVER[user_level] >= $this_level){
		$result = true;
	}else{
		$result = false;
	}
	return $result;
}

/* getbasename function : 한글파일이 잘려서 나타나는 문제 (ex> 안녕.ppt --> .ppt) 모든 basename() 함수를 getbasename()으로 대체  */
function getbasename($path) {
	$pattern = (strncasecmp(PHP_OS, 'WIN', 3) ? '/([^\/]+)[\/]*$/' : '/([^\/\\\\]+)[\/\\\\]*$/');
	if (preg_match($pattern, $path, $matches))
		return $matches[1];
	return '';
}

// 파일 업로드 시 중복파일의 경우 새로운 이름 부여
function GetUniqFileName($fileName, $uploadPath){
	$FileExt = strtolower(substr(strrchr($fileName, "."), 1));
	$FileName = substr($fileName, 0, strlen($fileName) - strlen($FileExt) - 1);
	$resultFileName = "$FileName.$FileExt";

	while(file_exists($uploadPath.$resultFileName)){
		$FileCnt++;
		$resultFileName = $FileName."_".$FileCnt.".".$FileExt;
	}
	return($resultFileName);
}

// 파일 업로드 시 중복파일의 경우 새로운 이름 부여
function GetUniqFileName2($tmp_file){
	$tmp_file = explode(' ',microtime());			//공백을 구분하여 마이크로초와 초를 구분
	$tmp_file[0] = substr($tmp_file[0],2,6);		//마이크로초의 소수점 뒷부분부터 6자리만 이용
	$filename = $tmp_file[1].$tmp_file[0].'_'.$ext;		//$ext는 위에서 사용된 확장자 부분, $ext='jpg'
	echo $filename;						//출력: 1304148776927509_jpg
}

// 파일 업로드 시 중복파일의 경우 새로운 이름 부여
function isUploadFile($fileName, $valid_file_extensions){
	$FileExt = strtolower(substr(strrchr($fileName, "."), 1));
	return in_array($FileExt, $valid_file_extensions);
}


// 4. 페이징 사용자 함수
function paging($page, $page_row, $page_scale, $total_count, $ext = ''){
    // 4-1. 전체 페이지 계산
    $total_page  = ceil($total_count / $page_row);

    // 4-2. 페이징을 출력할 변수 초기화
    $paging_str = "<ul class='pageNavi'>";

    // 4-3. 처음 페이지 링크 만들기
    if ($page > 1) {
        $paging_str .= "<li><a href='".$_SERVER[PHP_SELF]."?page=1&'".$ext." class='edge'>처음</a></li>";
    }

    // 4-4. 페이징에 표시될 시작 페이지 구하기
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;

    // 4-5. 페이징에 표시될 마지막 페이지 구하기
    $end_page = $start_page + $page_scale - 1;
    if ($end_page >= $total_page) $end_page = $total_page;

    // 4-6. 이전 페이징 영역으로 가는 링크 만들기
    if ($start_page > 1){
        $paging_str .= "<li><a href='".$_SERVER[PHP_SELF]."?page=".($start_page - 1)."&'".$ext." class='edge'>이전</a></li>";
    }

    // 4-7. 페이지들 출력 부분 링크 만들기
    if ($total_page > 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            // 현재 페이지가 아니면 링크 걸기
            if ($page != $i){
                $paging_str .= "<li><a href='".$_SERVER[PHP_SELF]."?page=".$i."&'".$ext.">$i</a></li>";
            // 현재페이지면 굵게 표시하기
            }else{
                $paging_str .= "<li><a href='#' class='now'>$i</li>";
            }
        }
    }

    // 4-8. 다음 페이징 영역으로 가는 링크 만들기
    if ($total_page > $end_page){
        $paging_str .= "<li><a href='".$_SERVER[PHP_SELF]."?page=".($end_page + 1)."&'".$ext." class='edge'>다음</a></li>";
    }

    // 4-9. 마지막 페이지 링크 만들기
    if ($page < $total_page) {
        $paging_str .= "<li><a href='".$_SERVER[PHP_SELF]."?page=".$total_page."&'".$ext." class='edge'>맨끝</a></li>";
    }
    
    $paging_str .= "</ul>";

    return $paging_str;
}
?>