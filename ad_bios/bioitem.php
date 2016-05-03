<?php
/*
   bioitem.php
   Output of the an individual bio entry
   Coded Sep. 24th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
$p_yr=$_REQUEST["p_yr"];
$p_bio_id=$_REQUEST["p_bio_id"];
  if ($p_yr==""){
     $p_yr = $yearout;
  }
// No blanks
  if ($p_bio_id==""){
     $p_bio_id = 1;
  }
$css="bio.css";
// connect to the database
$db = dbconnector::connect();
// Quickly grab the birthyear
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

// The search query
      $bio_query="SELECT ALL a.bio_id,a.section,a.bioyear,
                  a.date_entered,a.blab
                  FROM my_bio a
                  WHERE a.bio_id=$p_bio_id
                  LIMIT 1;";
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
         if ($row_count>0){
            $pagetitle="My Bio:";
// default html header with comments
            include("elements/header.php");
            print("<body>\n");
            print("<a href=\"index.php\">Back To The Bio Index</a><br /><br />\n\n");
            print("<div align=\"center\">\n\n");
            $age = ($bio_rows["bioyear"]-$temp_brthyr);
               if ($age == 0){
                  $age = 'Birth';
               }
            print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
            print("  <tr>\n");
            print("   <td width=\"200\" align=\"left\">My Bio: ");
            print("<a href=\"bio.php");
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
            include("elements/yearform.php");
// Search form
            include("elements/searchform.php");
            printf("   &#149;&nbsp;<a href=\"bioadd1.php?p_yr=%s\">New Entry</a>\n",$bio_rows["bioyear"]); // Needs fixing. :/
            print("   </td>\n");
            print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
            print("   <table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n");
               foreach($rows as $row) {
                  print("     <tr>\n");
                  print("      <td width=\"20\" align=\"center\" valign=\"top\">\n");
                  printf("      <a href=\"bioedit1.php?p_bio_id=%s\">",$row["bio_id"]);
                  print("<img src=\"/images/dot-red.gif\" width=\"6\" height=\"6\" border=\"0\"></a>\n");
                  print("      </td>\n");
                  print("      <td width=\"420\" align=\"left\" valign=\"top\">\n");
                     if ($row["section"] != 'biotxt') {
                        printf("      <b>%s (%s)</b><br /><br />\n\n",$row["section"],$row["bioyear"]);
                     }
                     if($p_term!='' && $p_term!=NULL){
                        $terms=explode(" ",$p_term);
                        $term_count=count($terms);
// If there was only one word, just use the original search term
                           if ($term_count==1){
                              $output=eregi_replace($p_term,"<b style=\"background-color:#990000;\">\\0</b>",$row["blab"]);
                           } else {
// If there was more than one word, highlight each individual word
                              $output=$row["blab"];
                              for($i=0;$i<$term_count;$i++){
                                 $output=eregi_replace($terms[$i],"<b style=\"background-color:#990000;\">\\0</b>",$output);
                              }
                           }
                     } else {
                        $output=$row["blab"];
                     }
                  printf("      %s\n",$output);
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