<?php
add_action( 'save_post_page', function( $post_ID, $post, $update ) {
  global $template_dir;

  // Пролучаем секции для страницы
  $sections = get_field( 'sections', $post_ID );

  if ( $sections ) {

    $cnt .= file_get_contents( $template_dir . '/js/components/utils.js' );

    $cnt .= 'document.addEventListener(\'DOMContentLoaded\', function() {';
    $cnt .= file_get_contents( $template_dir . '/js/components/menu.js' );
    $cnt .= file_get_contents( $template_dir . '/js/components/domcontentloaded-start.js' );

    // Получаем ярлык шаблона и убираем .php в нем (будет index, about и т.д.)
    $template_slug = str_replace( '.php', '', get_page_template_slug( $post_ID ) );

    foreach ( $sections as $section ) {
      $section_name = $section['acf_fc_layout'];

      $filename = $section_name . '.js';
      
      $filepath = $template_dir . '/blocks/' . $section_name . '/' . $filename;
      
      if ( file_exists( $filepath ) ) {
        $cnt .= file_get_contents( $filepath );
      }
    }

    $dest = $template_dir . '/js/script-' . $template_slug . '.js';

    if ( file_exists( $dest ) ) {
      unlink( $dest );
    }

    $cnt .= file_get_contents( $template_dir . '/js/components/domcontentloaded-end.js' );
    $cnt .= '});';

    file_put_contents( $dest, $cnt );

    // Создаем файл с информацией для gulp
    // build_pages_info( $page_info_cnt );
  }

}, 10, 3 );