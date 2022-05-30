<?php
global
  $template_directory,
  $logo_url,
  $logo_srcset,
  $tel,
  $tel_dry ?>
<aside class="menu" style="display:none">
  <div class="menu__cnt">
    <picture class="hdr__logo">
      <img src="<?php echo $logo_url ?>"<?php echo $logo_srcset ?> alt="Логотип" class="menu__logo-img">
    </picture> <?php
    wp_nav_menu( [
      'theme_location'  => 'header_menu',
      'container'       => 'nav',
      'container_class' => 'menu__nav',
      'menu_class'      => 'menu__nav-list',
      'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
    ] ) ?>
    <a href="<?php echo $tel_dry ?>" class="menu__tel tel"><?php echo $tel ?></a>
    <button class="menu__callback btn btn_blue">Обратный звонок</button>
  </div>
</aside>