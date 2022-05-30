//=include telMask.js
//=include validateForms.js
// setPolyfills();

// В основном для IE
if (!NodeList.prototype.forEach) {
  NodeList.prototype.forEach = Array.prototype.forEach;
}

if (!HTMLCollection.prototype.forEach) {
  HTMLCollection.prototype.forEach = Array.prototype.forEach;
}

fakeScrollbar = id('fake-scrollbar');

burger = q('.hdr__burger');

hdr = q('.hdr');

menu = mobileMenu({
  menu: q('.menu'),
  menuCnt: q('.menu__cnt'),
  openBtn: burger,
  closeBtn: burger,
  toRight: true,
  fade: false,
  allowPageScroll: false
});

let navLinks = qa('.nav-link');

for (let i = 0, len = navLinks.length; i < len; i++) {
  navLinks[i].addEventListener('click', scrollToTarget);
}

// q('.hero-sect__btn').addEventListener('click', scrol);

sticky(hdr);

callbackPopup = new Popup('.callback-popup', {
  openButtons: '.hdr__callback, .menu__callback',
  closeButtons: '.callback-popup__close'
});
