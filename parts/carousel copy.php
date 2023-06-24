<?php if( $carouselItems = get_field('projects_selection') ) { ?>
<?php  
  $firstBatch = array();
  $paged = ( isset($_GET['spg']) && $_GET['spg'] ) ? $_GET['spg'] : 1;
?>
<div id="carouselData" class="carousel-wrapper" data-page="1" data-baseUrl="<?php echo get_permalink(); ?>">
  <div class="carousel-inner">
    <div id="carousel" class="owl-carousel">
      
      <?php foreach ($carouselItems as $c) { 
        $img = get_field('main_photo', $c->ID);
        $firstBatch[] = $c->ID;
        if($img) { ?>
        <figure class="thumbnail" data-pid="<?php echo $c->ID ?>" data-title="<?php echo $c->post_title ?>">
          <div class="frame"></div>
          <div class="img" style="background-image:url('<?php echo $img['url'] ?>')"></div>
        </figure>
        <?php } ?>
      <?php } ?>
      
      <?php  
      $args = array(
        'posts_per_page'=> 10,
        'post_type'     => 'projects',
        'post_status'   => 'publish',
        'paged'         => $paged
      );

      if($firstBatch) {
        $args['post__not_in'] = $firstBatch;
      }

      $projects = new WP_Query($args);
      if ( $projects->have_posts() ) { ?>
        <?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
          <?php if( $img = get_field('main_photo') ) { ?>
          <figure class="thumbnail" data-pid="<?php the_ID(); ?>" data-title="<?php echo get_the_title(); ?>">
            <div class="frame"></div>
            <div class="img" style="background-image:url('<?php echo $img['url'] ?>')"></div>
          </figure>
          <?php } ?>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php } ?>

    </div>

    <a href="javascript:void(0)" data-action="previous" class="customControl control-previous"><span class="sr">Previous</span></a>
    <a href="javascript:void(0)" data-action="next" class="customControl control-next"><span class="sr">Next</span></a>
  </div>

  <div class="hiddenData" style="display:none">
    <?php 
      $projects = new WP_Query($args);
      if ( $projects->have_posts() ) { ?>
        <?php while ( $projects->have_posts() ) : $projects->the_post(); ?>
          <?php if( $img = get_field('main_photo') ) { ?>
          <figure class="thumbnail" data-pid="<?php the_ID(); ?>" data-title="<?php echo get_the_title(); ?>">
            <div class="frame"></div>
            <div class="img" style="background-image:url('<?php echo $img['url'] ?>')"></div>
          </figure>
          <?php } ?>
        <?php endwhile; wp_reset_postdata(); ?>
    <?php } ?>
  </div>
</div>

<?php } ?>