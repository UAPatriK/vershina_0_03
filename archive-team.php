<?php get_header(); ?>

  <div class="container">


  <div class="col-lg-12 col-lg-12-cont blog-main mrb">
    


  <h2 class="blog-post-big-title">Наша команда</h2>
<div class="row mbr">
   
  
   

      
          <?php
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


    $args = array(
      'post_type' => 'team',
      'posts_per_page' => -1,
      'paged'=>  $paged
     
    );
    $projects_category = new WP_Query( $args );
    if( $projects_category->have_posts() ) {
      while( $projects_category->have_posts() ) {
        $projects_category->the_post();
        ?>

   
     
         
           
 
 <div class="col-lg-12">
   <div class="row">
     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mrb_course"><?php the_post_thumbnail('','class=img-responsive img-thumbnail'); ?></div>
     <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">    <p class="main_news_page_sign"><?php echo get_post_meta($post->ID, 'team_row_1', 1); ?></p>
     <p><b>Курс:</b> <?php echo get_post_meta($post->ID, 'team_row_2', 1); ?></p>
      <p><b>Образование:</b> <?php echo get_post_meta($post->ID, 'team_row_3', 1); ?></p>
     <p><i><?php echo get_post_meta($post->ID, 'team_row_4', 1); ?></i></p>
</div>
    
     </div><hr class="mrb" />
  </div>
      <?php
      }
    }



    else {
      echo __('К сожалению, в данный момент участники отсутствуют',vershina_0_01);
    }
  ?>

<!--  -->
<div class="paginate col-sm-12 mrt0 mrb"> 
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
  










  

</div>
   



  </div>

       

    </div><!-- /.container -->






























<?php get_footer(); ?>