<section class="design-sect container has-decor-text"<?php echo $section_id ?> data-decor-text="<?php echo $section['decor_text'] ?>">
  <h2 class="design-sect__title"><?php echo $section['title'] ?></h2>
  <div class="design-sect__items"> <?php
    foreach ( $section['items'] as $item ) : ?>
      <div class="design-sect__item">
        <img src="#" alt="#" class="design-sect__item-icon lazy" data-src="<?php echo $item['icon']['url'] ?>">
        <p class="design-sect__item-descr"><?php echo $item['descr'] ?></p>
      </div> <?php
    endforeach ?>
  </div>
  <div class="design-sect__rows"> <?php
    foreach ( $section['rows'] as $row ) : ?>
      <div class="design-sect__row"> <?php
        if ( $row['left'] ) : ?>
          <b class="design-sect__row-left"><?php echo $row['left'] ?></b> <?php
        endif;
        if ( $row['center'] ) : ?>
          <b class="design-sect__row-center"><?php echo $row['center'] ?></b> <?php
        endif;
        if ( $row['right'] ) : ?>
          <span class="design-sect__row-right"><?php echo $row['right'] ?></span> <?php
        endif ?>
      </div> <?php
    endforeach ?>
  </div>
</section> <?php
unset( $section_id, $item, $row ) ?>