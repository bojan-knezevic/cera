<?php 

require_once 'vendor/autoload.php';

use App\Base; 


$html = new Base(
    "cerabydanielle - Home", 
    "",
    "Home page of cerabydanielle, Scented Candle Shop Website", 
    "Scented Candles, Candle Shop, Small Business",
); 

$html->renderHtmlStart();
$html->renderMetas();
$html->renderLinks();
$html->renderHeader();
?>
    <main>
        <section class="hero">
            <h1>cerabydanielle</h1>
            <p>Begin your exploration now and uncover the sights you've been dreaming of!</p>
            <a href="#" class="btn-primary">Discover Trends</a>
        </section>

        
        <!-- Popular Items Carousel Section -->
        <section class="popular-section">
            <h2 class="section-title">Popular Items</h2>
            <div class="carousel-container">
                <div class="carousel-track-wrapper">
                    <div class="carousel-track" id="popularTrack">
                        <div class="collection-card">
                            <div class="collection-img">
                                <img src="{$this->pathAdjustment}assets/images/candles/midnight-orchid.jpg" alt="Midnight Orchid Candle">
                            </div>
                            <div class="collection-info">
                                <h3>Midnight Orchid</h3>
                                <p>Rich floral notes & smoky vanilla bean.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Product</a>
                            </div>
                        </div>
                        <div class="collection-card">
                            <div class="collection-img">
                                <img src="{$this->pathAdjustment}assets/images/candles/golden-amber.jpg" alt="Golden Amber Candle">
                            </div>
                            <div class="collection-info">
                                <h3>Golden Amber</h3>
                                <p>Warm sandalwood, amber & sweet musk.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Product</a>
                            </div>
                        </div>
                        <div class="collection-card">
                            <div class="collection-img">
                                <img src="{$this->pathAdjustment}assets/images/candles/velvet-rose.jpg" alt="Velvet Rose Candle">
                            </div>
                            <div class="collection-info">
                                <h3>Velvet Rose</h3>
                                <p>Fresh-cut red roses & sparkling bergamot.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Product</a>
                            </div>
                        </div>
                        <div class="collection-card">
                            <div class="collection-img">
                                <img src="{$this->pathAdjustment}assets/images/candles/spiced-chai.jpg" alt="Spiced Chai Candle">
                            </div>
                            <div class="collection-info">
                                <h3>Spiced Chai</h3>
                                <p>Cinnamon, cardamom & steamed oat milk.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <!-- Scented Collections Carousel Section -->
        <section class="collections-section">
            <h2 class="section-title">Explore Our Scented Collections</h2>
            <div class="carousel-container">
                <button class="carousel-btn prev" onclick="scrollCarousel(-1)"><i class="bi bi-chevron-left"></i></button>
                <div class="carousel-track-wrapper" id="carouselWrapper">
                    <div class="carousel-track" id="carouselTrack">
                        <div class="collection-card">
                            <div class="collection-img"><i class="bi bi-snow"></i></div>
                            <div class="collection-info">
                                <h3>Winter 2025/2026</h3>
                                <p>Cozy pine, warm amber & vanilla spice notes.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Collection</a>
                            </div>
                        </div>
                        <div class="collection-card">
                            <div class="collection-img"><i class="bi bi-heart-fill"></i></div>
                            <div class="collection-info">
                                <h3>Valentines day 2026</h3>
                                <p>Romantic rose, sweet peony & velvety chocolate.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Collection</a>
                            </div>
                        </div>
                        <div class="collection-card">
                            <div class="collection-img"><i class="bi bi-flower1"></i></div>
                            <div class="collection-info">
                                <h3>Easter 2026</h3>
                                <p>Fresh spring blossoms & citrus morning dew.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Collection</a>
                            </div>
                        </div>
                        <div class="collection-card">
                            <div class="collection-img"><i class="bi bi-sun-fill"></i></div>
                            <div class="collection-info">
                                <h3>Summer 2026</h3>
                                <p>Coconut breeze, juicy mango & coastal air.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Collection</a>
                            </div>
                        </div>
                        <div class="collection-card">
                            <div class="collection-img"><i class="bi bi-cup-hot-fill"></i></div>
                            <div class="collection-info">
                                <h3>Winter 2026/2027</h3>
                                <p>Cinnamon hearth, roasted chestnut & cashmeran.</p>
                                <a href="#" class="btn-outline" style="padding: 0.3rem 1rem; font-size: 0.85rem;">View Collection</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-btn next" onclick="scrollCarousel(1)"><i class="bi bi-chevron-right"></i></button>
            </div>
        </section>
    </main>
<?php
$html->renderFooter();
$html->renderHtmlEnd();
?>
    