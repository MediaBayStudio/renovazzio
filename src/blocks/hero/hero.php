<?php 
  $hero_gallery = $section['gallery'];

  $hero_picture = '<picture class="hero-sect__pic">';

  $source_template = '<source type srcset media>';

  $img_template = '<img %src% alt="#" %srcset% class="hero-sect__img">';

  $img_tag = '';

  $source_tag = '';

  $i = 0;
  foreach ( $hero_gallery as $img ) {
    $img_fields = get_fields( $img['ID'] );
    $source_type = 'type="' . $img['mime_type'] . '"';
    $source_media = ' media="' . $img['description'] . '"';
    $img_urls = [];

    if ( $i === 0 ) {
      $img_src = 'src="' . $img['url'] . '"';
    } else {
      $source_urls[] = $img['url'];
    }

    if ( $img_fields ) {

      if ( $img_fields['webp'] ) {
        $source_webp_urls[] = $img_fields['webp']['url'];
      }
      if ( $img_fields['2x_webp'] ) {
        $source_webp_urls[] = $img_fields['2x_webp']['url'] . ' 2x';
      }
      if ( $img_fields['3x_webp'] ) {
        $source_webp_urls[] = $img_fields['3x_webp']['url'] . ' 3x';
      }
      if ( $img_fields['2x'] ) {
        if ( $i === 0 ) {
          $img_urls[] = $img_fields['2x']['url'] . ' 2x';
        } else {
          $source_urls[] = $img_fields['2x']['url'] . ' 2x';
        }
      } // end $img_fields['2x']

      if ( $img_fields['3x'] ) {
        if ( $i === 0 ) {
          $img_urls[] = $img_fields['3x']['url'] . ' 3x';
        } else {
          $source_urls[] = $img_fields['3x']['url'] . ' 3x';
        }
      } // end $img_fields['3x']

    } // end $img_fields


    if ( $i === 0 ) {
      $img_srcset = ' srcset="' . implode( ', ', $img_urls ) . '"';
      $img_tag = str_replace( [ '%src%', '%srcset%' ], [ $img_src, $img_srcset ], $img_template );
    } else {
      $source_srcset = 'srcset="' . implode( ', ', $source_urls ) . '"';
      $source_tag = str_replace( [ 'type', 'srcset', ' media' ], [ $source_type, $source_srcset, $source_media ], $source_template );
      $hero_picture .= $source_tag;
    }

    if ( $is_webp_support && $source_webp_urls ) {
      $source_webp_srcset = 'srcset="' . implode( ', ', $source_webp_urls ) . '"';
      $source_webp_tag = str_replace( [ 'type', 'srcset', ' media' ], [ 'type="image/webp"', $source_webp_srcset, $source_media ], $source_template );
      $hero_picture .= $source_webp_tag;
    }

    $i++;

    unset( $source_urls, $source_webp_urls, $source_srcset, $source_webp_srcset, $source_tag, $source_webp_tag, $img_srcset, $img_urls );
  }

  $hero_picture .= $img_tag . '</picture>';

 ?>
<section class="hero-sect"<?php echo $section_id ?>>
  <div class="hero-sect__text container"> <?php
  echo $hero_picture ?>
    <h1 class="hero-sect__title"><?php echo $section['title'] ?></h1>
    <p class="hero-sect__subtitle"><?php echo $section['subtitle'] ?></p>
    <button class="hero-sect__btn btn btn_blue" onclick="scrollToTarget(event, '<?php echo $section['btn_target'] ?>')"><?php echo $section['btn_text'] ?></button>
  </div>
  <div class="hero-sect__features container"> <?php
    foreach ( $section['features'] as $feat ) : ?>
      <div class="feat">
        <img src="#" alt="#" class="feat__icon lazy" data-src="<?php echo $feat['img']['url'] ?>">
        <p class="feat__text"><?php echo $feat['title'] ?></p>
      </div> <?php
    endforeach ?>
  </div>
</section> <?php
unset( $section_id, $hero_gallery, $hero_picture, $data_media_attr, $feat, $i ) ?>