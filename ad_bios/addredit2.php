<?php
/*
   addredit2.epj
   Post address edits to the db.
   Coded Jan. 17th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
// All the basics
   include("elements/basics.epj");
   $css="bio.css";
   IF ($p_addid != '' && $p_addid != null
      && $p_frmdate != '' && $p_frmdate != null
      && $p_todate != '' && $p_todate != null
      && $p_street != '' && $p_street != null
      && $p_city != '' && $p_city != null
      && $p_stprv != '' && $p_stprv != null
      && $p_cntry != '' && $p_cntry != null) {
// Successful
      $add_query="UPDATE my_addresses SET
                 from_date = '$p_frmdate',
                 to_date = '$p_todate',
                 street = '$p_street',
                 city = '$p_city',
                 stprv = '$p_stprv',
                 country = '$p_cntry',
                 postcode = '$p_code',
                 phone = '$p_phone',
                 notes = '$p_notes',
                 roommates = '$p_rmmate'
                 WHERE (add_id = $p_addid);";
// connect to the database
      $db = mysql_connect(g_dbhost, g_dbuser, g_dbpass);
// choose the correct database
      mysql_select_db(g_dbname,$db);
//   print($add_query);
      $add_result = mysql_query($add_query,$db);
      mysql_close($db);
      header("Location: ".$basepath."ad_bios/addresses.epj?p_addid=".$p_addid."\n\n");
   } ELSE {
// Unsuccessful
      print("Doofus: All fields are required.");
   }
//   mysql_free_result($add_result);
?>