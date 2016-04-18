<?php
/*
   bioedit1.php
   Bring a bio blurb into editable forms.
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
$css="bio.css";
$p_bio_id=$_REQUEST["p_bio_id"];
$bio_query="SELECT ALL a.bio_id,a.section,a.bioyear,a.date_entered,a.blab,a.showme FROM my_bio a WHERE a.bio_id = '".$p_bio_id."';";
// connect to the database
$db = dbconnector::connect();
$stmt="";
$success='y';
	//   print($bio_query);
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
	if($row_count>0){
		$pagetitle="My Bio: Edit";
	// default html header with comments
		include("elements/header.php");
		print("<body>\n");
		print("<a href=\"index.php\">Back To The Bio Index</a><br /><br />\n\n");
		print("<div align=\"center\">\n\n");
		print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
		print("  <tr>\n");
		print("   <td width=\"200\" align=\"left\">My Bio: Admin</td>\n");
		print("   <td width=\"200\" align=\"right\">Edit</span>\n");
		print("   </td>\n");
		print("  </tr>\n");
		print("</table><br /><br />\n\n");
		print("<table border=\"0\">\n");
		print("  <tr>\n");
		print("   <td width=\"120\" align=\"left\" valign=\"top\">\n");
	// Form containing all available years.
	//         include("elements/yearform.php");
		print("   </td>\n");
		print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
		print("   <table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n");
			foreach($rows as $row) {
				print("     <tr>\n");
				print("      <td width=\"420\" align=\"left\" valign=\"top\">\n");
				print("      <form action=\"bioedit2.php\" method=\"post\">\n");
				print("      <i>Priv?</i> <input type=\"checkbox\" name=\"p_show\" value=\"n\"");
					if($row["showme"]=='n'){
						print(" checked");
					}
				print("><br /><br />\n\n");
				printf("      <input type=\"hidden\" name=\"p_bio_id\" value=\"%s\">\n",$row["bio_id"]);
				printf("      <input type=\"hidden\" name=\"p_bioyr\" value=\"%s\">\n",$row["bioyear"]);
				
				printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_date\" value=\"%s\" maxlength=\"100\"><br />\n",$row["date_entered"]);
					if ($row["section"] != 'biotxt') {
						printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_bio_type\" value=\"%s\" maxlength=\"100\">\n",$row["section"]);
					} else {
						printf("      <input type=\"hidden\" name=\"p_bio_type\" value=\"%s\"><br />\n",$row["section"]);
					}
				printf("      <textarea name=\"p_blab\" rows=\"15\" cols=\"85\">%s</textarea><br /><br />\n",$row["blab"]);
				print("      <div align=\"center\"><input type=\"submit\" name=\"p_send\" value=\"Update\">&nbsp;&nbsp;\n");
				print("      <input type=\"reset\" value=\"Start Over\"></div>\n");
				print("      </form>\n");
				print("      </td>\n");
				print("     </tr>\n");
			}
		print("   </table><br /><br />\n");
		print("   </td>\n");
		print("  </tr>\n");
		print("</table>\n");
		print("</div>\n");
		include("elements/footers.php");
	} else {
		print("Hm... nothing found.... ?!?!?!?!<br />\n");
	}
?>