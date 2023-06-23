<?php
get_header(); 
?>
<div id="primary" class="homepage-content">
  <main id="main" class="site-main wrapper" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

     <h1 style="display:none;"><?php the_title(); ?></h1>

    <?php endwhile; ?>

  </main>
</div>

<?php
get_footer();
