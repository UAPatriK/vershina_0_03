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
<style>
.modal {
  text-align: center;
  padding: 0!important;
}

.modal:before {
  content: '';
  display: inline-block;
  height: 100%;
  vertical-align: middle;
  margin-right: -4px;
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}

@media (min-width: 768px) {
  .modal-dialog {
    width: 90%;
    margin: 30px auto;
  }
}

</style>
<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style=" border-radius: 0px; margin-top: 20px;">
    <div class="modal-content" style="border-radius: 0px;">
      <div class="modal-header" >
<div class="row">
       <div class="col-xs-10">  <h3 class="modal-title" style=" font-weight:bold;" id="myModalLabel">Добро пожаловать в детский центр развития Вершина!</h3></div>
        <div class="col-xs-2">  <button type="button" style="margin-top: 10px;" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
      </div>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-sm-6 col-xs-12">
        <h4 class="modal-title" style="color: #a50057; margin-bottom: 10px; font-weight:bold;" id="myModalLabel">Записаться на первое занятие:</h4>
      <?php echo do_shortcode('[contact-form-7 id="20" title="Записаться на первое занятие"]'); ?>
      </div>

<div class="col-sm-6  col-xs-12">
  <h4 class="modal-title" style="color: #a50057; margin-bottom: 10px; font-weight:bold;" id="myModalLabel">Ближайшие события:</h4>


<?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'post_type' => 'events',
      'posts_per_page' => 3,
      'paged'=>  $paged
         );
    $projects_category = new WP_Query( $args );
    if( $projects_category->have_posts() ) {
      while( $projects_category->have_posts() ) {
        $projects_category->the_post();
        ?>
<div class="row">
<div class="col-lg-3 col-xs-12"><?php the_post_thumbnail('','class=img-responsive img_center'); ?></div>
<div class="col-lg-9  col-xs-12 event_item">
<p><?php echo get_post_meta($post->ID, 'events_row_1', 1); ?>  <?php echo get_post_meta($post->ID, 'events_row_2', 1); ?></p>
<h1><a href="<?php echo get_post_meta($post->ID, 'events_row_4', 1); ?>"><?php echo get_post_meta($post->ID, 'events_row_3', 1); ?></a></h1>
<p class="event_price"><?php echo get_post_meta($post->ID, 'events_row_5', 1); ?></p>
</div>
</div>
<hr style="margin-bottom: 10px; margin-top: 10px;" />



        <article class="partners_article col-lg-4 col-md-4 col-sm-4 col-xs-12"><h1 style="display:none"><?php the_title() ?></h1> <a href="<?php echo get_post_meta($post->ID, 'partners_row_1', 1); ?>" target="blank"></a></article>

            
      <?php
      }
    }
    else {

      echo __('К сожалению, в ближайшее время, мероприятия не запланированы.',vershina_0_01);
    }
  ?>

</div>

      </div>
        
      </div>
     
    </div>
  </div>
</div>

       

    </div><!-- /.container -->
    

    <?php get_footer(); ?>