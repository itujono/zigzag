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
                    Data Barang Return
                </h3>
            </div>
            <div class="md-card-content">
                <ul class="md-list">
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Nama Barang</span>
                            <span class="md-list-heading uk-text-large"><?php echo $detail_return_barang->nameBARANG;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Quantity Barang</span>
                            <span class="md-list-heading uk-text-large"><?php echo $detail_return_barang->qtybarangRETURN;?> Barang</span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Harga</span>
                            <span class="md-list-heading uk-text-large uk-text-success">Rp. <?php echo number_format($detail_return_barang->priceBARANG, 0,',','.'); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Kode Barang</span>
                            <span class="md-list-heading uk-text-large"><?php echo $detail_return_barang->kodebarangRETURN;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Kode Order</span>
                            <span class="md-list-heading uk-text-large"><?php echo $detail_return_barang->kodeorderRETURN;?></span>
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
                    Detail Customer Return
                </h3>
            </div>
            <div class="md-card-content large-padding">
                <div class="uk-grid uk-grid-divider uk-grid-medium">
                    <div class="uk-width-large-1-2">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Customer</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $detail_return_barang->nameCUSTOMER;?></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Dikirim ke</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $detail_return_barang->addressCUSTOMER;?><br><?php echo $data_customer_province_city['city_name'].' - '.$data_customer_province_city['province'] ?></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Alasan Return</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $detail_return_barang->reasonRETURN;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-1-2">
                    <?php if($detail_return_barang->statusRETURN == 1){ ?>
                        <form action="<?php echo base_url();?>zigzagadmin/order/process_return_admin" method="POST">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                            <input type="hidden" name="idRETURN" value="<?php echo $detail_return_barang->idRETURN;?>" required/>
                            <input type="hidden" name="idbarangRETURN" value="<?php echo $detail_return_barang->idbarangRETURN;?>" required/>
                            <input type="hidden" name="qtybarangRETURN" value="<?php echo $detail_return_barang->qtybarangRETURN;?>" required/>
                            <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Alasan Admin</span>
                            <textarea class="md-input label-fixed uk-margin-bottom" name="reasonadminRETURN"><?php echo $detail_return_barang->reasonadminRETURN;?></textarea>
                            <select class="uk-margin-bottom" data-md-selectize data-md-selectize-bottom data-uk-tooltip="{pos:'top'}" title="Pilih status return" name="statusRETURN">
                                <option value="" disabled="disabled" selected="selected">Select...</option>
                                <option value="2">Barang Return Disetujui</option>
                                <option value="3">Barang Return Ditolak</option>
                            </select>
                            <span class="uk-input-group-addon"><?php echo form_submit('submit', 'SAVE', 'class="md-btn md-btn-primary" id="show_preloader_md"'); ?></span>
                        </form>
                    <?php } else { 
                        if($detail_return_barang->statusRETURN == 1){
                            $status='<span class="uk-badge uk-badge-warning">Dalam Proses Verifikasi admin</span>';
                        } elseif($detail_return_barang->statusRETURN == 2) {
                            $status='<span class="uk-badge uk-badge-primary">Barang Return Disetujui</span>';
                        } else {
                            $status='<span class="uk-badge uk-badge-danger">Barang Return Ditolak</span>';
                        }
                    ?>
                        <p>
                            <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Status return</span>
                            <?php echo $status;?>
                        </p>
                        <p>
                            <span class="uk-text-muted uk-text-small uk-display-block uk-margin-small-bottom">Alasan admin return</span>
                            <?php echo $detail_return_barang->reasonadminRETURN;?>
                        </p>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>