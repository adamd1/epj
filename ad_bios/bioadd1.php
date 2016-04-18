<?php
/*
   bioadd1.php
   Enter a new bio thing.
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
$stmt="";
$css="bio.css";
$pagetitle="My Bio: Edit";
// default html header with comments
include("elements/header.php");
	if(isset($_REQUEST["p_yr"]) && $_REQUEST["p_yr"]!=""){
		$p_yr=$_REQUEST["p_yr"];
	} else {
		$p_yr=$yearout;
	}
print("<body>\n");
print("<a href=\"index.php\">Back To The Bio Index</a><br /><br />\n\n");
print("<div align=\"center\">\n\n");
print("<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" class=\"title\">\n");
print("  <tr>\n");
print("   <td width=\"200\" align=\"left\">My Bio: Admin</td>\n");
print("   <td width=\"200\" align=\"right\">New Entry</span>\n");
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
print("     <tr>\n");
print("      <td width=\"420\" align=\"left\" valign=\"top\">\n");
print("      <form action=\"bioadd2.php\" method=\"post\">\n");
print("      <i>Priv?</i> <input type=\"checkbox\" name=\"p_show\" value=\"n\"><br /><br />\n\n");
printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_bioyr\" value=\"%s\"><br />\n",$p_yr);
printf("      <input type=\"text\" style=\"width: 150px;\" name=\"p_date\" value=\"%s\" maxlength=\"100\"><br />\n",date('Y-m-d H:i:s'));
print("      <input type=\"text\" style=\"width: 150px;\" name=\"p_bio_type\" value=\"biotxt\"><br />\n");
print("      <textarea name=\"p_blab\" rows=\"15\" cols=\"85\"></textarea><br /><br />\n");
print("      <div align=\"center\"><input type=\"submit\" name=\"p_send\" value=\"Update\">&nbsp;&nbsp;\n");
print("      <input type=\"reset\" value=\"Start Over\"></div>\n");
print("      </form>\n");
print("      </td>\n");
print("     </tr>\n");
print("   </table><br /><br />\n");
print("   </td>\n");
print("  </tr>\n");
print("</table>\n");
print("</div>\n");
include("elements/footers.php");
?>