<?php if( $heroImage = get_field('hero_image') ) { ?>
<div class="hero">
  <div class="image" style="background-image:url('<?php echo $heroImage['url']; ?>');"></div>
</div>
<?php } ?>