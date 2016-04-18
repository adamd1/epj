<?php
/*
   addmap.epj
   A popup map layout
   for the ad_prive db
   October, 2002
   Adam D.
*/
// All the basics
   include_once("elements/basics.epj");

// 1st: set defaults for blanks
      IF(!$p_addid){
         $p_addid='1';
      }
   $add_query="SELECT DISTINCT a.map_url,a.street,
                               a.city,a.stprv,a.country
               FROM my_addresses a
               WHERE (a.add_id = $p_addid)
               LIMIT 1;";
//   print($add_query);
// Connect to the database
   $db = mysql_connect($dbhost,$dbuser,$dbpass);
   mysql_select_db($dbname,$db);
// Now: Run the query for the graph.
// Run the query for the graph.
   $add_result=mysql_query($add_query,$db);
      IF($add_row=mysql_fetch_array($add_result)){
         $addr_output=str_replace("<br />", " - ", $add_row["street"]).", ";
         $addr_output.=$add_row["city"].", ".$add_row["stprv"].", ".$add_row["country"];
// No css this time...
         $css='music.css';
         $pagetitle=str_replace("<br />", " - ", $add_row["street"]).", ".$add_row["city"];
// default html header with comments
         include("elements/header.epj");
         print("<body>\n");
         print("<div style=\"position:absolute;top:0px;left:0px;\" align=\"center\">\n");
         print("<a href=\"javascript:self.close();\">");
         printf("<img src=\"%s\" ",$add_row["map_url"]);
         print("width=\"356\" height=\"249\" border=\"0\" "); 
         printf(" alt=\"%s\"></a>",$addr_output);
//         print("<br />\n<a href=\"javascript:self.close();\">close window</a><br />\n");
         print("</div>\n");
         print("</body>\n");
         print("</html>\n");
      }
   mysql_free_result($add_result);
   mysql_close($db);
?>