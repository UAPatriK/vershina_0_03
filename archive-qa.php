<?php get_header(); ?>




 <div class="container">


  <div class="col-lg-12 col-lg-12-cont blog-main mrb">
   
   <h2 class="blog-post-big-title">Вопросы и ответы</h2>

           
 

         
          <?php
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


    $args = array(
      'post_type' => 'qa',
      'paged'=>  $paged
     
    );
    $projects_category = new WP_Query( $args );
    if( $projects_category->have_posts() ) {
      while( $projects_category->have_posts() ) {
        $projects_category->the_post();
        ?>

   
            
          <div class="blog-post mrb_course">    
            <p class="main_news_page_sign"><?php echo get_post_meta($post->ID, 'qa_row_1', 1); ?></p>
            <p><i>  <?php echo get_post_meta($post->ID, 'qa_row_2', 1); ?></i></p>
           
         
            <hr>
            </div>
 

  
      <?php
      }
    }



    else {
      echo __('К сожалению, в данный момент вопросы и ответы отсутствуют',vershina_0_01);
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

       

    </div><!-- /.container -->
















<?php get_footer(); ?>