<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="main">
    <div class="ui grid">
        <div class="sixteen wide column">
            <div class="header">
                <h3>Konfirmasi Pembayaran di Sini</h3>
                Merasa udah transfer kewajiban? Maka kamu seharusnya coba makan wortel dan bayam di pagi hari mulai besok.
            </div>
            <?php if (!empty($message_confirmation)){ ?>
            <div class="ui compact red message print-success-msg-profile">
                <i class="close icon"></i>
                <h5 class="header"><?php echo $message_confirmation['title']; ?></h5>
                <?php echo $message_confirmation['text']; ?>
            </div>
            <?php } ?>
            <form method="POST" action="<?php echo base_url();?>order/process_confirmation" class="ui form" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="required field">
                    <label for="nomorOrder">Nomor order</label>
                    <select class="ui search dropdown" name="kodeCONFIRM" required="required" id="kode_order">
                        <option value="" selected disabled="disabled">Pilih Kode order kamu</option>
                        <?php
                        if(!empty($listkodeorder)){
                            foreach ($listkodeorder as $kode) {
                        ?>
                            <option value="<?php echo $kode->kodeORDER;?>"><?php echo $kode->kodeORDER;?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <?php echo form_error('kodeCONFIRM'); ?>
                </div>
                <div class="fields">
                    <div class="six wide required field">
                        <label for="bankRekeningPengirim">Bank pengirim</label>
                        <select class="ui search dropdown" name="bankCONFIRM" required="required">
                            <option value="">Pilih bank</option>
                            <option value="BNI">BNI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BCA">BCA</option>
                            <option value="CIMB NIAGA">CIMB NIAGA</option>
                        </select>
                        <?php echo form_error('bankCONFIRM'); ?>
                    </div>
                    <div class="ten wide required field">
                        <label for="namaRekeningPengirim">Atas nama pengirim</label>
                        <input type="text" name="nameCONFIRM" placeholder="Misal: Joni Sudrajat" required="required" value="<?php echo set_value('nameCONFIRM'); ?>">
                        <?php echo form_error('nameCONFIRM'); ?>
                    </div>
                </div>
                <div class="required field">
                    <label for="nomorRekeningPengirim">Nomor rekening pengirim</label>
                    <input type="number" name="rekeningCONFIRM" placeholder="Misal: 10900112345678" required="required" value="<?php echo set_value('rekeningCONFIRM'); ?>">
                    <?php echo form_error('rekeningCONFIRM'); ?>
                </div>
                <div class="required field" id="show_total"></div>
                <div class="required field">
                    <label for="nominalTransfer">Nominal yang ditransfer (masukkan hanya angka)</label>
                    <input type="number" name="nominalCONFIRM" value="<?php echo set_value('nominalCONFIRM'); ?>" placeholder="Misal: 200000">
                    <?php echo form_error('nominalCONFIRM'); ?>
                </div>
                <div class="field">
                    <label for="uploadBukti">Upload bukti</label>
                    <input type="file" name="uploadBukti" class="ui button" accept="image/jpg, image/jpeg, image/png" required="required">
                    <?php echo form_error('uploadBukti'); ?>
                </div>
                <div class="ui divider"></div>
                <div class="required inline field mb2em">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" class="hidden" name="setujuCONFIRM" required="required">
                        <label for="persetujuan">Saya menjamin data yang saya input di atas adalah benar</label>
                    </div>
                    <?php echo form_error('setujuCONFIRM'); ?>
                </div>
                <input type="submit" class="ui zz button" value="Konfirmasi">
                <a href="<?php echo base_url();?>" class="ui direct basic button"><i class="angle left icon"></i> Kembali ke Home</a>
            </form>
        </div>
    </div>
    <div class="ui page dimmer">
        <div class="content">
            <div class="center">
                <h2 class="ui inverted icon header">
                    <i class="heart icon"></i>
                    Okay, terima kasih udah luangin waktunya, ya. <br> Kami akan segera memberi kabar begitu payment kamu berhasil kami verifikasi.
                </h2>
            </div>
        </div>
    </div>
</div> <!-- kelar Main -->
