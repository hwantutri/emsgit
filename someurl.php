<?php

$dbConfig['dbServer'] = 'localhost'; 		/* Server */
$dbConfig['dbUser'] = 'root'; 				/* Username */
$dbConfig['dbPassword'] = ''; 				/* Password */
$dbConfig['dbDatabase'] = 'inventory'; 		/* Database */
					/* id column */
/* list the column names that are being sent to this script (Input variables)  the first one should be the primary key. */
/* columns array format:  $_POST['VARIABLE'] => 'DB column name' */
$myColumns =  array(
	'sid'=>'sid'
	,'sname'=>'sname'
	,'sbrand'=>'sbrand'
	,'sprice'=>'sprice'
	,'squantity'=>'squantity'
);
$myTableName = 'stock';
$postConfig['sid'] = 'sid'; 
$total = $_POST['sprice'] * $_POST['squantity'];

/*----====|| end CONFIG ||====----*/
/* jqGrid specifi settings, don;t need to be modified if using jqgrid  */
$postConfig['search'] = '_search'; 			/* search */
$postConfig['searchField'] = 'searchField'; /* searchField */
$postConfig['searchOper'] = 'searchOper'; 	/* searchOper */
$postConfig['searchStr'] = 'searchString'; 	/* searchString */
$postConfig['action'] = 'oper'; 			/* action variable */
$postConfig['sortColumn'] = 'sidx'; 		/* sort column */
$postConfig['sortOrder'] = 'sord'; 			/* sort order */
$postConfig['page'] = 'page'; 				/* current requested page */
$postConfig['limit'] = 'rows';				/* restrict number of rows to return */
$myConfig['row'] = 'cell'; 				/* row data identifier */
$myConfig['read'] = 'oper'; 				/* action READ keyword *//* set to be the same as action keyword for default */
$myConfig['create'] = 'add';				/* action CREATE keyword */
$myConfig['update'] = 'edit';				/* action UPDATE keyword */
$myConfig['delete'] = 'del';				/* action DELETE keyword */
$myConfig['totalPages'] = 'total';		/* total pages */
$myConfig['totalRecords'] = 'records';	/* total records */
$myConfig['responseSuccess'] = 'success';	/* total records */
$myConfig['responseFailure'] = 'fail';	/* total records */
/* end of jqgrid specific settings */
$o=null;

/*----====|| SETUP SEARCH CONDITION ||====----*/
function fnSearchCondition($searchOperation, $searchString){
	switch($searchOperation){
		case 'eq': $searchCondition = '= "'.$searchString.'"'; break;
		case 'ne': $searchCondition = '!= "'.$searchString.'"'; break;
		case 'bw': $searchCondition = 'LIKE "'.$searchString.'%"'; break;
		case 'ew': $searchCondition = 'LIKE "%'.$searchString.'"'; break;
		case 'cn': $searchCondition = 'LIKE "%'.$searchString.'%"'; break;
		case 'lt': $searchCondition = '< "'.$searchString.'"'; break;
		case 'gt': $searchCondition = '> "'.$searchString.'"'; break;
		case 'le': $searchCondition = '<= "'.$searchString.'"'; break;
		case 'ge': $searchCondition = '>= "'.$searchString.'"'; break;
		
	}
	return $searchCondition;
}
/*----====|| INPUT VARIABLE CLEAN FUNCTION||====----*/
/* you can replace this with a call to a clean function you prfer, or leave it as is.*/
function fnCleanInputVar($string){
	//$string = mysql_real_escape_string($string);
	return $string;
}
/*----====|| GET and CLEAN THE POST VARIABLES ||====----*/
foreach ($postConfig as $key => $value){ 
	if(isset($_REQUEST[$value])){
		$postConfig[$key] = fnCleanInputVar($_REQUEST[$value]); 
	}
}
foreach ($myColumns as $key => $value){ 
	if(isset($_REQUEST[$key])){
		$myColumnValues[$key] = '"'.fnCleanInputVar($_REQUEST[$key]).'"';
	}
}
/*----====|| INPUT VARIABLES ARE CLEAN AND CAN BE USED IN QUERIES||====----*/
/*----====|| CONNECT TO THE DB ||====----*/
$dbLink = mysql_connect($dbConfig['dbServer'], $dbConfig['dbUser'], $dbConfig['dbPassword']);
if (!$dbLink) {die('Could not connect: ' . mysql_error());}
mysql_select_db($dbConfig['dbDatabase'], $dbLink);
/*----====|| ACTION SWITCH ||====----*/

switch($postConfig['action']){
	case $myConfig['read']:
		/* ----====|| ACTION = READ ||====----*/
		/*query to count rows*/
		$sql='select count('.$postConfig['sid'].') as numRows from '.$myTableName;
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result,MYSQL_NUM);
		$count = $row[0];
		$intLimit = $postConfig['limit'];
		/*set the page count*/
		if( $count > 0 && $intLimit > 0) { $total_pages = ceil($count/$intLimit); } 
		else { $total_pages = 1; } 
		$intPage = $postConfig['page'];
		if ($intPage > $total_pages){$intPage=$total_pages;}
		$intStart = (($intPage-1) * $intLimit);
		/*Run the data query*/
		$sql = 'select * from '.$myTableName;
		if($postConfig['search'] == 'true'){
			$sql .= ' WHERE ' . $postConfig['searchField'] . ' ' . fnSearchCondition($_POST['searchOper'], $postConfig['searchStr']);
		}
		$sql .= ' ORDER BY ' . $postConfig['sortColumn'] . ' ' . $postConfig['sortOrder']; 
		$sql .= ' LIMIT '.$intStart.','.$intLimit;
		
		//if($postConfig['search'] == true){ $sql .= ' where '.$searchCondition; }
		$result = mysql_query( $sql ) 
		or die('Couldn t execute query.'.mysql_error());
		/*Create the output object*/
		$o->page = $intPage; 
		$o->total = $total_pages;
		$o->records = $count;
		$i=0;
		while($row = mysql_fetch_array($result,MYSQL_NUM)) { 
			/* 1st column needs to be the id, even if it's not named ID */
			$o->rows[$i]['sid']=$row[0];
			/* assign the row contents to a row var. */
			$o->rows[$i][$myConfig['row']]=$row;
			$i++; 
		}
		break;
	case $myConfig['create']:
		/* ----====|| ACTION = CREATE ||====----*/
		/*basic start to the insert query*/
		$new_id = $_POST['sid'];
		if($new_id==""){
		break;
		}
		else{
		$sql = 'insert into '.$myTableName.'(';
		/*add the list of columns */
		$sql .= implode(',',$myColumns);
		/*  !!! add any additional columns not defined in the column array here. */
		$sql .= ',stotal)VALUES(';
		/* add the values from POST vars */
		$sql .= implode(',',$myColumnValues);
		/*  !!! add any additional columns not defined in the column array here. */
		$sql .= ','.$total.')';
		mysql_query( $sql ) 
		or die('Couldn t execute query.'.mysql_error());
		break;
		}
	case $myConfig['update']:
		/* ----====|| ACTION = UPDATE ||====----*/
		$sql = 'update '.$myTableName.' set ';
		/* create all of the update statements */
		foreach($myColumns as $key => $value){ $updateArray[$key] = $value.'='.$myColumnValues[$key]; };
		$sql .= implode(',',$updateArray);
		/* add any additonal update statements here */
		$sql .= ', stotal='.$total.' where sid = '.$myColumnValues['sid'];
		mysql_query( $sql ) 
		or die('Couldn t execute query.'.mysql_error());
		break;
	}
print json_encode($o);
?>