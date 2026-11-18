<?php

namespace App;

use PDO;

class Base
{
    public function __construct
    (
        public string $title = '',
        public string $pathAdjustment = '',
        public string $description = '',
        public string $keywords = '',
    ){}

    /**
    * @return void
     */
    function renderHtmlStart(): void
    {
        $result = <<<HTML
        <!DOCTYPE html>
        <html lang="en" data-theme="light">
        <head>
            <title>$this->title</title>
        HTML;
        echo $result;
    }


    function renderMetas(): void
    {
        $result = <<<METAS
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="$this->description" name="description">
        <meta content="$this->keywords" name="keywords">
METAS;

        echo $result;
    }

    /**
    * @return void
     */
    function renderLinks(): void
    {
        $result = <<<LINKS

        <link rel="stylesheet" href="{$this->pathAdjustment}assets/styles/style.css">
        <link href="{$this->pathAdjustment}assets/images/icon.jpg" rel="icon">
        <link href="{$this->pathAdjustment}assets/images/icon.jpg" rel="apple-touch-icon">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- CDN CSS Files -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" integrity="sha512-Zcn6bjR/8RZbLEpLIeOwNtzREBAJnUKESxces60Mpoj+2okopSAcSUIUOseddDm0cxnGQzxIR7vJgsLZbdLE3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" integrity="sha512-cn16Qw8mzTBKpu08X0fwhTSv02kK/FojjNLz0bwp2xJ4H+yalwzXKFw/5cLzuBZCxGWIA+95X4skzvo8STNtSg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.4/swiper-bundle.min.css" integrity="sha512-1CRCT9P70z3SktzqL7P8o8YvlmT1nXwFeXLBuVBa4mzQJ4fsvpmsObWooerRi4WzQT8QFrBVz/36mt/XGPYVzw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Leaflet JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <!-- Theme Flashing Fix -->
        <script>
            (function() {
                const savedTheme = localStorage.getItem('ceraby_theme') || 'dark';
                document.documentElement.setAttribute('data-theme', savedTheme);
            })();
        </script>

        </head>
LINKS;

        echo $result;
    }

    /**
    * @return void
     */
    function renderHeader(): void
    {
        
        $text = <<<NAVBAR
        <body>

    <header>
        <a href="#" class="logo-container">
            <div class="logo-image-container">
                <img src="{$this->pathAdjustment}assets/images/icon.jpg" alt="cerabydanielle logo">
            </div>
        </a>
        <nav>
            <a href="#" class="active">Home</a>
            <a href="#">Search</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
        </nav>
        <div class="nav-actions">
            <button class="theme-toggle" id="themeToggleBtn" title="Switch Theme">
                <i class="bi bi-moon-fill" id="themeIcon"></i>
            </button>
            <a href="#" class="btn-outline">Sign up</a>
            <a href="#" class="btn-solid">Log in</a>
        </div>
    </header>
NAVBAR;
        echo $text;
    }

    /**
    * @return void
     */
    public function renderFooter(): void
    {
        $text = <<<FOOTER
            <footer>
                <div class="footer-content">
                    <div class="footer-col">
                        <div class="logo-container" style="margin-bottom: 1rem;">
                            <div class="logo-badge">CERA</div>
                            <span class="logo-text">cerabydanielle</span>
                        </div>
                        <p>Who needs a travel agency when you can do it yourself! Dive in, explore fascinating sights, and design your own unique tours hassle-free, all in one place.</p>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/cerabydanielle/" target="_blank" class="social-icon"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="footer-col">
                        <h3>Information</h3>
                        <p>Need to reach us? Drop us a line at our contact info.</p>
                        <p><strong>Email:</strong>cerabydanielle@gmail.com</p>
                        <p><strong>Contact:</strong> <a href="https://www.instagram.com/cerabydanielle/" target="_blank" class="insta-link">@cerabydanielle</a></p>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="scroll-top" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                        <i class="bi bi-arrow-up"></i>
                    </div>
                    <p>&copy; Copyright cerabydanielle. All Rights Reserved.</p>
                </div>
            </footer>
            <!-- End  Footer -->
            FOOTER;
        echo $text;
    }

    /**
    * @return void
     */
    function renderHtmlEnd(): void
    {
        $text = <<<FIN
        <!--div id="preloader"><img src="assets/images/preloader.gif" alt=""></div> Preloader - DO NOT CHANGE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
            
            <!-- CDN Scripts -->
            <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>           
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js" integrity="sha512-S/H9RQ6govCzeA7F9D0m8NGfsGf0/HjJEiLEfWGaMCjFzavo+DkRbYtZLSO+X6cZsIKQ6JvV/7Y9YMaYnSGnAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.4/swiper-bundle.min.js" integrity="sha512-/LKHQ9K9yatyOfEKXiysc9SPCpF6xkvfHQxtPkhdKS83GvfyIWDwKaOr3/LqVxbEX89Bqz+SbMHEPWm0AeRWnA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            
            <script src="{$this->pathAdjustment}assets/scripts/main.js"></script>
            </body>
            </html>
        FIN;
        echo $text;
    }

    /**
    * @param string $href
    * @param string $text
    * @return void
     */
    public function renderSideMenuOption(string $href, string $text): void
    {
        $trimmedText = trim($text);
        $option = <<<SIDEOPTION
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="single-team-member">
                            <div class="profile-item admin-item text-center d-flex  justify-content-center" style="height: 5rem">
                                <a href="{$href}" class="nav-link fs-2 my-auto" id="btn{$trimmedText}">
                                    {$text}
                                </a>
                            </div>
                        </div>
                    </div>
SIDEOPTION;
    echo $option;
    }
 
    /**
* @param string $href
* @param string $text
* @return void
     */
    public function renderDashboardOption(string $href, string $text): void
    {
        $option = <<<DASHBOARDOPTION
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="single-option">
                                <div class="option-details">
                                    <a href="$href">
                                        <p>$text</p>
                                    </a>
                                </div>
                            </div>
                        </div>
DASHBOARDOPTION;

        echo $option;
    }

    public function renderNotificationModal(string $text,) :void
    {
        $item = <<<SUCCESSMODAL
<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notification" aria-hidden="true" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div id="notification-body" class="modal-body text-center">
                              {$text}
                            </div>
                        </div>
                    </div>
                </div>
SUCCESSMODAL;
echo $item;
    }
}