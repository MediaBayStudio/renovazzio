<section class="form-sect container"<?php echo $section_id ?>>
  <div class="form-sect__wrap has-decor-text" data-decor-text="<?php echo $section['decor_text'] ?>">
    <h2 class="form-sect__title"><?php echo $section['title'] ?></h2>
    <p class="form-sect__subtitle"><?php echo $section['subtitle'] ?></p> <?php
    echo do_shortcode( '[contact-form-7 id="' . $section['form']->ID . '" html_class="form"]' ) ?>
  </div>
</section> <?php
unset( $section_id ) ?>