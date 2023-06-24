<?php if( $carouselItems = get_field('projects_selection') ) { ?>
<?php  
  $firstBatch = array();
  $paged = ( isset($_GET['spg']) && $_GET['spg'] ) ? $_GET['spg'] : 1;
?>
<div id="carouselData" class="carousel-wrapper" data-perview="5" data-page="1" data-baseUrl="<?php echo get_permalink(); ?>">
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

    </div>

    <a href="javascript:void(0)" data-action="previous" class="customControl control-previous"><span class="sr">Previous</span></a>
    <a href="javascript:void(0)" data-action="next" class="customControl control-next"><span class="sr">Next</span></a>
  </div>
</div>

<?php } ?>