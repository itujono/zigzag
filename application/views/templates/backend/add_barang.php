<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  $title1 = 'Buat Data Barang Baru';
  $actions = 'savebarang';
  $controller = 'barang';
  if($getbarang->idBARANG != NULL){
     $title1 = 'Perbaharui Data Barang';
  }
  $url = base_url().'zigzagadmin/'.$controller.'/'.$actions;
?>
<div class="uk-width-medium-1-1">
  <h4 class="heading_a uk-margin-bottom"><?php echo $title1;?></h4>

  <?php if (!empty($message)){ ?>
      <div class="uk-alert uk-alert-<?php echo $message['type']; ?>" data-uk-alert>
        <a href="#" class="uk-alert-close uk-close"></a>
        <h4><?php echo $message['title']; ?></h4>
        <?php echo $message['text']; ?>
      </div>
  <?php } ?>

  <div class="md-card">
    <div class="md-card-content">
      <ul class="uk-tab uk-tab-grid" data-uk-tab="{connect:'#tabs_4'}">
        <li class="uk-width-1-1 uk-active"><a href="#">Form Barang (Produk)</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <!-- START FORM INPUT AREA -->
        <li>
          <h3 class="heading_a uk-margin-bottom">Buat data baru atau Perbaharui data</h3>
          <form method="post" name="formbarang" action="<?php echo $url;?>" enctype="multipart/form-data" id="form_validation">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <?php echo form_hidden('idBARANG',encode($getbarang->idBARANG),'hidden'); ?>
            <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-1">Barang/Produk Upload
                <?php echo form_upload('imgBARANG[]','','class="md-input" multiple accept="image/png, image/jpg, image/jpeg"');?>
                <ul class="img-edit clearfix">
                  <?php 
                  if(!empty($getbarang->map)){
                  foreach ($getbarang->map as $key=> $value_img) { ?>
                    <li class="uk-position-relative">
                        <a href="#" class="uk-modal-close uk-close uk-close-alt uk-position-absolute" onclick="UIkit.modal.confirm('Are you sure want to delete this picture?', function(){ document.location.href='<?php echo base_url().'zigzagadmin/'.$controller."/deleteimgbarang/".encode($getbarang->idBARANG).'/'.$getbarang->imgs[$key]; ?>'; });"></a>
                          <img src="<?php echo $value_img; ?>" class="img_medium"/>
                    </li>
                    <br>
                  <?php } ?>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-3 uk-margin-top">
                  <label>Nama Barang</label>
                  <br>
                  <input type="text" class="md-input label-fixed" name="nameBARANG" autocomplete value="<?php echo $getbarang->nameBARANG;?>"/>
                  <p class="text-red"><?php echo form_error('nameBARANG'); ?></p>
              </div>
              <div class="uk-width-medium-1-3 uk-margin-top">
                <label>Kategori Barang</label>
                <br>
                  <?php echo form_dropdown('idCATEGORY', $getcategory, $getbarang->idCATEGORY,'required id="select_demo_5" data-md-selectize data-md-selectize-bottom'); ?>
                  <p class="text-red"><?php echo form_error('idCATEGORY'); ?></p>
              </div>
              <div class="uk-width-medium-1-3 uk-margin-top">
                <label>Harga (tanpa Koma)</label>
                <br>
                  <input class="md-input label-fixed" type="number" name="priceBARANG" value="<?php echo $getbarang->priceBARANG;?>" required>
                <p class="text-red"><?php echo form_error('priceBARANG'); ?></p>
              </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-3 uk-margin-top">
                  <label>Material Barang</label>
                  <br>
                  <input type="text" class="md-input label-fixed" name="materialBARANG" autocomplete value="<?php echo $getbarang->materialBARANG;?>"/>
                  <p class="text-red"><?php echo form_error('materialBARANG'); ?></p>
              </div>
              <div class="uk-width-medium-1-3 uk-margin-top">
                  <label>Dimensi Barang</label>
                  <br>
                  <input type="text" class="md-input label-fixed" name="dimensionBARANG" autocomplete value="<?php echo $getbarang->dimensionBARANG;?>"/>
                  <p class="text-red"><?php echo form_error('dimensionBARANG'); ?></p>
              </div>
              <div class="uk-width-medium-1-3 uk-margin-top">
                  <label>Berat Barang (KG)</label>
                  <br>
                  <input type="number" class="md-input label-fixed" name="weightBARANG" autocomplete value="<?php echo $getbarang->weightBARANG;?>"/>
                  <p class="text-red"><?php echo form_error('weightBARANG'); ?></p>
              </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-3 uk-margin-top">
                  <label>Stok Barang</label>
                  <br>
                  <input type="number" class="md-input label-fixed" name="stockBARANG" autocomplete value="<?php echo $getbarang->stockBARANG;?>"/>
                  <p class="text-red"><?php echo form_error('stockBARANG'); ?></p>
              </div>
              <div class="uk-width-medium-1-3 uk-margin-top">
                  <label>Kode Barang</label>
                  <br>
                  <input type="text" class="md-input label-fixed" name="codeBARANG" autocomplete value="<?php echo $getbarang->codeBARANG;?>"/>
                  <p class="text-red"><?php echo form_error('codeBARANG'); ?></p>
              </div>
              <div class="uk-width-medium-1-3 uk-margin-top">
                  <label>Warna Barang</label>
                  <br>
                  <input type="text" class="md-input label-fixed" name="colorBARANG" autocomplete value="<?php echo $getbarang->colorBARANG;?>"/>
                  <p class="text-red"><?php echo form_error('colorBARANG'); ?></p>
              </div>
            </div>
            <div class="uk-grid" data-uk-grid-margin>
              <div class="uk-width-medium-1-1 uk-margin-top">
                <label>Deskripsi Barang</label>
                <br>
                <textarea id="wysiwyg_tinymces" cols="30" rows="4" name="descBARANG" class="md-input label-fixed"><?php echo $getbarang->descBARANG;?></textarea>
                <p class="text-red"><?php echo form_error('descBARANG'); ?></p>
              </div>
            </div>
              <div class="uk-width-medium-1-1 uk-margin-top">
               <div class="uk-form-row">
                 <span class="uk-input-group-addon"><?php echo form_submit('submit', 'SAVE', 'class="md-btn md-btn-primary" id="show_preloader_md"'); ?></span>
               </div>
              </div>
                </div>
              </div>
            </div>
          </form>
        </li>
        <!-- END FORM INPUT AREA -->
      </ul>
    </div>
  </div>
</div>
