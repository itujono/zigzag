<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<html class="no-js" lang="">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?php echo $title;?></title>
<meta name="description" content="Laman Resmi Nyat Kadir, Anggota DPR RI dari Fraksi Partai Nasdem">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="manifest" href="site.webmanifest">
<link rel="apple-touch-icon" href="icon.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

<?php echo $addons; ?>

</head>
<body>
<div class="preloader"></div>
<nav class="navbar">
    <div class="container">
        <div class="navbar-brand">
            <a href="<?php echo base_url();?>" class="navbar-item main-logo">
                <img src="<?php echo base_url().$this->data['asfront'];?>img/logo.png" alt="Logo Utama Nyat Kadir" width="">
            </a>
            <button class="button navbar-burger" data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="navbar-menu" id="navMenu">
            <div class="navbar-start">
             <?php
              $menus = array (array('','Home'), array('about','Tentang'), array('article','Artikel'), array('news','News/Events'), array('gallery','Galeri'), array('press','Liputan Media'));
              foreach ($menus as $values) {
                if(!empty($this->uri->segment(3))) {
                  $url = $this->uri->segment(2);
                } else {
                  $url = $this->uri->segment(1);
                }
                $class = '';
                if($url == $values[0])$class = 'active';
                if($values[1] != 'Artikel'){
            ?>
                <a href="<?php echo base_url().$values[0];?>" class="navbar-item <?php echo $class;?>"><?php echo $values[1];?></a>
                <?php } else { ?>
                <div href="#" class="navbar-item has-dropdown is-hoverable">
                    <a href="<?php echo base_url().$values[0];?>" class="navbar-link">Artikel</a>
                    <div class="navbar-dropdown">
                        <?php 
                            $menu_category = selectall_category_for_navigation_frontend();
                            if(!empty($menu_category)){
                                foreach ($menu_category as $menu_cat) {
                        ?>
                        <a href="<?php echo base_url();?>article/category/<?php echo base64_encode($menu_cat->idCAT).'-'.seo_url($menu_cat->nameCAT);?>" class="navbar-item"><?php echo $menu_cat->nameCAT;?></a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            </div>
            <div class="navbar-end">
                <div href="#" class="navbar-item has-dropdown is-hoverable">
                <?php
                    if(!empty($this->session->userdata('Name'))){
                ?>
                    <a href="#" class="navbar-link">
                        <span class="icon"><i class="mdi mdi-account-circle"></i></span> &nbsp; <?php echo $this->session->userdata('Name');?>
                    </a>
                    <div class="navbar-dropdown">
                        <a href="<?php echo base_url();?>account/<?php echo $this->session->userdata('idUSER'); ?>/<?php echo seo_url($this->session->userdata('Name')); ?>" class="navbar-item">Atur Akun</a>
                        <a href="<?php echo base_url();?>user/logout" class="navbar-item">Keluar</a>
                    </div>
                <?php } else { ?>
                    <a href="#" class="navbar-link">
                        <span class="icon"><i class="mdi mdi-account-circle"></i></span> &nbsp; Daftar
                    </a>
                    <div class="navbar-dropdown">
                        <a href="<?php echo base_url();?>user" class="navbar-item">Login</a>
                        <a href="<?php echo base_url();?>user/index_registration" class="navbar-item">Daftar</a>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div> <!-- kelar Navbar-Menu -->
    </div>
</nav>
