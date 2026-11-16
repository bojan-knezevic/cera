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
        <html lang="en">
        <head>
            <title>$this->title</title>
        HTML;
        echo $result;
    }

    /**
     * @return void
     */
    function renderHtmlEnd(): void
    {
        $text = <<<FIN
        <!--div id="preloader"><img src="Assets/Images/preloader.gif" alt=""></div> Preloader - DO NOT CHANGE!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
            
            <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
            
            <!-- CDN Scripts -->
            <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>           
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js" integrity="sha512-S/H9RQ6govCzeA7F9D0m8NGfsGf0/HjJEiLEfWGaMCjFzavo+DkRbYtZLSO+X6cZsIKQ6JvV/7Y9YMaYnSGnAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.4/swiper-bundle.min.js" integrity="sha512-/LKHQ9K9yatyOfEKXiysc9SPCpF6xkvfHQxtPkhdKS83GvfyIWDwKaOr3/LqVxbEX89Bqz+SbMHEPWm0AeRWnA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            
            <script src="
        FIN;
        echo $text;
        echo $this->pathAdjustment . 'assets/javascript/main.js"></script>';
        echo '</body>
              </html>';
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

        <link rel="stylesheet" href="{$this->pathAdjustment}assets/style/style.css">
        <link href="{$this->pathAdjustment}assets/images/icon.png" rel="icon">
        <link href="{$this->pathAdjustment}assets/images/icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

        <!-- CDN CSS Files -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" integrity="sha512-Zcn6bjR/8RZbLEpLIeOwNtzREBAJnUKESxces60Mpoj+2okopSAcSUIUOseddDm0cxnGQzxIR7vJgsLZbdLE3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" integrity="sha512-oAvZuuYVzkcTc2dH5z1ZJup5OmSQ000qlfRvuoTTiyTBjwX1faoyearj8KdMq0LgsBTHMrRuMek7s+CxF8yE+w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" integrity="sha512-cn16Qw8mzTBKpu08X0fwhTSv02kK/FojjNLz0bwp2xJ4H+yalwzXKFw/5cLzuBZCxGWIA+95X4skzvo8STNtSg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css" integrity="sha512-T+KoG3fbDoSnlgEXFQqwcTC9AdkFIxhBlmoaFqYaIjq2ShhNwNao9AKaLUPMfwiBPL0ScxAtc+UYbHAgvd+sjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.4/swiper-bundle.min.css" integrity="sha512-1CRCT9P70z3SktzqL7P8o8YvlmT1nXwFeXLBuVBa4mzQJ4fsvpmsObWooerRi4WzQT8QFrBVz/36mt/XGPYVzw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- CDN JavaScript Files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
LINKS;

        echo $result;
    }

    /**
     * @return void
     */
    function renderHeader(): void
    {
        $account = new Account();
        $text = <<<NAVBAR
        <body>
        <header id="header" class="fixed-top d-flex align-items-center">
            <div class="container d-flex justify-content-between">

                <div class="logo">
                    <h1><a href="{$this->pathAdjustment}home"><img src="{$this->pathAdjustment}assets/images/logo.png" alt="Found 2.0 logo"></a></h1>
                </div>

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="nav-link " href="{$this->pathAdjustment}home" id="index">Home</a></li>
                        <li><a class="nav-link " href="{$this->pathAdjustment}popular" id="popular">Popular</a></li>
                        <li><a class="nav-link " href="{$this->pathAdjustment}search" id="search">Search</a></li>
                        <li><a class="nav-link" href="{$this->pathAdjustment}about" id="about">About</a></li>
                       <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>-->
                </li>
NAVBAR;
        echo $text;
        if(!empty($_SESSION['logged_in'])){
            $useragent=$_SERVER['HTTP_USER_AGENT'];
            if (empty($_SESSION['org']) && $account->isAdmin($_SESSION['username']) && isset($_SESSION['admin']))
            {
                echo ' <li class="dropdown"><a class="nav-link" href="' .$this->pathAdjustment. 'dashboard/admin/profile"><span>Admin</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a class="nav-link" href="'. $this->pathAdjustment .'dashboard/admin/user-options/search">User Options</a></li>
                        <li><a class="nav-link" href="'. $this->pathAdjustment .'dashboard/admin/org-options/search">Organisation Options</a></li>
                        <li><a class="nav-link" href="'. $this->pathAdjustment .'dashboard/admin/tour-options/search">Tour Options</a></li>
                        <li class="dropdown nav-link"><a href="'. $this->pathAdjustment .'dashboard/admin/sight-options/search"><span>Sight Options</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="' . $this->pathAdjustment .'dashboard/admin/comment-options/search">Comment Options</a></li>
                            </ul>
                        </li>
                        <li><a class="nav-link" href="'. $this->pathAdjustment .'dashboard/admin/city-options/search">City Options</a></li>
                        <li><a class="nav-link" href="'. $this->pathAdjustment .'dashboard/admin/category-options/search">Category Options</a></li>
                    </ul>';
            }
            if(!empty($_SESSION['org']))
                echo ' <li><a class="nav-link" href="' . $this->pathAdjustment . 'dashboard/organisation/profile" id="Profile">Profile</a></li>';
            else
                echo ' <li><a class="nav-link" href="' . $this->pathAdjustment . 'dashboard/user/profile" id="Profile">Profile</a></li>';

            echo '<li><a class="nav-link" href="' . $this->pathAdjustment . 'auth/logout" id="logout">Log out</a></li>';
        }
        else{
            echo ' <li><a class="nav-link" href="' . $this->pathAdjustment . 'auth/signup" id="Signup">Sign up</a></li>
                            <li><a class="nav-link" href="' . $this->pathAdjustment . 'auth/login" id="Login">Log in</a></li>';
        }

        echo '</ul> <i class="bi bi-list mobile-nav-toggle"></i>
                </nav>
            </div>
        
        </header>';
    }

    /**
     * @return void
     */
    public function renderFooter(): void
    {
        $text = <<<FOOTER
            <footer>
                <div class="footer-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="footer-content">
                                    <div class="footer-head">
                                        <div class="footer-logo">
                                            <h2><img src="{$this->pathAdjustment}assets/images/logo.png" alt="Found 2.0 logo"></h2>
                                        </div>
            
                                        <p>Who needs a travel agency when you can do it yourself! Dive in, explore fascinating sights, and design your own unique tours hassle-free, all in one place.</p>
                                        <div class="footer-icons">
                                            <ul>
                                                <li>
                                                    <a href="#"><i class="bi bi-facebook"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="bi bi-twitter"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="bi bi-instagram"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class="bi bi-linkedin"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end single footer -->
                            <div class="col-md-4">
                                <div class="footer-content">
                                    <div class="footer-head">
                                        <h4>information</h4>
                                        <p>
                                            Need to reach us? Drop us a line at our contact info.
                                        </p>
                                        <div class="footer-contacts">
                                            <p><span>Email:</span> placeholder email</p>
                                            <p><span>Working Hours:</span> 9:00-17:00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>
                <div class="footer-area-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="copyright text-center">
                                    <p>
                                        &copy; Copyright <strong>found2.0</strong>. All Rights Reserved.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End  Footer -->
            FOOTER;
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
   /* public function renderSightItem(string $href, string $imageUrl, string $alt, string $name): void
    {
        $sight = <<<SIGHTITEM
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="single-sight">
                                <div class="sight-images sight-details-img">
                                    <a href="$href">
                                        <img class="sight-details-img-cover" src="$imageUrl" alt="$alt">
                                    </a>
                                </div>
                                <div class="sight-content text-center">
                                    <h4>$name</h4>
                                </div>
                            </div>
                        </div>
SIGHTITEM;

        echo $sight;
    }
   */

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

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $username
     * @param string $email
     * @param string $phone
     * @param string $image
     * @param int $active
     * @param int $admin
     * @param int $banned
     * @return void
     */
    public function renderSearchUserItem(
        int $id,
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $phone,
        string $image,
        int $active,
        int $admin,
        int $banned
    ): void
    {
        $item = <<<SEARCHITEM
            <section class="search-result-item my-2">
                <div class="row">
                <div class="col-md-2">
                    <div class="d-flex justify-content-center">
                        <img class="search-images" src="{$image}" alt="User profile image">
                    </div>
                    <p>User ID: {$id}</p>
                </div>
                    <div class="col-sm-8">
                        <h4>{$firstName} {$lastName}</h4>
                        <p>Username: {$username}</p>
                        <p>Email: {$email}</p>
                        <p>Phone: {$phone}</p>
                        <p>Active: {$active} Admin: {$admin} Banned: {$banned}</p>
                    </div>
                    <div class="col-sm-1 text-center" id="userButtons">
SEARCHITEM;
        echo $item;
        if($banned)
           echo '<button class="btn btn-info btn-sm mb-2 btnBan" id="unban-' . $id .'">Unban</button><br>';
        else
           echo '<button class="btn btn-warning btn-sm mb-2 btnBan" id="ban-' . $id .'" >Ban</button><br>';
        echo '  </div>
                </div>
                <div class="search-result-item-body">
                </div>
                </section>';
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $country
     * @param string $latitude
     * @param string $longitude
     * @return void
     */
    public function renderSearchCityItem(int $id, string $name, string $country, string $latitude, string $longitude): void
    {
        $item = <<<SEARCHITEM
            <section class="search-result-item my-2">
                <div class="row">
                <div class="col-md-2">
                    <p>City ID: {$id}</p>
                </div>
                    <div class="col-sm-8">
                        <h4>{$name}</h4>
                        <p>{$country}</p>
                        <p>{$latitude} / {$longitude}</p>
                    </div>
                    <div class="col-sm-1 text-center" id="userButtons">
                    <button class="btn btn-secondary btn-sm mb-2 btnEdit" data-name="{$name}" data-country="{$country}" data-lat="{$latitude}" data-lon="{$longitude}" id="edit-{$id}">Edit</button>
                    <button class="btn btn-danger btn-sm mb-2 btnRemoveCity" id="remove-{$id}">Remove</button>
                </div>
                </div>
                <div class="search-result-item-body">
                </div>
                </section>
                        
                    
SEARCHITEM;
        echo $item;
    }

    /**
     * @param int $id
     * @param string $name
     * @return void
     */
    public function renderSearchCategoryItem(int $id, string $name): void
    {
        $item = <<<SEARCHITEM
            <section class="search-result-item my-2">
                <div class="row">
                <div class="col-md-2">
                    <p>Category ID: {$id}</p>
                </div>
                    <div class="col-sm-8">
                        <h4>{$name}</h4>
                    </div>
                    <div class="col-sm-1 text-center" id="userButtons">
                    <button class="btn btn-secondary btn-sm mb-2 btnEdit" data-name="{$name}" id="edit-{$id}">Edit</button>
                    <button class="btn btn-danger btn-sm mb-2 btnRemoveCat" id="remove-{$id}">Remove</button>
                </div>
                </div>
                <div class="search-result-item-body">
                </div>
                </section>
                        
                    
SEARCHITEM;
        echo $item;
    }

    /**
     * @param int $id
     * @param string $brn
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $country
     * @param int $cityId
     * @param string $address
     * @param int $active
     * @param int $hidden
     * @param int $verified
     * @return void
     */
    public function renderSearchOrgItem(
        int $id,
        string $brn,
        string $name,
        string $email,
        string $phone,
        string $country,
        int $cityId,
        string $address,
        int $active,
        int $hidden,
        int $verified
    ): void
    {
        $stmt = $GLOBALS['pdo']->prepare("SELECT city_name FROM cities WHERE city_id=?");
        $stmt->execute([$cityId]);
        $city = $stmt->fetch(PDO::FETCH_ASSOC)['city_name'];

        $item = <<<SEARCHITEM
            <section class="search-result-item my-2">
                <div class="row">
                <div class="col-md-3">
                    <p>ID: {$id}</p>
                    <p>BRN: {$brn}</p>
                    <p>{$country}, $city</p>
                    <p>{$address}</p>
                </div>
                    <div class="col-sm-7">
                        <h4>{$name}</h4>
                        <p>Email: {$email}</p>
                        <p>Phone: {$phone}</p>
                        <p>Activated: {$active}</p>
                        <p>Verified: {$verified} Hidden: {$hidden}</p>
                    </div>
                    <div class="col-sm-1 text-center" id="orgButtons">                    
SEARCHITEM;
        echo $item;
        if(!$verified) {
            echo '<button class="btn btn-info btn-sm mb-2 btnVerify" id="verify-' . $id . '">Verify</button><br>';
        }
        else {
            echo '<button class="btn btn-warning btn-sm mb-2 btnVerify" id="disprove-' . $id . '" >Disprove</button><br>';
        }
        if($hidden)
            echo '<button class="btn btn-warning btn-sm mb-2 btnHide" id="show-' . $id .'">Show</button><br>';
        else
            echo '<button class="btn btn-danger btn-sm mb-2 btnHide" id="hide-' . $id .'" >Hide</button><br>';
        echo '</div>
                </div>
                <div class="search-result-item-body">
                </div>
                </section>';
    }

    /**
     * @param string $text
     * @return void
     */
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

    /**
     * @param array $data
     * @return void
     */
    public function renderSearchSightResult(array $data): void
    {
        echo '<div class="col-md-3 col-sm-3 col-xs-12 sight-details-bottom">';
        echo '<div class="single-sight">';
        echo '<div class="sight-image sight-details-img">';
        echo '<a href="' . $this->pathAdjustment . 'sight/details?sight=' . $data['sight_id'] . '">';
        echo '<img class="sight-details-img-cover" src="' . $this->pathAdjustment . 'assets/images/sight/'. $data['photo'] .' " alt="Sight image">';
        echo '</a>';
        echo '</div>';
        echo ' <div class="team-content text-center">';
        echo '<h4 style="word-break: break-word; cursor: default;">' . $data['sight_name']. '</h4>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    /**
     * @param int $id
     * @param string $sightName
     * @param int $orgId
     * @param int $cityId
     * @param string $latitude
     * @param string $longitude
     * @param string $description
     * @param int $category
     * @param string $address
     * @param int $popularity
     * @param string $photo
     * @return void
     */
    public function renderSearchSightItem
    (int $id,
     string $sightName,
     int $orgId,
     int $cityId,
     string $latitude,
     string $longitude,
     string $description,
     int $category,
    string $address,
    int $popularity,
    string $photo
    ): void
    {

        $stmtCity = $GLOBALS['pdo']->prepare("SELECT * FROM cities WHERE city_id=?");
        $stmtCity->execute([$cityId]);
        $city = $stmtCity->fetch(PDO::FETCH_ASSOC)['city_name'];

        $stmtOrg = $GLOBALS['pdo']->prepare("SELECT * FROM organisations WHERE org_id=?");
        $stmtOrg->execute([$orgId]);
        $org = $stmtOrg->fetch(PDO::FETCH_ASSOC)['org_name'];

        $stmtCat = $GLOBALS['pdo']->prepare("SELECT * FROM categories WHERE category_id=?");
        $stmtCat->execute([$category]);
        $cat = $stmtCat->fetch(PDO::FETCH_ASSOC)['category_name'];

        $item = <<<SEARCHITEM
            <section class="search-result-item my-2">
                <div class="row">
                <div class="col-md-3">
                <div class="d-flex justify-content-center">
                        <img class="search-images" src="{$this->pathAdjustment}assets/images/sight/{$photo}" alt="Sight photo">
                    </div>
                    <p>ID: {$id}</p>
                    <p>Org: {$org}</p>
                    <p>{$city},</p>
                    <p>{$address}</p>
                    <p class="m-0">Category:</p>
                    <p >{$cat}</p>
                </div>
                    <div class="col-sm-7">
                        <h4>{$sightName}</h4>
                        <p>{$description}</p>
                        <p>Latitude: {$latitude}</p>
                        <p>Longitude: {$longitude}</p>
                    </div>
                    <div class="col-sm-1 text-center" id="sightButtons">    
                       <p><i class="bi bi-star-fill"></i>: {$popularity}</p>
                       <a class="btn btn-danger btn-sm mb-2 btnRemoveSight" id="remove-{$id}">Remove</a>
                    </div>
                </div>
                <div class="search-result-item-body">
                </div>
                </section>             
SEARCHITEM;
        echo $item;
    }

    /**
     * @param int $id
     * @param int $userId
     * @param string $tourName
     * @param string $country
     * @param int $visibility
     * @param string $description
     * @param int $popularity
     * @param array $sights
     * @return void
     */
    public function renderSearchTourItem
    (
        int $id,
        int $userId,
        string $tourName,
        string $country,
        int $visibility,
        string $description,
        int $popularity,
        array $sights
    ): void
    {
        $stmtUser = $GLOBALS['pdo']->prepare("SELECT username FROM users WHERE user_id=?");
        $stmtUser->execute([$userId]);
        $user = $stmtUser->fetch(PDO::FETCH_ASSOC)['username'].' ';
        $visibility = ($visibility) ? 'Public' : 'Private';
        $item = <<<SEARCHITEM
            <section class="search-result-item my-2">
                <div class="row">
                <div class="col-md-3">
                    <p>ID: {$id}</p>
                    <p>User: {$user}</p>
                    <p>{$country}</p>
                    <p>{$visibility}</p>
                </div>
                    <div class="col-sm-7">
                        <h4>{$tourName}</h4>
                        <p>{$description}</p>
                    </div>
                    <div class="col-sm-1 text-center" id="sightButtons">    
                       <p><i class="bi bi-star-fill"></i>: {$popularity}</p>
                       <a class="btn btn-danger btn-sm mb-2 btnRemoveTour" id="remove-{$id}">Remove</a>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                          
SEARCHITEM;
        echo $item;
        foreach($sights as $sight)
            $this ->renderTourDetailsSight($sight);
        echo "</div>
                </section>";
    }

    /**
     * @param array $data
     * @param string $image
     * @return void
     */
    public function renderSearchTourResult(array $data, string $image): void
    {
        echo '<div class="col-md-3 col-sm-3 col-xs-12 sight-details-bottom">';
        echo '<div class="single-sight">';
        echo '<div class="sight-image sight-details-img">';
        echo '<a href="' . $this->pathAdjustment . 'tour/details?tour=' . $data['tour_id'] . '">';
        echo '<img class="sight-details-img-cover" src="'. $this->pathAdjustment. 'assets/images/sight/' . $image . '" alt="Tour image">';
        echo '</a>';
        echo '</div>';
        echo ' <div class="team-content text-center">';
        echo '<h4  style="word-break: break-word; cursor: default;">' . $data['tour_name'] . '</h4>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    /**
     * @param array $sight_details
     * @return void
     */
    public function renderTourDetailsSight(array $sight_details): void
    {
        echo '<div class="col-md-3 col-sm-3 col-xs-12 sight-details-bottom">';
        echo '<div class="single-sight">';
        echo '<div class="sight-image sight-details-img">';
        echo '<a href="' . $this->pathAdjustment . 'sight/details?sight=' . $sight_details['sight_id'] . '">';
        echo '<img class="sight-details-img-cover" src="'. $this->pathAdjustment . 'assets/images/sight/' . $sight_details['photo'] . '" alt="">';
        echo '</a>';
        echo '</div>';
        echo ' <div class="sight-content text-center">';
        echo '<h4>' . $sight_details['sight_name'] . '</h4>';
        echo '<p>' . $sight_details['address'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    /**
     * @param string $image
     * @return void
     */
    public function renderProfileImage(string $image): void
    {
        echo '<img src="' . $this->pathAdjustment . 'assets/images/profile/' . $image . '" alt="Profile picture" id="profileImage" width="150">';
    }

    /**
     * @param array $data
     * @return void
     */
    public function renderTourSight(array $data):void
    {
        echo '<div class="col-md-3 col-sm-3 col-xs-12 sight-details-bottom">';
        echo '<div class="single-sight">';
        echo '<div class="sight-image sight-details-img">';
        echo '<input type="checkbox" value="' . $data['sight_id'] . '" id="sight-' . $data['sight_id'] . '">';

        echo '<img role="button" class="sight-details-img-cover" src="' . $this->pathAdjustment . 'assets/images/sight/'. $data['photo'] .' " alt="Sight image">';
        echo '</div>';
        echo ' <div class="team-content text-center">';
        echo '<div id="order-'. $data['sight_id'] .'" class="order"></div>';
        echo '<h4 style="cursor: default">' . $data['sight_name']. '</h4>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    /**
     * @param int $id
     * @param int $userId
     * @param string $username
     * @param string $sightName
     * @param int $sightId
     * @param string $comment
     * @param int $hidden
     * @param string $created
     * @param string $updated
     * @return void
     */
    public function renderComment
    (int $id,
     int $userId,
     string $username,
     string $sightName,
     int $sightId,
     string $comment,
     int $hidden,
     string $created,
     string $updated
    ): void
    {
        $item = <<<SEARCHITEM
            <section class="search-result-item my-2">
                <div class="row">
                <div class="col-md-3">
                    <p>ID: {$id}</p>
                    <p>User ID: {$userId}</p>
                    <p>Username: {$username}</p>
                    <p>Sight ID: {$sightId}</p>
                    <p>Sight Name: {$sightName}</p>
                    <p>Hidden: {$hidden}</p>
                </div>
                    <div class="col-sm-7">
                        <p><b>{$comment}</b></p>
                        <p>Created: {$created}</p>
                        <p>Updated: {$updated}</p>
                    </div>
                    <div class="col-sm-1 text-center" id="sightButtons">    
                                    
SEARCHITEM;
        echo $item;
        if(!$hidden)
            echo '<a class="btn btn-primary btn-sm mb-2 btnHideComment" id="hide-' . $id .'">Hide</a>';
        else
            echo '<a class="btn btn-warning btn-sm mb-2 btnHideComment" id="hide-' . $id .'">Show</a>';
        echo '        <a class="btn btn-danger btn-sm mb-2 btnRemoveComment" id="remove-' . $id .'">Remove</a>
                    </div>
                </div>
                <div class="search-result-item-body">
                </div>
                </section>';
    }
}