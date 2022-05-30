mapBlock = id('contacts-map');

if (mapBlock) {
  let ymapsInit = function() {
    let tag = document.createElement('script'),
      loaderText = mapBlock.getAttribute('data-loader'),
      counter = 0;

    tag.setAttribute('src', 'https://api-maps.yandex.ru/2.1/?apikey=82596a7c-b060-47f9-9fb6-829f012a9f04&lang=ru_RU&onload=ymapsOnload');
    document.body.appendChild(tag);
    mapBlock.removeEventListener('lazyloaded', ymapsInit);

  };

  mapBlock.addEventListener('lazyloaded', ymapsInit);
}