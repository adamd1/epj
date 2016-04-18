<?php
/*
   bioedit1.epj
   Output of the guts of my bio database
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
$stmt="";
$css="bio.css";
$p_show="";
$p_bioyr=$_REQUEST["p_bioyr"];
$p_date=$_REQUEST["p_date"];
$p_bio_type=$_REQUEST["p_bio_type"];
$p_blab=$_REQUEST["p_blab"];
if(isset($_REQUEST["p_show"])){
	$p_show=$_REQUEST["p_show"];
}

if ($p_bioyr != '' && $p_bioyr != null && $p_date != '' && $p_date != null && $p_bio_type != '' && $p_bio_type != null && $p_blab != '' && $p_blab != null) {
	// No blanks! Goodieee!
	// Preset some values...
	$out=str_replace("\n","<br />\n",$p_blab);
		if($p_show!="n"){
			$p_show="y";
		}
	$sql="INSERT INTO my_bio SET
	section = '$p_bio_type',
	date_entered = '$p_date',
	bioyear = '$p_bioyr',
	showme = '$p_show',
	blab = '".addslashes($out)."';";
	// connect to the database
	$db = dbconnector::connect();
	$stmt="";
	//   print($bio_query);
	$stmt = $db->prepare($sql);
	$newid=0;
		try{
			// Execute
			$retVal = $stmt -> execute();
			$newid=$db->lastInsertId();
		} catch (PDOException $ex) {
			// $this->_log->logError(__METHOD__.': Exception '.$ex->getMessage());
			print($ex->getMessage());
		}
		if($newid != 0){
			$success='y';
		} else {
			$success='n';
		}
	$stmt=null;
		if ($success=='y'){
			// Successful insertion
			// print("!");
			header("Location:bio.php?p_yr=".$p_bioyr."\n\n");
		} else {
			// Unsuccessful insertion
			print("Hmph!");
		}
	} else {
		// Blanks: no goodieee
		print("Doofus: All fields are required.");
	}
?>