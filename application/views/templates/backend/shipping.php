<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$title1 = 'Buat Data Shipping Baru';
$actions = 'saveshipping';
$controller = 'shipping';
if($getshipping->idSHIPPING != NULL){
 $title1 = 'Perbaharui Data Shipping';
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
        <li class="uk-width-1-2 <?php echo $tab['data-tab']?>>"><a href="#">Daftar Shipping</a></li>
        <li class="uk-width-1-2 <?php echo $tab['form-tab']?>"><a href="#">Form Shipping</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Thumbnail</th>
                <th>Shipping</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Thumbnail</th>
                <th>Shipping</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php 
              if(!empty($listshipping)){
                foreach ($listshipping  as $key => $ship) { 
                  $id = encode($ship->idSHIPPING);
                  ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><img class="img_thumb" src="<?php echo $ship->imageSHIPPING;?>" alt="<?php echo $ship->nameSHIPPING;?>"/></td>
                    <td><?php echo $ship->nameSHIPPING; ?></td>
                    <td><?php echo $ship->status; ?></td>
                    <td><?php echo date('d F Y', strtotime($ship->createdateSHIPPING));?></td>
                    <?php
                    $msg2 = 'Are you sure want to change this data ?';
                    $url2 = 'zigzagadmin/'.$controller.'/index_shipping/'.urlencode($id);
                    ?>
                    <td class="uk-text-center">
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
              <form method="post" name="formshipping" action="<?php echo $url;?>" id="form_validation" class="uk-form-stacked" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <?php echo form_hidden('idSHIPPING',encode($getshipping->idSHIPPING),'hidden'); ?>
                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-1">
                    <div class="md-card">
                      <div class="md-card-content">
                        <?php
                          if(!empty($getshipping->imageSHIPPING)){
                        ?>
                        <div class="uk-margin-bottom uk-text-center uk-position-relative">
                            <a href="#" class="uk-modal-close uk-close uk-close-alt uk-position-absolute" onclick="UIkit.modal.confirm('Apakah anda yakin akan menghapus gambar ini?', function(){ document.location.href='<?php echo base_url().$this->data['folBACKEND'].$controller."/deleteimgshipping/".encode($getshipping->idSHIPPING); ?>'; });"></a>
                            <img src="<?php echo $getshipping->imageSHIPPING;?>" alt="<?php echo $getshipping->nameSHIPPING;?>" class="img_medium"/>
                        </div>
                        <?php } else { ?>
                          <?php echo form_upload('imgSHIPPING','','class="md-input" required accept="image/png, image/jpg, image/jpeg"'); ?>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-2 uk-margin-top">
                    <div class="parsley-row">
                      <label>Nama Shipping<span class="req">*</span></label>
                      <input type="text" class="md-input" name="nameSHIPPING" autocomplete value="<?php echo cetak($getshipping->nameSHIPPING) ?>" required/>
                    </div>
                    <p class="text-red"><?php echo form_error('nameSHIPPING'); ?></p>
                  </div>
                  <div class="uk-width-medium-1-2 uk-margin-top">
                    <div class="parsley-row">
                      <?php
                        $checkdis= '';
                        if($getshipping->statusSHIPPING == 1) $checkdis = 'checked' ;
                      ?>
                      <input type="checkbox" data-switchery <?php echo $checkdis; ?> data-switchery-size="large" data-switchery-color="#d32f2f" name="statusSHIPPING" id="switch_demo_large">
                      <label for="switch_demo_large" class="inline-label"><b>Aktifkan Shipping</b></label>
                    </div>
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
   </ul>
 </div>
</div>
</div>