  <?php get_header(); ?>

  <div class="container">

      <div class="row">
<?php echo do_shortcode( '[responsive_slider]' ); ?>
    
      </div>

  <div class="col-lg-12 col-lg-12-cont blog-main">
        <h2 class="blog-post-big-title">Добро пожаловать!</h2>
        
           <?php query_posts('p=4'); ?>
  <?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
          <?php the_content(); ?>
          <?php endwhile; ?>
          <?php endif; ?>


  <h2 class="blog-post-big-title sign_mrg">Популярные курсы:</h2>
<div class="row">
 
 

 
<?php
$args = array(   'courses_category' => 'popular_courses', 'posts_per_page'=>'4' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); ?>

   <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12  mrb_cell">
    <div class="col-lg-12 col-md-12  col-sm-12 col-xs-12 "><div class="row"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('','class=img-responsive'); ?></a></div></div> 
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-page_course sm_row"> <table class="table table_style_sign" ><tr><td style="vertical-align:middle;border-top:0px;"> <a href="<?php the_permalink() ?>" class="black_signs course_sign" ><?php the_title(); ?></a></td></tr> </table></div>
    </div>




<?php
endwhile;
wp_reset_query(); ?>


  
  

</div>





    <div class="row mrb">
           <div class="col-lg-7 col-sm-7 col-md-7 col-xs-12"><h2 class="blog-post-big-title">Новости:</h2>


  <?php query_posts('cat=2&showposts=3'); ?> 
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

                <div class="blog-post">    <p class="blog-post-main"><?php the_time('d.m.Y'); ?> <?php the_time(); ?></p>
            <p class="main_news_page_sign"><a href="<?php the_permalink() ?>" class="black_signs"><?php the_title(); ?></a></p>
             <p><?php the_post_thumbnail('','class=img-responsive'); ?> </p>
           
           <?php the_content(''); ?>  <a href="<?php the_permalink() ?>" class="more_link">Читать далее</a>
 
            <hr>
            </div>


  <?php endwhile; ?>
 
<?php endif; ?>

 

           </div>
            <div class="col-lg-4 col-lg-offset-1  col-md-4 col-md-offset-1  col-sm-4 col-sm-offset-1  col-xs-12 blog-sidebar"> <div class="sidebar-module sidebar_module_contacts">
              <h2 class="blog-post-big-title">Контакты:</h2>
         <p><?php echo (get_post_meta(__('4',Vershina), 'header_contacts_row_1', true)); ?></p>
         <p><?php echo (get_post_meta(__('4',Vershina), 'header_contacts_row_2', true)); ?></p>
         <p><?php echo (get_post_meta(__('4',Vershina), 'header_contacts_row_3', true)); ?></p>
         <p><?php echo (get_post_meta(__('4',Vershina), 'header_contacts_row_4', true)); ?></p>
         
          </div>


           <div class="sidebar-module sidebar_module_contact_form">
               <h2 class="blog-post-big-title">Записаться на первое занятие:</h2>
               <?php echo do_shortcode('[contact-form-7 id="20" title="Записаться на первое занятие"]'); ?>

          </div>
          </div>
          </div>


   
  


   

</div>
   



  </div>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width: 1200px;">
    <div class="modal-content">
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-lg-6">
        <h4 class="modal-title" style="color: #a50057; font-weight:bold;" id="myModalLabel">Записаться на первое занятие:</h4>
      <?php echo do_shortcode('[contact-form-7 id="20" title="Записаться на первое занятие"]'); ?>
      </div></div>
        
      </div>
     
    </div>
  </div>
</div>

       

    </div><!-- /.container -->
    

    <?php get_footer(); ?>