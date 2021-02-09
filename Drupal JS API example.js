(function ($, Drupal) {

  Drupal.behaviors.aitBurger = {
    attach: function () {
      $('.mobile-menu-burger').once().on('click', function () {
        $(this).toggleClass('collapsed');
        $('.region--header-mobile').toggleClass('active');
        $('body').toggleClass('inactive-body');
      });
    }
  };

  Drupal.behaviors.aitLanguages = {
    attach: function () {
      $('.language-button').once().on('click', function () {
        $(this).toggleClass('collapsed');
        $('.region--header-mobile-languages').toggleClass('active');
        $('body').toggleClass('inactive-body');
      });
    }
  };

})(jQuery, Drupal);
