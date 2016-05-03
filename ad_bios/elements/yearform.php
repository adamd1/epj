<?php
/*
   yearform.php
   Show all the years which are available in my bio db.
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
$pri="";
if(isset($_REQUEST["$pri"])){
	$pri=$_REQUEST["$pri"];
}
$yr_query="SELECT DISTINCT bioyear FROM my_bio ORDER BY bioyear DESC;";
$stmt = $db->prepare($yr_query);
// Execute
$retVal = $stmt -> execute();
// Row count...
$rows2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
$rs2 = $db->query('SELECT FOUND_ROWS()');
$row_count2 = (int) $rs2->fetchColumn();
// If row count > 0, do stuff...
$stmt = null;
$ctr=0;
if($row_count2>0){
	print("   <form action=\"bio.php\" method=\"post\">\n");
		if($pri=='y'){
			print("   <input type=\"hidden\" name=\"pri\" value=\"y\">\n");
		}
	print("   <select name=\"p_yr\" onChange=\"this.form.submit();\">\n");
		foreach($rows2 as $row2) {
			printf("   <option value=\"%s\"",$row2["bioyear"]);
				if ($row2["bioyear"] == $p_yr){
					print(" selected");
				}
			printf(">%s</option>\n",$row2["bioyear"]);
		}
	print("   </select>&nbsp;\n");
	print("   <input type=\"submit\" name=\"p_send\" value=\"Go\">\n");
	print("   </form>\n");
}
?>