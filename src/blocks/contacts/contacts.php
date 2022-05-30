<section class="contacts-sect container"<?php echo $section_id ?>>
  <div class="contacts-sect__wrap">
    <section class="contacts-sect__form-wrap">
      <h2 class="contacts-sect__form-title"><?php echo $section['form_title'] ?></h2>
      <p class="contacts-sect__form-descr"><?php echo $section['form_descr'] ?></p> <?php
      echo do_shortcode( '[contact-form-7 id="' . $section['form']->ID . '" html_class="form contacts-form"]' ) ?>
    </section>
    <section class="contacts-sect__contacts-wrap lazy" data-src="#">
      <h2 class="contacts-sect__title"><?php echo $section['title'] ?></h2>
      <p class="contacts-sect__subtitle"><?php echo $section['subtitle'] ?></p>
      <p class="address contacts__address"><?php echo $address ?></p>
      <a href="tel:<?php echo $tel_dry ?>" class="tel contacts__tel"><?php echo $tel ?></a>
      <a href="mailto:<?php echo $email ?>" class="email contacts__email"><?php echo $email ?></a>
    </section>
  </div>
  <div id="contacts-map" class="lazy" data-src="#" data-zoom="<?php echo $zoom ?>" data-coords="<?php echo $coords ?>"></div>
</section> <?php
unset( $section_id ) ?>
<script>
  var contactsMap;

  function ymapsOnload() {
    let mapBlockId = 'contacts-map',
      mapBlock = id( mapBlockId),
      mapAddress = q('.contacts__address', mapBlock.parentElement).textContent,
      mapZoom = mapBlock.getAttribute('data-zoom'),
      dataCoords = mapBlock.getAttribute('data-coords').split(/, |,/),
      mapCoords = {
        a: dataCoords[0],
        b: dataCoords[1]
      },
      setCoords = function() {
        let needleCoords,
          zoom;

        if (media(mediaQueries.xl)) {
          // needleCoords = [59.934, 30.436]
        } else if (media(mediaQueries.lg)) {
          needleCoords = [60.01130397303443, 30.39855158652847];
          // needleCoords = [60.011263842509194, 30.382513928814515];
          zoom = 15;
        } else if (media(mediaQueries.m)) {
          needleCoords = [60.013201650066094, 30.397750979744885];
        } else {
          needleCoords = dataCoords;
        }

        contactsMap.setCenter(needleCoords);

        if (zoom) {
          contactsMap.setZoom(zoom);  
        }

      };

    ymaps.ready(function() {
      contactsMap = new ymaps.Map(mapBlockId, {
        center: [mapCoords.a, mapCoords.b],
        zoom: mapZoom,
        controls: []
      }, {
        searchControlProvider: 'yandex#search'
      });
      
      let geoIcon = new ymaps.Placemark(contactsMap.getCenter(), {
        iconCaption: 'Реновацио',
        hintContent: 'Реновацио',
        balloonContent: mapAddress
      }, {
        iconLayout: 'default#image',
        iconImageHref: '<?php echo $template_directory ?>/img/icon-geo.svg',
        iconImageSize: [38, 46]
      });

      contactsMap.behaviors.disable('scrollZoom');
      contactsMap.geoObjects.add(geoIcon);
      contactsMap.panes.get('ground').getElement().style.filter = 'grayscale(100%)';
      setCoords();
      window.addEventListener('resize', setCoords);
    });
  }
</script>