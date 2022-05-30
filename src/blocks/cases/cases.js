let casesBlock = q('.cases-sect__cases');

if (casesBlock) {

  casePopup = new Popup('.case-popup', {
    closeButtons: '.case-popup__close'
  });

  casePopup.addEventListener('popupclose', function() {
    $casePopupImages.slick('unslick');
    $casePopupImagesNav.slick('unslick');
    $.fancybox.destroy();
  })


  let casePopupTitle = q('.case-popup__title', casePopup),
    casePopupArea = q('.case-popup__area', casePopup),
    casePopupText = q('.case-popup__text', casePopup),
    casePopupImages = q('.case-popup__images', casePopup),
    casePopupImagesNav = q('.case-popup__images-nav', casePopup),
    $casePopupImages = $(casePopupImages),
    $casePopupImagesNav = $(casePopupImagesNav),
    $casesBlock = $(casesBlock),
    casesSlides = qa('.case', casesBlock),
    loadmoreBtn = q('.cases-sect__more-btn', casesBlock.parentElement),
    arrowSvg = '<svg class="arrow__svg" width="41" height="8" viewBox="0 0 41 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M40.3536 4.35355C40.5488 4.15829 40.5488 3.84171 40.3536 3.64645L37.1716 0.464466C36.9763 0.269204 36.6597 0.269204 36.4645 0.464466C36.2692 0.659728 36.2692 0.976311 36.4645 1.17157L39.2929 4L36.4645 6.82843C36.2692 7.02369 36.2692 7.34027 36.4645 7.53553C36.6597 7.7308 36.9763 7.7308 37.1716 7.53553L40.3536 4.35355ZM0 4.5H40V3.5H0V4.5Z" fill="currentColor"/></svg>',
    cornerArrowSvg = '<svg class="arrow__svg" width="9" height="21" viewBox="0 0 9 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.615431 20.0376L8.23047 9.72557L0.615433 1" stroke="currentColor"/></svg>',
    childs = casesBlock.children,
    childsLength = childs.length,
    coeff = 1,
    getTargetHeight = function(coeff) {
      coeff = coeff || 1;
      return (childs[0].offsetHeight + +getComputedStyle(childs[0]).marginBottom.slice(0, -2)) * 4 * coeff;
    },
    setCasesBlockHeight = function(event) {
      if (media('(max-width:767.98px)')) {
        loadmoreBtn&&loadmoreBtn.removeAttribute('hidden');

        if (event && event.type === 'click') {
          let needleHeight = getTargetHeight(coeff) + 'px';
          casesBlock.style.maxHeight = needleHeight;
        }

        console.log('coeff*4', coeff * 4);
        console.log('childsLength', childsLength);
        if (coeff * 4 >= childsLength) {
          loadmoreBtn&&loadmoreBtn.setAttribute('hidden', '');
        }

      } else {
        casesBlock.removeAttribute('style');
        loadmoreBtn&&loadmoreBtn.setAttribute('hidden', '');
        coeff = 1;
      }
    },
    buildCasesSlider = function() {
      if (media('(max-width:767.98px)')) {
        if (SLIDER.hasSlickClass($casesBlock)) {
          $casesBlock.slick('unslick');
        }
      } else {
        if (SLIDER.hasSlickClass($casesBlock)) {
          return;
        }
        if (casesSlides.length && casesSlides.length > 6) {
          $casesBlock.slick({
            appendArrows: $('.cases-sect__arrows'),
            prevArrow: SLIDER.createArrow('cases-sect__prev', arrowSvg),
            nextArrow: SLIDER.createArrow('cases-sect__next', arrowSvg),
            infinite: false,
            mobileFirst: true,
            variableWidth: true,
            slidesPerRow: 2,
            rows: 3,
            responsive: [{
              breakpoint: 1023.98,
              settings: {
                slidesPerRow: 3,
                rows: 2
              }
            }]
          });
        }
      }
    },
    prevAttr,
    slideByMouse = function(e, slider) {
      let deltaY = e.deltaY;

      slider = slider || $(this);

      slider[0].removeEventListener('mousewheel', slideByMouse);

      slider.on('afterChange', function() {
        slider[0].addEventListener('mousewheel', slideByMouse);
        slider.off('afterChange');
      });

      if (deltaY > 0) {
        slider.slick('slickNext');
      } else if (deltaY < 0) {
        slider.slick('slickPrev');
      }
    };

  // casesBlock.style.maxHeight = getTargetHeight(1) + 'px';

  // loadmoreBtn && (loadmoreBtn.addEventListener('click', function(e) {
  //   coeff++;
  //   setCasesBlockHeight(e);
  // }));

  // casePopup.addEventListener('popupclose', function() {
  //   console.log('closed');
  // });


  casesBlock.addEventListener('click', function(e) {
    e.preventDefault();
    let target = e.target;

    if (target.classList.contains('case__link')) {
      let parent = target.closest('.case'),
        title = parent.getAttribute('data-title'),
        area = parent.getAttribute('data-area'),
        gallery = q('.case__images', parent),
        galleryClone = gallery.cloneNode(true),
        galleryChilds = galleryClone.children,
        popupImages = '',
        popupNavImages = '',
        text = q('.case__text', parent);

      if (area) {
        area = area.replace('м2', 'м<sup class="case__title-sup">2</sup>');
      }

      if (galleryChilds) {

        galleryChilds.forEach(function(a) {
          let clearImgHTML = a.children[0].outerHTML.replace(/ lazyloaded| lazy| src=".*?"|data-/g, '');

          popupImages += a.outerHTML.replace(/<img[\s\S]*?>/, clearImgHTML)
            .replace('case__link"', 'case-popup__link" data-fancybox="images"')
            .replace('case__img', 'case-popup__images-img');
          popupNavImages += clearImgHTML.replace('case__img', 'case-popup__images-nav-img');
        });
      }

      casePopupTitle.innerHTML = title;
      casePopupArea.innerHTML = area;
      casePopupText.innerHTML = text.innerHTML;
      casePopupImages.innerHTML = popupImages;
      casePopupImagesNav.innerHTML = popupNavImages;

      $('[data-fancybox="images"]').fancybox({
        beforeClose: function(e, instance, slide) {
          $casePopupImages.slick('slickGoTo', e.currIndex);
        },
        backFocus: false,
        buttons: [
          'share',
          'zoom',
          'fullScreen',
          'close'
        ]
      });

      casePopupImagesNav.addEventListener('mousewheel', slideByMouse);

      casePopupImages.addEventListener('mousewheel', slideByMouse);

      $casePopupImages.slick({
        prevArrow: SLIDER.createArrow('case-popup__prev', cornerArrowSvg),
        nextArrow: SLIDER.createArrow('case-popup__next', cornerArrowSvg),
        infinite: false,
        draggable: false
      });

      $casePopupImagesNav.slick({
        arrows: false,
        dots: true,
        // appendArrows: $('.cases-sect__arrows'),
        // prevArrow: SLIDER.createArrow('cases-sect__prev', arrowSvg),
        // nextArrow: SLIDER.createArrow('cases-sect__next', arrowSvg),
        infinite: false,
        variableWidth: true,
        slidesToScroll: 5,
        slidesToShow: 5
      });

      let casePopupNavImages = qa('img', casePopupImagesNav);

      casePopupNavImages[0].classList.add('current');

      $casePopupImages.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        $casePopupImagesNav.slick('slickGoTo', nextSlide);
        casePopupNavImages.forEach(function(img) {
          img.classList.remove('current');
        });
        casePopupNavImages[nextSlide].classList.add('current');
      });

      casePopupImagesNav.addEventListener('click', function() {
        let target = event.target,
          tragetIndex = qa('.case-popup__images-nav-img', casePopupImagesNav, true).indexOf(target);

        $casePopupImages.slick('slickGoTo', tragetIndex);
      });

      $casePopupImagesNav.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        $casePopupImages.slick('slickGoTo', nextSlide);
      });


      casePopup.openPopup();


    }

    console.log(target);
  });


  windowFuncs.resize.push(setCasesBlockHeight, buildCasesSlider);


}