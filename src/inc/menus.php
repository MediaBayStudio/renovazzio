<?php

// Функция определения класса для пунктов меню
function wp_nav_menu_get_class_name( $container_class ) {
  $class = '';

  switch ( $container_class ) {
    case 'hdr__nav':
      $class = 'hdr__nav-li';
      break;
    case 'ftr__nav':
      $class = 'ftr__nav-li';
      break;
    case 'menu__nav':
      $class = 'menu__nav-li';
      break;
    default:
      $class = 'nav__li';
      break;
  }

  return $class;
}

// Меню на сайте
  add_action( 'after_setup_theme', function() {
    register_nav_menus( [
      'header_menu' =>  'Меню в шапке сайта',
      // 'mobile_menu' =>  'Мобильное меню на сайте',
      // 'footer_menu' =>  'Меню в подвале сайта'
    ] );
  } );

// добавить класс для ссылки в меню (a)
  add_filter( 'nav_menu_link_attributes', function( $atts, $item ) {
    $atts['class'] = 'nav-link';
    return $atts;
  }, 10, 2);  

// задать свои классы для пунктов меню (li)
  add_filter( 'nav_menu_css_class', function( $classes, $item, $args, $depth ) {
    $li_class = wp_nav_menu_get_class_name( $args->container_class );

    $classesArray = [ $li_class ];

    foreach ( $classes as $class ) {
      if ( $class === 'current-menu-item' ) {
        $classesArray[] = 'current';
      } else if ( $class === 'last' ) {
        $classesArray[] = 'last';
      }
    }
    return $classesArray;
  }, 10, 4);

// убрать id у пунктов меню
  add_filter( 'nav_menu_item_id', function( $menu_id, $item, $args, $depth ) {
    return '';
  }, 10, 4);


// Добавляем точки-разделители для пунктов меню
add_filter( 'wp_nav_menu_items', function ( $items, $args ) {
  $container_class = $args->container_class;

  if ( $container_class === 'menu__nav' ) {
    return $items;
  }

  $li_class = wp_nav_menu_get_class_name( $args->container_class );
  $li_class = str_replace( 'nav-li', 'nav-dot', $li_class );
  
  return str_replace( '</li>', '<li class="' . $li_class . '"></li></li>', $items );
}, 10, 2 );
