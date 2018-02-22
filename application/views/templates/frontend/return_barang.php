<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="main">
	<div class="ui grid">
		<div class="sixteen wide column">
			<div class="header">
				<h3>Mau Ngembaliin Barang?</h3>
				Meskipun kami sedih, tapi kamu tetap harus menunjukkan alasannya di form berikut ini ya. Awas!
			</div>
			<?php if (!empty($message_return)){ ?>
            <div class="ui compact red message print-success-msg-profile">
                <i class="close icon"></i>
                <h5 class="header"><?php echo $message_return['title']; ?></h5>
                <?php echo $message_return['text']; ?>
            </div>
            <?php } ?>
			<form class="ui form" id="" method="POST" action="<?php echo base_url();?>customer/process_return_barang">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				<div class="required field">
					<label for="merkBarang">Merk dan jenis barang</label>
					<input type="text" name="merkBarang" placeholder="Misal: Pouch bag Andalas X1">
				</div>
				<div class="two fields">
					<div class="required field">
						<label for="nomorOrder">Nomor order</label>
						<select class="ui search dropdown" name="kodeorderRETURN" id="kode_order_return" required="required">
	                        <option value="" selected disabled="disabled">Pilih Kode order kamu</option>
	                        <?php
	                        if(!empty($list_kodeorder_customer)){
	                            foreach ($list_kodeorder_customer as $kode) {
	                        ?>
	                            <option value="<?php echo $kode->kodeORDER;?>"><?php echo $kode->kodeORDER;?></option>
	                        <?php } ?>
	                        <?php } ?>
	                    </select>
	                    <?php echo form_error('kodeorderRETURN'); ?>
					</div>
					<div class="required field">
						<label for="kodeBarang">Kode barang</label>
						<select class="ui search dropdown" id="kode_barang_return" name="kodebarangRETURN" required="required">
                            <option value="" disabled="disabled">Pilih kode order kamu dulu</option>
                        </select>
                        <?php echo form_error('kodebarangRETURN'); ?>
					</div>
				</div>
				<div class="required field">
					<label for="alasanRetur">Alasan ingin meretur barang</label>
					<textarea name="reasonRETURN" rows="6" placeholder="Misal: Barang tidak sesuai harapan" required="required"><?php echo set_value('reasonRETURN'); ?></textarea>
					<?php echo form_error('reasonRETURN'); ?>
				</div>
				<div class="ui divider"></div>
				<div class="required inline field mb2em">
					<div class="ui checkbox">
						<input type="checkbox" tabindex="0" class="hidden" name="setujuRETURN" required="required">
						<label for="persetujuan">Saya menjamin data yang saya input di atas adalah jujur dan adil</label>
					</div>
					<?php echo form_error('setujuRETURN'); ?>
				</div>
				<input type="submit" class="ui zz button" value="Konfirmasi retur"></button>
				<a href="/" class="ui direct basic button"><i class="angle left icon"></i> Kembali ke Home</a>
			</form>
		</div>
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