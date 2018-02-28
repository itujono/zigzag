 <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }" class="uk-margin-bottom">
 	<h1><?php echo $detailorder->nameCUSTOMER;?>, <?php echo $detailorder->teleCUSTOMER;?></h1>
 	<span class="uk-text-muted uk-text-upper"><b><?php echo $detailorder->kodeORDER;?> (<?php echo dF($detailorder->createdateORDER, 'd F Y H:i');?>) - <?php echo $detailorder->status;?></span></b>
 </div>

<?php if (!empty($message)){ ?>
  <div class="uk-alert uk-alert-<?php echo $message['type']; ?>" data-uk-alert>
    <a href="#" class="uk-alert-close uk-close"></a>
    <h4><?php echo $message['title']; ?></h4>
    <?php echo $message['text']; ?>
  </div>
<?php } ?>

 <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
 	<div class="uk-width-xLarge-2-10 uk-width-large-3-10">
 		<div class="md-card">
 			<div class="md-card-toolbar">
 				<h3 class="md-card-toolbar-heading-text">
 					Informasi Order
 				</h3>
 			</div>
 			<div class="md-card-content">
 				<ul class="md-list">
 					<li>
 						<div class="md-list-content">
 							<span class="uk-text-small uk-text-muted uk-display-block">Destinasi Order</span>
 							<span class="md-list-heading uk-text-medium uk-text-success"><?php echo $destinasi_data_customer_province_city['city_name'].' - '.$destinasi_data_customer_province_city['province'];?></span>
 						</div>
 					</li>
 					<li>
 						<div class="md-list-content">
 							<span class="uk-text-small uk-text-muted uk-display-block">Alamat Order</span>
 							<span class="md-list-heading uk-text-medium uk-text-success"><?php echo $detailorder->addressORDER;?></span>
 						</div>
 					</li>
 					<li>
 						<div class="md-list-content">
 							<span class="uk-text-small uk-text-muted uk-display-block">Kode Order</span>
 							<span class="md-list-heading uk-text-medium"><i><?php echo $detailorder->kodeORDER;?></i></span>
 						</div>
 					</li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Subtotal</span>
                            <span class="md-list-heading uk-text-medium"><i>Rp. <?php echo number_format($detailorder->subtotal, 0,',','.'); ?></i></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Ekspedisi</span>
                            <span class="md-list-heading uk-text-medium"><i><?php echo strtoupper($detailorder->ekspedisiORDER).' - '.$detailorder->ketekspedisiORDER.' - Rp. '.number_format($detailorder->totalekspedisiORDER, 0,',','.'); ?></i></span>
                        </div>
                    </li>
 					<li>
 						<div class="md-list-content">
 							<span class="uk-text-small uk-text-muted uk-display-block">Grandtotal Order</span>
 							<span class="md-list-heading uk-text-medium uk-text-primary">Rp. <?php echo number_format( $detailorder->subtotal+$detailorder->totalekspedisiORDER, 0,',','.'); ?></span>
 						</div>
 					</li>
 				</ul>
 			</div>
 		</div>
 	</div>
 	<div class="uk-width-xLarge-8-10  uk-width-large-7-10">
 		<div class="md-card">
 			<div class="md-card-toolbar uk-grid-width-large-1-3">
 				<h3 class="md-card-toolbar-heading-text">
 					Detail Pelanggan
 				</h3>
 				<h3 class="md-card-toolbar-heading-text uk-text-danger">
 				
 				</h3>
 				<h3 class="md-card-toolbar-heading-text">
 				<?php
 					//if($detailorder->statusORDER != 5 AND $detailorder->statusORDER != 7){
 				?>
 					<!-- <a class="md-btn md-btn-success md-btn-block md-btn-wave-light" href="<?php echo base_url();?>zigzagadmin/order/editorder/<?php echo encode($detailorder->idORDER);?>">Update</a> -->
 				<?php //} ?>
 				</h3>
 			</div>
 			<div class="md-card-content large-padding">
 				<div class="uk-grid uk-grid-divider uk-grid-medium">
 					<div class="uk-width-large-1-2">
 						<div class="uk-grid uk-grid-small">
 							<div class="uk-width-large-1-3">
 								<span class="uk-text-muted uk-text-small">Nama</span>
 							</div>
 							<div class="uk-width-large-2-3">
 								<span class="uk-text-large uk-text-middle"><a href="#"><?php echo $detailorder->nameCUSTOMER;?></a></span>
 							</div>
 						</div>
 						<hr class="uk-grid-divider">
 						<div class="uk-grid uk-grid-small">
 							<div class="uk-width-large-1-3">
 								<span class="uk-text-muted uk-text-small">Email</span>
 							</div>
 							<div class="uk-width-large-2-3">
 								<span class="uk-text-large uk-text-middle"><a href="mailto:<?php echo $detailorder->emailCUSTOMER;?>"><?php echo $detailorder->emailCUSTOMER;?></a></span>
 							</div>
 						</div>
 						<hr class="uk-grid-divider">
 						<div class="uk-grid uk-grid-small">
 							<div class="uk-width-large-1-3">
 								<span class="uk-text-muted uk-text-small">No. Telepon/HP</span>
 							</div>
                            <?php
                                if($detailorder->telehomeORDER != '0'){
                                    $telehome = $detailorder->telehomeORDER;
                                } else {
                                    $telehome = '-';
                                }
                            ?>
 							<div class="uk-width-large-2-3">
 								<?php echo $detailorder->teleCUSTOMER.' / '.$telehome;?>
 							</div>
 						</div>
 						<hr class="uk-grid-divider uk-hidden-large">
 					</div>
                    <div class="uk-width-large-1-2">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Alamat</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $detailorder->addressCUSTOMER;?></span>
                            </div>
                        </div>
                        <hr class="uk-grid-divider">
                        <div class="uk-grid uk-grid-small">
                            <div class="uk-width-large-1-3">
                                <span class="uk-text-muted uk-text-small">Kota - Provinsi</span>
                            </div>
                            <div class="uk-width-large-2-3">
                                <span class="uk-text-large uk-text-middle"><?php echo $data_customer_province_city['city_name'].' - '.$data_customer_province_city['province'];?></span>
                            </div>
                        </div>
                    </div>
 				</div>
 			</div>
 		</div>
 		<div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Detail Order
                </h3>
            </div>
            <div class="md-card-content large-padding">
                <div class="uk-grid" data-uk-grid-margin>
                    <div class="uk-width-medium-2-10">
                        <span class="uk-display-block uk-margin-small-top uk-text-large">Detail</span>
                    </div>
                    <div class="uk-width-medium-8-10">
                        <table class="uk-table">
                            <thead>
                                <tr>
                                    <th class="uk-width-4-10">Produk</th>
                                    <th class="uk-width-3-10">Qty</th>
                                    <th class="uk-width-3-10 uk-text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($order_detail_customer as $order_detail) {
                            ?>
                                <tr>
                                    <td><a href="<?php echo base_url();?>zigzagadmin/barang/detail_barang/<?php echo encode(urlencode($order_detail->idproductdetailORDER));?>"><?php echo $order_detail->productdetailORDER;?> (<?php echo $order_detail->codeBARANG;?>)</a></td>
                                    <td><?php echo $order_detail->qtydetailORDER;?></td>
                                    <td class="uk-text-right">Rp. <?php echo number_format($order_detail->pricedetailORDER*$order_detail->qtydetailORDER, 0,',','.'); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
 	</div>
 </div>
<?php //if($detailorder->statusORDER != 5 AND $detailorder->statusORDER != 7){ ?>
<div class="md-fab-wrapper">
	<div class="md-fab md-fab-accent md-fab-sheet">
	   <div class="md-fab-wrapper md-fab-speed-dial-horizontal">
	   	<?php //if($detailorder->statusORDER != 5 AND $detailorder->statusORDER != 7){ ?>
            <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xE54A;</i></a>
        <?php //} ?>
            <div class="md-fab-wrapper-small">
            <?php //if($detailorder->statusORDER == 1){ ?>
                <!-- <a data-uk-tooltip title="Proses pencucian" class="md-fab md-fab-small md-fab-primary" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detailorder->idORDER);?>/2"><i class="material-icons">&#xE86A;</i></a> -->
            <?php //} elseif($detailorder->statusORDER == 2 OR $detailorder->statusORDER == 3 OR $detailorder->statusORDER == 4 OR $detailorder->statusORDER == 5 OR $detailorder->statusORDER == 6 OR $detailorder->statusORDER == 7 OR $detailorder->statusORDER == 8 OR $detailorder->statusORDER == 9) { ?>
                <a data-uk-tooltip="{cls:'long-text'}" title="Menunggu Pembayaran" class="md-fab md-fab-small md-fab-primary" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detailorder->idORDER);?>/2"><i class="material-icons">&#xE863;</i></a>

                <?php //if($this->session->userdata('roleUSER') == 22 OR $this->session->userdata('roleUSER') == 24){ ?>
                
                <a data-uk-tooltip title="Dalam proses pembayaran" class="md-fab md-fab-small md-fab-primary" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detailorder->idORDER);?>/3"><i class="material-icons">&#xE86A;</i></a>

                <a data-uk-tooltip="{cls:'long-text'}" title="Pembayaran disetujui" class="md-fab md-fab-small md-fab-success" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detailorder->idORDER);?>/4"><i class="material-icons">&#xE877;</i></a>

                <a data-uk-tooltip="{cls:'long-text'}" title="Proses digudang" class="md-fab md-fab-small md-fab-danger" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detailorder->idORDER);?>/5"><i class="material-icons">&#xE5C9;</i></a>

                <a data-uk-tooltip title="Barang Terkirim" class="md-fab md-fab-small md-fab-success" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detailorder->idORDER);?>/6"><i class="material-icons">&#xE877;</i></a>

                <a data-uk-tooltip="{cls:'long-text'}" title="Pesanan dibatalkan" class="md-fab md-fab-small md-fab-primary" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detailorder->idORDER);?>/7"><i class="material-icons">&#xE863;</i></a>
                <?php //} ?>
            <?php //} ?>
            </div>
        </div>
	</div>
</div>
<?php //} ?>