<section class="faq-sect container"<?php echo $section_id ?>>
  <h2 class="faq-sect__title has-decor-text" data-decor-text="<?php echo $section['decor_text'] ?>"><?php echo $section['title'] ?></h2>
  <ul class="faq-sect__list" id="faq-list"> <?php
    foreach ( $section['faq'] as $faq ) : ?>
      <li class="faq-sect__li">
        <span class="faq-sect__li-title"><span class="faq-sect__li-title-icon"></span><?php echo $faq['question']; ?></span>
        <p class="faq-sect__li-descr"><?php echo $faq['answer']; ?></p>
      </li> <?php
    endforeach ?>
  </ul>
</section> <?php
unset( $section_id, $faq, $p ) ?>