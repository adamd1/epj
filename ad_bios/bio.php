<?php
/*
   bio.php
   Output of the guts of my bio database
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
   // Last Modified: 6/28/2014 12:41:06 PM
   // Completely re-coded using more modern php and mysql implementation.
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
$css="bio.css";
$p_yr="";
	if(isset($_REQUEST["p_yr"]) && $_REQUEST["p_yr"]!=""){
		$p_yr=$_REQUEST["p_yr"];
	} else {
		$p_yr=$yearout;
	}

$pri="";
	if(isset($_GET["pri"]) && $_GET["pri"]!=""){
		$pri=$_GET["pri"];
	}
// connect to the database
$db = dbconnector::connect();
$stmt="";
$sqla="select min(bioyear) birthyr from my_bio;";

$stmt = $db->prepare($sqla);
// Execute
$retVal = $stmt -> execute();
// Row count...
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rs1 = $db->query('SELECT FOUND_ROWS()');
$row_count = (int) $rs1->fetchColumn();
// If row count > 0, do stuff...
$stmt = null;
$ctr=0;
	if($row_count>0){
		$arrResp["status"]=1;
		$arrResp["message"]="Found data.";
			foreach($rows as $row) {
				$temp_brthyr = $row["birthyr"];
			}
	} else {
		$arrResp["status"]=0;
		$arrResp["message"]="No data found";
		$temp_brthyr="";
	}
$rows=null;$row=null;
$base_query="select bio_id,section,bioyear,
date_entered,blab,showme,palm_posted,
DATE_FORMAT(date_entered, '%b. %D') outdate
from my_bio
where bioyear = ".$p_yr;
$nosho_query=" and lower(showme) != 'n'";
$end_query=" order by section asc,date_entered asc;";
	if ($pri != 'y'){
		$bio_query=$base_query.$nosho_query.$end_query;
	} else {
		$bio_query=$base_query.$end_query;
	}
// print($bio_query);

$stmt = $db->prepare($bio_query);
// Execute
$retVal = $stmt -> execute();
// Row count...
$rows3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rs1 = $db->query('SELECT FOUND_ROWS()');
$row_count = (int) $rs1->fetchColumn();
// If row count > 0, do stuff...
$stmt = null;
$ctr=0;
	if($row_count>0){
		$pagetitle="My Bio: ".$p_yr;
// default html header with comments
		include("elements/header.php");
		print("<body>\n");
		print("<a href=\"index.php\">Back To The Bio Index</a><br /><br />\n\n");
		print("<div align=\"center\">\n\n");
		$age = ($p_yr-$temp_brthyr);
			if ($age == 0){
				$age = 'Birth';
			}
		print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
		print("  <tr>\n");
		printf("   <td width=\"200\" align=\"left\">My Bio: %s</td>\n",$p_yr);
		printf("   <td width=\"200\" align=\"right\">(%s)</span>\n",$age);
		print("   </td>\n");
		print("  </tr>\n");
		print("</table><br /><br />\n\n");
		print("<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
		print("  <tr valign=\"top\">\n");
		print("   <td width=\"200\" align=\"left\" class=\"blurb\">\n");
// Add new entry
		printf("   &#149;&nbsp;<a href=\"bioadd1.php?p_yr=%s\">New Entry</a>\n",$p_yr);
		print("   </td>\n");
		print("   <td width=\"200\" align=\"left\">\n");
		// Form containing all available years.
		include("elements/yearform.php");
		print("   </td>\n");
		print("   <td width=\"200\" align=\"left\">\n");
		// Search form
		include("elements/searchform.php");
		print("   </td>\n");
		print("</table>\n");
		$td1="20";
		$td2="610";
		$tablewid=$td1+$td2;
		printf("   <table width=\"%s\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n",$tablewid);
			foreach($rows3 as $row) {
				print("     <tr>\n");
				printf("      <td width=\"%s\" align=\"center\" valign=\"top\">\n",$td1);
				printf("      <a href=\"bioedit1.php?p_bio_id=%s\">",$row["bio_id"]);
				print("<img src=\"/images/dot-red.gif\" width=\"6\" height=\"6\" border=\"0\"></a>\n");
				print("      </td>\n");
				printf("      <td width=\"%s\" align=\"left\" valign=\"top\"",$td2);
					if (strtolower($row["showme"])=='n'){
						print(" style=\"background-color:rgb(40,0,0);\"");
					}
				print(">\n");
					if ($row["section"] != 'biotxt') {
						printf("      <b>%s (%s)</b><br /><br />\n\n",$row["section"],$row["bioyear"]);
					} else {
						printf("      <i>[%s]</i><br />\n",$row["outdate"]);
					}
					if ($row["palm_posted"]=='y'){
						print("<img src=\"palm_icon.gif\" width=\"23\" height=\"33\" align=\"left\" border=\"0\" alt=\"Palm-Posted\">\n\n");
					}
				printf("      %s\n",$row["blab"]);
				print("      </td>\n");
				print("     </tr>\n");
			}
		print("   </table><br /><br />\n");
		print("</div>\n");
		include("elements/footers.php");
	} else {
		$pagetitle="My Bio: ".$p_yr;
		// default html header with comments
		include("elements/header.php");
		print("<body>\n");
		print("<div align=\"center\">\n\n");
		$age = ($p_yr-$temp_brthyr);
			if ($age == 0){
				$age = 'Birth';
			}
		print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
		print("  <tr>\n");
		printf("   <td width=\"200\" align=\"left\">My Bio: %s</td>\n",$p_yr);
		printf("   <td width=\"200\" align=\"right\">(%s)</span>\n",$age);
		print("   </td>\n");
		print("  </tr>\n");
		print("</table><br /><br />\n\n");
		print("<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
		print("  <tr valign=\"top\">\n");
		print("   <td width=\"200\" align=\"left\" class=\"blurb\">\n");
// Add new entry
		printf("   &#149;&nbsp;<a href=\"bioadd1.php?p_yr=%s\">New Entry</a>\n",$p_yr);
		print("   </td>\n");
		print("   <td width=\"200\" align=\"left\">\n");
// Form containing all available years.
		include("elements/yearform.php");
		print("   </td>\n");
		print("   <td width=\"200\" align=\"left\">\n");
// Search form
		include("elements/searchform.php");
		print("   </td>\n");
		print("</table>\n");
		print("<br /><br />\n\nNo bio records found for the current year. Please add a new record using the link above.<br /><br /><br />\n\n\n");
		print("</div>\n");
		include("elements/footers.php");
	}
?>
