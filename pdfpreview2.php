<?php

  include ('./pdfclass/class.ezpdf.php');
  include_once 'database.php';
  $db = new Database();
  
  $status = $_POST['statusselect'];

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
  
  if($status=='AVAILABLE'){
  $result = mysql_query("SELECT * from workload where wstatus='$status'");
  while($row=mysql_fetch_object($result)) {
	$data[$row->wid]['ID']=$row->wid;
	$data[$row->wid]['DESCRIPTION']=$row->wdescription;
	$data[$row->wid]['CLIENT']=$row->wclient;
	$data[$row->wid]['DATE AND TIME']=$row->wtime;
	$data[$row->wid]['TOTAL']='';
  }
  }
  else if($status=='ASSIGNED'){
  $result = mysql_query("SELECT workload.wid as id, workload.wdescription as descr, workload.wclient as client,
						workload.wtime as time, assignment.crew_id as assigned FROM workload, assignment
						WHERE workload.wstatus='$status' and workload.wid=assignment.assignment_id");
  while($row=mysql_fetch_object($result)) {
	$data[$row->id]['ID']=$row->id;
	$data[$row->id]['DESCRIPTION']=$row->descr;
	$data[$row->id]['CLIENT']=$row->client;
	$data[$row->id]['DATE AND TIME']=$row->time;
	$data[$row->id]['ASSIGNED TO']=$row->assigned;
	$data[$row->id]['TOTAL']='';
  }
  }
  else if($status=='all'){
  $result = mysql_query("SELECT workload.wid as id, workload.wdescription as descr, workload.wclient as client,
						workload.wtime as time from workload");
  while($row=mysql_fetch_object($result)) {
	$data[$row->id]['ID']=$row->id;
	$data[$row->id]['DESCRIPTION']=$row->descr;
	$data[$row->id]['CLIENT']=$row->client;
	$data[$row->id]['DATE AND TIME']=$row->time;
	$data[$row->id]['TOTAL']='';
  }
  }
  
  $data['']['ID'] = '';
  $data['TOTAL']['ID'] = 'TOTAL';
  
	$search = mysql_query("select cname from crew where cid='$id'");
	while($row = mysql_fetch_object($search)){
		$name = $row->cname;
	}
  
    $pdf->ezText('<b>WORKLOAD REPORT</b>',12,$center);
    $pdf->ezText('',12);
    $pdf->ezText('',12);
	$pdf->ezText('',12);

  //Get the sum of the last column named 'Total'
  $coltotal = 0; 
  $totalwork = mysql_num_rows($result);
    $data['TOTAL']['TOTAL']=$totalwork;

  $pdf->ezTable($data,"","",array('width'=>600,
                                  'cols'=>array('TOTAL'=>array('justification'=>right))));
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