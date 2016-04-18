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
   $terms=explode(" ",$p_term);
   $term_count=count($terms);
      IF($term_count>1){
         $qryterm="+".$p_term;
      } ELSE {
         $qryterm=$p_term;
      }
// connect to the database
   $db = mysql_connect(g_dbhost, g_dbusr, g_dbpass);
// choose the correct database
   mysql_select_db(g_dbname,$db);
// The search query
   $srch_query="SELECT a.bio_id,MATCH (a.blab)
                AGAINST ('$qryterm') score,
                a.bio_id,DATE_FORMAT(a.date_entered,'%b. %c %Y %l:%i%p') outdate,
                left(a.blab,178) outblab,a.bioyear
                FROM my_bio a
                WHERE MATCH (a.blab)
                AGAINST ('$qryterm')
                GROUP BY score DESC
                ORDER BY score DESC;";
//    print($bio_query);
   $srch_result = mysql_query($srch_query,$db);
   $srch_count = mysql_num_rows($srch_result);
   $terms=explode(" ",$p_term);
   $term_count=count($terms);
   IF ($srch_rows = mysql_fetch_array($srch_result)){
      $pagetitle="My Bio: Search: ".$p_term;
// default html header with comments
      include("elements/header.epj");
      print("<body>\n");
      print("<a href=\"index.epj\">Back To The Bio Index</a><br /><br />\n\n");
      print("<div align=\"center\">\n\n");
      print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
      print("  <tr>\n");
      printf("   <td width=\"200\" align=\"left\">My Bio: Search</td>\n");
      printf("   <td width=\"200\" align=\"right\"><i>%s</i></span></td>\n",$p_term);
      print("  </tr>\n");
      print("</table><br /><br />\n\n");
      print("<table border=\"0\">\n");
      print("  <tr>\n");
      print("   <td width=\"120\" align=\"left\" valign=\"top\" class=\"blurb\">\n");
// Form containing all available years.
      include("elements/yearform.epj");
// Search form
      include("elements/searchform.epj");
      printf("   &#149;&nbsp;<a href=\"bioadd1.epj?p_yr=%s\">New Entry</a>\n",$yearout);
      print("   </td>\n");
      print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
      printf("   <div align=\"center\"><b>%s entr",$srch_count);
      IF($srch_count>1){
         print("ies");
      } ELSE {
         print("y");
      }
      print(" matched your search</b></div><br /><br />\n");
      print("   <table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n");
      DO {

// If there was only one word, just use the original search term
         IF ($term_count==1){
            $output=eregi_replace($p_term,"<b style=\"background-color:#990000;\">\\0</b>",$srch_rows["outblab"]);
         } ELSE {
 // If there was more than one word, highlight each individual word
            $output=$srch_rows["outblab"];
            FOR($i=0;$i<$term_count;$i++){
               $output=eregi_replace($terms[$i],"<b style=\"background-color:#990000;\">\\0</b>",$output);
            }
         }

         print("     <tr>\n");
         print("      <td width=\"20\" align=\"center\" valign=\"top\">\n");
         printf("      <img src=\"/images/dot-red.gif\" width=\"6\" height=\"6\" border=\"0\">\n");
         print("      </td>\n");
         print("      <td width=\"330\" align=\"left\" valign=\"top\">\n");
         printf("<a href=\"bioitem.epj?p_bio_id=%s",$srch_rows["bio_id"]);
         printf("&p_term=%s\">",$p_term);
//                  printf("%s</a> ",$srch_rows["outdate"]);
         printf("%s</a> ",$srch_rows["bioyear"]);
         printf("(%s&#037;)<br />",NUMBER_FORMAT(($srch_rows["score"]*10),2,'.',','));
         printf("      <i>%s...</i><br /><br />\n",$output);
         print("      </td>\n");
         print("     </tr>\n");
      }
      WHILE ($srch_rows = mysql_fetch_array($srch_result));
      print("   </table><br /><br />\n");
      print("   </td>\n");
      print("  </tr>\n");
      print("</table>\n");
      print("</div>\n");
      include("elements/footers.epj");
   } ELSE {
      $pagetitle="My Bio: Search: No Results";
// default html header with comments
      include("elements/header.epj");
      print("<body>\n");
      print("<a href=\"index.epj\">Back To The Bio Index</a><br /><br />\n\n");
      print("<div align=\"center\">\n\n");
      print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
      print("  <tr>\n");
      printf("   <td width=\"200\" align=\"left\">My Bio: Search</td>\n");
      printf("   <td width=\"200\" align=\"right\"><i>%s</i></span></td>\n",$p_term);
      print("  </tr>\n");
      print("</table><br /><br />\n\n");
      print("<table border=\"0\">\n");
      print("  <tr>\n");
      print("   <td width=\"120\" align=\"left\" valign=\"top\" class=\"blurb\">\n");
// Form containing all available years.
      include("elements/yearform.epj");
// Search form
      include("elements/searchform.epj");
      printf("   &#149;&nbsp;<a href=\"bioadd1.epj?p_yr=%s\">New Entry</a>\n",$yearout);
      print("   </td>\n");
      print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
      printf("   <div align=\"center\"><b>No entries matched your search</b></div><br /><br />\n");
      print("   </td>\n");
      print("  </tr>\n");
      print("</table>\n");
      print("</div>\n");
      include("elements/footers.epj");
   }
   mysql_free_result($srch_result);
   mysql_close($db);
?>
