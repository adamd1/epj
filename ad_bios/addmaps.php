<?php
/*
   addmap.epj
   A popup map layout
   for the ad_prive db
   October, 2002
   Adam D.
*/
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__."/data/DBConnector.php";


$p_addid="";
	if(isset($_REQUEST["p_addid"]) && $_REQUEST["p_addid"]!=""){
		$p_addid=$_REQUEST["p_addid"];
	}
// 1st: set defaults for blanks
	if($p_addid==""){
		$p_addid="1";
	}
   $add_query="SELECT DISTINCT a.map_url,a.street,a.city,a.stprv,a.country
               FROM my_addresses a
               WHERE (a.add_id = $p_addid)
               LIMIT 1;";
//   print($add_query);
// connect to the database
$db = dbconnector::connect();
// Now: Run the query for the graph.
// Prepare
$stmt = $db->prepare($sql);
// Execute
$retVal = $stmt -> execute();
// Row count...
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rs1 = $db->query('SELECT FOUND_ROWS()');
$row_count = (int) $rs1->fetchColumn();
// If row count > 0, do stuff...
$stmt = null;
$ctr=0;
// Process...
	if($row_count>0){
		foreach($rows as $row) {
			$addr_output=str_replace("<br />", " - ", $row["street"]).", ";
			$addr_output.=$row["city"].", ".$row["stprv"].", ".$row["country"];
			// No css this time...
			$css='music.css';
			$pagetitle=str_replace("<br />", " - ", $row["street"]).", ".$row["city"];
			// default html header with comments
			include("elements/header.php");
			print("<body>\n");
			print("<div style=\"position:absolute;top:0px;left:0px;\" align=\"center\">\n");
			print("<a href=\"javascript:self.close();\">");
			printf("<img src=\"%s\" width=\"356\" height=\"249\" border=\"0\" alt=\"%s\"></a>",$row["map_url"],$addr_output);
			// print("<br />\n<a href=\"javascript:self.close();\">close window</a><br />\n");
			print("</div>\n");
			print("</body>\n");
			print("</html>\n");
		}
	}
?>