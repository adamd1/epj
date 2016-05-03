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
$stmt="";
$terms="";
$term_count=0;
$css="bio.css";
	if(isset($_REQUEST["p_term"]) && trim($_REQUEST["p_term"])!=""){
		$p_term=$_REQUEST["p_term"];
		$terms=explode(" ",$p_term);
		$term_count=count($terms);
	}
	if($term_count>1){
		$qryterm="+".$p_term;
	} else {
		$qryterm=$p_term;
	}
// connect to the database
$db = dbconnector::connect();
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
// Prepare
$stmt = $db->prepare($srch_query);
// Execute
$retVal = $stmt -> execute();
// Row count...
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rs1 = $db->query('SELECT FOUND_ROWS()');
$row_count = (int) $rs1->fetchColumn();
$stmt = null;
$ctr=0;
$terms=explode(" ",$p_term);
$term_count=count($terms);
   if ($row_count>0){
      $pagetitle="My Bio: Search: ".$p_term;
// default html header with comments
      include("elements/header.php");
      print("<body>\n");
      print("<a href=\"index.php\">Back To The Bio Index</a><br /><br />\n\n");
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
      include("elements/yearform.php");
// Search form
      include("elements/searchform.php");
      printf("   &#149;&nbsp;<a href=\"bioadd1.php?p_yr=%s\">New Entry</a>\n",$yearout);
      print("   </td>\n");
      print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
      printf("   <div align=\"center\"><b>%s entr",$srch_count);
      if($srch_count>1){
         print("ies");
      } else {
         print("y");
      }
      print(" matched your search</b></div><br /><br />\n");
      print("   <table border=\"0\" cellpadding=\"3\" cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\">\n");
	      foreach($rows as $row) {
           // If there was only one word, just use the original search term
	         if ($term_count==1){
	            $output=preg_replace("/".$p_term."/","<b style=\"background-color:#990000;\">$1</b>",$row["outblab"]);
	         } else {
	 						// If there was more than one word, highlight each individual word
	            $output=$row["outblab"];
	            for($i=0;$i<$term_count;$i++){
	               $output=preg_replace("/".$terms[$i]."/","<b style=\"background-color:#990000;\">$1</b>",$output);
	            }
	         }
	         print("     <tr>\n");
	         print("      <td width=\"20\" align=\"center\" valign=\"top\">\n");
	         printf("      <img src=\"/images/dot-red.gif\" width=\"6\" height=\"6\" border=\"0\">\n");
	         print("      </td>\n");
	         print("      <td width=\"330\" align=\"left\" valign=\"top\">\n");
	         printf("<a href=\"bioitem.php?p_bio_id=%s",$row["bio_id"]);
	         printf("&p_term=%s\">",$p_term);
           // printf("%s</a> ",$row["outdate"]);
	         printf("%s</a> ",$row["bioyear"]);
	         printf("(%s&#037;)<br />",NUMBER_FORMAT(($row["score"]*10),2,'.',','));
	         printf("      <i>%s...</i><br /><br />\n",$output);
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
      $pagetitle="My Bio: Search: No Results";
// default html header with comments
      include("elements/header.php");
      print("<body>\n");
      print("<a href=\"index.php\">Back To The Bio Index</a><br /><br />\n\n");
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
      include("elements/yearform.php");
// Search form
      include("elements/searchform.php");
      printf("   &#149;&nbsp;<a href=\"bioadd1.php?p_yr=%s\">New Entry</a>\n",$yearout);
      print("   </td>\n");
      print("   <td width=\"440\" align=\"left\" valign=\"top\">\n");
      printf("   <div align=\"center\"><b>No entries matched your search</b></div><br /><br />\n");
      print("   </td>\n");
      print("  </tr>\n");
      print("</table>\n");
      print("</div>\n");
      include("elements/footers.php");
   }
?>