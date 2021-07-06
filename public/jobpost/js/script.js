// navbar js
var nav_offset_top = $('header').height() + 50;
/*-------------------------------------------------------------------------------
  Navbar
-------------------------------------------------------------------------------*/

//* Navbar Fixed
function navbarFixed() {
    if ($('.header_menu').length) {
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= nav_offset_top) {
                $('.header_menu').addClass('navbar_fixed');
            } else {
                $('.header_menu').removeClass('navbar_fixed');
            }
        });
    }
}
navbarFixed();

$('.ckeditor').ckeditor();