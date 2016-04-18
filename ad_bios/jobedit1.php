<?php
/*
   jobedit1.epj
   Bring a job entry into editable forms.
   Coded Jan. 18th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// All the basics
   include("elements/basics.epj");
   $css="bio.css";

   $job_query="SELECT ALL a.job_id,a.from_date,a.to_date,a.jobtitle,a.company,
               a.comp_type,a.street,a.city,a.stprv,a.country,
               a.postcode,a.notes,a.co_workers,
               DATE_FORMAT(a.from_date, '%b. %Y') AS fmtfromdt,
               DATE_FORMAT(a.to_date, '%b. %Y') AS fmttodt
               FROM my_jobs a
               WHERE (a.job_id = $p_jobid)
               LIMIT 1;";
// connect to the database
   $db = mysql_connect(g_dbhost, g_dbusr, g_dbpass);
// choose the correct database
   mysql_select_db(g_dbname,$db);
//   print($job_query);
   $job_result = mysql_query($job_query,$db);
   $pagetitle="My Job: Edit";
// default html header with comments
   include("elements/header.epj");
   print("<body>\n");
   print("<a href=\"jobs.epj\">Back To The Jobs Index</a><br /><br />\n\n");
   print("<div align=\"center\">\n\n");
   print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
   print("  <tr>\n");
   print("   <td width=\"200\" align=\"left\">My Jobs: Admin</td>\n");
   print("   <td width=\"200\" align=\"right\">Edit</span>\n");
   print("   </td>\n");
   print("  </tr>\n");
   print("</table><br /><br />\n\n");
      IF ($job_result){
         $job_count = mysql_num_rows($job_result);
         print("<table border=\"0\">\n");
         print("  <tr>\n");
         print("   <td width=\"120\" align=\"left\" valign=\"top\">\n");
// Form containing all available years.
//         include("elements/yearform.epj");
         print("   </td>\n");
         print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
         print("   <td width=\"440\" align=\"left\" valign=\"top\" class=\"blurb\">\n");
            WHILE($job_rows = mysql_fetch_array($job_result)) {
               print("      <form action=\"jobedit2.epj\" method=\"post\">\n");
               printf("      <input type=\"hidden\" name=\"p_jobid\" value=\"%s\">\n",$job_rows["job_id"]);
               print("      <b>From:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_frmdate\" value=\"%s\" maxlength=\"150\"><br />\n",$job_rows["from_date"]);
               print("      <b>Until:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_todate\" value=\"%s\" maxlength=\"100\"><br />\n",$job_rows["to_date"]);
               print("      <b>Job Title:</b><br />\n");
               printf("      <textarea name=\"p_jobttl\" rows=\"6\" cols=\"50\">%s</textarea><br /><br />\n",$job_rows["jobtitle"]);
               print("      <b>Company:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_comp\" value=\"%s\" maxlength=\"100\"><br />\n",$job_rows["company"]);
               print("      <b>Company Type:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_comptype\" value=\"%s\" maxlength=\"100\"><br />\n",$job_rows["comp_type"]);
               print("      <b>Street:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_street\" value=\"%s\" maxlength=\"100\"><br />\n",$job_rows["street"]);
               print("      <b>City:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_city\" value=\"%s\" maxlength=\"100\"><br />\n",$job_rows["city"]);
               print("      <b>Prov. / State:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_stprv\" value=\"%s\" maxlength=\"100\"><br />\n",$job_rows["stprv"]);
               print("      <b>Country:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_cntry\" value=\"%s\" maxlength=\"100\"><br />\n",$job_rows["country"]);
               print("      <b>Zip:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_code\" value=\"%s\" maxlength=\"100\"><br />\n",$job_rows["postcode"]);
               print("      <b>Notes:</b><br />\n");
               printf("      <textarea name=\"p_notes\" rows=\"15\" cols=\"85\">%s</textarea><br /><br />\n",$job_rows["notes"]);
               print("      <b>Co-Workers:</b><br />\n");
               printf("      <textarea name=\"p_cowork\" rows=\"4\" cols=\"85\">%s</textarea><br /><br />\n",$job_rows["co_workers"]);
               print("      <div align=\"center\"><input type=\"submit\" name=\"p_send\" value=\"Update\">&nbsp;&nbsp;\n");
               print("      <input type=\"reset\" value=\"Start Over\"></div>\n");
               print("      </form>\n");
            }
         print("   </td>\n");
         print("  </tr>\n");
         print("</table>\n");
         mysql_free_result($job_result);
      } else {
         print("Hm... nothing found.... ?!?!?!?!<br />\n");
      }
   print("</div>\n");
   include("elements/footers.epj");
   mysql_close($db);
?>