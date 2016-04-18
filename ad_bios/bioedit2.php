<?php
/*
   bioedit2.epj
   Post bio edits to the db.
   Coded Jan. 2nd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// All the basics
   include("elements/basics.epj");
   $css="bio.css";
   if ($p_bio_id != '' && $p_bio_id != null
       && $p_date != '' && $p_date != null
       && $p_bio_type != '' && $p_bio_type != null
       && $p_blab != '' && $p_blab != null
       && $p_bioyr != '' && $p_bioyr != null) {
// Successful
      $out=ereg_replace ("\n","<br />\n",$p_blab);
      // $out=$p_blab;
         if($p_show!="n"){
            $p_show="y";
         }
      $bio_query="UPDATE my_bio SET
                 section = '$p_bio_type',
                 date_entered = '$p_date',
                 showme = '$p_show',
                 blab = '$out'
                 WHERE (bio_id = $p_bio_id);";
// connect to the database
      $db = mysql_connect(g_dbhost, g_dbusr, g_dbpass);
// choose the correct database
      mysql_select_db(g_dbname,$db);
//   print($bio_query);
      $bio_result = mysql_query($bio_query,$db);
      mysql_close($db);
      header("Location: ".$basepath."ad_bios/bio.epj?p_yr=".$p_bioyr."\n\n");
   } else {
// Unsuccessful
      print("Doofus: All fields are required.");
   }
//   mysql_free_result($bio_result);
?>