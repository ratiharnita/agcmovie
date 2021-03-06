<?php
function query($sql) {
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$query_id = 0;
        $affected_rows = 0;
	$query_id = @mysqli_query($db,$sql);

	if (!$query_id) {
		echo "<b>Query fail:</b> ".mysqli_error($db);
		return 0;
	}
	
	$affected_rows = @mysqli_affected_rows($db);

	return $query_id;
        mysqli_close($db);
}

function query_insert($table, $data) {
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	$q="INSERT INTO `".$table."` ";
	$v=''; $n='';

	foreach($data as $key=>$val) {
		$n.="`$key`, ";
		if(strtolower($val)=='null') $v.="NULL, ";
		elseif(strtolower($val)=='now()') $v.="NOW(), ";
		else $v.= "'".escape($val)."', ";
	}

	$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";

	if(query($q)){
		return mysqli_insert_id($db);
	}
	else return false;
        mysqli_close($db);
}

function options_update( $where='', $data ) {
	$q="UPDATE `oc_options` SET ";

	foreach($data as $key=>$val) {
		if(strtolower($val)=='null') $q.= "`$key` = NULL, ";
		elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
		else $q.= "`$key`='".escape($val)."', ";
	}

	$q = rtrim($q, ', ') . ' WHERE option_name = "'.$where.'"';

	return query($q);
}

function query_update($table, $data, $where='1') {
	$q="UPDATE `".$table."` SET ";

	foreach($data as $key=>$val) {
		if(strtolower($val)=='null') $q.= "`$key` = NULL, ";
		elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
		else $q.= "`$key`='".escape($val)."', ";
	}

	$q = rtrim($q, ', ') . ' WHERE '.$where.';';

	return query($q);
}