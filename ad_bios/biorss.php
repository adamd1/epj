<?php
/**************************************
Adam's first rss feed.
Nov. 30, 2005
***************************************/
// All the basics
include("elements/basics.epj");
$rightnow = date(U);
// File location we output the feed to...
$fp = fopen("/var/websites/ad_bios/feed.xml", "w");

if($p_yr=="") {
   $p_yr=$yearout;
}
// SQL query
$base_query="SELECT ALL a.bio_id,a.section,a.bioyear,
             a.date_entered,a.blab,a.showme,a.palm_posted,
             DATE_FORMAT(a.date_entered, '%b. %D') AS outdate
             FROM my_bio a
             WHERE a.bioyear = $p_yr";
$nosho_query=" AND lower(a.showme) != 'n'";
$end_query=" ORDER BY a.section ASC,
                      a.date_entered ASC;";

   if ($pri != 'y'){
      $bio_query=$base_query.$nosho_query.$end_query;
   } else {
      $bio_query=$base_query.$end_query;
   }

fputs ($fp, "<?xml version=\"1.0\"?>\r<!DOCTYPE rss SYSTEM \"http://my.netscape.com/publish/formats/rss-0.91.dtd\">\r<rss version=\"0.91\">\r<channel>\r   <copyright>Copyright 1997-$yearout Brainrub.com</copyright>\r   <pubDate>".$formattedpubdate."</pubDate>\r");

// connect to the database
$db = hookMeUp();

// headers
fputs ($fp, "   <description>A website about personal technology.</description>\r   <link>http://brainrub.com/</link>\r   <title>Brainrub.com</title>\r<image>\r   <link>http://brainrub.com/</link>\r   <title>Brainrub.com</title>\r   <url>http://www.brainrub.com/images/brainrub_banner.jpg</url>\r   <height>65</height>\r   <width>470</width>\r</image>\r<webMaster>adam@brainrub.com (Adam D.)</webMaster>\r   <managingEditor>webmaster@brainrub.com (Adam D.)</managingEditor>\r<language>en-us</language>\r<skipHours>\r   <hour>1</hour>\r   <hour>2</hour>\r   <hour>3</hour>\r   <hour>4</hour>\r   <hour>5</hour>\r   <hour>6</hour>\r   <hour>7</hour>\r   <hour>8</hour>\r   <hour>23</hour>\r   <hour>24</hour>\r   </skipHours>\r   <skipDays>\r   <day>Saturday</day>\r   <day>Sunday</day>\r   </skipDays>\r");

$bio_res = mysql_query($bio_query,$db);
   if($bio_res){
      while ($bio_row = mysql_fetch_array($bio_res)) {
         fputs ($fp, "<item>\r<title>$bio_row[outdate]: $bio_row[section]");
            if ($array[author]<>"") {
               fputs ($fp, ", Adam D.");
            }
         fputs ($fp, "</title>\r<link>http://ad4m.kicks-ass.net:8080/ad_bios/bioitem.epj?p_bio_id=$bio_row[bio_id]</link>\r<description>Stuff!</description>\r</item>\r\r");
      }
      mysql_free_result($bio_res);
   }

fputs ($fp, "</channel>\r</rss>");
fclose ($fp);
// Close the db connection
closeMeUp($db);
?>
