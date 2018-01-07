<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title;?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">

    <?php echo $addons; ?>
    
</head>
<body>

    <div class="app" id="app">
        <header>
            <div class="ui pointing menu main">
                <a href="<?php echo base_url();?>" class="active item">Home</a>
                <?php
                $category_parent = selectall_category_for_frontend(1);
                $category_child = selectall_category_for_frontend(NULL,1);
                if(!empty($category_parent)){
                    foreach ($category_parent as $parent) {
                ?>
                <div class="ui pointing dropdown link category item">
                    <span class="text"><?php echo $parent->nameCATEGORY;?></span>
                    <i class="dropdown icon"></i>
                    <div class="menu category-content">
                        <?php
                        foreach ($category_child as $child) {
                            if($parent->idCATEGORY == $child->parentCATEGORY){
                        ?>
                        <a href="#" class="item"><?php echo $child->nameCATEGORY;?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>  
                </div>
                    <?php } ?>
                <?php } ?>
                <!-- /////// -->
                <div class="right menu">
                    <div class="item">
                        <div class="ui transparent icon input">
                            <input type="text" placeholder="Search...">
                            <i class="search link icon"></i>
                        </div>
                    </div>
                    <a class="ui top dropdown button cart item">
                        <i class="shopping basket icon"></i>
                    </a>
                    <div class="ui popup cart-content">
                        <div class="cart-header">
                            <h4>Cart kamu</h4>
                        </div>
                        <div class="ui divided items">
                            <div class="item">
                                <a href="#" class="ui mini image">
                                    <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/503/015/5820503015_2_1_2.jpg" alt="">
                                </a>
                                <div class="content">
                                    <h4 class="header">Bag with slingshot</h4>
                                    <div class="description">
                                        <p>1 x Rp 250.000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <a href="#" class="ui mini image">
                                    <img src="https://static.pullandbear.net/2/photos/2018/V/0/2/p/5820/501/700/5820501700_2_1_2.jpg" alt="">
                                </a>
                                <div class="content">
                                    <h4 class="header">Bag pouch for travelling</h4>
                                    <div class="description">
                                        <p>1 x Rp 250.000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="centered cart-total">
                            <h4>Total: Rp 550.000,00</h4>
                        </div>
                        <a href="cart.html" class="ui animated bottom attached fade black button" tabindex="0">
                            <div class="visible content"><i class="send icon"></i></div>
                            <div class="hidden content">Checkout sekarang</div>
                        </a>
                    </div>
                        <!-- <div class="ui popup cart-content empty">
                            <div class="content">
                                <h4>Kamu belum menambahkan item apapun di Cart</h4>
                                <a href="#">Belanja dulu deh</a>
                            </div>
                        </div> --> <!-- TODO: Kalo Cart nya empty wak -->
                        <div class="ui top left pointing dropdown button item">
                            <img src="<?php echo base_url().$this->data['asfront'];?>img/user.jpg" class="ui avatar image">
                            <span>Rusmanto </span>
                            <i class="dropdown icon"></i>
                            <div class="ui menu">
                                <a class="item">
                                    <i class="wrench icon"></i>
                                    Atur akun
                                </a>
                                <a class="item">
                                    <i class="rocket icon"></i>
                                    Profil
                                </a>
                                <a class="divider"></a>
                                <a class="item" href="#">Logout</a>
                                <a class="item login-trigger" href="#">Login</a>

                                <div class="ui tiny modal login">
                                    <div class="header">Hi! Welcome back!</div>
                                    <form class="ui form" action="index.html" method="">
                                        <div class="field">
                                            <label for="emailLogin">Email kamu</label>
                                            <input type="email" name="emailLogin" placeholder="Ketik email kamu...">
                                        </div>
                                        <div class="field">
                                            <label for="passwordLogin">Password kamu</label>
                                            <input type="password" name="passwordLogin" placeholder="Dan password kamu...">
                                        </div>
                                        <button type="submit" name="button" class="ui fluid login button">Login</button>
                                    </form>
                                    <div class="forgot">
                                        Lupa password? <a href="forgot.html" class="item">Klik di sini</a>
                                    </div>
                                    <div class="ui horizontal divider">
                                        Males isi form?
                                    </div>
                                    <div class="login-buttons">
                                        <button class="ui facebook button">
                                            <i class="facebook icon"></i>
                                            Login via Facebook
                                        </button>
                                    </div>
                                    <div class="signup-link">
                                        Belum punya akun? <a href="#">Buat dulu di sini</a>
                                    </div>
                                </div> <!-- kelar Modal Login -->

                                <div class="ui tiny modal register">
                                    <div class="header">Hi! Silakan Mendaftar</div>
                                    <form class="ui form" action="index.html" method="">
                                        <div class="field">
                                            <label for="nama">Nama lengkap kamu</label>
                                            <input type="text" name="nama" placeholder="John Doe">
                                        </div>
                                        <div class="field">
                                            <label for="email">Email kamu</label>
                                            <input type="email" name="email" placeholder="emailku@email.com">
                                        </div>
                                        <div class="field">
                                            <label for="password">Password kamu</label>
                                            <input type="password" name="password" placeholder="Minimal 8 karakter">
                                        </div>
                                        <div class="field">
                                            <label for="passwordRepeat">Ulangi password kamu</label>
                                            <input type="password" name="passwordRepeat" placeholder="Minimal 8 karakter">
                                        </div>
                                        <div class="two fields">
                                            <div class="field">
                                                <label for="provinsi">Provinsi</label>
                                                <select class="ui search dropdown" id="provinsi" name="provinsi">
                                                    <option value="" selected>Pilih provinsi kamu</option>
                                                    <option value="aceh">Aceh</option>
                                                    <option value="bali">Bali</option>
                                                    <option value="babel">Bangka Belitung</option>
                                                    <option value="banten">Banten</option>
                                                    <option value="kepri">Kepulauan Riau</option>
                                                </select>
                                            </div>
                                            <div class="field">
                                                <label for="provinsi">Kota/Kab</label>
                                                <select class="ui search dropdown" id="kota" name="kota">
                                                    <option value="" selected>Pilih kota kamu</option>
                                                    <option value="batam" data-chained="kepri">Batam</option>
                                                    <option value="pinang" data-chained="kepri">Tanjung Pinang</option>
                                                    <option value="bintan" data-chained="kepri">Bintan</option>
                                                    <option value="kundur" data-chained="kepri">Kundur</option>
                                                    <option value="karimun" data-chained="kepri">Karimun</option>
                                                    <option value="denpasar" data-chained="bali">Denpasar</option>
                                                    <option value="bangli" data-chained="bali">Bangli</option>
                                                    <option value="badung" data-chained="bali">Badung</option>
                                                    <option value="buleleng" data-chained="bali">Buleleng</option>
                                                    <option value="serang" data-chained="banten">Serang</option>
                                                    <option value="tangerang" data-chained="banten">Tangerang</option>
                                                    <option value="cilegon" data-chained="banten">Cilegon</option>
                                                    <option value="bangka" data-chained="babel">Bangka</option>
                                                    <option value="belitung" data-chained="babel">Belitung</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label for="kodepos">Kode Pos</label>
                                            <input type="number" name="kodepos" placeholder="Misal: 29433">
                                        </div>
                                        <div class="field">
                                            <label for="alamat">Alamat kamu</label>
                                            <textarea name="alamat" rows="6" placeholder="Jalan Kesturi Blok B No. 14, Sei Panas"></textarea>
                                        </div>
                                        <div class="field">
                                            <div class="ui checkbox">
                                                <input type="checkbox" tabindex="0" class="hidden" name="sk">
                                                <label>Saya telah menyetujui isi <a href="#">Syarat dan Ketentuan</a> Zigzag Online Shop</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="ui fluid login button">Register</button>
                                    </form>

                                    <div class="ui horizontal divider">
                                        Males isi form?
                                    </div>
                                    <div class="login-buttons">
                                        <button class="ui facebook button">
                                            <i class="facebook icon"></i>
                                            Login via Facebook
                                        </button>
                                    </div>
                                    <div class="login-link">
                                        Sudah punya akun? <a href="#">Silakan login di sini</a>
                                    </div>
                                </div> <!-- kelar Modal Register -->

                            </div> <!-- kelar UI Menu -->
                        </div> <!-- kelar Dropdown Item -->
                    </div>
                </div> <!-- kelar Pointing Menu -->
            </header>
