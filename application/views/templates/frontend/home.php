<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<aside class="sidebar">
    <div class="ui vertical menu">
        <div class="item">
            <div class="header">Products</div>
            <div class="menu">
                <a href="#" class="item">Shoes</a>
                <a href="#" class="item">Bags</a>
                <a href="#" class="item">Lingeries</a>
            </div>
        </div>
        <div class="item">
            <div class="header">Supports</div>
            <div class="menu">
                <a href="#" class="item">Cool</a>
                <a href="#" class="item">Keren</a>
            </div>
        </div>
        <div class="item">
            <div class="header">Products</div>
            <div class="menu">
                <a href="#" class="item">Shoes</a>
                <a href="#" class="item">Bags</a>
                <a href="#" class="item">Lingeries</a>
            </div>
        </div>
    </div>

    <div class="ui cards deposit">
        <div class="card">
            <div class="content">
                <div class="header">Coba deposit kami</div>
                <a href="#" class="learn-more">Apa itu deposit?</a>
                <div class="ui fluid popup what-is-deposit item center right">
                    <div class="ui avatar image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" alt="">
                    </div>
                    <div class="content">
                        <div class="header">Apa itu deposit?</div>
                        <div class="description">
                            Deposit Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.
                        </div>
                    </div>
                </div>
                <div class="description">
                    Dan dapatkan berbagai macam benefit menarik.
                </div>
                <form class="ui form">
                    <div class="grouped fields">
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="nominal" class="hidden" tabindex="0" checked=""/>
                                <label>Pilih nominal: </label>
                                <div class="field">
                                    <select class="ui dropdown">
                                        <option value="50000">Rp 50.000,00</option>
                                        <option value="100000">Rp 100.000,00</option>
                                        <option value="150000">Rp 150.000,00</option>
                                        <option value="500000">Rp 500.000,00</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="nominal" class="hidden" tabindex="0" />
                                <label for="">Input nominal: </label>
                                <div class="field">
                                    <input type="number" id="nominalSelect" name="nominalSelect" value="" placeholder="Masukkan angka...">
                                </div>
                            </div>
                        </div>
                    </div>
                </form> <!-- kelar UI Form -->
            </div> <!-- kelar class Content di Deposit -->

            <button class="ui bottom attached right labeled icon black button">
                <i class="right arrow icon"></i> Deposit
            </button>

        </div>
    </div> <!-- kelar Deposit -->
</aside>

<div class="main">

    <div class="ui main-ad stackable grid">
        <div class="twelve wide column">
            <div class="ui card">
                <div class="one-item-carousel owl-carousel owl-theme">
                    <?php 
                    if(!empty($listslider)){
                        foreach ($listslider as $slider) {
                    ?>
                    <div class="image">
                        <img src="<?php echo $slider->imageSLIDER;?>" alt="<?php echo $slider->titleSLIDER;?>">
                    </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="four wide column">
            <a href="#" class="ui card">
                <div class="image">
                    <img src="https://source.unsplash.com/collection/1055793/" alt="">
                </div>
            </a>
        </div>
    </div> <!-- kelar Main-Ad -->

    <div class="ui best-seller stackable grid">

        <div class="four wide doubling blackish column">
            <div class="card">
                Best-selling minggu ini! Be inspired!
                <div>
                    <a href="#">
                        Lihat semua <i class="right long arrow icon"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="twelve wide column loop owl-theme owl-carousel">

            <div class="three wide doubling column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Brick-shaped backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="three wide doubling column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="floating ui red label">HOT!</div>
                    <div class="content">
                        <h4 class="header">Handbag-style backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="three wide doubling column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/9823/501/807/9823501807_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Basic two-tone backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="three wide doubling column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/502/015/5820502015_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Faux leather backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="three wide doubling column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Brick-shaped backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="three wide doubling column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="floating ui red label">HOT!</div>
                    <div class="content">
                        <h4 class="header">Handbag-style backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="three wide doubling column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/9823/501/807/9823501807_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Basic two-tone backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="three wide doubling column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/502/015/5820502015_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Faux leather backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>

        </div> <!-- kelar div Loop / Owl-Carousel -->

    </div>
    <div class="ui promo stackable grid">
        <div class="four wide blackish column">
            <div class="card">
                Promo keren minggu ini! You don't want to miss these.
                <div>
                    <a href="#">
                        Lihat semua <i class="right long arrow icon"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="twelve wide column loop owl-theme owl-carousel">
        <?php
        if(!empty($barangpromo)){
            foreach ($barangpromo as $promo) {
        ?>
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="<?php echo $promo->imageBARANG;?>" class="visible content" alt="<?php echo $promo->nameBARANG;?>">
                        <img src="<?php echo $promo->imageBARANG2;?>" class="hidden content" alt="<?php echo $promo->nameBARANG;?>">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="floating ui red label">HOT!</div>
                    <div class="content">
                        <h4 class="header">Brick-shaped backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        <?php } ?>
        </div> <!-- kelar div Loop / Owl-Carousel -->
    </div>

    <div class="ui new-arrival stackable grid">

        <div class="four wide blackish column">
            <div class="card">
                Barang baru minggu ini! Too fresh!
                <div>
                    <a href="#">
                        Lihat semua <i class="right long arrow icon"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="twelve wide column loop owl-theme owl-carousel">
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Brick-shaped backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Handbag-style backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/9823/501/807/9823501807_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Basic two-tone backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/502/015/5820502015_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="floating ui red label">HOT!</div>
                    <div class="content">
                        <h4 class="header">Faux leather backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Brick-shaped backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Handbag-style backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/9823/501/807/9823501807_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="header">Basic two-tone backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="three wide column">
                <a href="#" class="ui card">
                    <div class="ui slide masked reveal image">
                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/502/015/5820502015_2_1_2.jpg" class="visible content">
                        <img src="https://source.unsplash.com/user/nativemello/" class="hidden content">
                        <div class="ui icon black buttons additional-actions">
                            <button class="ui button add-to-wishlist" title="Tambahkan ke Wishlist">
                                <i class="empty heart icon"></i>
                            </button>
                            <button class="ui button add-to-cart" title="Tambahkan ke Cart">
                                <i class="shopping basket icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="floating ui red label">HOT!</div>
                    <div class="content">
                        <h4 class="header">Faux leather backpack</h4>
                        <div class="meta">
                            <span class="price">IDR 50K</span>
                            <span class="category">Bag, Clutch</span>
                        </div>
                    </div>
                </a>
            </div>
        </div> <!-- kelar div Loop / Owl-Carousel -->
    </div>
</div> <!-- kelar Main -->