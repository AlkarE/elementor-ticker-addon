jQuery(document).ready(function ($) {
  $('.ticker').each(function () {
    let speed = $(this).attr('data-speed');
    let direction = $(this).attr('data-direction')
    console.log($(this))
    $(this).simplemarquee({
      speed,
      direction,
      space: 0,
      delayBetweenCycles: 0,
      cycles: 'infinity'

    })
  });
});