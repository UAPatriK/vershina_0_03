<?php get_header(); ?>




  <div class="container">


  <div class="col-lg-12 col-lg-12-cont blog-main mrb">
   
   <h2 class="blog-post-big-title"><?php single_cat_title(''); ?>:</h2>

      
 

         <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>


          <div class="blog-post mrb_course">    <p class="blog-post-main"><?php the_time('d.m.Y'); ?> <?php the_time(); ?></p>
            <p class="main_news_page_sign"><a href="<?php the_permalink() ?>" class="black_signs"><?php the_title(); ?></a></p>
           <p><?php the_post_thumbnail('','class=img-responsive'); ?> </p>
<?php the_content(''); ?>  <a href="<?php the_permalink() ?>" class="more_link">Читать далее</a>

             <hr>
            </div>



          
  

	



<?php endwhile; ?>
  <div class="paginate"> 
    <?php

          global $wp_query;
          $big = 999999999;

      echo paginate_links(  array(
          'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big ) )),
          'format' => '?paged=%#%',
          'current' => max(1, get_query_var('paged' )),
          'total' => $wp_query -> max_num_pages

        ) );
       ?>
       </div>

<?php endif; ?>
   
  


   

</div>
   



  </div>

       

    </div><!-- /.container -->











<?php get_footer(); ?>	

