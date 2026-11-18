(function() {
    "use strict";
    let pathAdjustment = '';
    
    $(document).ready(function () {
        let loc = window.location.pathname;
        let dir = loc.substring(0, loc.lastIndexOf('/'));
        let arr = dir.split('/');

        for (let i = 0; i < arr.length - 1; i++)
            pathAdjustment += '../';
        //$.getScript(pathAdjustment + 'assets/javascript/password-strength.js');

        // Sync icon state on load
        const savedTheme = localStorage.getItem('ceraby_theme') || 'dark';
        $('html').attr('data-theme', savedTheme);
        const $themeIcon = $('#themeIcon');
        if (savedTheme === 'light') {
            $themeIcon.removeClass('bi-moon-fill bi-moon').addClass('bi-sun-fill');
        } else {
            $themeIcon.removeClass('bi-sun-fill bi-sun').addClass('bi-moon-fill');
        }
    });

    // Toggle theme on <html> instead of <body>
    $(document).on('click', '#themeToggleBtn', function (e) {
        e.preventDefault();
        const $html = $('html');
        const $themeIcon = $('#themeIcon');

        if ($html.attr('data-theme') === 'dark') {
            $html.attr('data-theme', 'light');
            localStorage.setItem('ceraby_theme', 'light');
            $themeIcon.removeClass('bi-moon-fill bi-moon').addClass('bi-sun-fill');
        } else {
            $html.attr('data-theme', 'dark');
            localStorage.setItem('ceraby_theme', 'dark');
            $themeIcon.removeClass('bi-sun-fill bi-sun').addClass('bi-moon-fill');
        }
    });

    $(document).on('click', '.scroll-top', function () {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
    });

    let scrollPosition = 0;
    window.scrollCarousel = function(direction) {
        const $track = $('#carouselTrack');
        const $card = $track.find('.collection-card').first();
        const cardWidth = $card.outerWidth(true);
        
        scrollPosition += direction * cardWidth;
        
        const maxScroll = $track[0].scrollWidth - $track.parent().width();
        if (scrollPosition < 0) scrollPosition = 0;
        if (scrollPosition > maxScroll) scrollPosition = maxScroll;
        
        $track.css('transform', `translateX(-${scrollPosition}px)`);
    };

})();