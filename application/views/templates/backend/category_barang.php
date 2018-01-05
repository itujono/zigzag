<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$title1 = 'Buat Data Kategori Barang Baru';
$actions = 'savecategorybarang';
$controller = 'barang';
if($getcategory->idCATEGORY != NULL){
 $title1 = 'Perbaharui Data Kategori Barang';
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
        <li class="uk-width-1-2 <?php echo $tab['data-tab']?>>"><a href="#">Daftar Kategori Barang</a></li>
        <li class="uk-width-1-2 <?php echo $tab['form-tab']?>"><a href="#">Form Kategori Barang</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Parent Kategori</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Parent Kategori</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php 
              if(!empty($listcategorybarang)){
                foreach ($listcategorybarang  as $key => $cat_bar) {
                  $id = encode($cat_bar->idCATEGORY);
                  $category_parent = selectall_category_name_row($cat_bar->parentCATEGORY);
                  if($cat_bar->parentCATEGORY == 0){
                    $parents = "<span class='uk-badge uk-badge-primary'>Parent</span>";
                  } else {
                    $parents = "<span class='uk-badge uk-badge-success'>".$category_parent->nameCATEGORY."</span>";
                  }
                  ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $cat_bar->nameCATEGORY; ?></td>
                    <td><?php echo $parents; ?></td>
                    <td><?php echo date('d F Y', strtotime($cat_bar->createdateCATEGORY));?></td>
                    <?php
                    $icndel = '&#xE16C;';
                    $msg1 = 'Are you sure want to delete this data ?';
                    $msg2 = 'Are you sure want to change this data ?';
                    $url1 = 'zigzagadmin/'.$controller.'/actiondelete_category_barang/'.urlencode($id);
                    $url2 = 'zigzagadmin/'.$controller.'/index_category_barang/'.urlencode($id);
                    ?>
                    <td class="uk-text-center">
                      <a href="#" onclick="UIkit.modal.confirm('<?php echo $msg1; ?>', function(){ document.location.href='<?php echo site_url($url1);?>'; });"><i class="md-icon material-icons"><?php echo $icndel; ?></i></a>
                      <a href="#" onclick="UIkit.modal.confirm('<?php echo $msg2; ?>', function(){ document.location.href='<?php echo site_url($url2);?>'; });"><i class="md-icon material-icons">&#xE254;</i></a>
                    </td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </li>
            <!-- END LIST SLIDER -->

            <!-- START FORM INPUT AREA -->
            <li>
              <h3 class="heading_a uk-margin-bottom">Buat data baru atau Perbaharui data</h3>
              <form method="post" name="formcategorybarang" action="<?php echo $url;?>" id="form_validation" class="uk-form-stacked">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <?php echo form_hidden('idCATEGORY',encode($getcategory->idCATEGORY),'hidden'); ?>
                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-2 uk-margin-top">
                    <br>
                    <div class="parsley-row">
                      <label>Nama Kategori<span class="req">*</span></label>
                      <input type="text" class="md-input" name="nameCATEGORY" autocomplete value="<?php echo cetak($getcategory->nameCATEGORY) ?>" required/>
                    </div>
                    <p class="text-red"><?php echo form_error('nameCATEGORY'); ?></p>
                  </div>
                  <div class="uk-width-medium-1-2 uk-margin-top">
                    <div class="parsley-row">
                      <label>Parent Kategori</label>
                      <br>
                      <?php echo form_dropdown('parentCATEGORY', $dropdown_category_barang, $getcategory->parentCATEGORY,'required id="select_demo_5" data-md-selectize data-md-selectize-bottom'); ?>
                    </div>
                    <p class="text-red"><?php echo form_error('parentCATEGORY'); ?></p>
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