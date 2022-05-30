    <?php
      global
        $logo_url,
        $site_url,
        $template_directory ?>
    <footer class="ftr container">
      <div class="ftr__top">
        <img src="<?php echo $logo_url ?>" alt="Логотип" class="ftr__logo">
        <span class="ftr__copy">Все права защищены <q>Реновацио</q>&nbsp;<?php echo date( 'Y' ) ?>&nbsp;&copy;</span>
        <div class="ftr__policy-block">
          <a href="policy.pdf" class="ftr__policy" target="_blank" title="Посмотреть политику конфиденциальности">Политика конфиденциальности</a>
          <div class="ftr__dev">Разработано – <a href="https://media-bay.ru" class="ftr__dev-link" target="_blank" title="Перейти на сайт разработчика">media bay</a></div>
        </div>
      </div> <?php 
      wp_nav_menu( [
        'theme_location'  => 'header_menu',
        'container'       => 'nav',
        'container_class' => 'ftr__nav',
        'menu_class'      => 'ftr__nav-list',
        'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
      ] ) ?>
    </footer>
    <div id="fake-scrollbar"></div>
    <div class="thanks" style="display:none">
      <div class="thanks__cnt">
        <button type="button" class="thanks__close">
          <svg xmlns="http://www.w3.org/2000/svg" class="thanks__close-svg"><path d="M17.5 1L1 17.5M1.5 1L18 17.5" class="thanks__close-path"/></svg>
        </button>
        <span class="thanks__title">Спасибо!</span>
        <p class="thanks__descr">Мы свяжемся с&nbsp;вами в&nbsp;ближайшее время.</p>
      </div>
    </div>
    <div class="case-popup popup">
      <div class="case-popup__cnt">
        <button type="button" class="case-popup__close">
          <svg xmlns="http://www.w3.org/2000/svg" class="case-popup__close-svg"><path d="M17.5 1L1 17.5M1.5 1L18 17.5" class="case-popup__close-path"/></svg>
        </button>
        <span class="case-popup__title"></span>
        <span class="case-popup__area"></span>
        <div class="case-popup__images"></div>
        <div class="case-popup__images-nav"></div>
        <div class="case-popup__text"></div>
      </div>
    </div> <?php
    wp_footer() ?>
  </div>
</body>
</html>