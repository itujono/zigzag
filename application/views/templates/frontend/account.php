<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($data_customer_province_city)){
    $name_city =  $data_customer_province_city->nameCITY;
    $name_province = $data_customer_province_city->namePROVINCE;
} else {
    $name_city =  '- ';
    $name_province = ' -';
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
                    <div class="will-edit">
                        <figure class="ui circular image">
                            <img src="<?php echo $data_customer->imageCUSTOMER; ?>" alt="<?php echo $data_customer->nameCUSTOMER;?>">
                        </figure>
                        <div class="name">
                            <?php echo $data_customer->nameCUSTOMER;?>
                            <p><?php echo $name_city;?>, <?php echo $name_province;?></p>
                        </div>
                    </div>
                    <form action="<?php echo base_url();?>customer/save_profile_picture_customer" method="POST" class="ui form inline-editable general-info" enctype="multipart/form-data">

                        <div class="ui compact red message print-error-msg-profile" style="display:none">
                            <h5 class="header">Oops!</h5>

                        </div>
                        <div class="ui compact red message print-success-msg-profile" style="display:none">
                            <h5 class="header">Sukses!</h5>
                            Data berhasil disimpan.
                        </div>
                        <div class="ui compact red message print-notsave-msg-profile" style="display:none">
                            <h5 class="header">Oops!</h5>
                            Kami tidak dapat menyimpan data anda, coba lagi nanti.
                        </div>
                        <div class="field">
                            <label for="inline-photo">Ganti foto?</label>
                            <input type="file" name="imgCUSTOMER" id="imgCUSTOMER" required="required">
                        </div>
                       <div class="field">
                            <label for="provinsi">Provinsi</label>
                            <select class="ui search dropdown" id="inline-provinsi" name="idPROVINCE" required="required">
                                <option value="" selected disabled="disabled">Pilih provinsi kamu</option>
                                <?php
                                $listprovince = select_all_province();
                                if(!empty($listprovince)){
                                    foreach ($listprovince as $key => $pro) {
                                    if($pro->idPROVINCE == $data_customer_province_city->idPROVINCE){
                                        $idpro="selected";
                                    } else {
                                        $idpro="";
                                    }
                                ?>
                                    <option <?php echo $idpro; ?> value="<?php echo $pro->idPROVINCE;?>"><?php echo $pro->namePROVINCE;?>
                                    </option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="field">
                            <label for="provinsi">Kota/Kab</label>
                            <select class="ui search dropdown inline_city" id="inline_city" name="inline_city" required="required">
                                <option value="" selected disabled="disabled">Pilih provinsi kamu</option>
                            </select>
                        </div>
                        <button class="ui mini button submit upload_profile_picture_customer" type="submit">Update</button>
                        <button class="ui mini button basic cancel">Cancel</button>
                    </form>
                    <a href="#" class="ui icon editable button general-info"> <i class="write icon"></i> </a>
                </div>
                <div>
                    <div class="title"> Contact </div>
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
                    <div class="ui compact red message print-error-msg-profile" style="display:none">
                        <h5 class="header">Oops!</h5>
                    </div>
                    <div class="ui compact teal message print-success-msg-profile" style="display:none">
                        <i class="close icon"></i>
                        <h5 class="header">Sukses!</h5>
                        Data berhasil disimpan.
                    </div>
                    <div class="ui compact red message print-notsave-msg-profile" style="display:none">
                        <h5 class="header">Oops!</h5>
                        Kami tidak dapat menyimpan data anda, coba lagi nanti.
                    </div>
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

        </div>
        <!-- kelar Four Wide Column -->

        <div class="twelve wide column profile-content">

            <div class="ui pointing menu">
                <a href="#" class="active item" data-tab="wishlist">
                    <i class="empty heart icon"></i> Wishlist</a>
                <a href="#" class="item" data-tab="order-history">
                    <i class="diamond icon"></i> Histori Pembelian</a>
                <a href="#" class="item" data-tab="retur-history">
                    <i class="moon icon"></i> Histori Retur</a>
                <a href="#" class="right floated item" data-tab="settings">
                    <i class="wrench icon"></i> Settings</a>
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
                                <button class="ui basic teal tiny button move-to-cart add_cart" title="Tambahkan ke Cart" data-barangid="<?php echo $wish->idBARANG;?>" data-barangnama="<?php echo $wish->nameBARANG;?>" data-barangharga="<?php echo $wish->priceBARANG;?>">
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

                    <div class="event">
                        <div class="label">
                            <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                        </div>

                        <div class="content">

                            <div class="summary">
                                Kamu belanja
                                <span>2 tas</span> dan
                                <span>3 sepatu</span>
                                <div class="date"> 2 hari yang lalu </div>
                            </div>
                            <div class="item-list">
                                <ul>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
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

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 2 x Rp 300.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 600.000,00 </td>
                                            </tr>

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 2 x Rp 300.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 600.000,00 </td>
                                            </tr>

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 1 x Rp 250.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 250.000,00 </td>
                                            </tr>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Total:</th>
                                                <th>Rp 1.450.000,00</th>
                                            </tr>
                                        </tfoot>

                                    </table>

                                    <div class="footer-detail">
                                        <address>
                                            <strong>Dikirim ke</strong>
                                            <br> Jalan Kepodang Raya Blok XX #33 Sei Kundur
                                            <br> Kendari, Sulawesi Tenggara 23590
                                            <br>
                                            <br>

                                            <strong>Telepon</strong>
                                            <br> 0778 34590354 / 0812 249845780
                                            <br>
                                            <br>

                                            <strong>Catatan</strong>
                                            <br> Jangan sampe tumpah. Mau dimasak soalnya.
                                        </address>
                                        <address>
                                            <strong>Nama penerima di tempat</strong>
                                            <br> Rusmanda Norman
                                            <br>
                                            <br>

                                            <strong>Tanggal tiba</strong>
                                            <br> 13 Desember 2022
                                            <br>
                                            <br>

                                            <strong>Ekspedisi</strong>
                                            <br> Si Kilat
                                            <br>
                                            <br>

                                            <strong>Status</strong>
                                            <br>
                                            <i class="check square green icon"></i> Keanter
                                            <!-- atau -->
                                            <i class="minus square red icon"></i> Bermasalah
                                        </address>
                                    </div>
                                </div>
                                <!-- kelar div Content-Detail -->

                            </div>
                            <!-- kelar div Item-List -->
                        </div>

                    </div>
                    <!-- kelar div Event satuan -->

                    <div class="event">
                        <div class="label">
                            <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                        </div>

                        <div class="content">

                            <div class="summary">
                                Kamu belanja
                                <span>4 lingerie</span> dan
                                <span>1 sepatu</span>
                                <div class="date"> 13 Oktober 2012 </div>
                            </div>
                            <div class="item-list">
                                <ul>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" alt="">
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

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 2 x Rp 300.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 600.000,00 </td>
                                            </tr>

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 2 x Rp 300.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 600.000,00 </td>
                                            </tr>

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 1 x Rp 250.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 250.000,00 </td>
                                            </tr>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Total:</th>
                                                <th>Rp 1.450.000,00</th>
                                            </tr>
                                        </tfoot>

                                    </table>

                                    <div class="footer-detail">
                                        <address>
                                            <strong>Dikirim ke</strong>
                                            <br> Jalan Kepodang Raya Blok XX #33 Sei Kundur
                                            <br> Kendari, Sulawesi Tenggara 23590
                                            <br>
                                            <br>

                                            <strong>Telepon</strong>
                                            <br> 0778 34590354 / 0812 249845780
                                            <br>
                                            <br>

                                            <strong>Catatan</strong>
                                            <br> Jangan sampe tumpah. Mau dimasak soalnya.
                                        </address>
                                        <address>
                                            <strong>Nama penerima di tempat</strong>
                                            <br> Rusmanda Norman
                                            <br>
                                            <br>

                                            <strong>Tanggal tiba</strong>
                                            <br> 13 Desember 2022
                                            <br>
                                            <br>

                                            <strong>Ekspedisi</strong>
                                            <br> Si Kilat
                                            <br>
                                            <br>

                                            <strong>Status</strong>
                                            <br>
                                            <i class="check square green icon"></i> Keanter
                                            <!-- atau -->
                                            <i class="minus square red icon"></i> Bermasalah
                                        </address>
                                    </div>
                                </div>
                                <!-- kelar div Content-Detail -->

                            </div>
                            <!-- kelar div Item-List -->
                        </div>

                    </div>
                    <!-- kelar div Event satuan -->

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

                    <div class="event">
                        <div class="label">
                            <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                        </div>

                        <div class="content">

                            <div class="summary">
                                Kamu ngembaliin
                                <span>2 tas</span> dan
                                <span>3 sepatu</span>
                                <div class="date"> 2 hari yang lalu </div>
                            </div>
                            <div class="item-list">
                                <ul>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
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

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 2 x Rp 300.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 600.000,00 </td>
                                            </tr>

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 2 x Rp 300.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 600.000,00 </td>
                                            </tr>

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 1 x Rp 250.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 250.000,00 </td>
                                            </tr>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Total:</th>
                                                <th>Rp 1.450.000,00</th>
                                            </tr>
                                        </tfoot>

                                    </table>

                                    <div class="footer-detail">
                                        <address>
                                            <strong>Dikirim dari</strong>
                                            <br> Jalan Kepodang Raya Blok XX #33 Sei Kundur
                                            <br> Kendari, Sulawesi Tenggara 23590
                                            <br>
                                            <br>

                                            <strong>Alasan retur</strong>
                                            <br> Jangan sampe tumpah. Mau dimasak soalnya.
                                        </address>
                                    </div>
                                </div>
                                <!-- kelar div Content-Detail -->

                            </div>
                            <!-- kelar div Item-List -->
                        </div>

                    </div>
                    <!-- kelar div Event satuan -->

                    <div class="event">
                        <div class="label">
                            <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                        </div>

                        <div class="content">

                            <div class="summary">
                                Kamu ngembaliin
                                <span>4 lingerie</span> dan
                                <span>1 sepatu</span>
                                <div class="date"> 13 Oktober 2012 </div>
                            </div>
                            <div class="item-list">
                                <ul>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" alt="">
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

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 2 x Rp 300.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 600.000,00 </td>
                                            </tr>

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 2 x Rp 300.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 600.000,00 </td>
                                            </tr>

                                            <tr>
                                                <td class="single line">
                                                    <div class="ui image header">
                                                        <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                                        <div class="content">
                                                            Pouch Bag Slingshot Cool
                                                            <div class="sub header">
                                                                Kode: PX3459
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> 1 x Rp 250.000,00 </td>
                                                <td>-</td>
                                                <td> Rp 250.000,00 </td>
                                            </tr>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Total:</th>
                                                <th>Rp 1.450.000,00</th>
                                            </tr>
                                        </tfoot>

                                    </table>

                                    <div class="footer-detail">
                                        <address>
                                            <strong>Dikirim dari</strong>
                                            <br> Jalan Kepodang Raya Blok XX #33 Sei Kundur
                                            <br> Kendari, Sulawesi Tenggara 23590
                                            <br>
                                            <br>

                                            <strong>Alasan retur</strong>
                                            <br> Jangan sampe tumpah. Mau dimasak soalnya.
                                        </address>
                                    </div>

                                </div>
                                <!-- kelar div Content-Detail -->

                            </div>
                            <!-- kelar div Item-List -->
                        </div>

                    </div>
                    <!-- kelar div Event satuan -->

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