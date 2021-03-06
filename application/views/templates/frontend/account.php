<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($data_customer_province_city)){
    
    $name_city =  $data_customer_province_city['city_name'];
    $name_province = $data_customer_province_city['province'];
    $id_province = $data_customer_province_city['province_id'];
    
} else {
    $name_city =  '- ';
    $name_province = ' -';
    $id_province = '-';
}
if(!empty($data_customer)){
    $address_customer = $data_customer->addressCUSTOMER;
    $zip_customer = $data_customer->zipCUSTOMER;
    $tele_customer = $data_customer->teleCUSTOMER;
} else {
    $address_customer = '-';
    $zip_customer = '-';
    $tele_customer = '-';
}
?>


<div class="main">
    <div class="ui stackable grid">

        <div class="four wide column user-information">

            <div class="ui segment">
                <div class="ui compact red message print-error-msg" style="display:none">
                    <h4 class="header">Oops!</h4>
                </div>
                <div>
                    <div class="ui compact red message print-success-msg-profile" style="display:none">
                            <i class="close icon"></i>
                            <h5 class="header">Sukses!</h5>
                            Gambar Profile berhasil diupload
                    </div>
                    <div class="ui compact red message print-notsave-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                        Kami tidak dapat menyimpan data anda, coba lagi nanti.
                    </div>
                    <ul class="profile-data">
                        <li>
                        <figure class="ui circular image">
                            <img id="uploaded-image" src="<?php echo $data_customer->imageCUSTOMER; ?>" alt="<?php echo $data_customer->nameCUSTOMER;?>">
                        </figure>
                        </li>
                    </ul>
                    <?php if(empty($this->session->userdata('profile_picture'))) {  ?>
                    <form method="POST" action="<?php echo base_url();?>customer/save_profile_picture_customer" class="ui form inline-editable general-picture" enctype="multipart/form-data" id="upload_profile_picture_customer">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                        <div class="field">
                            <label for="inline-photo">Ganti foto?</label>
                            <input type="file" name="imgCUSTOMER" id="imgCUSTOMER" accept="image/jpg, image/jpeg, image/png">
                        </div>
                        <input class="ui mini button submit" type="submit" value="Update">
                        <button class="ui mini button basic cancel">Cancel</button>
                    </form>
                    <a href="#" class="ui icon editable button general-picture"> <i class="write icon"></i> </a>
                    <?php } ?>
                </div>
                <div>
                    <div class="title"> Customer </div>
                    <!-- ///////////// -->
                    <div class="ui compact teal message print-success-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Sukses!</h5>
                        Data berhasil disimpan.
                    </div>
                    <div class="ui compact red message print-notsave-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                        Kami tidak dapat menyimpan data anda, coba lagi nanti.
                    </div>
                    <div class="ui compact red message print-error-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                        Ini apaan gak tau.
                    </div>
                    <!-- /////////////// -->
                    <ul class="customer-data">
                        <li class="name_customer"><?php echo $data_customer->nameCUSTOMER;?></li>
                        <li class="city_customer"><?php echo $name_city;?></li><li class="province_customer"><?php echo $name_province;?></li>
                    </ul>
                    <form method="POST" action="<?php echo base_url();?>customer/save_data_customer" class="ui form inline-editable general-info">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                        <div class="field">
                            <label for="inline-name">Nama kamu</label>
                            <input type="text" name="name_customer" id="name_customer" value="<?php echo $data_customer->nameCUSTOMER;?>">
                        </div>
                       <div class="field">
                            <label for="provinsi">Provinsi</label>
                            <select class="ui search dropdown" id="inline_provinsi" name="inline_provinsi" required="required">
                                <option value="" selected disabled="disabled">Pilih provinsi kamu</option>
                                <?php
                                $listprovince = select_all_province();
                                if(!empty($listprovince)){
                                    foreach ($listprovince as $pro) {
                                    if($pro['province_id'] == $id_province){
                                        $idpro="selected";
                                    } else {
                                        $idpro="";
                                    }
                                ?>
                                    <option <?php echo $idpro; ?> value="<?php echo $pro['province_id'];?>"><?php echo $pro['province'];?>
                                    </option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="field">
                            <label for="kota">Kota/Kab</label>
                            <select class="ui search dropdown" id="inline_city" name="inline_city" required="required">
                                <option value="" disabled="disabled">Pilih provinsi kamu dulu</option>
                            </select>
                        </div>
                        <button class="ui mini button submit save_data_customer" type="submit">Update</button>
                        <button class="ui mini button basic cancel">Cancel</button>
                    </form>
                    <a href="#" class="ui icon editable button general-info"> <i class="write icon"></i> </a>
                </div>


                <div>
                    <div class="title"> Contact </div>

                    <!-- ///////////// -->
                    <div class="ui compact teal message print-success-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Sukses!</h5>
                        Data berhasil disimpan.
                    </div>
                    <div class="ui compact red message print-notsave-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                        Kami tidak dapat menyimpan data anda, coba lagi nanti.
                    </div>
                    <div class="ui compact red message print-error-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                        Ini apaan gak tau.
                    </div>
                    <!-- /////////////// -->

                    <ul class="contact-data">
                        <li class="email-data"> <?php echo $data_customer->emailCUSTOMER;?></li>
                        <li class="tele-data"> <?php echo $tele_customer;?></li>
                    </ul>
                    <form action="<?php echo base_url();?>customer/save_email_tele_customer" class="ui form inline-editable contact" method="POST">
                        <div class="field">
                            <label for="inline-email">Email kamu</label>
                            <input type="email" name="emailCUSTOMER" id="emailCUSTOMER" value="<?php echo $data_customer->emailCUSTOMER;?>">
                        </div>
                        <div class="field">
                            <label for="inline-phone">Hape kamu</label>
                            <input type="number" name="teleCUSTOMER" id="teleCUSTOMER" value="<?php echo $data_customer->teleCUSTOMER;?>">
                        </div>
                        <button type="submit" class="ui mini button submit save-email-tele-customer">Update</button>
                        <button class="ui mini button basic cancel">Cancel</button>
                    </form>
                    <a href="#" class="ui icon button editable contact">
                        <i class="write icon"></i>
                    </a>
                </div>


                <div>
                    <div class="title"> Shipping </div>

                    <!-- /////////////// -->
                    <div class="ui compact red message print-error-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                        Ini apaan coba, Ndan?
                    </div>
                    <div class="ui compact teal message print-success-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Sukses!</h5>
                        Data berhasil disimpan.
                    </div>
                    <div class="ui compact red message print-notsave-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                        Kami tidak dapat menyimpan data anda, coba lagi nanti.
                    </div>
                    <!-- //////////////// -->

                    <ul class="address">
                        <li class="alamat-data">
                            <?php echo $address_customer;?>
                            <br><?php echo $name_city;?>, <?php echo $name_province;?>
                        </li>
                        <li class="zip-data">
                            <?php echo $zip_customer;?>
                        </li>
                    </ul>
                    <form action="<?php echo base_url();?>customer/save_address_zip_customer" class="ui form inline-editable alamat" method="POST">
                        <div class="field">
                            <textarea id="addressCUSTOMER" rows="5" name="addressCUSTOMER"><?php echo $data_customer->addressCUSTOMER;?></textarea>
                        </div>
                        <div class="field">
                            <label for="zipCUSTOMER">Kode Pos kamu</label>
                            <input type="number" name="zipCUSTOMER" id="zipCUSTOMER" value="<?php echo $data_customer->zipCUSTOMER;?>">
                        </div>
                        <button class="ui mini button submit save-address-zip-customer" type="submit">Update</button>
                        <button class="ui mini button basic cancel">Cancel</button>
                    </form>
                    <a href="#" class="ui icon button editable alamat">
                        <i class="write icon"></i>
                    </a>
                </div>


                <div>
                    <div class="title"> Socials </div>

                    <!-- ///////////////// -->
                    <div class="ui compact red message print-error-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                    </div>
                    <div class="ui compact teal message print-success-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Sukses!</h5>
                        Data berhasil disimpan.
                    </div>
                    <div class="ui compact red message print-notsave-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Oops!</h5>
                        Kami tidak dapat menyimpan data anda, coba lagi nanti.
                    </div>
                    <!-- //////////////////// -->

                    
                    <?php
                        if(!empty($data_customer_social)){
                            $facebook= $data_customer_social->facebooknameSOCIAL;
                            $instagram = $data_customer_social->instagramnameSOCIAL;
                        } else {
                            $facebook='-';
                            $instagram='-';
                        } 
                    ?>
                    <ul class="social-media">
                        <li>
                            <i data-feather="facebook"></i>
                            <a href="http://facebook.com/<?php echo $facebook;?>" target="_blank" class="facebook-social"><?php echo $facebook;?></a>
                        </li>
                        <li>
                            <i data-feather="instagram"></i>
                            <a href="http://instagram.com/<?php echo $instagram;?>" target="_blank"  class="instagram-social"><?php echo $instagram;?></a>
                        </li>
                    </ul>
                    <form action="<?php echo base_url();?>customer/save_social_customer" class="ui form inline-editable social" method="POST">
                        <div class="field">
                            <label for="inline-facebook">Alamat Facebook</label>
                            <input type="text" name="facebooknameSOCIAL" id="facebooknameSOCIAL" value="<?php echo $facebook;?>">
                        </div>
                        <div class="field">
                            <label for="inline-instagram">Alamat Instagram</label>
                            <input type="text" name="instagramnameSOCIAL" id="instagramnameSOCIAL" value="<?php echo $instagram;?>">
                        </div>
                        <button class="ui mini button submit save-social-customer" type="submit">Update</button>
                        <button class="ui mini button basic cancel">Cancel</button>
                    </form>
                    <a href="#" class="ui icon button editable social">
                        <i class="write icon"></i>
                    </a>
                </div>

            </div>

        </div> <!-- kelar Four Wide Column -->


        <div class="twelve wide column profile-content">

            <div class="ui pointing menu">
                <a href="#" class="active item" data-tab="wishlist">
                    <i class="empty heart icon"></i> Wishlist</a>
                <a href="#" class="item" data-tab="order-history">
                    <i class="diamond icon"></i> Histori Pembelian</a>
                <a href="#" class="item" data-tab="retur-history">
                    <i class="moon icon"></i> Histori Retur</a>
                <?php if(empty($this->session->userdata('profile_picture'))) {  ?>
                <a href="#" class="right floated item" data-tab="settings">
                    <i class="wrench icon"></i> Settings</a>
                <?php } ?>
            </div>

            <div class="ui tab active segment" id="wishlist" data-tab="wishlist">
                <div class="header">
                    <h3>
                        <i class="empty heart icon"></i> Wishlist
                    </h3>
                    <!-- <button class="ui basic teal button move-all-to-cart">
                        <i class="plus icon"></i> Pindahkan semuanya ke Cart
                    </button> -->
                </div>
                <div class="ui divided items">
                <?php
                    if(!empty($data_customer_wish)){
                        foreach ($data_customer_wish as $wish) {
                ?>
                    <div class="item" id="wishlist_item">
                        <figure class="ui tiny image">
                            <img src="<?php echo $wish->imageWISHBARANG;?>" alt="<?php echo $wish->nameBARANG;?>">
                        </figure>
                        <div class="content">
                            <a href="<?php echo base_url();?>detail/<?php echo $wish->slugBARANG;?>" class="header"><?php echo $wish->nameBARANG;?></a>
                            <div class="meta">
                                <?php echo $wish->nameCATEGORY;?>
                                <span><?php echo number_format($wish->priceBARANG, 0,',','.'); ?></span>
                            </div>
                            <div class="description">
                                <?php echo character_limiter($wish->descBARANG, 153);?>
                            </div>
                            <div class="extra">
                                <input type="hidden" name="qtyBARANG" id="<?php echo $wish->idBARANG;?>" value="1" class="quantity">
                                <input type="hidden" name="idWISH" id="idWISH" value="<?php echo $wish->idWISH;?>">
                                <button class="ui basic teal tiny button move-to-cart add_cart" title="Tambahkan ke Cart" data-barangid="<?php echo $wish->idBARANG;?>" data-barangnama="<?php echo $wish->nameBARANG;?>" data-barangharga="<?php echo $wish->priceBARANG;?>" data-stokbarang="<?php echo $wish->stockBARANG;?>">
                                    <i class="plus icon"></i>Pindahkan ke Cart
                                </button>
                                <a href="#" class="remove-from-wishlist remove-wishlist" id="idWISH" data-wishid="<?php echo $wish->idWISH;?>"><i class="remove icon"></i>Hapus dari Wishlist</a>                                        
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } else { ?>
                    <div class="ui info message all-moved-to-cart">
                        <div class="header">Oops!</div>
                        Daftar Wishlist kamu belum ada.
                    </div>
                    <?php } ?>
                    <!-- Ini message kalo semuanya udah berhasil dipindahin yaa -->
                    <!-- <div class="ui info message all-moved-to-cart">
                        <div class="header"> Udah dipindahin semua </div>
                        Yup! Semua wishlist kamu udah berhasil dipindahin ke Cart ya.
                        <a href="cart.html">Have a look!</a>
                    </div> -->

                    <div class="ui compact teal message moved-to-cart">
                        <i class="close icon"></i>
                        <h4 class="header">Great!</h4>
                        <p><i class="alarm icon"></i> Item berhasil dipindahkan ke Cart</p>
                    </div>

                    <div class="ui compact teal message removed-from-wishlist">
                        <i class="close icon"></i>
                        <h4 class="header">Alright!</h4>
                        <p><i class="alarm icon"></i> Kamu telah membatalkan item Wishlist kamu</p>
                    </div>

                    <div class="ui mini modal confirmation-delete-all-cart">
                        <div class="header">Pindahin semua?</div>
                        <div class="content">
                            <p>Yakin nih ya mau pindahin semua item di Wishlist ke Cart?</p>
                        </div>
                        <div class="actions">
                            <div class="ui approve zz button">Yakin</div>
                            <div class="ui cancel button">Batal</div>
                        </div>
                    </div>

                </div>
            </div>
            <!--kelar Segment Wishlist -->


            <div class="ui tab segment" id="order-history" data-tab="order-history">

                <div class="header">
                    <h3>
                        <i class="diamond icon"></i> Order History</h3>
                </div>
    
                <div class="ui feed details">
                    <!-- ntar taruh buka php disini -->
                    <?php
                        if(!empty($history_order)){
                            foreach ($history_order as $hist_order) {
                    ?>
                    <div class="event">
                        <div class="label">
                            <img src="<?php echo $data_customer->imageCUSTOMER; ?>" alt="<?php echo $data_customer->nameCUSTOMER; ?>">
                        </div>
                        <div class="content">
                            <div class="summary">
                                Kamu belanja
                                <?php $history_order_detail = history_detail_order_customer($hist_order->idORDER); ?>
                                <span> <?php echo count($history_order_detail);?> Barang</span>
                                <div class="date"> <?php echo timeAgo(dF('H:i:s',strtotime($hist_order->createdateORDER))); ?> </div>
                            </div>
                            <div class="item-list">
                                <ul>
                                    <?php
                                    $history_order_detail = history_detail_order_customer($hist_order->idORDER);
                                    foreach ($history_order_detail as $key_image => $hist_detail) {
                                    $map[] = directory_map('assets/upload/barang/pic-barang-'.folenc($hist_detail->idproductdetailORDER), FALSE, TRUE);
                                    if(!empty($map)){
                                        foreach ($map  as $key => $value) {
                                            $imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($hist_detail->idproductdetailORDER).'/'.$value[0];
                                        }
                                    }
                                    ?>
                                    <li>
                                        <img src="<?php echo $imageBARANG; ?>">
                                    </li>
                                    <?php } ?>
                                    <a href="#" class="more" data-text-swap="Tutup">Selengkapnya...</a>
                                </ul>

                                <div class="content-detail">
                                    <table class="ui celled padded table">
                                        <thead>
                                            <tr>
                                                <th class="single line">Item</th>
                                                <th>Harga</th>
                                                <th>Keterangan</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $history_order_detail = history_detail_order_customer($hist_order->idORDER);
                                        foreach ($history_order_detail as $key => $hist_detail) {
                                            $map[] = directory_map('assets/upload/barang/pic-barang-'.folenc($hist_detail->idproductdetailORDER), FALSE, TRUE);
                                            if(!empty($map)){
                                                foreach ($map  as $key => $value) {
                                                    $imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($hist_detail->idproductdetailORDER).'/'.$value[0];
                                                }
                                            }
                                        ?>
                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="<?php echo $imageBARANG; ?>" alt="<?php echo $hist_detail->nameBARANG; ?>">
                                                        <div class="content">
                                                            <?php echo $hist_detail->nameBARANG; ?>
                                                            <div class="sub header">
                                                                Kode: <?php echo $hist_detail->codeBARANG; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <?php echo $hist_detail->qtydetailORDER; ?> x Rp. <?php echo number_format($hist_detail->pricedetailORDER);?> </td>
                                                <td>-</td>
                                                <td> Rp. <?php echo number_format($hist_detail->pricedetailORDER*$hist_detail->qtydetailORDER);?> </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Total:</th>
                                                <th>Rp. <?php echo number_format($hist_order->subtotal+$hist_order->totalekspedisiORDER);?></th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="footer-detail">
                                        <?php $data_order_destination = selectall_city_by_province($hist_order->cityORDER, $hist_order->provinceORDER);
                                        ?>
                                        <address>
                                            <strong>Dikirim ke</strong>
                                            <br> <?php echo $hist_order->addressORDER;?>
                                            <br> <?php echo $data_order_destination['city_name'];?>, <?php echo $data_order_destination['province'];?> <?php echo $hist_order->zipORDER;?>
                                            <br>
                                            <br>
                                            <?php
                                                $telehome = $hist_order->telehomeORDER;
                                                if($hist_order->telehomeORDER == 0){
                                                    $telehome = '-';
                                                }
                                            ?>
                                            <strong>Telepon</strong>
                                            <br> <?php echo $hist_order->teleORDER;?> / <?php echo $telehome;?>
                                            <br>
                                            <br>

                                            <strong>Catatan</strong>
                                            <br> Jangan sampe tumpah. Mau dimasak soalnya.
                                        </address>
                                        <address>
                                            <strong>Nama penerima di tempat</strong>
                                            <br> <?php echo $hist_order->nameORDER;?>
                                            <br>
                                            <br>

                                            <strong>Ekspedisi</strong>
                                            <br> <?php echo strtoupper($hist_order->ekspedisiORDER);?>
                                            <br>
                                            <br>

                                            <strong>Status</strong>
                                            <br>
                                            <?php echo $hist_order->status;?>
                                        </address>
                                    </div>
                                </div>
                                <!-- kelar div Content-Detail -->
                            </div>
                            <!-- kelar div Item-List -->
                        </div>
                    </div>
                    <!-- kelar div Event satuan -->
                        <?php } ?>
                    <?php } ?>
                    <!-- ntar taruh tutup php disini -->

                </div>
                <!-- kelar Ui Feed Details -->

            </div>
            <!--kelar Segment Order History -->


            <div class="ui tab segment" id="retur-history" data-tab="retur-history">
                <div class="header">
                    <h3>
                        <i class="moon icon"></i> Retur History</h3>
                </div>
                <div class="ui feed details">
                <?php
                    if(!empty($return_barang_customer)){
                        foreach ($return_barang_customer as $return) {
                ?>
                    <div class="event">
                        <div class="label">
                            <img src="<?php echo $data_customer->imageCUSTOMER; ?>" alt="<?php echo $data_customer->nameCUSTOMER; ?>">
                        </div>
                        <div class="content">
                            <div class="summary">
                                Kamu ngembaliin
                                <span><?php echo $return->qtybarangRETURN;?> pcs Barang</span>
                                <div class="date"> <?php echo timeAgo(dF('H:i:s',strtotime($return->createdateRETURN))); ?></div>
                            </div>
                            <div class="item-list">
                                <ul>
                                    <li>
                                        <img src="<?php echo $return->imageRETURNBARANG;?>">
                                    </li>
                                    <a href="#" class="more" data-text-swap="Tutup">Selengkapnya...</a>
                                </ul>

                                <div class="content-detail">
                                    <table class="ui celled padded table">

                                        <thead>
                                            <tr>
                                                <th class="single line">Item</th>
                                                <th>Harga</th>
                                                <th>Keterangan</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                            $return_details_product = return_detail_barang_customer($return->kodeorderRETURN, $return->idbarangRETURN);
                                            foreach ($return_details_product as $return_det) {
                                        ?>
                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="<?php echo $return->imageRETURNBARANG;?>" alt="<?php echo $return_det->productdetailORDER;?>">
                                                        <div class="content">
                                                            <?php echo $return_det->productdetailORDER;?>
                                                            <div class="sub header">
                                                                Kode: <?php echo $return_det->codeBARANG;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <?php echo $return_det->qtybarangRETURN; ?> x Rp. <?php echo number_format($return_det->pricedetailORDER);?></td>
                                                <td><?php echo $return->status;?> </td>
                                                <td> Rp. <?php echo number_format($return_det->pricedetailORDER*$return_det->qtybarangRETURN);?> </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Total:</th>
                                                <?php
                                                $return_details_product = return_detail_barang_customer($return->kodeorderRETURN, $return->idbarangRETURN);
                                                        foreach ($return_details_product as $return_det) {
                                                ?>
                                                <th>Rp. <?php echo number_format($return_det->pricedetailORDER*$return_det->qtybarangRETURN);?></th>
                                                <?php } ?>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="footer-detail">
                                        <address>
                                            <strong>Dikirim dari</strong>
                                            <br> <?php echo $return->addressORDER;?>
                                            <br> <?php echo $name_city;?>, <?php echo $name_province;?> <?php echo $return->zipORDER;?>
                                            <br>
                                            <br>

                                            <strong>Alasan return</strong>
                                            <br> <?php echo $return->reasonRETURN;?>
                                            <br>
                                            <br>
                                            <strong>Alasan admin return</strong>
                                            <?php if(empty($return->reasonadminRETURN)){ ?>
                                            <br> -
                                            <?php } else { ?>
                                            <br> <?php echo $return->reasonadminRETURN;?>
                                            <?php } ?>
                                        </address>
                                    </div>
                                </div>
                                <!-- kelar div Content-Detail -->

                            </div>
                            <!-- kelar div Item-List -->
                        </div>
                    </div>
                    <!-- kelar div Event satuan -->
                        <?php } ?>
                    <?php } ?>
                </div>
                <!-- kelar Ui Feed Details -->

            </div>
            <!--kelar Segment Order History -->


            <div class="ui tab segment" id="settings" data-tab="settings">
                <div class="header">
                    <h3>
                        <i class="wrench icon"></i> Settings</h3>
                </div>

                <h2 class="ui header">
                    Ubah Password
                    <div class="sub header">Di sini kamu bisa ubah password. Keren gak tuh?</div>
                </h2>

                <div class="ui grid">
                    <div class="eight wide column">
                        <form class="ui form change-password" method="POST" action="<?php echo base_url();?>customer/change_password_customer">
                            
                            <div class="field">
                                <label>Password lama</label>
                                <input type="password" name="oldpassword" id="oldpassword" placeholder="Masukkan dulu password lama kamu">
                            </div>
                            <div class="field">
                                <label>Password baru</label>
                                <input type="password" name="password" id="password" placeholder="Masukkan password baru kamu">
                            </div>
                            <div class="field">
                                <label>Ulangi</label>
                                <input type="password" name="repassword" id="repassword" placeholder="Ulangi lagi password baru kamu">
                            </div>
                            <button class="ui zz button change-password" type="submit">&#9889; &nbsp; Ubah password</button>
                        </form>
                    </div>
                </div>

                <div class="ui mini modal confirmation-change-password">
                    <div class="header">Ubah password?</div>
                    <div class="content">
                        <p>Yakin nih ya mau ubah password</p>
                    </div>
                    <div class="actions">
                        <div class="ui approve zz button">Yakin</div>
                        <div class="ui cancel button">Batal</div>
                    </div>
                </div>

                <div class="ui info icon message password-changed">
                    <i class="checkmark icon"></i>
                    <div class="content">
                        <div class="header"> Selamat! </div>
                        Password kamu udah berhasil diubah. Cool!
                    </div>
                </div>
                <div class="ui info icon message password-not-same" style="display: none">
                    <i class="checkmark icon"></i>
                    <div class="content">
                        <div class="header"> Maaf! </div>
                        Password baru kamu tidak sama dengan form konfirmasi password baru, mohon ulangi
                    </div>
                </div>
                <div class="ui info icon message password-error" style="display: none">
                    <i class="checkmark icon"></i>
                    <div class="content">
                        <div class="header"> Maaf! </div>
                        Sistem tidak bisa merubah kata sandi anda, karena kata sandi lama anda tidak sama dengan yang anda masukkan sebelumnya, Mohon ulangi!.
                    </div>
                </div>
                <div class="ui info icon message password-error-validation" style="display: none">
                    <i class="checkmark icon"></i>
                    <div class="content">
                        <div class="header"> Maaf! </div>
                        
                    </div>
                </div>

            </div>
            <!--kelar Segment Settings -->


        </div>
        <!-- kelar Twelve Wide Column -->

    </div>

</div> <!-- kelar Main -->