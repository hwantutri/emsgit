<?php

  include ('./pdfclass/class.ezpdf.php');
  include_once 'database.php';
  $db = new Database();
  
  $id = $_POST['crewid2'];
  $date = $_POST['new_date2'];
  
  //Create PDF instance
  $pdf = new Cezpdf($paper='FOLIO',$orientation='landscape');
  $pdf->ezSetmargins(60,80,40,40);
  $pdf->selectFont('../pdfclass/fonts/Helvetica.afm');

  $center = array('','','','justification'=>'center');

  $pdf->ezText('<b>MAGNUM - Computer Sales and Services </b>',12,$center);
 // $pdf->ezText('Computer Sales and Services',12,$center);
  $pdf->ezText('Iligan City, Philippines',12,$center);
  $pdf->ezText('',12);
  $pdf->ezText('',12);
  $pdf->ezText('',12);
  $pdf->ezText('',12);
  
  $result = mysql_query("SELECT workload.wdescription AS name, workload.wtime AS time, workload.wclient AS client
					FROM assignment, workload
					WHERE assignment.crew_id = '$id'
					AND workload.wtime like '%$date%'
					AND assignment.assignment_id = workload.wid");
  while($row=mysql_fetch_object($result)) {
	$data[$row->name]['DESCRIPTION']=$row->name;
	$data[$row->name]['CLIENT']=$row->client;
	$data[$row->name]['DATE AND TIME']=$row->time;
	$data[$row->name]['TOTAL TRANSACTIONS']='';
  }
  
  $data['']['DESCRIPTION'] = '';
  $data['TOTAL TRANSACTIONS']['DESCRIPTION'] = 'TOTAL TRANSACTIONS';
  
	$search = mysql_query("select cname from crew where cid='$id'");
	while($row = mysql_fetch_object($search)){
		$name = $row->cname;
	}
  
    $pdf->ezText('<b>WORKLOAD REPORT</b>',12,$center);
    $pdf->ezText('',12);
    $pdf->ezText('',12);
	$pdf->ezText('',12);
	$pdf->ezText('                                     <b>ID NO.</b>	: '. $id .'',12);
	$pdf->ezText('                                     <b>NAME</b>		: '. $name .'',12);
	$pdf->ezText('',12);
    $pdf->ezText('',12);

  //Get the sum of the last column named 'Total'
  $coltotal = 0; 
  $result = mysql_query("select assignment.crew_id as id from assignment, workload where assignment.crew_id='$id' AND workload.wtime like '%$date%' AND assignment.assignment_id = workload.wid");
  $totalwork = mysql_num_rows($result);
    $data['TOTAL TRANSACTIONS']['TOTAL TRANSACTIONS']=$totalwork;

  $pdf->ezTable($data,"","",array('width'=>600,
                                  'cols'=>array('TOTAL TRANSACTIONS'=>array('justification'=>right))));
 // $pdf->ezText('',12);
 // $pdf->ezText('',12);
 // $pdf->ezText('',12);
 // $pdf->ezText('',12);
 // $pdf->ezText('Certified true and correct:',12);
 // $pdf->ezText('',12);
 // $pdf->ezText('',12);
 // $pdf->ezText('_________________________________',12);
 // $pdf->ezText(' (Signature above printed name)',10);

  $pdf->ezStream();

?>