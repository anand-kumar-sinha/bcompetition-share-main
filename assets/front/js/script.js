 
 //back-to-top scroll
  $(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $(window).load(function(){
		  $('#preloader').fadeOut('slow',function(){$(this).remove();});
	    });    // site preloader

	});



//page scroll
new SmoothScroll();
function SmoothScroll(el) {
  var t = this, h = document.documentElement;
  el = el || window;
  t.rAF = false;
  t.target = 0;
  t.scroll = 0;
  t.animate = function() {
    t.scroll += (t.target - t.scroll) * 0.1;
    if (Math.abs(t.scroll.toFixed(5) - t.target) <= 0.47131) {
      cancelAnimationFrame(t.rAF);
      t.rAF = false;
    }
    if (el == window) scrollTo(0, t.scroll);
    else el.scrollTop = t.scroll;
    if (t.rAF) t.rAF = requestAnimationFrame(t.animate);
  };
  el.onmousewheel = function(e) {
    e.preventDefault();
    e.stopPropagation();
    var scrollEnd = (el == window) ? h.scrollHeight - h.clientHeight : el.scrollHeight - el.clientHeight;
    t.target += (e.wheelDelta > 0) ? -70 : 70;
    if (t.target < 0) t.target = 0;
    if (t.target > scrollEnd) t.target = scrollEnd;
    if (!t.rAF) t.rAF = requestAnimationFrame(t.animate);
  };
  el.onscroll = function() {
    if (t.rAF) return;
    t.target = (el == window) ? pageYOffset || h.scrollTop : el.scrollTop;
    t.scroll = t.target;
  };
}



//dropdown menu
if (matchMedia) {
        var mq = window.matchMedia("(min-width: 768px)");
        mq.addListener(WidthChange);
        WidthChange(mq)
    }

    function WidthChange(a) {
        if (a.matches) {
            $(document).ready(function() {
				$('.navbar-inverse .navbar-nav > li.dropdown').hover(function() {
					$('ul.dropdown-menu', this).stop(true, true).slideDown('slow');
					$(this).addClass('open');
				}, function() {
					$('ul.dropdown-menu', this).stop(true, true).slideUp('slow');
					$(this).removeClass('open');
				});
			});
			
        } else {
			 $(document).ready(function() {
                $('.navbar-inverse .navbar-nav > li.dropdown').click(function() {});
			 });
          }
      };




jQuery(document).ready(function($) {
  $('#myCarousel').carousel({
	interval: 3000
  });
});




