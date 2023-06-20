<?php
get_header(); 
?>

<style>
  h1 {
    text-align: center;
    font-family: "Wix Madefor Text",sans-serif;
    font-size: 5rem;
    line-height: 1.1;
    text-transform: uppercase;
    letter-spacing: 0.01em;
    margin: 15% 0 0;
  }
</style>
<div id="primary" class="homepage-content">
  <main id="main" class="site-main wrapper" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <h1 class="page-title">This page is under construction</h1>

    <?php endwhile; ?>

  </main>
</div>

<?php
get_footer();
