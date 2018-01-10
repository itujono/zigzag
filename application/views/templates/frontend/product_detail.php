<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<aside class="sidebar">
    <div class="ui vertical menu">
        <div class="item">
            <div class="header">Bags</div>
            <div class="menu">
                <a href="#" class="active item"><!--<i class="shopping bag icon"></i>--> All Bags</a>
                <a href="#" class="item">Pouch Bags</a>
                <a href="#" class="item">So Bags</a>
                <a href="#" class="item">Air Bags</a>
            </div>
        </div>
        <div class="item">
            <div class="header">Shoes</div>
            <div class="menu">
                <a href="#" class="item">All Shoes</a>
                <a href="#" class="item">Wedges</a>
                <a href="#" class="item">High Heels</a>
                <a href="#" class="item">Boots</a>
                <a href="#" class="item">Pantofel</a>
                <a href="#" class="item">Sneakers</a>
            </div>
        </div>
        <div class="item">
            <div class="header">Lingeries</div>
            <div class="menu">
                <a href="#" class="item">All Lingeries</a>
                <a href="#" class="item">Casual</a>
                <a href="#" class="item">Naughty</a>
                <a href="#" class="item">Formal</a>
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

            <button class="ui bottom attached right large labeled icon black button">
                <i class="right arrow icon"></i> Deposit
            </button>

        </div>
    </div> <!-- kelar Deposit -->
</aside>
<div class="main">
    <div class="ui breadcrumb">
        <a href="#" class="section">Home</a>
        <div class="divider"> / </div>
        <a href="#" class="section">Produk</a>
        <div class="divider"> / </div>
        <a href="#" class="section"><?php echo $parentcategory->nameCATEGORY;?></a>
        <div class="divider"> / </div>
        <a href="#" class="section"><?php echo $getbarang->nameCATEGORY;?></a>
        <div class="divider"> / </div>
        <div class="active section"><?php echo $getbarang->nameBARANG;?></div>
    </div>
    <div class="ui item-detail stackable grid">
        <div class="two column row">

            <div class="five wide column">
                <div class="owl-carousel one-item-carousel owl-theme">
                <?php 
                if(!empty($getbarang->map)){
                  foreach ($getbarang->map as $value_img) { ?>
                    <div class="image">
                        <img src="<?php echo $value_img; ?>" alt="<?php echo $getbarang->nameBARANG;?>" data-zoom-image="<?php echo $value_img; ?>" id="product-zoom">
                    </div>
                    <?php } ?>
                <?php } ?>
                </div>
                <div class="share-to-social">
                    <h5 class="header">Share item ini ke teman-teman mu</h5>
                    <div class="ui icon basic buttons">
                        <a href="#" class="ui button"><i class="facebook icon"></i></a>
                        <a href="#" class="ui button"><i class="twitter icon"></i></a>
                        <a href="#" class="ui button"><i class="whatsapp icon"></i></a>
                        <a href="#" class="ui button"><i class="google plus icon"></i></a>
                    </div>
                </div>
            </div>

            <div class="eleven wide column">
                <div class="content">
                    <h2 class="header"><?php echo $getbarang->nameBARANG;?></h2>
                    <div class="price">
                        Rp. <?php echo number_format($getbarang->priceBARANG, 0,',','.'); ?>
                        <!-- <span class="ui label"><i class="mail icon"></i> Potongan 10K untuk VIP Member</span> -->
                    </div>
                    <div class="description">
                        <?php echo $getbarang->descBARANG;?>
                    </div>
                    <div class="ui three column doubling grid features">
                        <div class="column">
                            <div class="ui list">
                                <div class="item">
                                    <i class="copy icon"></i>
                                    <div class="content">
                                        <div class="header">Material</div>
                                        <?php echo $getbarang->materialBARANG;?>
                                    </div>
                                </div>
                                <div class="item">
                                    <i class="cube icon"></i>
                                    <div class="content">
                                        <div class="header">Dimensi</div>
                                        <?php echo $getbarang->dimensionBARANG;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui list">
                                <div class="item">
                                    <i class="file archive outline icon"></i>
                                    <div class="content">
                                        <div class="header">Berat</div>
                                        <?php echo $getbarang->weightBARANG;?>
                                    </div>
                                </div>
                                <div class="item">
                                    <i class="checkmark icon"></i>
                                    <div class="content">
                                        <div class="header">Stock</div>
                                        <?php echo $getbarang->stockBARANG;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="ui list">
                                <div class="item">
                                    <i class="crosshairs icon"></i>
                                    <div class="content">
                                        <div class="header">Kode</div>
                                        <?php echo $getbarang->codeBARANG;?>
                                    </div>
                                </div>
                                <div class="item">
                                    <i class="snowflake icon"></i>
                                    <div class="content">
                                        <div class="header">Warna</div>
                                        <?php echo $getbarang->colorBARANG;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- kelar Grid Features -->
                    <div class="quantity-select">
                        <div class="field">
                            <label for="qty-select">Qty </label>
                            <select class="ui compact dropdown quantity" name="qtyBARANG" id="<?php echo $getbarang->idBARANG;?>">
                                <option value="1" selected="selected">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <button class="add_cart ui toggle fade add-to-cart black button" tabindex="0" data-barangid="<?php echo $getbarang->idBARANG;?>" data-barangnama="<?php echo $getbarang->nameBARANG;?>" data-barangharga="<?php echo $getbarang->priceBARANG;?>">
                            <i class="plus square outline icon"></i> Tambahkan ke Keranjang
                        </button> &nbsp; &nbsp;
                        <span>atau</span> &nbsp; &nbsp; <a href="#" class="button add-to-wishlist">Tambahkan ke Wishlist <i class="empty heart icon"></i></a>
                    </div>
                </div>
            </div>

        </div> <!-- kelar div Item -->
    </div> <!-- kelar Item-Detail -->

</div> <!-- kelar Main -->