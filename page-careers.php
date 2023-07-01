<?php
/**
 * Template Name: Careers
 */
get_header(); ?>

<div id="primary" class="content-area-full templated projects-page">
	<main id="main" class="site-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="titlediv">
        <div class="wrapper"><h1 class="page-title"><?php the_title(); ?></h1></div>
      </div>
    <?php endwhile; ?>

    <?php if( $boxes = get_field('boxes') ) { ?>
    <div class="careers-boxes">
      <div class="wrapper">
      <?php foreach($boxes as $b) { 
        $pagelink = $b['page_link'];
        $box_title = $b['box_title'];
        $box_image = $b['box_image'];
        ?>
        <div class="box">
          <?php if($pagelink){ ?><a href="<?php echo $pagelink?>"><?php } ?>
          <?php if($box_image) { ?>
            <figure>
              <img src="<?php echo $box_image['url'] ?>" alt="<?php echo $box_image['title'] ?>" />
            </figure>
          <?php } ?>
          <?php if($box_title) { ?>
          <div class="button3D">
            <div class="ins"><span class="txt"><?php echo $box_title?></span></div>
          </div>
          <?php } ?>
          <?php if($pagelink){ ?></a><?php } ?>
        </div>
      <?php } ?>
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
