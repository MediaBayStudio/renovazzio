let faqBlock = id('faq-list')

if (faqBlock) {
  let faqBlocks = faqBlock.children,
    coeff = 0,

    initDropdown = function() {
      let childs = faqBlocks[0].children;

      setTimeout(function() {
        hideText(1, true);

        let childsHeight = 0;

        for (let i = 0, len = childs.length; i < len; i++) {
          childsHeight += childs[i].scrollHeight
        }

        faqBlocks[0].style.maxHeight = coeff + childsHeight + 'px';
        faqBlocks[0].classList.add('active');
      }, 1);

      faqBlock.addEventListener('click', function(e) {
        let target = e.target;
        if (target.classList.contains('faq-sect__li-title') && !target.parentElement.classList.contains('active')) {
          dropdownText(target);
        }
      });

    },

    dropdownText = function(element) {
      element = element || faqBlocks[0]; // если элемент не передали, то открываем первый

      let parent = element.parentElement,
        childs = parent.children,
        childsHeight = 0;

      for (let i = 0, len = childs.length; i < len; i++) {
        childsHeight += childs[i].scrollHeight;
      }

      if (parent.classList.contains('active')) {
        if (faqBlocks.length > 1) {
          parent.style.maxHeight = minHeight + 'px';
          parent.classList.remove('active');
        }
      } else {
        hideText(0, true);
        parent.classList.add('active');
        parent.style.maxHeight = coeff + childsHeight + 'px';
      }
    },

    hideText = function(start, setHeight) {
      for (let i = start; i < faqBlocks.length; i++) {
        faqBlocks[i].classList.remove('active');
        if (setHeight) {
          faqBlocks[i].style.maxHeight = coeff + faqBlocks[i].children[0].scrollHeight + 'px';
        }
      }
    };

  initDropdown();

}