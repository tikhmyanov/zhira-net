<?php get_header(); ?>

<section class="training-studio-section">
  <div class="container">
    <div class="row training-list">
      <div class="col-xs-12 item ">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
        <?php get_template_part( 'nav', 'below-single' ); ?>
        <?php endwhile; endif; ?>
     </div>
    </div>
  </div>

  

</section>

<?php get_footer(); ?>