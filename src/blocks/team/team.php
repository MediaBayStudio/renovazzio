<section class="team-sect container has-decor-text"<?php echo $section_id ?> data-decor-text="<?php echo $section['decor_text'] ?>">
  <h2 class="team-sect__title"><?php echo $section['title'] ?></h2>
  <ul class="team-sect__list" id="team-list"> <?php
    foreach ( $section['team'] as $char ) : ?>
      <li class="char">
        <img src="#" alt="<?php echo $char['name'] ?>" class="char__photo lazy" data-src="<?php echo $char['img']['url'] ?>">
        <span class="char__name"><?php echo $char['name'] ?></span>
        <span class="char__position"><?php echo $char['position'] ?></span>
      </li> <?php
    endforeach ?>
  </ul>
</section> <?php
unset( $section_id, $team, $char ) ?>