  <footer class="blog-footer">
     <div class="container-fluid">
       <div class="col-lg-3 col-lg-offset-1 col-md-4 col-sm-4  col-xs-12 mrb">
       <p class="lead"><b>Главная</b></p>
         
           <?php
               wp_nav_menu(array('theme_location' => 'footer_menu1', 'menu_id'=> 'navmenu-f'));

             ?>
         
       </div>
         <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 mrb">
       <p class="lead"><b>О нас</b></p>
         
          <?php
               wp_nav_menu(array('theme_location' => 'footer_menu2', 'menu_id'=> 'navmenu-f'));

             ?>
        
       </div>
         <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 mrb">
       <p class="lead"><b>Фотогалерея</b></p>
         
         <?php
               wp_nav_menu(array('theme_location' => 'footer_menu3', 'menu_id'=> 'navmenu-f'));

             ?>
         
       </div>

        

       <div class="col-lg-2 pull-right col-md-12 col-sm-12  col-xs-12 mrb">
            <a href="<?php echo (get_post_meta(__('4',Vershina), 'facebook_link', true)); ?>" target="blank"  class="mrsoc"><img src="<?php bloginfo('template_url'); ?>/images/fb.png" width="42px" alt=""></a>
          <a href="<?php echo (get_post_meta(__('4',Vershina), 'vkontakte_link', true)); ?>"  target="blank" class="mrsoc"><img src="<?php bloginfo('template_url'); ?>/images/vk.png" width="42px" alt=""></a>
           <a href="<?php echo (get_post_meta(__('4',Vershina), 'youtube_link', true)); ?>"  target="blank" class="mrsoc"><img src="<?php bloginfo('template_url'); ?>/images/yb.png" width="42px" alt=""></a>
          <a href="<?php echo (get_post_meta(__('4',Vershina), 'instagram_link', true)); ?>"  target="blank"  class="mrsoc"><img src="<?php bloginfo('template_url'); ?>/images/inst.png" width="42px" alt=""></a>
           <hr>
          <a href="http://vershina.org.ua">&copy Vershina 2016</a><br/>
         <!--  <a href="http://iti.dp.ua" target="blank">Разработано в IT-integrator</a> -->
       </div>
     </div>
    </footer>


   <!-- Bootstrap core JavaScript
    ==================================================
   Placed at the end of the document so the pages load faster 

      <script src="<?php bloginfo('template_url'); ?>/js/function.js"></script>  
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
    <script src="<?php bloginfo('template_url'); ?>/js/ie10-viewport-bug-workaround.js"></script> -->
    <?php wp_footer(); ?>
  </body>
</html>













