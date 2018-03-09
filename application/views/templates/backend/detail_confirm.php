 <div id="page_heading" data-uk-sticky="{ top: 48, media: 960 }" class="uk-margin-bottom">
 	<h1><?php echo $detail_confirm->nameCONFIRM;?></h1>
 	<span class="uk-text-muted uk-text-upper"><b><?php echo $detail_confirm->kodeCONFIRM;?> (<?php echo dF($detail_confirm->createdateCONFIRM, 'd F Y H:i');?>)</span></b>
 </div>
 <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
 	<div class="uk-width-xLarge-2-10 uk-width-large-3-10">
        <div class="md-card">
            <div class="md-card-toolbar">
                <h3 class="md-card-toolbar-heading-text">
                    Foto Bukti Transfer
                </h3>
            </div>
            <div class="md-card-content">
                <div class="uk-margin-bottom uk-text-center">
                <?php
                    $map = directory_map('assets/upload/confirmation-file/file-confirmation-'.folenc($detail_confirm->idCONFIRM), FALSE, TRUE);
                    if(!empty($map)){
                    $imageCONFIRM = base_url() . 'assets/upload/confirmation-file/file-confirmation-'.folenc($detail_confirm->idCONFIRM).'/'.$map[0];
                ?>
                    <img src="<?php echo $imageCONFIRM;?>" alt="<?php echo $detail_confirm->nameCONFIRM;?>" class="img_medium" />
                <?php } else { ?> 
                 Tidak ada gambar yang ditampilkan 
                <?php } ?> 
                </div>
            </div>
        </div>
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
 							<span class="uk-text-small uk-text-muted uk-display-block">Kode Order</span>
 							<span class="md-list-heading uk-text-medium uk-text-success"><?php echo $detail_confirm->kodeCONFIRM;?> - (<?php echo $detail_confirm_order->nameORDER; ?>)</span>
 						</div>
 					</li>
 					<li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">BANK Pengirim</span>
                            <span class="md-list-heading uk-text-medium uk-text-success"><?php echo $detail_confirm->bankCONFIRM;?> a/n <?php echo $detail_confirm->nameCONFIRM;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Total Transfer</span>
                            <span class="md-list-heading uk-text-medium"><i>Rp. <?php echo number_format($detail_confirm->nominalCONFIRM, 0,',','.'); ?></i></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">BANK Penerima</span>
                            <span class="md-list-heading uk-text-medium uk-text-success"><?php echo $detail_confirm_order->paymentORDER;?></span>
                        </div>
                    </li>
 					<li>
 						<div class="md-list-content">
 							<span class="uk-text-small uk-text-muted uk-display-block">Grandtotal Order</span>
 							<span class="md-list-heading uk-text-medium uk-text-primary">Rp. <?php echo number_format( $detail_confirm_order->subtotal+$detail_confirm_order->totalekspedisiORDER, 0,',','.'); ?></span>
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
 					Detail Pelanggan/Konfirmasi
 				</h3>
 			</div>
 			<div class="md-card-content large-padding">
 				<div class="uk-grid uk-grid-divider uk-grid-medium">
 					<div class="uk-width-large-1-2">
 						<div class="uk-grid uk-grid-small">
 							<div class="uk-width-large-1-3">
 								<span class="uk-text-muted uk-text-small">Nama Pengirim</span>
 							</div>
 							<div class="uk-width-large-2-3">
 								<span class="uk-text-large uk-text-middle"><a href="#"><?php echo $detail_confirm->nameCONFIRM;?></a></span>
 							</div>
 						</div>
 						<hr class="uk-grid-divider">
 						<div class="uk-grid uk-grid-small">
 							<div class="uk-width-large-1-3">
 								<span class="uk-text-muted uk-text-small">Waktu Konfirmasi</span>
 							</div>
 							<div class="uk-width-large-2-3">
 								<span class="uk-text-large uk-text-middle"><?php echo dF($detail_confirm->createdateCONFIRM , 'd F Y H:i');?></span>
 							</div>
 						</div>
 						<hr class="uk-grid-divider uk-hidden-large">
 					</div>
 				</div>
 			</div>
 		</div>
    </div>
<?php if($detail_confirm_order->statusORDER != 4){ ?>
<div class="md-fab-wrapper">
	<div class="md-fab md-fab-accent md-fab-sheet">
	   <div class="md-fab-wrapper md-fab-speed-dial-horizontal">
            <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">&#xE54A;</i></a>
            <div class="md-fab-wrapper-small">
                <a data-uk-tooltip="{cls:'long-text'}" title="Pembayaran disetujui" class="md-fab md-fab-small md-fab-success" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detail_confirm_order->idORDER);?>/4"><i class="material-icons">&#xE877;</i></a>
                <a data-uk-tooltip="{cls:'long-text'}" title="Pembayaran ditolak" class="md-fab md-fab-small md-fab-primary" href="<?php echo base_url();?>zigzagadmin/order/changestatus/<?php echo encode($detail_confirm_order->idORDER);?>/8"><i class="material-icons">&#xE863;</i></a>
            </div>
        </div>
	</div>
</div>
<?php } ?>