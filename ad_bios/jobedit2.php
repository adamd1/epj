<?php
/*
   jobedit2.epj
   Post job entry edits to the db.
   Coded Jan. 18th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// All the basics
   include("elements/basics.epj");
   $css="bio.css";
   IF ($p_jobid != '' && $p_jobid != null
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
      $db = mysql_connect(g_dbhost, g_dbusr, g_dbpass);
// choose the correct database
      mysql_select_db(g_dbname,$db);
//   print($job_query);
      $job_result = mysql_query($job_query,$db);
      mysql_close($db);
      header("Location: ".$basepath."ad_bios/jobs.epj?p_jobid=".$p_jobid."\n\n");
   } ELSE {
// Unsuccessful
      print("Doofus: All fields are required.");
   }
//   mysql_free_result($job_result);
?>