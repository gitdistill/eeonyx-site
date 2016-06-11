  <?php
  $paragraph_with_image_rows = get_field('paragraph_with_image');
  //var_dump( $paragraph_with_image_rows );
  if( $paragraph_with_image_rows ){
    foreach ($paragraph_with_image_rows as $key => $row) {
      $swap_columns = $row['image_alignment'] == 'right';
      $hide_image_on_mobile = $row['hide_image_on_mobile']
      ?>

      <div class="paragraph-with-image row row-<?=$key?>">
        <div class="col-sm-4 image <?=$swap_columns?'col-sm-push-8':'';?>">
          <?php if( $row['image'] ) { ?>
            <img src="<?=$row['image']['url']?>" class="<?=$hide_image_on_mobile?'hidden-xs':'';?>" alt="<?=$row['image']['alt']?>">
          <?php } ?>
        </div>
        <div class="col-sm-7 text <?=$swap_columns?'col-sm-pull-3':'';?>">
          <?=$row['text']?>
        </div>
      </div>

    <?php } ?>
  <?php } ?>
  