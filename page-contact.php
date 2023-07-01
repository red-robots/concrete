<?php
/**
 * Template Name: Contact Us
 */
get_header(); ?>

<div id="primary" class="content-area-full contact-page-template">
	<main id="main" class="site-main" role="main">
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="titlediv">
        <div class="wrapper"><h1 class="page-title"><?php the_title(); ?></h1></div>
      </div>

      <?php
        $logo = get_field('logo');
        $heading1 = get_field('column_one_heading');
        $content1 = get_field('column_one_content');
        $heading2 = get_field('column_two_heading');
        $content2 = get_field('column_two_content');
      ?>
      <div class="entry-content contentDiv">
        <div class="wrapper">
          <div class="flexwrap">
            <?php if($logo) { ?>
            <div class="flexcol">
              <img src="<?php echo $logo['url']?>" alt="<?php echo $logo['title']?>"/>
            </div>
            <?php } ?>

            <?php if($heading1 || $content1) { ?>
            <div class="flexcol">
              <?php if($heading1) { ?>
              <h3><?php echo $heading1; ?></h3>
              <?php } ?>
              <?php if($content1) { ?>
              <div class="info"><?php echo $content1; ?></div>
              <?php } ?>
            </div>
            <?php } ?>

            <?php if($heading2 || $content2) { ?>
            <div class="flexcol">
              <?php if($heading2) { ?>
              <h3><?php echo $heading2; ?></h3>
              <?php } ?>
              <?php if($content2) { ?>
              <div class="info"><?php echo $content2; ?></div>
              <?php } ?>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
    <?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
