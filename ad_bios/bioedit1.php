<?php
/*
   bioedit1.epj
   Bring a bio blurb into editable forms.
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// All the basics
   include("elements/basics.epj");
   $css="bio.css";
   $bio_query="SELECT ALL a.bio_id,a.section,a.bioyear,
              a.date_entered,a.blab,a.showme
              FROM my_bio a
              WHERE a.bio_id = $p_bio_id;";
// connect to the database
      $db = mysql_connect(g_dbhost, g_dbusr, g_dbpass);
// choose the correct database
      mysql_select_db(g_dbname,$db);
//   print($bio_query);
   $bio_result = mysql_query($bio_query,$db);
   $bio_count = mysql_num_rows($bio_result);
      if ($bio_count>0){
         $pagetitle="My Bio: Edit";
// default html header with comments
         include("elements/header.epj");
         print("<body>\n");
         print("<a href=\"index.epj\">Back To The Bio Index</a><br /><br />\n\n");
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
//         include("elements/yearform.epj");
         print("   </td>\n");
         print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
         print("   <table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n");
            while($bio_rows = mysql_fetch_array($bio_result)) {
               print("     <tr>\n");
               print("      <td width=\"420\" align=\"left\" valign=\"top\">\n");
               print("      <form action=\"bioedit2.epj\" method=\"post\">\n");
               print("      <i>Priv?</i> <input type=\"checkbox\" name=\"p_show\" value=\"n\"");
                  if($bio_rows["showme"]=='n'){
                     print(" checked");
                  }
               print("><br /><br />\n\n");
               printf("      <input type=\"hidden\" name=\"p_bio_id\" value=\"%s\">\n",$bio_rows["bio_id"]);
               printf("      <input type=\"hidden\" name=\"p_bioyr\" value=\"%s\">\n",$bio_rows["bioyear"]);
               
               printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_date\" value=\"%s\" maxlength=\"100\"><br />\n",$bio_rows["date_entered"]);
                  if ($bio_rows["section"] != 'biotxt') {
                     printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_bio_type\" value=\"%s\" maxlength=\"100\">\n",$bio_rows["section"]);
                  } else {
                     printf("      <input type=\"hidden\" name=\"p_bio_type\" value=\"%s\"><br />\n",$bio_rows["section"]);
                  }
               printf("      <textarea name=\"p_blab\" rows=\"15\" cols=\"85\">%s</textarea><br /><br />\n",$bio_rows["blab"]);
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
         include("elements/footers.epj");
      } else {
         print("Hm... nothing found.... ?!?!?!?!<br />\n");
      }
   mysql_free_result($bio_result);
   mysql_close($db);
?>