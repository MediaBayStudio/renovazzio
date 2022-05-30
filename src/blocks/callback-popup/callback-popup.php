<div class="callback-popup popup"<?php echo $section_id ?>>
  <div class="callback-popup__cnt popup__cnt">
    <button type="button" class="callback-popup__close">
      <svg xmlns="http://www.w3.org/2000/svg" class="callback-popup__close-svg"><path d="M17.5 1L1 17.5M1.5 1L18 17.5" class="callback-popup__close-path"/></svg>
    </button>
    <h2 class="callback-popup__title"><?php echo $section['title'] ?></h2> <?php
    if ( $section['subtitle'] ) : ?>
      <p class="callback-popup__subtitle"><?php echo $section['subtitle'] ?></p> <?php
    endif;
    echo do_shortcode( '[contact-form-7 id="' . $section['form']->ID . '" html_class="form"]' ) ?>
  </div>
</div> <?php
unset( $section_id ) ?>