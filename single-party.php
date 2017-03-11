<?php get_header(); ?>





  <div class="container">


  <div class="col-lg-12 col-lg-12-cont blog-main mrb">
    
      	<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

 <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  mrb_course">
   <?php the_post_thumbnail('','class=img-responsive'); ?> 
     
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
       <h2 class="blog-post-big-title"><?php the_title(); ?></h2>
      <!--   <p><b>Возраст:</b> <?php echo get_post_meta($post->ID, 'party_row_1', 1); ?></p>
        <p><b>Стоимость:</b> <?php echo get_post_meta($post->ID, 'party_row_2', 1); ?></p>
        <p><b>Количество занятий в неделю:</b> <?php echo get_post_meta($post->ID, 'party_row_3', 1); ?></p>
        <p><b>Строка:</b> <?php echo get_post_meta($post->ID, 'party_row_4', 1); ?></p> -->
       <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">
  Заказать
</button>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Заказать оформление праздника</h4>
      </div>
      <div class="modal-body">
     <?php echo do_shortcode('[contact-form-7 id="890" title="Заказать праздник"]'); ?>

      
        
      </div>
      
    </div>
  </div>
</div>



    </div>
  

</div>
<hr/>
  <p class="main_news_page_sign">Оформление праздника: </p>

<?php the_content(); ?>





<script type="text/javascript">(function() {
  if (window.pluso)if (typeof window.pluso.start == "function") return;
  if (window.ifpluso==undefined) { window.ifpluso = 1;
    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
    var h=d[g]('body')[0];
    h.appendChild(s);
  }})();</script>
<div class="pluso" data-background="transparent" data-options="big,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,facebook,twitter,odnoklassniki,email"></div>
<?php endwhile; ?>
 
<?php endif; ?>


  </div>

       

    </div><!-- /.container -->

   



    <?php get_footer(); ?>