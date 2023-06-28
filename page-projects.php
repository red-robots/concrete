<?php
/**
 * Template Name: Our Projects
 */
get_header(); ?>

<div id="primary" class="content-area-full projects-page">
	<main id="main" class="site-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="titlediv">
        <div class="wrapper"><h1 class="page-title"><?php the_title(); ?></h1></div>
      </div>
    <?php endwhile; ?>

    <?php
    $taxonomy = 'project-category';
    $terms = get_terms( array(
      'taxonomy'   => $taxonomy,
      'hide_empty' => false,
    ));
    if($terms) { ?>
    <div class="categories">
      <div class="wrapper">
        <div class="flexwrap">
          <?php foreach($terms as $term) { 
            $term_id = $term->term_id;
            $catImage = get_field('project_category_image',$taxonomy.'_'.$term_id);
            ?>
            <div class="term">
              <div class="inside">
                <a href="<?php echo get_term_link($term) ?>" class="featImage">
                  <?php if( $catImage ) { ?>
                  <figure class="hasImage" style="background-image:url('<?php echo $catImage['url'] ?>')">
                    <span class="b1"></span><span class="b2"></span>
                    <img src="<?php echo get_stylesheet_directory_uri().'/images/resizer.png' ?>" alt="">
                  </figure>
                  <?php } else { ?>
                  <figure class="noImage">
                    <span class="b1"></span><span class="b2"></span>
                    <img src="<?php echo get_stylesheet_directory_uri().'/images/resizer.png' ?>" alt="">
                  </figure>
                  <?php } ?>
                  </a>
                <div class="title">
                  <div class="button">
                  <a href="<?php echo get_term_link($term) ?>"><span><?php echo $term->name ?></span></a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>


    <?php if( get_the_content() ) { ?>
    <div class="entry-content contentDiv">
      <div class="wrapper"><?php the_content(); ?></div>
    </div>
    <?php } ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
