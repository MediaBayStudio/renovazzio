let teamList = id('team-list');
console.log(teamList);

if (teamList) {
  let $teamList = $(teamList),
    arrowSvg = '<svg class="arrow__svg" width="10" height="22" viewBox="0 0 10 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 21L9 10.1667L1 1" stroke="currentColor"/></svg>',
    dot =  '<button type="button" class="dot"></button>',
    buildTeamSlider = function() {
      if (media('(min-width:575.98px)')) {
        if (SLIDER.hasSlickClass($teamList)) {
          $teamList.slick('unslick');
        }
      } else {
        if (SLIDER.hasSlickClass($teamList)) {
          return;
        }
        $teamList.slick({
          prevArrow: SLIDER.createArrow('team-sect__prev', arrowSvg),
          nextArrow: SLIDER.createArrow('team-sect__next', arrowSvg),
          infinite: false,
          appendDots: $('.team-sect'),
          dots: true,
          dotsClass: 'team-sect__dots',
          customPaging: function() {
            return dot;
          }
        });
      }
    };
    
  windowFuncs.resize.push(buildTeamSlider);
}