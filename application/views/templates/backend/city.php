<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$title1 = 'Buat Data Kota Baru';
$actions = 'savecity';
$controller = 'location';
if($getcity->idCITY != NULL){
 $title1 = 'Perbaharui Data Kota';
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
        <li class="uk-width-1-2 <?php echo $tab['data-tab']?>>"><a href="#">Daftar Kota</a></li>
        <li class="uk-width-1-2 <?php echo $tab['form-tab']?>"><a href="#">Form Kota</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php 
              if(!empty($listcity)){
                foreach ($listcity  as $key => $city) { 
                  $id = encode($city->idCITY);
                  ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $city->namePROVINCE; ?></td>
                    <td><?php echo $city->nameCITY; ?></td>
                    <td><?php echo date('d F Y', strtotime($city->createdateCITY));?></td>
                    <?php
                    $icndel = '&#xE16C;';
                    $msg1 = 'Are you sure want to delete this data ?';
                    $msg2 = 'Are you sure want to change this data ?';
                    $url1 = 'zigzagadmin/'.$controller.'/actiondelete_province/'.urlencode($id);
                    $url2 = 'zigzagadmin/'.$controller.'/index_province/'.urlencode($id);
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
              <form method="post" name="formprovince" action="<?php echo $url;?>" id="form_validation" class="uk-form-stacked">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <?php echo form_hidden('idCITY',encode($getcity->idCITY),'hidden'); ?>
                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-2 uk-margin-top">
                    <div class="parsley-row">
                      <label>Provinsi</label>
                      <br>
                      <?php echo form_dropdown('idPROVINCE', $dropdown_province, $getcity->idPROVINCE,'required id="select_demo_5" data-md-selectize data-md-selectize-bottom'); ?>
                    </div>
                    <p class="text-red"><?php echo form_error('idPROVINCE'); ?></p>
                  </div>
                  <div class="uk-width-medium-1-2 uk-margin-top">
                    <div class="parsley-row">
                      <label>Nama Kota<span class="req">*</span></label>
                      <input type="text" class="md-input" name="nameCITY" autocomplete value="<?php echo cetak($getcity->nameCITY) ?>" required/>
                    </div>
                    <p class="text-red"><?php echo form_error('nameCITY'); ?></p>
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