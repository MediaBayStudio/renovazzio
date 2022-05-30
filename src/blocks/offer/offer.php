<section class="offer-sect container"<?php echo $section_id ?>>
  <h2 class="offer-sect__title"><?php echo $section['title'] ?></h2>
  <div class="offer-sect__wrap">
    <img src="#" alt="#" data-src="<?php echo $section['img']['url'] ?>" class="offer-sect__img lazy">
    <ul class="offer-sect__list"> <?php
      foreach ( $section['list'] as $li ) :?>
        <li class="offer-sect__li"><?php echo $li['li'] ?></li> <?php
      endforeach ?>
    </ul>
  </div>
</section> <?php
unset( $section_id, $li ) ?>