<section class="services-sect container"<?php echo $section_id ?>>
  <h2 class="services-sect__title"><?php echo $section['title'] ?></h2>
  <div class="services-sect__services"> <?php
    foreach ( $section['items'] as $item ) : ?>
      <div class="service">
        <img src="#" alt="#" class="service__img lazy" data-src="<?php echo $item['img']['url'] ?>">
        <!-- <strong class="service__title has-right-line"><span class="service__title-text"><?php #echo $item['title'] ?></span></strong> -->
        <!-- <div class="service__heading"> -->
          <strong class="service__title has-right-line"><span class="text"><?php echo $item['title'] ?></span></strong>
        <!-- </div> -->
        <ul class="service__list"> <?php
          foreach ( $item['list'] as $li ) : ?>
            <li class="service__li"><?php echo $li['li'] ?></li> <?php
          endforeach ?>
        </ul>
        <span class="service__price"><?php echo str_replace( 'м2', 'м<sup class="service__price-sup">2</sup>', $item['price'] ) ?></span>
      </div> <?php
    endforeach ?>
  </div>
</section> <?php
unset( $section_id, $item, $li ) ?>