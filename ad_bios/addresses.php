<?php
/*
   addresses.php
   Output of all the addresses at which I've lived
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
   Last updated: June 4th, 2005
   Lots of code fixes. More streamlined db access...
*/

// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__."/data/DBConnector.php";
$css="bio.css";
$js="js/adbios.js";
$pagetitle="My Addresses";
$leeway=15;
// default html header with comments
include("elements/header.php");
// connect to the database
$db = dbconnector::connect();
$stmt="";
$p_addid="";
	if(isset($_REQUEST["p_addid"]) && $_REQUEST["p_addid"]!=""){
		$p_addid=$_REQUEST["p_addid"];
	}
?>
<body>
<a href="index.php">Back To The Bio Index</a><br /><br />
<div align="center">
<table width="400" border="0" cellspacing="0" cellpadding="3" class="title">
  <tr>
   <td width="200" align="left" valign="top">The addresses of my life...</td>
   <td width="200" align="right" valign="top">How geek-anal-retentive is this?</td>
  </tr>
</table><br /><br />
<?php
   if($p_addid==""){
			print("<table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\">\n");
			print("     <tr>\n");
			print("      <td width=\"520\" align=\"left\" valign=\"top\" class=\"blurb\">For those who care, those who don't, and - well - those who have just been having a hard time tracking me down over the years: Here's the complete list of addresses I've lived at in my life.</td>\n");
			print("     </tr>\n");
			print("   </table><br />\n\n");
			$sql = "SELECT add_id,from_date,to_date,street,city,
			stprv,country,postcode,phone,notes,
			roommates,
			DATE_FORMAT(from_date, '%m-%d-%Y') AS fmtfromdt,
			DATE_FORMAT(to_date, '%m-%d-%Y') AS fmttodt
			from my_addresses
			order by from_date desc;";
			// Prepare
			$stmt = $db->prepare($sql);
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
   				$temp_counter = $row_count;
         print("<table border=\"0\" width=\"465\" cellpadding=\"5\" ");
         print("cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n");
               foreach($rows as $row) {
                  print("  <tr>\n");
                  print("   <td width=\"15\" align=\"right\" valign=\"top\">");
                  printf("%s.</a></td>\n",$temp_counter);
                  print("   <td width=\"250\" align=\"left\" valign=\"top\">\n");
                  printf("   <a href=\"addresses.php?p_addid=%s\">",$row["add_id"]);
                  printf("%s</a><br />\n",$row["street"]);
                  printf("   %s, %s\n",$row["city"],$row["stprv"]);
                  print("   </td>\n");
                  print("   <td width=\"250\" align=\"right\" valign=\"top\">\n");
                  printf("   [%s - ",$row["fmtfromdt"]);
                     if ($row["to_date"] != '' || $row["fmttodt"] != NULL){
                        printf("%s",$row["fmttodt"]);
                     } else {
                        print("Present");
                     }
                  print("]\n");
                  printf("   <a href=\"addredit1.php?p_addid=%s\" title=\"[Edit]\">&#149;</a>\n",$row["add_id"]);
                  print("   </td>\n");
                  print("  </tr>\n");
               $temp_counter--;
               }
         print("</table>\n");
         $stmt=null;
      }
   } else {
			print("<a href=\"addresses.php\">Back To The Address Listings</a><br /><br />\n\n");
			$sql="SELECT ALL a.add_id,a.from_date,a.to_date,a.street,
			a.city,a.stprv,a.country,a.postcode,a.phone,a.notes,
			a.roommates,a.map_url,a.photo_url,a.photo_wid,a.photo_ht,
			DATE_FORMAT(a.from_date, '%b. %Y') AS fmtfromdt,
			DATE_FORMAT(a.to_date, '%b. %Y') AS fmttodt
			FROM my_addresses a
			WHERE (a.add_id = $p_addid)
			LIMIT 1;";
			// Prepare
			$stmt = $db->prepare($sql);
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
            print("<table border=\"0\" width=\"450\" cellpadding=\"3\" ");
            print("cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\" style=\"border: 1px red solid\">\n");
               foreach($rows as $row) {
                  print("  <tr>\n");
                  print("   <td width=\"450\" align=\"right\" valign=\"top\">\n");
                  printf("   [%s - ",$row["fmtfromdt"]);
                     if ($row["to_date"] != '' || $row["fmttodt"] != NULL){
                        printf("%s",$row["fmttodt"]);
                     } else {
                        print("Present");
                     }
                  print("]<br />\n");
                  printf("   <a href=\"addredit1.php?p_addid=%s\">%s</a><br />\n",$row["add_id"],$row["street"]);
                  printf("   %s, %s<br />\n",$row["city"],$row["stprv"]);
                  printf("   %s<br />\n",$row["country"]);
                  printf("   %s<br />\n",$row["postcode"]);
                  printf("   %s",$row["phone"]);
// Google Maps...
                  $mapaddress=urlencode($row["street"]." ".$row["city"].", ".$row["stprv"]." ".$row["country"]." ".$row["postcode"]);
                  print("<br>\n&#149;&nbsp;<a href=\"https://www.google.ca/maps/search/".$mapaddress."\">Google Map</a>");
// Map image...
                     if($row["map_url"]<>""){
                        print("<br>\n&#149;&nbsp;<a href=\"javascript:openCustomWin('".$row["map_url"]."','370','260','40','200','bioMap','0');\">View Map</a>");
                     }
// Photo...
                     if($row["photo_url"]<>""){
                        print("<br>\n&#149;&nbsp;<a href=\"javascript:openCustomWin('".$row["photo_url"]."','".($row["photo_wid"]+$leeway)."','".($row["photo_ht"]+$leeway)."','40','200','bioMap','0');\">View Photo</a>");
                     }
                  print("   </td>\n");
                  print("  </tr>\n");
                  print("  <tr>\n");
                  print("   <td width=\"450\" align=\"left\" valign=\"top\">\n");
                  printf("   %s<br /><br />\n\n",$row["notes"]);
                     if ($row["roommates"] != '' || $row["roommates"] != NULL){
                        print("   <b>Roommates:</b><br />\n");
                        printf("   %s\n",$row["roommates"]);
                     }
                  print("   </td>\n");
                  print("  </tr>\n");
               }
            print("</table><br /><br />\n\n");
         }
      }
   print("</div>\n");
   include("elements/footers.php");
?>