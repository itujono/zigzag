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

    <div class="<?php echo $class;?>" id="app">
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
                            <form action="<?php echo base_url();?>product/search" method="GET">
                                <input type="text" name="product" placeholder="Search...">
                                <i class="search link icon"></i>
                            </form>
                        </div>
                    </div>
                    <a class="ui top dropdown button cart item">
                        <i class="shopping basket icon"></i>
                    </a>
                    <div class="ui popup cart-content">
                        <div class="cart-header">
                            <h4>Cart kamu</h4>
                        </div>
                        <div class="ui divided items" id="hide_info">
                            <div class="item">
                                <div class="content">
                                    <h4 class="header">Kamu belum menambahkan item apapun di Cart</h4>
                                </div>
                            </div>
                        </div>
                        <div class="ui divided items" id="detail_cart"></div>
                    </div>
                        <div class="ui top left pointing dropdown button item">
                        <?php
                            if(!empty($this->session->userdata('idCUSTOMER'))){
                        ?>
                            <img src="<?php echo base_url().$this->data['asfront'];?>img/user.jpg" class="ui avatar image">
                            <span><?php echo $this->session->userdata('Name');?> </span>
                            <i class="dropdown icon"></i>
                        <?php } else { ?>
                            <img src="<?php echo base_url().$this->data['asfront'];?>img/user.jpg" class="ui avatar image">
                            <span>Guest </span>
                        <?php } ?>
                            <div class="ui menu">
                            <?php 
                            if(!empty($this->session->userdata('idCUSTOMER'))){
                            ?>
                                <a class="item" href="<?php echo base_url();?>customer/account/<?php echo seo_url($this->session->userdata('Name'));?>">
                                    <i class="rocket icon"></i>
                                    Profil
                                </a>
                                <a class="divider"></a>
                                <a class="item" href="<?php echo base_url();?>customer/logout" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="<?php echo base_url();?>customer/logout" method="POST" style="display: none;">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                                </form>
                            <?php } else { ?>
                            <a class="item login-trigger" href="#">Login</a>
                            <?php } ?>
                                <div class="ui tiny modal login">
                                    <div class="header">Hi! Welcome back!</div>
                                    <form class="ui form" action="<?php echo base_url();?>customer/process" method="POST">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
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
                                    <form class="ui form" action="<?php echo base_url();?>customer/register" method="POST">
                                        <div class="ui compact red message print-error-msg" style="display:none">
                                            <h4 class="header">Oops!</h4>

                                        </div>
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                                        <div class="field">
                                            <label for="nama">Nama lengkap kamu</label>
                                            <input type="text" name="nameCUSTOMER" placeholder="John Doe">
                                        </div>
                                        <div class="field">
                                            <label for="email">Email kamu</label>
                                            <input type="email" name="emailCUSTOMER" placeholder="emailku@email.com">
                                        </div>
                                        <div class="field">
                                            <label for="password">Password kamu</label>
                                            <input type="password" name="passwordCUSTOMER" placeholder="Minimal 8 karakter">
                                        </div>
                                        <div class="field">
                                            <label for="passwordRepeat">Ulangi password kamu</label>
                                            <input type="password" name="repasswordCUSTOMER" placeholder="Minimal 8 karakter">
                                        </div>
                                        <div class="two fields">
                                            <div class="field">
                                                <label for="provinsi">Provinsi</label>
                                                <select class="ui search dropdown" id="provinsi" name="idPROVINCE">
                                                    <option value="" selected disabled="disabled">Pilih provinsi kamu</option>
                                                    <?php
                                                    $listprovince = select_all_province();
                                                    if(!empty($listprovince)){
                                                        foreach ($listprovince as $key => $pro) {
                                                            ?>
                                                        <option value="<?php echo $pro->idPROVINCE;?>"><?php echo $pro->namePROVINCE;?>
                                                        </option>
                                                    <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="field">
                                                <label for="provinsi">Kota/Kab</label>
                                                <select class="ui search dropdown" id="city" name="cityCUSTOMER">
                                                    <option value="" selected disabled="disabled">Pilih provinsi kamu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label for="kodepos">Kode Pos</label>
                                            <input type="number" name="zipCUSTOMER" placeholder="Misal: 29433">
                                        </div>
                                        <div class="field">
                                            <label for="kodepos">Nomor Telepon</label>
                                            <input type="number" name="teleCUSTOMER" placeholder="Misal: +6282200000">
                                        </div>
                                        <div class="field">
                                            <label for="alamat">Alamat kamu</label>
                                            <textarea name="addressCUSTOMER" rows="6" placeholder="Jalan Kesturi Blok B No. 14, Sei Panas"></textarea>
                                        </div>
                                        <div class="field">
                                            <div class="ui checkbox">
                                                <input type="checkbox" tabindex="0" class="hidden" name="skCUSTOMER" required="required">
                                                <label>Saya telah menyetujui isi <a href="#">Syarat dan Ketentuan</a> Zigzag Online Shop</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="ui fluid login button check-submit">Register</button>
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