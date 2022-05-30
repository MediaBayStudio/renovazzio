<?php
$template_directory = get_template_directory_uri();
$template_dir = get_template_directory();
$wp_content_dir = content_url();
$site_url = site_url();
$is_front_page = is_front_page();
$is_404 = is_404();
$is_category = is_category();
$is_admin = is_admin();

$address = get_option( 'contacts_address' );
$tel = get_option( 'contacts_tel' );
$tel_dry = preg_replace( '/\s/', '', $tel );
$email = get_option( 'contacts_email' );
$coords = get_option( 'contacts_coords' );
$zoom = get_option( 'contacts_zoom' );

// Проверка поддержки webp браузером
if ( strpos( $_SERVER['HTTP_ACCEPT'], 'image/webp' ) !== false || strpos( $_SERVER['HTTP_USER_AGENT'], ' Chrome/' ) !== false ) {
  $is_webp_support = true; // webp поддерживается
} else {
  $is_webp_support = false; // webp не поддерживается
}

// Удаление разных скриптов и стилей от wp
// Отключаем гутенберг
// Отключаем emoji
// Отключаем весь css-файл CF7
// Отключаем генерацию некоторых лишнех тегов
require $template_dir . '/inc/disable-wp-scripts-and-styles.php';

// Поддержки темой, настройка thumbnails
require $template_dir . '/inc/theme-support-and-thumbnails.php';

// Переимновать стандартные записи вордпресс в проекты
require $template_dir . '/inc/rename-posts.php';

// Подключение стилей и скриптов, чистка лишнего в html-тегах, настройка атрибутов
require $template_dir . '/inc/enqueue-styles-and-scripts.php';

// Настройка доп. полей в панели настройки->общее
require $template_dir . '/inc/options-fields.php';

// Подключение и настройка меню, атрибутов, классов, id
require $template_dir . '/inc/menus.php';

if ( is_super_admin() || is_admin_bar_showing() ) {
  // Создание файлов стилей и скриптов для темы
  require $template_dir . '/inc/build-pages-info.php';
  require $template_dir . '/inc/build-styles.php';
  require $template_dir . '/inc/build-scripts.php';

  // Отключение некоторых пунктов меню
  require $template_dir . '/inc/remove-admin-menu.php';

  // Стили в админку
  // Пишем в админку
  add_action( 'admin_head', function() {
    print
    '<style>
      .compat-attachment-fields tr[data-name="webp"],
      .compat-attachment-fields tr[data-name="2x"],
      .compat-attachment-fields tr[data-name="3x"],
      .compat-attachment-fields tr[data-name="2x_webp"],
      .compat-attachment-fields tr[data-name="3x_webp"] {
        display: inline-block !important;
        max-width: 33%;
      }
    </style>';
  } );
}


$logo_id = get_theme_mod( 'custom_logo' );
$logo_url = wp_get_attachment_url( $logo_id );
// $logo_sizes_field = get_field( 'sizes', $logo_id );

// if ( $logo_sizes_field['2x'] ) {
//   $logo_sizes[] = $logo_sizes_field['2x']['url'] . ' 2x';
// }
// if ( $logo_sizes_field['3x'] ) {
//   $logo_sizes[] = $logo_sizes_field['3x']['url'] . ' 3x';
// }

// $logo_srcset = $logo_sizes ? $logo_srcset = ' srcset="' . implode( ', ', $logo_sizes ) . '"' : '';
// $logo_preload_srcset = $logo_srcset ? str_replace( 'srcset', 'imagesrcset', $logo_srcset ) : '';