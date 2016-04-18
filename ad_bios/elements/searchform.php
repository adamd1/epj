<?php
/*
   searchform.epj
   A basic one line search field
   Coded Sep. 24th, 2002.
   (c) 2002 Adam Drake
   adam@brainrub.com
*/
   print("   <form action=\"biosearch.epj\" method=\"post\">\n");
   print("   <input type=\"text\" name=\"p_term\" size=\"20\" ");
      IF(isset($p_term)){
         printf("value=\"%s\"",$p_term);
      }
   print(">&nbsp;\n");
   print("   <input type=\"submit\" name=\"p_send\" value=\"Search\">\n");
   print("   </form>\n");
?>