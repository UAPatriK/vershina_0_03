<?php get_header(); ?>



 <div class="container">


  <div class="col-lg-12 col-lg-12-cont blog-main">
    


  <h2 class="blog-post-big-title">Перечень курсов:</h2>
<div class="row">

<?php
    
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


    $args = array(
      'post_type' => 'courses',
      'paged'=>  $paged
     
    );
    $projects_category = new WP_Query( $args );
    if( $projects_category->have_posts() ) {
      while( $projects_category->have_posts() ) {
        $projects_category->the_post();
        ?>
            
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12  mrb_catalogue">
      <div class="col-lg-12 col-md-12  col-sm-12 col-xs-12 "><div class="row"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('','class=img-responsive'); ?></a></div></div> 
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-page_course sm_row"> <table class="table table_style_sign" ><tr><td style="vertical-align:middle;border-top:0px;"> <a href="<?php the_permalink() ?>" class="black_signs course_sign" ><?php the_title(); ?></a></td></tr> </table></div>
    </div>
 

  


	




      <?php
      }
    }



    else {
      echo __('<p>К сожалению в данный момент курсы отсутствуют</p>', vershina_0_03);
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