<?php
if($getbarang->hotBARANG == 1){
    $badge = "<span class='uk-badge uk-badge-danger'>HOT!</span>";
} else {
    $badge = "";
}
?>
<div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
    <h1><?php echo $getbarang->nameBARANG;?> <?php echo $badge;?></h1>
    <span class="uk-text-muted uk-text-upper uk-text-small"><?php echo strtoupper($getbarang->codeBARANG);?></span>
</div>


<div class="uk-grid uk-grid-medium" data-uk-grid-margin>
    <div class="uk-width-xLarge-2-10 uk-width-large-3-10">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Foto Produk
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-margin-bottom uk-text-center">
                <?php
                    $map = directory_map('assets/upload/barang/pic-barang-'.folenc($getbarang->idBARANG), FALSE, TRUE);
                    if(!empty($map)){
                    $imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($getbarang->idBARANG).'/'.$map[0];
                ?>
                    <img src="<?php echo $imageBARANG;?>" alt="<?php echo $getbarang->nameBARANG;?>" class="img_medium" />
                <?php } else { ?> 
                 Tidak ada gambar yang ditampilkan 
                <?php } ?> 
                </div>
                <ul class="uk-grid uk-grid-width-small-1-3 uk-text-center" data-uk-grid-margin>
                <?php
                if(!empty($getbarang->map)){
                    foreach ($getbarang->map as $value_img) {
                ?>
                    <li>
                        <img src="<?php echo $value_img;?>" alt="<?php echo $getbarang->nameBARANG;?>" class="img_small"/>
                    </li>
                    <?php } ?>
                <?php } ?>
                </ul>
            </div>
        </div>
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Data
                </h3>
            </div>
            <div class="md-card-content">
                <ul class="md-list">
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Harga</span>
                            <span class="md-list-heading uk-text-large uk-text-success">Rp. <?php echo number_format($getbarang->priceBARANG, 0,',','.'); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Stok</span>
                            <span class="md-list-heading uk-text-large"><?php echo $getbarang->stockBARANG;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Kode</span>
                            <span class="md-list-heading uk-text-large"><?php echo $getbarang->codeBARANG;?></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="uk-width-xLarge-8-10  uk-width-large-7-10">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Detail
                </h3>
            </div>
            <div class="md-card-content large-padding">
                <div class="uk-grid uk-grid-divider uk-grid-medium">
                    <div class="uk-width-large-1-2">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Nama Barang/Produk</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><a href="<?php echo base_url();?>zigzagadmin/barang/add_barang/<?php echo encode(urlencode($getbarang->idBARANG));?>" data-uk-tooltip title="Edit Barang/Produk?"><?php echo $getbarang->nameBARANG;?></a></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Kategori</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $getbarang->nameCATEGORY;?></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Material</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $getbarang->materialBARANG;?></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Dimensi</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <?php echo $getbarang->dimensionBARANG;?>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Berat</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <?php echo $getbarang->weightBARANG;?> KG
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Warna</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <?php echo $getbarang->colorBARANG;?>
                            </div>
                        </div>
                        <hr class="uk-grid-divider uk-hidden-large">
                    </div>
                    <div class="uk-width-large-1-2">
                        <p>
                            <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Deskripsi Barang</span>
                            <?php echo $getbarang->descBARANG;?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>