<?php
   $advance_content =  unserialize(get_option('site_mode_advanced'));

   if($advance_content['footer_code']) {
         echo wp_kses_post($advance_content['footer_code']);
   }
 wp_footer();
   ?>
</body>
</html>