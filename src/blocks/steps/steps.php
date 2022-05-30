<section class="steps-sect container"<?php echo $section_id ?>>
  <h2 class="steps-sect__title"><?php echo $section['title'] ?></h2>
  <div class="steps-sect__steps has-decor-text" data-decor-text="<?php echo $section['decor_text'] ?>"> <?php
    foreach ( $section['steps'] as $step ) : ?>
      <div class="step">
        <!-- <strong class="step__title has-right-line"><span class="step__title-text"><?php #echo $step['title'] ?></span></strong> -->
        <strong class="step__title has-right-line"><span class="text"><?php echo $step['title'] ?></span></strong>
        <p class="step__descr"><?php echo $step['descr'] ?></p>
      </div> <?php
    endforeach ?>
  </div>
</section> <?php
unset( $section_id, $step ) ?>