<?php get_header(); ?>





  <div class="container">

    

  <div class="col-lg-12 col-lg-12-cont blog-main mrb">
   



                	<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
         <p class="blog-post-main"><?php the_time('d.m.Y'); ?> <?php the_time(); ?></p>
 <p class="main_news_page_sign"><?php the_title(); ?></p>

            
    <?php the_post_thumbnail('','class=img-responsive'); ?> 
    <br/>

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