<?php

/* Template Name: Page Blog */
 
get_header();

$args = array( 'posts_per_page' => 3 );
$lastposts = get_posts( $args );

foreach( $lastposts as $post ) : setup_postdata($post); ?>
  <article class="training-studio-section">
    <div class="row">
      <div class="col-xs-12">
        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'homepage-thumb' ); } ?>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?>
      </div>
  </article>
<?php endforeach;

wp_reset_postdata();

get_footer();

?>