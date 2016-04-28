<?php
/*
   bio.php
   Output of the guts of my bio database
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
$p_yr=$_REQUEST["p_yr"];

   $css="bio.css";
      if (!$p_yr){
         $p_yr = $yearout;
      }
// connect to the database
$db = dbconnector::connect();

      $brthyr_query="SELECT MIN(a.bioyear) AS birthyr
                    FROM my_bio a;";

			// Prepare
			$stmt = $db->prepare($brthyr_query);
			// Execute
			$retVal = $stmt -> execute();
			// Row count...
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$rs1 = $db->query('SELECT FOUND_ROWS()');
			$row_count = (int) $rs1->fetchColumn();
			// If row count > 0, do stuff...
			$stmt = null;
			$ctr=0;
         if ($row_count>0){
         		foreach($rows as $row) {
               $temp_brthyr = $row["birthyr"];
            }
         }
      $base_query="SELECT ALL a.bio_id,a.section,a.bioyear,
                   a.date_entered,a.blab,a.showme,a.palm_posted,
                   DATE_FORMAT(a.date_entered, '%b. %D, %Y') AS outdate
                   FROM my_bio a
                   WHERE lower(a.showme) = 'n'";
      $end_query=" ORDER BY a.section ASC,
                            a.date_entered ASC;";
      $bio_query=$base_query.$end_query;
//    print($bio_query);

			// Prepare
			$stmt = $db->prepare($bio_query);
			// Execute
			$retVal = $stmt -> execute();
			// Row count...
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$rs1 = $db->query('SELECT FOUND_ROWS()');
			$row_count = (int) $rs1->fetchColumn();
			// If row count > 0, do stuff...
			$stmt = null;
			$ctr=0;
         if($row_count>0) {
         $bio_count = $row_count;
            if ($bio_count>0){
               $pagetitle="My Bio: Priv&eacute;";
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
               print("   <td width=\"200\" align=\"left\">My Bio: Priv&eacute;</td>\n");
               print("   <td width=\"200\" align=\"right\">(Priv&eacute; only)</span>\n");
               print("   </td>\n");
               print("  </tr>\n");
               print("</table><br /><br />\n\n");
               print("<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
               print("  <tr valign=\"top\">\n");
               print("   <td width=\"200\" align=\"left\" class=\"blurb\">\n");
// Add new entry
               printf("   &#149;&nbsp;<a href=\"bioadd1.php?p_yr=%s\">New Entry</a>\n",$bio_rows["bioyear"]);
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
                  foreach($rows as $row) {
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
               print("Hm... nothing found.... ?!?!?!?!<br />\n");
            }
         }
?>