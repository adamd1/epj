<?php
/*
                 S P E C K !
                 [ The page header. ]
                 Brought to you by EmergencyPuffJacket.com

                 Sun Like Star
                 PHP code by Adam Drake
                 June - July, 2000
*/
$avgo="";
$js="adbios.js";
$nocopy="";
	if(isset($_GET["avgo"]) && $_GET["avgo"]!=""){
		$avgo=$_GET["avgo"];
	}
	if ($pagetitle == "") {
		$pagetitle="The New Speck Apache!";
	}
	if ($css == "") {
		$css = "speck1.css";
	}
   print("<!doctype HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">\n\n");
   print("<!--\n");
   print("  A d a m   D . ' s   P r i v a t e   W e b s i t e\n\n");
   print("  D e s i g n e d   a n d   d e v e l o p e d   b y\n\n");
   print("  A d a m   D .\n\n");
   print("  a t   b r a i n r u b . c o m\n\n");
   print("  a d a m | @ | b r a i n r u b | dot | c o m\n\n");
   print("  Contents, design and code are all\n\n");
   printf("  Copyright (c) 1997 - %s by Adam Drake\n\n",$yearout);
   print("  All Rights Reserved\n");
   print("-->\n\n");
   print("<html lang =\"en\">\n");
   print("   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n");
      if ($avgo == 'y'){
         print("   <meta name=\"HandheldFriendly\" content=\"true\">\n");
      }
      if ($css != 'NO') {
         printf("   <style type=\"text/css\" media=\"all\">@import \"css/%s\";</style>\n",$css);
      }
   printf("   <title>%s</title>\n",$pagetitle);
      if ($js){
         printf("   <script type=\"text/javascript\" src=\"%s\"></script>\n",$js);
      }
   print("</head>\n\n");
?>