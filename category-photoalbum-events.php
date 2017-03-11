<?php get_header(); ?>

 <div class="container">


  <div class="col-lg-12 col-lg-12-cont blog-main mrb">
    


  <h2 class="blog-post-big-title"><?php single_cat_title(''); ?>:</h2>
<div class="row mbr">
   
       <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>


   <div class="col-lg-12">
   <div class="row">
     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mrb_course"><a href="<?php the_permalink() ?>"> <?php the_post_thumbnail('','class=img-responsive'); ?></a></div>
     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">    <p class="main_news_page_sign"><a href="<?php the_permalink() ?>"  class="black_signs"><?php the_title(); ?></a></p>
     <p><i><?php the_excerpt(); ?></i></p>
</div>
   
     </div><hr class="mrb" />
      </div>
<?php endwhile; ?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
 <div class="paginate"> 
    <?php

          global $wp_query;
          $big = 999999999;

      echo paginate_links(  array(
          'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big ) )),
          'format' => '?paged=%#%',
          'current' => max(1, get_query_var('paged' )),
          'total' => $wp_query -> max_num_pages,
           'prev_next'    => True,
          'prev_text'    => __('« Назад'),
          'next_text'    => __('Вперед »'),


        ) );
       ?>
       </div></div> 
 
<?php endif; ?>
  

</div>
   



  </div>

       

    </div><!-- /.container -->







<?php get_footer(); ?>