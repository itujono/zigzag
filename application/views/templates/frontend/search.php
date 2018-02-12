<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="main">
    <div class="ui grid">
        <div class="sixteen wide column">
            <div class="header">
                <h3>Mencari <strong><?php echo $keyword;?></strong> </h3>
                Ada <?php echo $countresult;?> hasil pencarian buat kata kunci <strong><?php echo strtolower($keyword);?></strong> &nbsp; &#9749;
            </div>

            <div class="ui divided items search-results">
            <?php
                if(!empty($searching)){
                    foreach ($searching as $search) {
            ?>
                <div class="item">
                    <a href="<?php echo base_url();?>detail/<?php echo $search->slugBARANG;?>" class="ui tiny image">
                        <img src="<?php echo $search->imageSEARCH;?>" alt="<?php echo $search->nameBARANG;?>">
                    </a>
                    <div class="content">
                        <a href="#" class="header"><?php echo $search->nameBARANG;?></a>
                        <div class="meta">
                            <span>Ada di dalam <a href="#"><?php echo $search->nameCATEGORY;?></a></span> &bull; &nbsp; <span>Rp <?php echo number_format($search->priceBARANG, 0,',','.'); ?></span>
                        </div>
                        <div class="description">
                            <?php echo character_limiter($search->descBARANG,133);?>
                        </div>
                        <div class="extra">
                            <button class="ui basic button add-to-wishlist" title="Tambahkan ke Wishlist" data-idbarang="<?php echo encode(urlencode($search->idBARANG));?>">
                                <i class="empty heart icon"></i>
                                Tambahkan ke wishlist
                            </button>
                            <input type="hidden" name="qtyBARANG" id="<?php echo $search->idBARANG;?>" value="1" class="quantity">
                            <button class="add_cart ui basic teal button" title="Tambahkan ke Cart" data-barangid="<?php echo $search->idBARANG;?>" data-barangnama="<?php echo $search->nameBARANG;?>" data-barangharga="<?php echo $search->priceBARANG;?>" data-barangberat="<?php echo $search->weightBARANG;?>">
                                <i class="shopping basket icon"></i>
                                Tambahkan ke cart
                            </button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            <?php } else { ?>
                <div class="item">
                    <div class="content">
                        <a href="#" class="header">Tidak ada barang yang ditemukan</a>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div> <!-- kelar Sixteen Wide Column -->

    </div>
    <div class="ui page dimmer">
        <div class="content">
            <div class="center">
                <h2 class="ui inverted icon header">
                    <i class="heart icon"></i>
                    Okay, terima kasih udah luangin waktunya, ya. <br> Meskipun kamu mau retur, tapi kamu tetap adalah customer setia kami :(
                </h2>
            </div>
        </div>
    </div>
</div> <!-- kelar Main -->