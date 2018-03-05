<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="main">
    <div class="ui grid" id="step-shipping">
        <div class="sixteen wide column">
            <div class="ui three ordered steps">
                <div class="active step">
                    <div class="content">
                        <div class="title">Shipping</div>
                        <div class="description">Isi form order untuk pengiriman</div>
                    </div>
                </div>
                <div class="step">
                    <div class="content">
                        <div class="title">Billing</div>
                        <div class="description">Pilih metode pembayaran</div>
                    </div>
                </div>
                <div class="step">
                    <div class="content">
                        <div class="title">Confirm Order</div>
                        <div class="description">Review semua sebelum place order</div>
                    </div>
                </div>
                <?php
                    if(!empty($checkshipping_notactive)){
                ?>
                <div class="ui right rail">
                    <div class="ui sticky">
                        <div class="ui negative message">
                            <i class="close icon"></i>
                            <div class="header">
                                Sedang sibuk
                            </div>
                            <p>Mohon maaf, saat ini di ekspedisi 
                                <?php
                                    foreach ($checkshipping_notactive as $notactive) {
                                        echo $notactive->nameSHIPPING.', ';
                                    }
                                ?>
                                sedang dalam kesibukan yang yaampun banget. Jadi agak
                                lelet kalo mau ngirim barang. Harap maklum.</p>
                            <p>
                                <strong>Management</strong>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- kelar div Three Steps -->

            <h3 class="ui header" id="form-header">
                Isi detail kamu
                <div class="sub header">Isi detail info dan detail pengiriman</div>
            </h3>
            <form class="ui form" id="shipping-address" action="<?php echo base_url();?>product/process_checkout" method="POST">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <?php
                    $val = '';
                    if($data_filled != ''){
                        $val = $data_filled->idORDER;
                    }
                ?>
                <input type="hidden" name="idORDER" value="<?php echo $val; ?>">
                <div class="inline field mb2em">
                    <div class="ui segment seamless">
                        <div class="ui slider checkbox" id="default-address">
                            <input type="checkbox" name="original_data" class="hidden">
                            <label>Pake data alamat sesuai dari data Profile kamu? </label>
                        </div>
                    </div>
                </div>

                <!-- Ini section form kalo tak pilih data sesuai Profile -->
                <div class="two fields will-hidden">
                    <div class="required field">
                        <label for="nama">Nama lengkap penerima</label>
                        <?php
                            $val = set_value('nameORDER');
                            if($data_filled != ''){
                                $val = $data_filled->nameORDER;
                            }
                        ?>
                        <input type="text" name="nameORDER" placeholder="John Doe" value="<?php echo $val; ?>">
                        <?php echo form_error('nameORDER'); ?>
                    </div>
                    <div class="required field">
                        <label for="email">Email penerima</label>
                        <?php
                            $val = set_value('emailORDER');
                            if($data_filled != ''){
                                $val = $data_filled->emailORDER;
                            }
                        ?>
                        <input type="email" name="emailORDER" placeholder="emailku@email.com" value="<?php echo $val; ?>">
                        <?php echo form_error('emailORDER'); ?>
                    </div>
                </div>
                <div class="two fields mb2em will-hidden">
                    <div class="required field">
                        <label for="handphone">Nomor handphone</label>
                        <?php
                            $val = set_value('teleORDER');
                            if($data_filled != ''){
                                $val = $data_filled->teleORDER;
                            }
                        ?>
                        <input type="tel" name="teleORDER" placeholder="0812 34567890" value="<?php echo $val; ?>">
                        <?php echo form_error('teleORDER'); ?>
                    </div>
                    <div class="field">
                        <label for="telepon">Nomor telepon rumah/kantor</label>
                        <?php
                            $val = set_value('telehomeORDER');
                            if($data_filled != ''){
                                $val = $data_filled->telehomeORDER;
                            }
                        ?>
                        <input type="tel" name="telehomeORDER" placeholder="021 2345678" value="<?php echo $val; ?>">
                        <?php echo form_error('telehomeORDER'); ?>
                    </div>
                </div>

                <div class="three fields will-hidden">
                    <div class="required field">
                        <label for="provinsi-checkout">Provinsi</label>
                        <?php
                            $listprovince = select_all_province();
                            if(!empty($listprovince)){
                                $options = array();
                                foreach ($listprovince as $key => $value){
                                    $options[$value['province_id']] = $value['province'];
                                }
                            }
                        ?>
                        <?php echo form_dropdown('provinsi-checkout', $options, $this->input->post('provinsi-checkout'),'id="provinsi_checkout" class="ui search dropdown"'); ?>
                        <?php echo form_error('provinsi-checkout'); ?>
                    </div>
                    <div class="required field">
                        <label for="kota-checkout">Kota/Kabupaten</label>
                        <select class="ui search dropdown" id="city_checkout" name="city-checkout">
                            <option value="">Pilih kota kamu</option>
                        </select>
                        <?php echo form_error('city-checkout'); ?>
                    </div>
                    <div class="required field">
                        <label for="kodepos">Kode Pos</label>
                        <?php
                            $val = set_value('zipORDER');
                            if($data_filled != ''){
                                $val = $data_filled->zipORDER;
                            }
                        ?>
                        <input type="number" name="zipORDER" placeholder="Misal: 29433" value="<?php echo $val; ?>">
                        <?php echo form_error('zipORDER'); ?>
                    </div>
                </div>

                <!-- Ini section form kalo pilih sesuai data dari Profile -->
                 <div class="two fields will-show hide mb2em">
                    <div class="field">
                        <label for="nama">Nama lengkap penerima</label>
                        <input type="text" name="namedefaultORDER" value="<?php echo $data_customer->nameCUSTOMER;?>" readonly>
                        <?php echo form_error('namedefaultORDER'); ?>
                    </div>
                    <div class="field">
                        <label for="email">Email penerima</label>
                        <input type="email" name="emaildefaultORDER" value="<?php echo $data_customer->emailCUSTOMER;?>" readonly>
                        <?php echo form_error('emaildefaultORDER'); ?>
                    </div>
                </div>

                <div class="one fields will-show hide mb2em">
                    <div class="field">
                        <label for="nama">Nomor telepon penerima</label>
                        <input type="number" name="teledefaultORDER" value="<?php echo $data_customer->teleCUSTOMER;?>" readonly>
                        <?php echo form_error('teledefaultORDER'); ?>
                    </div>
                </div>

                <div class="three fields will-show hide mb2em">
                    <div class="field">
                        <label for="hidden-provinsi">Provinsi</label>
                        <?php echo $data_customer_province_city['province'];?>
                        <input type="hidden" name="provinsi_checkout_default" id="provinsi_checkout_default" value="<?php echo $data_customer_province_city['province_id'];?>" >
                        <?php echo form_error('provinsi_checkout_default'); ?>
                    </div>
                    <div class="field">
                        <label for="hidden-provinsi">Kota/Kabupaten</label>
                        <?php echo $data_customer_province_city['city_name'];?>
                        <input type="hidden" name="city_checkout_default" id="city_checkout_default" value="<?php echo $data_customer_province_city['city_id'];?>" >
                        <?php echo form_error('city_checkout_default'); ?>
                    </div>
                    <div class="field">
                        <label for="hidden-provinsi">Kode Pos</label>
                        <input type="number" name="zipdefaultORDER" value="<?php echo $data_customer->zipCUSTOMER;?>" readonly>
                        <?php echo form_error('zipdefaultORDER'); ?>
                    </div>
                </div>

                <div class="field will-show hide mb2em">
                    <label for="alamat">Alamat pengiriman</label>
                    <textarea name="addressdefaultORDER" rows="6" readonly><?php echo $data_customer->addressCUSTOMER;?></textarea>
                    <?php echo form_error('addressdefaultORDER'); ?>
                </div>

                <div class="required field mb2em will-hidden">
                    <label for="alamat">Alamat pengiriman</label>
                    <?php
                        $val = set_value('addressORDER');
                        if($data_filled != ''){
                            $val = $data_filled->addressORDER;
                        }
                    ?>
                    <textarea name="addressORDER" rows="6" placeholder="Jalan Kesturi Blok B No. 14, Sei Panas"><?php echo $val; ?></textarea>
                    <?php echo form_error('addressORDER'); ?>
                </div>
                <div class="inline three fields ekspedisi">
                    <label>Ekspedisi apa?</label>
                    <?php
                        if(!empty($checkshipping_active)){
                            foreach ($checkshipping_active as $key => $active) {
                    ?>
                    <div class="field">
                        <div class="ui segment">
                            <div class="ui radio checkbox <?php echo strtolower(str_replace(' ', '', $active->nameSHIPPING));?>">
                                <input type="radio" name="ekspedisiORDER" id="ekspedisi-shipping-<?php echo $key;?>" class="hidden ekspedisi_class" value="<?php echo strtolower(str_replace(' ', '', $active->nameSHIPPING));?>" required="required">
                                <label><?php echo $active->nameSHIPPING;?></label>
                                <?php echo form_error('ekspedisiORDER'); ?>
                            </div>
                        </div>
                    </div>
                        <?php } ?>
                    <?php } ?>
                </div>

                <?php 
                    if(!empty($checkshipping_active)){
                        foreach ($checkshipping_active as $keys => $active) {
                ?>
                <div class="ui tab segment" data-tab="tab-<?php echo strtolower(str_replace(' ', '', $active->nameSHIPPING));?>">
                    <div class="ui items">

                        <div class="item">
                            <div class="ui small image ekspedisi-logo">
                                <img src="<?php echo $active->imageSHIPPING;?>" alt="Logo <?php echo $active->nameSHIPPING;?>">
                            </div>
                            <div class="content" id="detail_ekspedisi<?php echo $keys;?>"></div>
                        </div>

                    </div>
                </div>
                    <?php } ?>
                <?php } ?>

                <div class="ui segment seamless">
                    <div class="field">
                        <?php
                            if(!empty($data_filled)){
                                $class= 'hidden';
                                if($data_filled->dropshipperORDER == '-'){
                                    $selected= '';
                                    $class= 'hidden';
                                } elseif($data_filled->dropshipperORDER == '') {
                                    $selected= '';
                                    $class= 'hidden';
                                } elseif($data_filled->dropshipperORDER != '') {
                                    $selected= 'checked';
                                    $class= 'visible';
                                }
                            } else {
                                $selected= 'checked';
                                $class= 'visible';
                                if($this->input->post('dropshipper_check') == ''){
                                    $selected= '';
                                    $class= 'hidden';
                                }
                            }
                        ?>
                        <div class="ui slider checkbox dropshipper <?php echo $selected;?>">
                            <input type="checkbox" name="dropshipper_check" tabindex="0" class="hidden">
                            <label>Saya mengirim barang ini kepada orang lain atas nama saya</label>
                        </div>
                    </div>
                </div>
                <div class="two fields transition <?php echo $class;?>" id="dropshipper-field">
                    <div class="field">
                        <label for="">Nama saya sebagai dropshipper</label>
                        <?php
                            $val = set_value('dropshipperORDER');
                            if($data_filled != ''){
                                $val = $data_filled->dropshipperORDER;
                            }
                        ?>
                        <input type="text" name="dropshipperORDER" placeholder="John Doe" value="<?php echo $val; ?>">
                        <?php echo form_error('dropshipperORDER'); ?>
                    </div>
                    <div class="field">
                        <label for="">Institusi/organisasi saya sebagai dropshipper</label>
                        <?php
                            $val = set_value('dropshippercompanyORDER');
                            if($data_filled != ''){
                                $val = $data_filled->dropshippercompanyORDER;
                            }
                        ?>
                        <input type="text" name="dropshippercompanyORDER" placeholder="CV Megah Jaya" value="<?php echo $val; ?>">
                        <?php echo form_error('dropshippercompanyORDER'); ?>
                    </div>
                </div>
                <button type="submit" class="ui fluid zz button ">Lanjut</button>
            </form>
        </div>
    </div> <!-- kelar div Grid / Step-Shipping -->
</div>
<!-- kelar Main -->