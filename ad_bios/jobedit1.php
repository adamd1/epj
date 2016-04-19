<?php
/*
   jobedit1.php
   Bring a job entry into editable forms.
   Coded Jan. 18th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
   $css="bio.css";
   $p_jobid="";
   	if(isset($_REQUEST["p_jobid"]) && $_REQUEST["p_jobid"]!=""){
   		$p_jobid=$_REQUEST["p_jobid"];
   	}
   $job_query="SELECT ALL a.job_id,a.from_date,a.to_date,a.jobtitle,a.company,
               a.comp_type,a.street,a.city,a.stprv,a.country,
               a.postcode,a.notes,a.co_workers,
               DATE_FORMAT(a.from_date, '%b. %Y') AS fmtfromdt,
               DATE_FORMAT(a.to_date, '%b. %Y') AS fmttodt
               FROM my_jobs a
               WHERE (a.job_id = $p_jobid)
               LIMIT 1;";

// connect to the database
$db = dbconnector::connect();
//   print($job_query);
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
   $pagetitle="My Job: Edit";
// default html header with comments
   include("elements/header.php");
   print("<body>\n");
   print("<a href=\"jobs.php\">Back To The Jobs Index</a><br /><br />\n\n");
   print("<div align=\"center\">\n\n");
   print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
   print("  <tr>\n");
   print("   <td width=\"200\" align=\"left\">My Jobs: Admin</td>\n");
   print("   <td width=\"200\" align=\"right\">Edit</span>\n");
   print("   </td>\n");
   print("  </tr>\n");
   print("</table><br /><br />\n\n");
      if($row_count>0){
         $job_count = mysql_num_rows($job_result);
         print("<table border=\"0\">\n");
         print("  <tr>\n");
         print("   <td width=\"120\" align=\"left\" valign=\"top\">\n");
// Form containing all available years.
//         include("elements/yearform.php");
         print("   </td>\n");
         print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
         print("   <td width=\"440\" align=\"left\" valign=\"top\" class=\"blurb\">\n");
            foreach($rows as $row) {
               print("      <form action=\"jobedit2.php\" method=\"post\">\n");
               printf("      <input type=\"hidden\" name=\"p_jobid\" value=\"%s\">\n",$row["job_id"]);
               print("      <b>From:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_frmdate\" value=\"%s\" maxlength=\"150\"><br />\n",$row["from_date"]);
               print("      <b>Until:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_todate\" value=\"%s\" maxlength=\"100\"><br />\n",$row["to_date"]);
               print("      <b>Job Title:</b><br />\n");
               printf("      <textarea name=\"p_jobttl\" rows=\"6\" cols=\"50\">%s</textarea><br /><br />\n",$row["jobtitle"]);
               print("      <b>Company:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_comp\" value=\"%s\" maxlength=\"100\"><br />\n",$row["company"]);
               print("      <b>Company Type:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_comptype\" value=\"%s\" maxlength=\"100\"><br />\n",$row["comp_type"]);
               print("      <b>Street:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_street\" value=\"%s\" maxlength=\"100\"><br />\n",$row["street"]);
               print("      <b>City:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_city\" value=\"%s\" maxlength=\"100\"><br />\n",$row["city"]);
               print("      <b>Prov. / State:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_stprv\" value=\"%s\" maxlength=\"100\"><br />\n",$row["stprv"]);
               print("      <b>Country:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_cntry\" value=\"%s\" maxlength=\"100\"><br />\n",$row["country"]);
               print("      <b>Zip:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_code\" value=\"%s\" maxlength=\"100\"><br />\n",$row["postcode"]);
               print("      <b>Notes:</b><br />\n");
               printf("      <textarea name=\"p_notes\" rows=\"15\" cols=\"85\">%s</textarea><br /><br />\n",$row["notes"]);
               print("      <b>Co-Workers:</b><br />\n");
               printf("      <textarea name=\"p_cowork\" rows=\"4\" cols=\"85\">%s</textarea><br /><br />\n",$row["co_workers"]);
               print("      <div align=\"center\"><input type=\"submit\" name=\"p_send\" value=\"Update\">&nbsp;&nbsp;\n");
               print("      <input type=\"reset\" value=\"Start Over\"></div>\n");
               print("      </form>\n");
            }
         print("   </td>\n");
         print("  </tr>\n");
         print("</table>\n");
      } else {
         print("Hm... nothing found.... ?!?!?!?!<br />\n");
      }
   print("</div>\n");
   include("elements/footers.php");
   mysql_close($db);
?>