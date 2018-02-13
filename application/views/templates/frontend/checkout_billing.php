<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="main">
    <div class="ui grid" id="step-shipping">
        <div class="sixteen wide column">
            <div class="ui three ordered steps">
                <div class="completed step">
                    <div class="content">
                        <div class="title">Shipping</div>
                        <div class="description">Isi form order untuk pengiriman</div>
                    </div>
                </div>
                <div class="active step">
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
            </div>
            <!-- kelar div Three Steps -->
        </div>
    </div> <!-- kelar div Grid / Step-Shipping -->

    <div class="ui grid" id="step-billing">
        <div class="sixteen wide column">
            <div class="ui three ordered steps">
                <div class="completed step">
                    <div class="content">
                        <div class="title">Shipping</div>
                        <div class="description">Isi form order untuk pengiriman</div>
                    </div>
                </div>
                <div class="active step">
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

            <div class="header" id="form-header">
                <h3>Pembayaran</h3>
                Pembayaran adalah hal yang bermakna bagi nusa dan bangsa orang Melayu di Pinang bagian selatan.
            </div>

            <form class="ui form" method="" id="payment-option">
                <div class="ui styled accordion payment-option">
                    <div class="title active">
                        <i class="dropdown icon"></i>
                        Transfer Bank
                    </div>

                    <div class="content active">
                        <div class="text">
                            <h3>Transfer Bank</h3>
                            Transfer bank mempunyai kelebihan yang mumpuni dibandingkan menabung di bank
                        </div>
                        <div class="ui form">
                            <div class="three required fields transfer">
                                <div class="field">
                                    <div class="ui segment">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="bank" tabindex="0" class="hidden">
                                            <label>BCA</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui segment">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="bank" tabindex="0" class="hidden">
                                            <label>Mandiri</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui segment">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="bank" tabindex="0" class="hidden">
                                            <label>BNI</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- kelar Ui Form -->

                        <div class="help-text">
                            <ol>
                                <li>Harap lakukan pembayaran paling lambat 3 jam, kalo nggak kami cancel nih,</li>
                                <li>Nomer rekening bakal dikasih tau pas di email nanti. Ini cuma pilihan bank yang diinginkan
                                    aja kok untuk transaksi.</li>
                            </ol>
                        </div>

                    </div>

                    <div class="title">
                        <i class="dropdown icon"></i>
                        Dana dari Deposit
                    </div>

                    <div class="content">

                        <div class="text">
                            <h3>Gunakan Dana dari Deposit Saya</h3>
                            Jika kamu memilih deposit dana, maka kamu harus mandi dulu pagi tadi
                        </div>

                        <div class="ui form">

                            <div class="field">
                                <div class="ui checkbox">
                                    <input type="checkbox" name="agree" tabindex="0" class="hidden">
                                    <label for="agree">Ya, gunakan dana dari Deposit saya</label>
                                </div>
                            </div>

                            <!-- <div class="field">
                                <label for="customAmount">Atau pilih nominal kamu sendiri (masukkan hanya angka)</label>
                                <input type="number" name="customAmount" placeholder="Misal: 350000">
                            </div> -->

                        </div>
                    </div>
                </div>
                <!-- kelar Accordion / Bank transfer -->

                <input type="submit" class="ui fluid teal button" id="billing" value="Lanjut">
            </form>

            <a href="#" class="back-to-previous">
                <i class="chevron left icon"></i> Kembali
            </a>
        </div>

    </div>
    <!-- kelar div Grid / Step-Billing -->


    <div class="ui grid" id="step-confirm">

        <div class="sixteen wide column">
            <div class="ui three ordered steps">
                <div class="completed step">
                    <div class="content">
                        <div class="title">Shipping</div>
                        <div class="description">Isi form order untuk pengiriman</div>
                    </div>
                </div>
                <div class="completed step">
                    <div class="content">
                        <div class="title">Billing</div>
                        <div class="description">Pilih metode pembayaran</div>
                    </div>
                </div>
                <div class="active step">
                    <div class="content">
                        <div class="title">Confirm Order</div>
                        <div class="description">Review semua sebelum place order</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header" id="form-header">
            <h3>Review order</h3>
            Ini adalah kesempatan terakhir kamu dalam hidup. Silakan review sebelum place order. Yuk!
        </div>

        <div class="sixteen wide column" id="cart-table">
            <table class="ui padded table">

                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="cart-item">
                        <td>
                            <div class="item">
                                <div class="ui tiny image">
                                    <img src="http://localhost/codewell/zigzag/assets/upload/slider/pic-slider-mg==/pic-slider-mg.jpg" alt="">
                                </div>
                                <div class="left aligned content">
                                    Basic Knitted Pulljump Pouch Bag
                                    <br>
                                    <strong>Kode: NY08909</strong>
                                </div>
                            </div>
                        </td>
                        <td>
                            Rp 450.000,00
                        </td>
                        <td>2</td>
                        <td>
                            Rp 900.000,00
                        </td>
                    </tr>
                    <tr class="cart-item">
                        <td>
                            <div class="item">
                                <div class="ui tiny image">
                                    <img src="http://localhost/codewell/zigzag/assets/upload/slider/pic-slider-mg==/pic-slider-mg.jpg" alt="">
                                </div>
                                <div class="left aligned content">
                                    Hand-bag Washed Jeans Parachutes
                                    <br>
                                    <strong>Kode: PX23498</strong>
                                </div>
                            </div>
                        </td>
                        <td>Rp 275.000,00</td>
                        <td>1</td>
                        <td>Rp 275.000,00</td>
                    </tr>
                </tbody>

                <tfoot class="full-width">
                    <tr>
                        <th colspan="4">
                            <button type="button" class="ui zz checkout right floated button">Bayar sekarang
                                <i class="angle right icon"></i>
                            </button>
                            <a href="checkout.html" class="ui black button">
                                <i class="angle left icon"></i> Nanti dulu
                            </a>
                        </th>
                    </tr>
                </tfoot>

            </table>
        </div>

        <div class="sixteen wide column" id="cart-recap">
            <div class="content">
                <h3 class="header">Detail belanja kamu</h3>

                <table class="ui very basic table">
                    <tbody>
                        <tr>
                            <td>Ekspedisi: </td>
                            <td class="right aligned">JNE</td>
                        </tr>
                        <tr>
                            <td>Alamat: </td>
                            <td class="right aligned">
                                Jalan Kepodang Raya Blok X #33
                                <br> Sukabumi, Kendari, Sulawesi Tenggara 20949
                            </td>
                        </tr>
                        <tr>
                            <td>Pembayaran: </td>
                            <td class="right aligned">Transfer Bank - BCA</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- kelar div Cart Recap Row -->

        <div class="sixteen wide column" id="cart-total">
            <div class="content">
                <h3 class="header">Total belanja kamu</h3>

                <table class="ui very basic table">
                    <tbody>
                        <tr>
                            <td>Subtotal: </td>
                            <td class="right aligned">Rp 1.450.000,00</td>
                        </tr>
                        <tr>
                            <td>Diskon: </td>
                            <td class="right aligned">-</td>
                        </tr>
                        <tr>
                            <td>PPh/PPN: </td>
                            <td class="right aligned">0%</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="relaxed">
                            <th>Total yang harus dibayar: </th>
                            <th class="right aligned">Rp 1.450.000,00</th>
                        </tr>
                    </tfoot>
                </table>

                <a href="#" class="ui animated fade large black fluid checkout button" tabindex="0">
                    <div class="visible content">Bayar sekarang</div>
                    <div class="hidden content">
                        <i class="shopping cart icon"></i>
                    </div>
                </a>

            </div>
        </div>
        <!-- kelar div Cart Total Row -->


    </div>


</div>
<!-- kelar Main -->