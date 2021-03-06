<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<footer>
    <div class="ui stackable five column grid footer">
        <div class="column footer-logo">
            <div>
                <h2>zig</h2>
                <h2>zag</h2>
            </div>
        </div>
        <div class="column">
            <h4 class="header">Malas</h4>
            <div class="ui link list">
                <a href="#" class="item">Makan enak</a>
                <a href="#" class="item">Makan kurang</a>
                <a href="#" class="item">Makan hebat</a>
                <div class="ui divider"></div>
                <a href="#" class="item">Makan keren</a>
                <a href="#" class="item">Makan lagi</a>
            </div>
        </div>
        <div class="column">
            <h4 class="header">Quick Links</h4>
            <div class="ui link list">
                <a href="#" class="item">Tentang Zigzag</a>
                <a href="#" class="item">Bermitra</a>
                <div class="ui divider"></div>
                <a href="#" class="item">Kebijakan Privasi</a>
                <a href="#" class="item">FAQ</a>
                <a href="#" class="item">Ketentuan Penggunaan</a>
            </div>
        </div>
        <div class="column">
            <h4 class="header">How To</h4>
            <div class="ui link list">
                <a href="#" class="item">Cara Order</a>
                <a href="#" class="item">Retur Barang</a>
                <a href="#" class="item">Refund Dana</a>
                <div class="ui divider"></div>
                <a href="#" class="item">Konfirmasi Pembayaran</a>
            </div>
        </div>
        <div class="column">
            <h4 class="header">Payment</h4>
            <div class="ui link list">
                <a href="#" class="item">Cara Order</a>
                <a href="#" class="item">Retur Barang</a>
                <a href="#" class="item">Refund Dana</a>
                <div class="ui divider"></div>
                <a href="#" class="item">Konfirmasi Pembayaran</a>
                <a href="#" class="item">Konfirmasi Transfer</a>
            </div>
        </div>
    </div>
</footer>
</div>
<?php if (!empty($message)){ ?>

<div class="ui compact teal message login-success <?php echo $message['addClass']; ?>">
    <i class="close icon"></i>
    <h4 class="header"><?php echo $message['title']; ?></h4>
    <p><i class="alarm icon"></i> <?php echo $message['text']; ?></p>
</div>

<script>
    const loginSuccess = document.querySelector(".ui.message.login-success")

    if (loginSuccess.classList.contains("visible")) {
        setTimeout(function() {
            loginSuccess.classList.remove("visible")
        }, 3000)
    }
</script>
<?php } ?>

<div class="ui compact teal message not-login">
    <i class="close icon"></i>
    <h4 class="header">Maaf!</h4>
    <p><i class="alarm icon"></i> Kamu belum melakukan login</p>
</div>
<!-- <div class="ui compact teal message logout-success">
    <i class="close icon"></i>
    <h4 class="header">Horeee!</h4>
    <p><i class="alarm icon"></i> Kamu udah logout. Jumpa lagi! </p>
</div> -->
<div class="ui compact teal message added-to-wishlist">
    <i class="close icon"></i>
    <h4 class="header">Great!</h4>
    <p><i class="alarm icon"></i> Item berhasil ditambahkan ke Wishlist</p>
</div>
<div class="ui compact teal message added-to-cart">
    <i class="close icon"></i>
    <h4 class="header">Great!</h4>
    <p><i class="alarm icon"></i> Item berhasil ditambahkan ke Cart</p>
</div>
<div class="ui compact red message removed-from-wishlist">
    <i class="close icon"></i>
    <h4 class="header">Oops!</h4>
    <p><i class="alarm icon"></i> Kamu telah membatalkan item Wishlist kamu</p>
</div>
<div class="ui compact red message error-wishlist">
    <i class="close icon"></i>
    <h4 class="header">Oops!</h4>
    <p><i class="alarm icon"></i> Maaf, kami tidak dapat menambahkan barang kamu ke wishlist!</p>
</div>
<div class="ui compact red message removed-from-cart">
    <i class="close icon"></i>
    <h4 class="header">Oops!</h4>
    <p><i class="alarm icon"></i> Kamu telah membatalkan item di Cart kamu</p>
</div>
<?php echo $plugins; ?>
<script type="text/javascript">
$("#provinsi").change(function (){
    var url = "<?php echo base_url().'customer/load_city/';?>"+$(this).val();
    $('#city').load(url);
    return false;
});
$("#inline_provinsi").change(function (){
    var url = "<?php echo base_url().'customer/load_city/';?>"+$(this).val();
    $('#inline_city').load(url);
    return false;
});
$("#provinsi_checkout").change(function (){
    var url = "<?php echo base_url().'customer/load_city/';?>"+$(this).val();
    $('#city_checkout').load(url);
    return false;
});
</script>
</body>
</html>
