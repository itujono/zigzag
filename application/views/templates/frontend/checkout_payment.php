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
                <?php
                    $cart_data = $this->cart->contents();
                    if(!empty($cart_data)){
                        foreach ($cart_data as $key => $cart_val) {
                            $map = directory_map('assets/upload/barang/pic-barang-'.folenc($cart_val['id']), FALSE, TRUE);
                            $imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($cart_val['id']).'/'.$map[0];
                ?>
                    <tr class="cart-item">
                        <td>
                            <div class="item">
                                <div class="ui tiny image">
                                    <img src="<?php echo $imageBARANG;?>" alt="<?php echo $cart_val['name'];?>">
                                </div>
                                <div class="left aligned content">
                                    <?php echo $cart_val['name'];?>
                                </div>
                            </div>
                        </td>
                        <td>
                           Rp. <?php echo number_format($cart_val['price']);?>
                        </td>
                        <td><?php echo $cart_val['qty'];?></td>
                        <td>
                           Rp. <?php echo number_format($cart_val['qty']*$cart_val['price']) ?>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>

                <tfoot class="full-width">
                    <tr>
                        <th colspan="4">
                            <a href="<?php echo base_url();?>product/process_checkout_payment" class="ui zz checkout right floated button">Bayar sekarang
                                <i class="angle right icon"></i>
                            </a>
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
                            <td class="right aligned"><?php echo strtoupper($order_payment->ekspedisiORDER);?></td>
                        </tr>
                        <tr>
                            <td>Alamat: </td>
                            <td class="right aligned">
                                <?php echo $order_payment->addressORDER;?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pembayaran: </td>
                            <td class="right aligned">Transfer Bank - <?php echo $order_payment->paymentORDER;?></td>
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
                            <td>Pengiriman (<?php echo $order_payment->ketekspedisiORDER;?>) : </td>
                            <td class="right aligned">Rp. <?php echo number_format($order_payment->totalekspedisiORDER); ?></td>
                        </tr>
                        <tr>
                            <td>Subtotal: </td>
                            <td class="right aligned">Rp. <?php echo number_format($this->cart->total()); ?></td>
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
                        <?php
                            $subtotal = $this->cart->total();
                            $ekspedisi_total = $order_payment->totalekspedisiORDER;
                        ?>
                        <tr class="relaxed">
                            <th>Total yang harus dibayar: </th>
                            <th class="right aligned">Rp. <?php echo number_format($subtotal+$ekspedisi_total); ?></th>
                        </tr>
                    </tfoot>
                </table>

                <a href="<?php echo base_url();?>product/process_checkout_payment" class="ui animated fade large black fluid checkout button" tabindex="0">
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