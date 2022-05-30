<?php
// Переименовываем стандартные записи wordpress
add_filter( 'post_type_labels_post', function ( $labels ){

  $new = [
    'name'                  => 'Проекты',
    'singular_name'         => 'Проект',
    'add_new'               => 'Добавить проект',
    'add_new_item'          => 'Добавить проект',
    'edit_item'             => 'Редактировать проект',
    'new_item'              => 'Новый проект',
    'view_item'             => 'Просмотреть проект',
    'search_items'          => 'Поиск проектов',
    'not_found'             => 'Проектов не найдено.',
    'not_found_in_trash'    => 'Проектов в корзине не найдено.',
    'parent_item_colon'     => '',
    'all_items'             => 'Все проекты',
    'archives'              => 'Архивы проектов',
    'insert_into_item'      => 'Вставить в проект',
    'uploaded_to_this_item' => 'Загруженные для этого проекта',
    'featured_image'        => 'Миниатюра проекта',
    'filter_items_list'     => 'Фильтровать список проектов',
    'items_list_navigation' => 'Навигация по списку проектов',
    'items_list'            => 'Список проектов',
    'menu_name'             => 'Проекты',
    'name_admin_bar'        => 'Проект', // пункте "добавить"
  ];

  return (object) array_merge( (array) $labels, $new );
} );
