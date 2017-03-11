<?php get_header(); ?>



  <div class="container">


  <div class="col-lg-12 col-lg-12-cont blog-main mrb">
   
   <h2 class="blog-post-big-title">Партнеры:</h2>

          <div class="row">
           
              <?php
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


    $args = array(
      'post_type' => 'partners',
      'posts_per_page' => -1,
      'paged'=>  $paged
     
    );
    $projects_category = new WP_Query( $args );
    if( $projects_category->have_posts() ) {
      while( $projects_category->have_posts() ) {
        $projects_category->the_post();
        ?>

     
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 mrb">
                <a href="<?php echo get_post_meta($post->ID, 'partners_row_1', 1); ?>" target="blank"><?php the_post_thumbnail('','class=img-responsive img-thumbnail'); ?></a>
               </div>

            
     
 

  
      <?php
      }
    }



    else {
      echo __('К сожалению, в данный момент партнеры отсутствуют',vershina_0_01);
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