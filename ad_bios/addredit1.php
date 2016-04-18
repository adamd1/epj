<?php
/*
   addredit1.php
   Bring an address entry into editable forms.
   Coded Jan. 17th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// All the basics
   include("elements/basics.php");
   $css="bio.css";
   $add_query="SELECT ALL a.add_id,a.from_date,a.to_date,a.street,
               a.city,a.stprv,a.country,a.postcode,a.phone,a.notes,
               a.roommates,
               DATE_FORMAT(a.from_date, '%b. %Y') AS fmtfromdt,
               DATE_FORMAT(a.to_date, '%b. %Y') AS fmttodt
               FROM my_addresses a
               WHERE (a.add_id = $p_addid)
               LIMIT 1;";
// connect to the database
   $db = mysql_connect(g_dbhost, g_dbusr, g_dbpass);
// choose the correct database
   mysql_select_db(g_dbname,$db);
//   print($add_query);
   $add_result = mysql_query($add_query,$db);
   $add_count = mysql_num_rows($add_result);
      if ($add_rows = mysql_fetch_array($add_result)){
         $pagetitle="My Bio: Edit An Address";
// default html header with comments
         include("elements/header.php");
         print("<body>\n");
         print("<a href=\"addresses.php\">Back To The Adress Index</a><br /><br />\n\n");
         print("<div align=\"center\">\n\n");
         print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
         print("  <tr>\n");
         print("   <td width=\"200\" align=\"left\">My Bio: Addresses</td>\n");
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
         print("   <td width=\"440\" align=\"left\" valign=\"top\" class=\"blurb\">\n");
            while ($add_rows = mysql_fetch_array($add_result)) {
               print("      <form action=\"addredit2.php\" method=\"post\">\n");
               printf("      <input type=\"hidden\" name=\"p_addid\" value=\"%s\">\n",$add_rows["add_id"]);
               print("      <b>From:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_frmdate\" value=\"%s\" maxlength=\"150\"><br />\n",$add_rows["from_date"]);
               print("      <b>Until:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_todate\" value=\"%s\" maxlength=\"100\"><br />\n",$add_rows["to_date"]);
               print("      <b>Street:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_street\" value=\"%s\" maxlength=\"100\"><br />\n",$add_rows["street"]);
               print("      <b>City:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_city\" value=\"%s\" maxlength=\"100\"><br />\n",$add_rows["city"]);
               print("      <b>Prov. / State:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_stprv\" value=\"%s\" maxlength=\"100\"><br />\n",$add_rows["stprv"]);
               print("      <b>Country:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_cntry\" value=\"%s\" maxlength=\"100\"><br />\n",$add_rows["country"]);
               print("      <b>Zip:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_code\" value=\"%s\" maxlength=\"100\"><br />\n",$add_rows["postcode"]);
               print("      <b>Phone:</b><br />\n");
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_phone\" value=\"%s\" maxlength=\"100\"><br />\n",$add_rows["phone"]);
               print("      <b>Notes:</b><br />\n");
               printf("      <textarea name=\"p_notes\" rows=\"15\" cols=\"85\">%s</textarea><br /><br />\n",$add_rows["notes"]);
               print("      <b>Roommates:</b><br />\n");
               printf("      <textarea name=\"p_rmmate\" rows=\"4\" cols=\"85\">%s</textarea><br /><br />\n",$add_rows["roommates"]);
               print("      <div align=\"center\"><input type=\"submit\" name=\"p_send\" value=\"Update\">&nbsp;&nbsp;\n");
               print("      <input type=\"reset\" value=\"Start Over\"></div>\n");
               print("      </form>\n");
            }
         print("   </td>\n");
         print("  </tr>\n");
         print("</table>\n");
         print("</div>\n");
         include("elements/footers.php");
      } else {
         print("Hm... nothing found.... ?!?!?!?!<br />\n");
      }
   mysql_free_result($add_result);
   mysql_close($db);
?>