<?php
/*
   index.php
   Main Index of my bio section
   Coded Jan. 3rd, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
require_once __DIR__."/core/config.php";
$css="bio.css";
$pagetitle="My Bio: Main Menu";
// default html header with comments
include("elements/header.php");
?>
<body>
<div align="center">
<table width="400" border="0" cellspacing="0" cellpadding="3" class="title">
  <tr>
   <td width="200" align="left">My Bio</td>
   <td width="200" align="right">&nbsp;</span>
   </td>
  </tr>
</table><br /><br />
<table border="0" style="border: 1px solid red;">
  <tr>
   <td width="160" align="left" valign="top" class="blurb">
   &#187;&nbsp;<a href="bio.php">My Bio</a><br />
   &#187;&nbsp;<a href="addresses.php">My Addresses</a><br />
   &#187;&nbsp;<a href="jobs.php">My Jobs</a>
   </td>
  </tr>
</table><br /><br />
</div>
<?php
include("elements/footers.php");
?>