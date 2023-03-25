import Swiper, { Pagination } from 'swiper'



// ------------------------ MENU

(() => {
  $('.menu-button').on('click', () => {
    $('body').toggleClass('mob-menu-open')
  })
})()



// ------------------------ SWIPER

new Swiper('.step-6-swiper', {
  modules: [Pagination],
  centeredSlides: true,
  slidesPerView: 1.2,
  spaceBetween: 5,
  simulateTouch: false,
  breakpoints: {
    641: {
      slidesPerView: 1.6,
      spaceBetween: 10,
    },
    1025: {
      slidesPerView: 2.4,
      spaceBetween: 20,
    }
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '"><span>' + document.querySelectorAll('.step-6-swiper .swiper-slide .title')[index].innerHTML + '</span></span>';
    },
  },
})



// ------------------------ ANCHOR NAV

$(window).scroll(function () {
  var scrollDistance = $(window).scrollTop();
  $('.step-anchor').each(function (i) {
    if ($(this).position().top - 100 <= scrollDistance) {
      $('a.anchor.active').removeClass('active');
      $('a.anchor').eq(i).addClass('active');
    } else {
      $('a.anchor').eq(i).removeClass('active');
    }
  });
}).scroll();

$(function () {
  $('a.anchor, a.achor-home').click(function () {
    $('body').removeClass('mob-menu-open')
    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']')
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - 50
        }, 500);
        return false;
      }
    }
  })
})



// ------------------------ FORM

$(function () {
  const form = $('.form-popup')
  const button = $('.button.form')
  const close = $('.form-popup .close')
  button.on('click', function (e) {
    e.preventDefault()
    //
    form.addClass('active')
    //
    const title = $(this).attr('data-form-title') || $(this).text()
    form.find('h4').text(title)
    form.find('.subject').val(title)
    //
    const hasPackage = $(this).hasClass('has-package')
    if (hasPackage) {
      form.find('label.package').show()
    } else {
      form.find('label.package').hide()
    }
    // set first option as default
    form.find('label.package select').val(form.find('label.package select option:first').val())
  })
  close.on('click', function () {
    form.removeClass('active')
  })
})
