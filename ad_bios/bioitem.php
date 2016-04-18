<?php
/*
   bioitem.epj
   Output of the an individual bio entry
   Coded Sep. 24th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// All the basics
   include("elements/basics.epj");
   $css="bio.css";
// connect to the database
      $db = mysql_connect(g_dbhost, g_dbusr, g_dbpass);
// choose the correct database
      mysql_select_db(g_dbname,$db);
// Quickly grab the birthyear
      $brthyr_query="SELECT MIN(a.bioyear) AS birthyr
                    FROM my_bio a;";
      $brthyr_result = mysql_query($brthyr_query,$db);
         IF ($brthyr_rows = mysql_fetch_array($brthyr_result)){
            $temp_brthyr = $brthyr_rows["birthyr"];
         }
      mysql_free_result($brthyr_result);
// The search query
      $bio_query="SELECT ALL a.bio_id,a.section,a.bioyear,
                  a.date_entered,a.blab
                  FROM my_bio a
                  WHERE a.bio_id=$p_bio_id
                  LIMIT 1;";
//    print($bio_query);
      $bio_result = mysql_query($bio_query,$db);
      $bio_count = mysql_num_rows($bio_result);
         IF ($bio_rows = mysql_fetch_array($bio_result)){
            $pagetitle="My Bio:";
// default html header with comments
            include("elements/header.epj");
            print("<body>\n");
            print("<a href=\"index.epj\">Back To The Bio Index</a><br /><br />\n\n");
            print("<div align=\"center\">\n\n");
            $age = ($bio_rows["bioyear"]-$temp_brthyr);
               IF ($age == 0){
                  $age = 'Birth';
               }
            print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
            print("  <tr>\n");
            print("   <td width=\"200\" align=\"left\">My Bio: ");
            print("<a href=\"bio.epj");
            printf("?p_yr=%s\">",$bio_rows["bioyear"]);
            printf("%s</a></td>\n",$bio_rows["bioyear"]);
            printf("   <td width=\"200\" align=\"right\">(%s)</span>\n",$age);
            print("   </td>\n");
            print("  </tr>\n");
            print("</table><br /><br />\n\n");
            print("<table border=\"0\">\n");
            print("  <tr>\n");
            print("   <td width=\"120\" align=\"left\" valign=\"top\" class=\"blurb\">\n");
// Form containing all available years.
            include("elements/yearform.epj");
// Search form
            include("elements/searchform.epj");
            printf("   &#149;&nbsp;<a href=\"bioadd1.epj?p_yr=%s\">New Entry</a>\n",$bio_rows["bioyear"]);
            print("   </td>\n");
            print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
            print("   <table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n");
               DO {
                  print("     <tr>\n");
                  print("      <td width=\"20\" align=\"center\" valign=\"top\">\n");
                  printf("      <a href=\"bioedit1.epj?p_bio_id=%s\">",$bio_rows["bio_id"]);
                  print("<img src=\"/images/dot-red.gif\" width=\"6\" height=\"6\" border=\"0\"></a>\n");
                  print("      </td>\n");
                  print("      <td width=\"420\" align=\"left\" valign=\"top\">\n");
                     IF ($bio_rows["section"] != 'biotxt') {
                        printf("      <b>%s (%s)</b><br /><br />\n\n",$bio_rows["section"],$bio_rows["bioyear"]);
                     }
                     IF($p_term!='' && $p_term!=NULL){
                        $terms=explode(" ",$p_term);
                        $term_count=count($terms);
// If there was only one word, just use the original search term
                           IF ($term_count==1){
                              $output=eregi_replace($p_term,"<b style=\"background-color:#990000;\">\\0</b>",$bio_rows["blab"]);
                           } ELSE {
// If there was more than one word, highlight each individual word
                              $output=$bio_rows["blab"];
                              FOR($i=0;$i<$term_count;$i++){
                                 $output=eregi_replace($terms[$i],"<b style=\"background-color:#990000;\">\\0</b>",$output);
                              }
                           }
                     } ELSE {
                        $output=$bio_rows["blab"];
                     }
                  printf("      %s\n",$output);
                  print("      </td>\n");
                  print("     </tr>\n");
               }
               WHILE ($bio_rows = mysql_fetch_array($bio_result));
            print("   </table><br /><br />\n");
            print("   </td>\n");
            print("  </tr>\n");
            print("</table>\n");
            print("</div>\n");
            include("elements/footers.epj");
         } ELSE {
            print("Hm... nothing found.... ?!?!?!?!<br />\n");
         }
      mysql_free_result($bio_result);
      mysql_close($db);
?>
