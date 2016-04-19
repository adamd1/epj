<?php
/*
   jobs.php
   Output of all the jobs I've held
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
$css="bio.css";
$pagetitle="My Jobs";
$p_jobid="";
	if(isset($_REQUEST["p_jobid"]) && $_REQUEST["p_jobid"]!=""){
		$p_jobid=$_REQUEST["p_jobid"];
	}
// require_once __DIR__."/lib/KLogger.php";  // Include KLogger first so config sets log dir
// Database connection object (Which auto-loads all the site configuration.)
require_once __DIR__ . "/data/DBConnector.php";
$stmt="";
// default html header with comments
   include("elements/header.php");
// connect to the database
$db = dbconnector::connect();
?>
<body>
<a href="index.php">Back To The Bio Index</a><br /><br />
<div align="center">
<table width="400" border="0" cellspacing="0" cellpadding="3" class="title">
  <tr>
   <td width="200" align="left" valign="top">The Jobs I've Had...</td>
   <td width="200" align="right" valign="top">How much further geek-anal-retentive is this?</td>
  </tr>
</table><br /><br />
<?php
   if($p_jobid==""){
			$sql="select all job_id,from_date,to_date,jobtitle,
			company,city,stprv,
			DATE_FORMAT(from_date, '%b. %Y') AS fmtfromdt,
			DATE_FORMAT(to_date, '%b. %Y') AS fmttodt
			from my_jobs
			order by from_date desc,
			to_date desc;";
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
				if($row_count>0){
					$j/f("<div align=\"center\">I have held <b>%s</b> occupation",$jobs_count);
					if($jobs_count>1) {
					print("s");
					}
					print(" to date.<br /><br />\n\n</div>");
					foreach($rows as $row) {
						print("  <tr>\n");
						print("   <td width=\"250\" align=\"left\" valign=\"top\">\n");
						printf("   &#187;<a href=\"jobs.php?p_jobid=%s\">",$row["job_id"]);
						printf("%s</a>",$row["company"]);
						printf(" %s, %s\n",$row["city"],$row["stprv"]);
						print("   </td>\n");
						print("   <td width=\"250\" align=\"right\" valign=\"top\">\n");
						printf("   [%s - ",$row["fmtfromdt"]);
							if ($row["to_date"] == ''
							|| $row["fmttodt"] == NULL
							|| $row["to_date"] == '0000-00-00 00:00:00'){
								print("Present");
							} else {
								printf("%s",$row["fmttodt"]);
							}
						print("]\n");
						printf("   <a href=\"jobedit1.php?p_jobid=%s\" title=\"[Edit]\">&#149;</a>\n",$row["job_id"]);
						print("   </td>\n");
						print("  </tr>\n");
					}
					print("</table><br /><br />\n\n");
				}
      } else {
				print("<a href=\"jobs.php\">Back To The Job Listings</a><br /><br />\n\n");
				$sql="SELECT ALL job_id,from_date,to_date,jobtitle,company,
				comp_type,street,city,stprv,country,
				postcode,notes,co_workers,
				DATE_FORMAT(from_date, '%b. %Y') AS fmtfromdt,
				DATE_FORMAT(to_date, '%b. %Y') AS fmttodt
				FROM my_jobs
				WHERE (job_id = $p_jobid)
				LIMIT 1;";
				// Prepare
				$stmt = $db->prepare($sql);
				// Execute
				$retVal = $stmt -> execute();
				// Row count...
				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$rs1 = $db->query('SELECT FOUND_ROWS()');
				$row_count = (int) $rs1->fetchColumn();
				$stmt = null;
				$ctr=0;
				if($row_count>0){
					print("<table border=\"0\" width=\"450\" cellpadding=\"3\" ");
					print("cellspacing=\"0\" bgcolor=\"#333333\" class=\"blurb\" style=\"border: 1px red solid\">\n");
						foreach($rows as $row) {
							print("  <tr>\n");
							print("   <td width=\"450\" align=\"right\" valign=\"top\">\n");
							printf("   <b><a href=\"jobedit1.php?p_jobid=%s\">",$row["job_id"]);
							printf("%s</a></b><br />\n",$row["company"]);
							printf("   %s<br />\n",$row["comp_type"]);
							printf("   [%s - ",$row["fmtfromdt"]);
								if ($row["to_date"] == ''
								|| $row["fmttodt"] == NULL
								|| $row["to_date"] == '0000-00-00 00:00:00'){
									print("Present");
								} else {
									printf("%s",$row["fmttodt"]);
								}
						print("]<br />\n");
						printf("   %s<br />\n",$row["jobtitle"]);
							if ($row["street"] != '' || $row["street"] != NULL){
								printf("   %s<br />\n",$row["street"]);
							}
						printf("   %s, %s<br />\n",$row["city"],$row["stprv"]);
						printf("   %s",$row["country"]);
						print("   </td>\n");
						print("  </tr>\n");
						print("  <tr>\n");
						print("   <td width=\"450\" align=\"left\" valign=\"top\">\n");
						printf("   %s<br /><br />\n\n",$row["notes"]);
							if ($row["co_workers"] != '' || $row["co_workers"] != NULL){
								print("   <b>People I Work With:</b><br />\n");
								printf("   %s\n",$row["co_workers"]);
							}
						print("   </td>\n");
						print("  </tr>\n");
				}
			print("</table><br /><br />\n\n");
		}
	}
$stmt=null;
include("elements/footers.php");
?>