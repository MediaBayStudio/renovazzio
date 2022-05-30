<section class="cases-sect container"<?php echo $section_id ?>>
  <!-- <div class="cases-sect__heading"> -->
  <h2 class="cases-sect__title"><?php echo $section['title'] ?></h2>
  <!-- <div class="cases-sect__arrows"></div> -->
  <!-- </div> -->
  <div class="cases-sect__cases"> <?php
    $i = 0;
    foreach ( $section['cases'] as $case ) :
      $case_gallery = get_field( 'gallery', $case );
      $case_text = get_field( 'text', $case );
      $case_thumbnail = get_the_post_thumbnail_url( $case->ID );
      $case_area = str_replace( 'м2', 'м<sup class="case__title-sup">2</sup>', $case_text['area'] );
      if ( $case_area ) {
        $case_area = ' | ' . $case_area;
      }
      $case_title = $case->post_title;
      $case_descr = str_replace( [
        '<p>',
        '<a>',
        '<ul>',
        '<ol>',
        '<li>'
      ], [
        '<p class="case-popup__p">',
        '<a class="case-popup__a">',
        '<ul class="case-popup__ul">',
        '<ol class="case-popup__ol">',
        '<li class="case-popup__li">'
      ], $case_text['text'] ) ?>
      <div class="case" data-area="<?php echo $case_text['area'] ?>" data-title="<?php echo esc_attr( $case_title ) ?>">
        <div class="case__text" style="display:none"> <?php
          echo $case_descr ?>
        </div>
        <div class="case__images"> <?php
          foreach ( $case_gallery as $case_img ) : ?>
            <a href="<?php echo $case_img['url'] ?>" class="case__link">
              <img src="#" alt="#" class="case__img lazy" data-src="<?php echo $case_img['url'] ?>">
            </a> <?php
          endforeach ?>
        </div>
        <div class="case__text">
          <strong class="case__title"><?php echo $case_title . $case_area ?></strong>
          <div class="case__arrow">
            <img src="#" alt="Стрелка" class="case__arrow-img lazy" data-src="<?php echo $template_directory ?>/img/icon-case-arrow.svg" >
          </div>
        </div>
      </div> <?php
      $i++;
    endforeach ?>
  </div>
  <!-- <button type="button" class="cases-sect__more-btn btn btn_blue btn_ol">Показать еще</button> -->
  <div class="cases-sect__arrows"></div>
</section> <?php
unset( $section_id, $i, $case, $case_gallery, $case_thumbnail, $case_title, $case_area, $case_text, $case_descr, $case_img) ?>