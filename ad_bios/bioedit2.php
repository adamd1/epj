<?php
/*
   bioedit2.php
   Post bio edits to the db.
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
   $css="bio.css";
$p_bio_id=$_REQUEST["p_bio_id"];
$p_date=$_REQUEST["p_date"];
$p_bio_type=$_REQUEST["p_bio_type"];
$p_blab=$_REQUEST["p_blab"];
$p_bioyr=$_REQUEST["p_bioyr"];

   if ($p_bio_id != '' && $p_bio_id != null
       && $p_date != '' && $p_date != null
       && $p_bio_type != '' && $p_bio_type != null
       && $p_blab != '' && $p_blab != null
       && $p_bioyr != '' && $p_bioyr != null) {
// Successful
      $out=ereg_replace ("\n","<br />\n",$p_blab);
      // $out=$p_blab;
         if($p_show!="n"){
            $p_show="y";
         }
      $bio_query="UPDATE my_bio SET
                 section = '".$p_bio_type."',
                 date_entered = '".$p_date."',
                 showme = '".$p_show."',
                 blab = '".$out."'
                 WHERE (bio_id = ".$p_bio_id.");";
// connect to the database
      $db = dbconnector::connect();
      $stmt="";
      $stmt = $db->prepare($sql);
		try{
			// Execute
			$retVal = $stmt -> execute();
			$newid=$db->lastInsertId();
      header("Location: ".$basepath."ad_bios/bio.php?p_yr=".$p_bioyr."\n\n");
		} catch (PDOException $ex) {
			// $this->_log->logError(__METHOD__.': Exception '.$ex->getMessage());
			print($ex->getMessage());
		}
   $stmt=null;
   } else {
// Unsuccessful
      print("Doofus: All fields are required.");
   }
//   mysql_free_result($bio_result);
?>