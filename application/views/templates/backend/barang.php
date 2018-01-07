<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3 class="heading_a uk-margin-bottom">Sortir produk bedasarkan Nama:</h3>
<?php if (!empty($message)){ ?>
  <div class="uk-alert uk-alert-<?php echo $message['type']; ?>" data-uk-alert>
    <a href="#" class="uk-alert-close uk-close"></a>
    <h4><?php echo $message['title']; ?></h4>
    <?php echo $message['text']; ?>
  </div>
 <?php } ?>

<ul id="products_sort" class="uk-subnav uk-subnav-pill">
  <li data-uk-sort="product-name:asc"><a href="#">Ascending</a></li>
  <li data-uk-sort="product-name:desc"><a href="#">Descending</a></li>
  <li><a href="<?php echo base_url();?>zigzagadmin/barang/add_barang" class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light">Tambah barang/produk</a></li>
</ul>

<div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 hierarchical_show" data-uk-grid="{gutter: 20, controls: '#products_sort'}">
<?php
if(!empty($listbarang)){
  foreach ($listbarang as $barang) {
?>
  <div data-product-name="<?php echo $barang->nameBARANG;?>">
    <div class="md-card md-card-hover-img">
      <div class="md-card-head uk-text-center uk-position-relative">
        <div class="uk-badge uk-badge-danger uk-position-absolute uk-position-top-left uk-margin-left uk-margin-top">Rp. <?php echo number_format($barang->priceBARANG, 0,',','.'); ?></div>
        <img class="md-card-head-img" src="<?php echo $barang->imageBARANG;?>" alt="<?php echo $barang->nameBARANG;?>"/>
      </div>
      <div class="md-card-content">
        <h4 class="heading_c uk-margin-bottom">
          <?php echo $barang->nameBARANG;?>
          <span class="sub-heading">KODE: <?php echo $barang->codeBARANG;?></span>
          <span class="sub-heading"><b>STOK: <?php echo $barang->stockBARANG;?> Barang</b></span>
        </h4>
        <p><?php echo word_limiter($barang->descBARANG,12); ?></p>
        <a class="md-btn md-btn-small md-btn-primary" href="<?php echo base_url();?>zigzagadmin/barang/detail_barang/<?php echo encode(urlencode($barang->idBARANG));?>">Detail</a>
        <a class="md-btn md-btn-small md-btn-danger" href="<?php echo base_url();?>zigzagadmin/barang/add_barang/<?php echo encode(urlencode($barang->idBARANG));?>">Edit</a>
      </div>
    </div>
  </div>
  <?php } ?>
<?php } ?>
</div>
