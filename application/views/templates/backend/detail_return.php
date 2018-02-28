<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }">
    <h1><?php echo $detail_return_barang->nameCUSTOMER;?></h1>
    <span class="uk-text-muted uk-text-upper uk-text-small"><?php echo strtoupper($detail_return_barang->kodeorderRETURN);?></span>
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
                    <img src="<?php echo $detail_return_barang->imagereturnBARANG;?>" alt="<?php echo $detail_return_barang->nameCUSTOMER;?>" class="img_medium" />
                </div>
            </div>
        </div>
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Data Return
                </h3>
            </div>
            <div class="md-card-content">
                <ul class="md-list">
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Harga</span>
                            <span class="md-list-heading uk-text-large uk-text-success">Rp. <?php echo number_format($detail_return_barang->priceBARANG, 0,',','.'); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Stok</span>
                            <span class="md-list-heading uk-text-large"><?php echo $detail_return_barang->stockBARANG;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Kode</span>
                            <span class="md-list-heading uk-text-large"><?php echo $detail_return_barang->codeBARANG;?></span>
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
                                <span class="uk-text-large uk-text-middle"><a href="<?php echo base_url();?>zigzagadmin/barang/add_barang/<?php echo encode(urlencode($detail_return_barang->idBARANG));?>" data-uk-tooltip title="Edit Barang/Produk?"><?php echo $detail_return_barang->nameBARANG;?></a></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Kategori</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $detail_return_barang->nameCATEGORY;?></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Material</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $detail_return_barang->materialBARANG;?></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Dimensi</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <?php echo $detail_return_barang->dimensionBARANG;?>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Berat</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <?php echo $detail_return_barang->weightBARANG;?> KG
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Warna</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <?php echo $detail_return_barang->colorBARANG;?>
                            </div>
                        </div>
                        <hr class="uk-grid-divider uk-hidden-large">
                    </div>
                    <div class="uk-width-large-1-2">
                        <p>
                            <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Deskripsi Barang</span>
                            <?php echo $detail_return_barang->descBARANG;?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>