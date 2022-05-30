<?php
function build_pages_info( $page_info_cnt ) {
  global $template_dir;
  // Путь к файлу с информацией для gulp
  $pages_info_path = $template_dir . '/pages-info.json';

  // Если существует, то лучше удалить и создать заново
  if ( file_exists( $pages_info_path ) ) {
    unlink( $pages_info_path );
  }

  file_put_contents( $pages_info_path, json_encode( $page_info_cnt ) );
}