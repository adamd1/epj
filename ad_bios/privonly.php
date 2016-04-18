<?php
/*
   bio.epj
   Output of the guts of my bio database
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// All the basics
   include("elements/basics.epj");
   $css="bio.css";
      if (!$p_yr){
         $p_yr = $yearout;
      }
// connect to the database
      $db = hookMeUp();

      $brthyr_query="SELECT MIN(a.bioyear) AS birthyr
                    FROM my_bio a;";
      $brthyr_result = mysql_query($brthyr_query,$db);
         if ($brthyr_rows = mysql_fetch_array($brthyr_result)){
            $temp_brthyr = $brthyr_rows["birthyr"];
         }
      mysql_free_result($brthyr_result);
      $base_query="SELECT ALL a.bio_id,a.section,a.bioyear,
                   a.date_entered,a.blab,a.showme,a.palm_posted,
                   DATE_FORMAT(a.date_entered, '%b. %D, %Y') AS outdate
                   FROM my_bio a
                   WHERE lower(a.showme) = 'n'";
      $end_query=" ORDER BY a.section ASC,
                            a.date_entered ASC;";
      $bio_query=$base_query.$end_query;
//    print($bio_query);
      $bio_result = mysql_query($bio_query,$db);
         if($bio_result) {
         $bio_count = mysql_num_rows($bio_result);
            if ($bio_count>0){
               $pagetitle="My Bio: Priv&eacute;";
// default html header with comments
               include("elements/header.epj");
               print("<body>\n");
               print("<a href=\"index.epj\">Back To The Bio Index</a><br /><br />\n\n");
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
               printf("   &#149;&nbsp;<a href=\"bioadd1.epj?p_yr=%s\">New Entry</a>\n",$bio_rows["bioyear"]);
               print("   </td>\n");
               print("   <td width=\"200\" align=\"left\">\n");
// Form containing all available years.
               include("elements/yearform.epj");
               print("   </td>\n");
               print("   <td width=\"200\" align=\"left\">\n");
// Search form
               include("elements/searchform.epj");
               print("   </td>\n");
               print("</table>\n");
               $td1="20";
               $td2="610";
               $tablewid=$td1+$td2;
               printf("   <table width=\"%s\" border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n",$tablewid);
                  while ($bio_rows = mysql_fetch_array($bio_result)) {
                     print("     <tr>\n");
                     printf("      <td width=\"%s\" align=\"center\" valign=\"top\">\n",$td1);
                     printf("      <a href=\"bioedit1.epj?p_bio_id=%s\">",$bio_rows["bio_id"]);
                     print("<img src=\"/images/dot-red.gif\" width=\"6\" height=\"6\" border=\"0\"></a>\n");
                     print("      </td>\n");
                     printf("      <td width=\"%s\" align=\"left\" valign=\"top\"",$td2);
                        if (strtolower($bio_rows["showme"])=='n'){
                           print(" style=\"background-color:rgb(40,0,0);\"");
                        }
                     print(">\n");
                        if ($bio_rows["section"] != 'biotxt') {
                           printf("      <b>%s (%s)</b><br /><br />\n\n",$bio_rows["section"],$bio_rows["bioyear"]);
                        } else {
                           printf("      <i>[%s]</i><br />\n",$bio_rows["outdate"]);
                        }
                        if ($bio_rows["palm_posted"]=='y'){
                           print("<img src=\"palm_icon.gif\" width=\"23\" height=\"33\" align=\"left\" border=\"0\" alt=\"Palm-Posted\">\n\n");
                        }
                     printf("      %s\n",$bio_rows["blab"]);
                     print("      </td>\n");
                     print("     </tr>\n");
                  }
               print("   </table><br /><br />\n");
               print("</div>\n");
               include("elements/footers.epj");
            } else {
               print("Hm... nothing found.... ?!?!?!?!<br />\n");
            }
            mysql_free_result($bio_result);
         }
// Close the db connection
      closeMeUp($db);
?>
