<?php get_header(); ?>









  <div class="container">


  <div class="col-lg-12 col-lg-12-cont blog-main  mrb">
    



   	<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
         


  <h2 class="blog-post-big-title"><?php the_title(); ?></h2>
  <p>  <?php the_post_thumbnail('','class=img-responsive'); ?>   </p>
<?php the_content(); ?>
<?php endwhile; ?>
 
<?php endif; ?>
    


   
  
   

</div>
   



  </div>

       

    </div><!-- /.container -->









<?php get_footer(); ?>