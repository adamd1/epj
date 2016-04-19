<?php
/*
   jobedit2.epj
   Post job entry edits to the db.
   Coded Jan. 18th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
   $css="bio.css";
   $p_jobid=$_REQUEST["p_jobid"];
   $p_frmdate=$_REQUEST["p_frmdate"];
   $p_jobttl=$_REQUEST["p_jobttl"];
   $p_comp=$_REQUEST["p_comp"];
   $p_city=$_REQUEST["p_city"];
   $p_stprv=$_REQUEST["p_stprv"];
   $p_cntry=$_REQUEST["p_cntry"];
   if ($p_jobid != '' && $p_jobid != null
       && $p_frmdate != '' && $p_frmdate != null
       && $p_jobttl != '' && $p_jobttl != null
       && $p_comp != '' && $p_comp != null
       && $p_city != '' && $p_city != null
       && $p_stprv != '' && $p_stprv != null
       && $p_cntry != '' && $p_cntry != null) {
// Successful
      $job_query="UPDATE my_jobs SET
                  from_date = '$p_frmdate',
                  to_date = '$p_todate',
                  jobtitle = '$p_jobttl',
                  company = '$p_comp',
                  comp_type = '$p_comptype',
                  street = '$p_street',
                  city = '$p_city',
                  stprv = '$p_stprv',
                  country = '$p_cntry',
                  postcode = '$p_code',
                  notes = '$p_notes',
                  co_workers = '$p_cowork'
                  WHERE (job_id = $p_jobid);";
	// connect to the database
	$db = dbconnector::connect();
	$stmt="";
	$stmt = $db->prepare($sql);
	$success=0;
	
		try{
			// Execute
			$retVal = $stmt -> execute();
			$success=1;
		} catch (PDOException $ex) {
			// $this->_log->logError(__METHOD__.': Exception '.$ex->getMessage());
			print($ex->getMessage());
		}
			if($success==1){
	      header("Location: ".$basepath."ad_bios/jobs.epj?p_jobid=".$p_jobid."\n\n");
	    } else {
				// Unsuccessful
	      print("Doofus: Empty fields!!");
			}
   } else {
// Unsuccessful
      print("Doofus: All fields are required.");
   }
?>