<?php
//================================
// My page footers
// (Including copyright info)
//================================
   IF ($nocopy != "y"){
      print("<div align=\"center\" class=\"copyright\">\n");
      printf("&copy;1990 - %s, Adam D.<br /><br />\n",$yearout);
      print("</div>\n\n");
   }
   print("</body>\n\n</html>\n");
?>