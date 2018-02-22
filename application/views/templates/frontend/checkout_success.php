<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="main">
    <div class="ui grid">
        <div class="sixteen wide column">

            <div class="centered content mb2em">

                <div class="icon icon--order-success svg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px">
                        <g fill="none" stroke="#58dcb9" stroke-width="3">
                            <circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
                            <path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
                        </g>
                    </svg>
                </div>
                <div class="success-text">
                    <h2>Okay! Orderan kamu sudah berhasil dibuat.</h2>
                    Selanjutnya silakan cek email ya untuk langkah pembayaran. Usahakan bayar jangan lewat dari 3 jam ya, nanti kena amuk massa loh. Thanks.
                </div>
                <a href="/" class="ui zz button mb2em">Kembali ke Home</a>
                <div class="done-payment-link">
                    Sudah melakukan pembayaran? <a href="confirmation.html">Klik di sini</a>
                </div>

            </div>

            <div class="sixteen wide column" id="cart-table">

                <div class="ui horizontal segments summary-info">
                    <div class="ui segment">
                        Nomor/Kode order <br> <strong><?php echo $order_success->kodeORDER;?></strong>
                    </div>
                    <div class="ui segment">
                        Pengiriman <br> <strong><?php echo strtoupper($order_success->ekspedisiORDER).' - '.$order_success->ketekspedisiORDER;?></strong>
                    </div>
                    <div class="ui segment">
                        Metode pembayaran <br> <strong><?php echo $order_success->paymentORDER;?></strong>
                    </div>
                </div>

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
                        $ordering_success = history_detail_order_customer($order_success->idORDER);
                            foreach ($ordering_success as $key => $order) {
                            $map[] = directory_map('assets/upload/barang/pic-barang-'.folenc($order->idproductdetailORDER), FALSE, TRUE);
                            if(!empty($map)){
                                foreach ($map  as $key => $value) {
                                    $imageBARANG = base_url() . 'assets/upload/barang/pic-barang-'.folenc($order->idproductdetailORDER).'/'.$value[0];
                                }
                            }
                    ?>
                        <tr class="cart-item">
                            <td>
                                <div class="item">
                                    <div class="ui tiny image">
                                        <img src="<?php echo $imageBARANG;?>" alt="<?php echo $order->nameBARANG;?>">
                                    </div>
                                    <div class="left aligned content">
                                        <?php echo $order->nameBARANG;?> <br>
                                        <strong>Kode: <?php echo $order->codeBARANG;?></strong>
                                    </div>
                                </div>
                            </td>
                            <td>
                                Rp. <?php echo number_format($order->pricedetailORDER);?>
                            </td>
                            <td><?php echo $order->qtydetailORDER;?></td>
                            <td>
                                Rp. <?php echo number_format($order->pricedetailORDER*$order->qtydetailORDER);?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>

            <div class="sixteen wide column" id="cart-recap">
                <div class="content">
                    <h3 class="header">Detail belanja kamu</h3>

                    <table class="ui very basic table">
                        <tbody>
                            <tr>
                                <td>Ekspedisi: </td>
                                <td class="right aligned"><?php echo strtoupper($order_success->ekspedisiORDER);?></td>
                            </tr>
                            <tr>
                                <td>Alamat: </td>
                                <td class="right aligned">
                                    <?php echo $order_success->addressORDER;?> <br>
                                    <?php echo $data_customer_province_city['city_name']; ?>, <?php echo $data_customer_province_city['province']; ?> <?php echo $order_success->zipORDER;?>
                                </td>
                            </tr>
                            <tr>
                                <td>Pembayaran: </td>
                                <td class="right aligned"><?php echo $order_success->paymentORDER;?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div> <!-- kelar div Cart Recap Row -->

            <div class="sixteen wide column" id="cart-total">
                <div class="content">
                    <h3 class="header">Total belanja kamu</h3>

                    <table class="ui very basic table">
                        <tbody>
                            <tr>
                                <td>Biaya Ekspedisi: </td>
                                <td class="right aligned">Rp.<?php echo number_format($order_success->totalekspedisiORDER);?></td>
                            </tr>
                            <tr>
                                <td>Subtotal: </td>
                                <td class="right aligned">Rp. <?php echo number_format($order_success->subtotal);?></td>
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
                                <th class="right aligned">Rp. <?php echo number_format($order_success->subtotal+$order_success->totalekspedisiORDER);?></th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="ui info message centered content">
                        Kamu juga bisa melihat semua orderan kamu di <a href="<?php echo base_url();?>customer/account/<?php echo seo_url($this->session->userdata('Name'));?>">Pesanan Saya</a>
                    </div>

                </div>
            </div> <!-- kelar div Cart Total Row -->

        </div>
    </div>
</div> <!-- kelar Main -->