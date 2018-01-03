<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$title1 = 'Buat Data Menu Baru';
$actions = 'savemenu';
$controller = 'menu_admin';
if($getmenu->idMENU != NULL){
 $title1 = 'Perbaharui Data Menu';
}
$url = base_url().'administrator/'.$controller.'/'.$actions;
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
        <li class="uk-width-1-2 <?php echo $tab['data-tab']?>>"><a href="#">List Menu</a></li>
        <li class="uk-width-1-2 <?php echo $tab['form-tab']?>"><a href="#">Form Menu</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="number-order">No.</th>
                <th>Nama Menu</th>
                <th>Ikon Menu</th>
                <th>Fungsi</th>
                <th>Parent Menu</th>
                <th>Created</th>
                <th class="action-order">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="number-order">No.</th>
                <th>Nama Menu</th>
                <th>Ikon Menu</th>
                <th>Fungsi</th>
                <th>Parent Menu</th>
                <th>Created</th>
                <th class="action-order">Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
              if(!empty($listmenu)){
                foreach ($listmenu  as $key => $menu) {
                  $id = encode($menu->idMENU);
                  $parent_menu = selectall_menu_name_row($menu->parentMENU);
                  if($menu->parentMENU == 0){
                    $parents = "Parent";
                  } else {
                    $parents = $parent_menu->namaMENU;
                  }
                  ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $menu->namaMENU; ?></td>
                    <td><i class="material-icons"><?php echo $menu->iconMENU; ?></i></td>
                    <td><?php echo $menu->functionMENU; ?></td>
                    <td><?php echo $parents; ?></td>
                    <td><?php echo date('d F Y', strtotime($menu->createdateMENU));?></td>
                    <?php
                    $icndel = '&#xE16C;';
                    $msg1 = 'Are you sure want to delete this data ?';
                    $msg2 = 'Are you sure want to change this data ?';
                    $url1 = 'administrator/'.$controller.'/delete_menu_admin/'.urlencode($id);
                    $url2 = 'administrator/'.$controller.'/index_menu/'.urlencode($id);
                    ?>
                    <td class="">
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
              <form method="post" name="formrental" action="<?php echo $url;?>" id="form_validation">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <?php echo form_hidden('idMENU',encode($getmenu->idMENU),'hidden'); ?>
                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-5 uk-margin-top">
                    <label>Nama Menu</label>
                    <br>
                    <input type="text" class="md-input label-fixed" name="namaMENU" autocomplete value="<?php echo $getmenu->namaMENU;?>" required/>
                    <p class="text-red"><?php echo form_error('namaMENU'); ?></p>
                  </div>
                  <div class="uk-width-medium-1-5 uk-margin-top">
                    <label>Ikon Menu</label>
                    <br>
                    <input type="text" class="md-input label-fixed" name="iconMENU" autocomplete value="<?php echo $getmenu->iconMENU;?>" required/>
                    <p class="text-red"><?php echo form_error('iconMENU'); ?></p>
                  </div>
                  <div class="uk-width-medium-1-5 uk-margin-top">
                    <label>Fungsi Menu</label>
                    <br>
                    <input type="text" class="md-input label-fixed" name="functionMENU" autocomplete value="<?php echo $getmenu->functionMENU;?>" required/>
                    <p class="text-red"><?php echo form_error('functionMENU'); ?></p>
                  </div>
                  <div class="uk-width-medium-1-5 uk-margin-top">
                    <div class="parsley-row">
                      <label>Parent Menu</label>
                      <br>
                      <?php echo form_dropdown('parentMENU', $dropdown_menu, $getmenu->parentMENU,'required id="select_demo_5" data-md-selectize data-md-selectize-bottom'); ?>
                    </div>
                    <p class="text-red"><?php echo form_error('parentMENU'); ?></p>
                  </div>
                  <div class="uk-width-medium-1-5 uk-margin-top">
                    <div class="parsley-row">
                      <?php
                        $checkdis= '';
                        if($getmenu->statusMENU == 1) $checkdis = 'checked' ;
                      ?>
                      <input type="checkbox" data-switchery <?php echo $checkdis; ?> data-switchery-size="large" data-switchery-color="#d32f2f" name="statusMENU" id="switch_demo_large">
                      <label for="switch_demo_large" class="inline-label"><b>Aktifkan Menu</b></label>
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
     <!-- END FORM INPUT AREA -->
   </ul>
 </div>
</div>
</div>
