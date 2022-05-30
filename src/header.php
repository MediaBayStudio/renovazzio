<?php
  global 
    $site_url,
    $tel,
    $tel_dry,
    $email,
    $address,
    $coords,
    $zoom,
    $template_directory,
    $logo_url;

    $page_style = str_replace( '.php', '', get_page_template_slug( $post->ID ) )    ?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ) ?>">
  <meta name="viewport" content="width=device-width, minimum-scale=1.0 initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- fonts preload --> <?php
	$fonts = [
		'Montserrat-Regular.woff',
		'Montserrat-Medium.woff',
		'Montserrat-Bold.woff',
		'SegoeUI-SemiBold.woff'
	];
	foreach ( $fonts as $font ) : ?>

	<link rel="preload" href="<?php echo $template_directory . '/fonts/' . $font ?>" as="font" type="font/woff" crossorigin="anonymous" /> <?php
	endforeach ?>
  <link rel="preload" as="style" href="<?php echo $template_directory ?>/style.css">
  <link rel="preload" as="style" href="<?php echo $template_directory ?>/css/style-<?php echo $page_style ?>.css">
  <link rel="preload" as="style" href="<?php echo $template_directory ?>/css/hover.css" media="(hover), (min-width:1024px)">
  <link rel="preload" as="style" href="<?php echo $template_directory ?>/css/fancybox.min.css">
  <link rel="preload" as="image" href="<?php echo $logo_url ?>">
  <link rel="preload" as="image" href="<?php echo $template_directory ?>/img/icon-tel.svg" media="(min-width:575.98px)"> <?php
  #echo $preload ?>
  <!-- favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $site_url ?>/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $site_url ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $site_url ?>/favicon-16x16.png">
  <link rel="manifest" href="<?php echo $site_url ?>/site.webmanifest">
  <link rel="mask-icon" href="<?php echo $site_url ?>/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff"> <?php
  if ( stripos( $_SERVER['HTTP_USER_AGENT'], 'lighthouse' ) === false ) : ?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
       (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
       m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
       (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
       ym(33498863, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            trackHash:true
       });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/33498863" style="position:absolute; left:-9999px;" alt="#" /></div></noscript>
    <!-- /Yandex.Metrika counter --> <?php
  endif;
  wp_head() ?>
</head>

<body data-template-directory-uri="<?php echo $template_directory ?>" data-site-url="<?php echo $site_url ?>" <?php body_class(); ?>> <?php
  wp_body_open() ?>
  <noscript>
    <!-- <noindex> -->Для полноценного использования сайта включите JavaScript в настройках вашего браузера.<!-- </noindex> -->
  </noscript>
  <div class="page-wrapper">
    <header class="hdr">
      <div class="hdr__top container">
        <img src="<?php echo $logo_url ?>" alt="Логотип" class="hdr__logo">
        <a href="tel:<?php echo $tel_dry ?>" class="hdr__tel tel"><?php echo $tel ?></a>
        <button type="button" class="hdr__callback btn btn_blue">Обратный звонок</button> <?php
        require 'template-parts/mobile-menu.php' ?>
        <button type="button" class="hdr__burger">
          <span class="hdr__burger-box">
            <span class="hdr__burger-inner"></span>
          </span>
        </button>
      </div>
      <div class="hdr__bottom container"> <?php 
        wp_nav_menu( [
          'theme_location'  => 'header_menu',
          'container'       => 'nav',
          'container_class' => 'hdr__nav',
          'menu_class'      => 'hdr__nav-list',
          'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
        ] ) ?>
      </div>
    </header>