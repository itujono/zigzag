<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$title1 = 'Buat Data Pengguna Admin';
$actions = 'saveuser';
$controller = 'user';
if($getuser->idADMIN != NULL){
 $title1 = 'Perbaharui Data Pengguna Admin';
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
        <li class="uk-width-1-2 <?php echo $tab['data-tab']?>>"><a href="#">List Admin</a></li>
        <li class="uk-width-1-2 <?php echo $tab['form-tab']?>"><a href="#">Form Admin</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Action</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Terakhir Login</th>
                <th>Menu</th>
                <th>Created</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Action</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Terakhir Login</th>
                <th>Menu</th>
                <th>Created</th>
              </tr>
            </tfoot>
            <tbody>
              <?php
              if(!empty($listuseradmin)){
                foreach ($listuseradmin  as $key => $admin) {
                  $id = encode($admin->idADMIN);
                  $multiple_menu = select_all_multiple_menu_for_row($admin->idADMIN);
                  if($admin->lastloginADMIN == '0000-00-00 00:00:00'){
                      $lastlog = 'Belum ada';
                  } else {
                      $lastlog = '<b style="color:red;"><i>'.timeAgo(dF('H:i:s',strtotime($admin->lastloginADMIN))).'</i></b>';
                  }
              ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <?php
                    $icndel = '&#xE16C;';
                    $msg1 = 'Are you sure want to delete this data ?';
                    $msg2 = 'Are you sure want to change this data ?';
                    $url1 = 'zigzagadmin/'.$controller.'/actiondelete_user/'.urlencode($id);
                    $url2 = 'zigzagadmin/'.$controller.'/index_user_admin/'.urlencode($id);
                    ?>
                    <td class="uk-text-center">
                      <a href="#" onclick="UIkit.modal.confirm('<?php echo $msg1; ?>', function(){ document.location.href='<?php echo site_url($url1);?>'; });"><i class="md-icon material-icons"><?php echo $icndel; ?></i></a>
                      <a href="#" onclick="UIkit.modal.confirm('<?php echo $msg2; ?>', function(){ document.location.href='<?php echo site_url($url2);?>'; });"><i class="md-icon material-icons">&#xE254;</i></a>
                    </td>
                    <td><?php echo $admin->nameADMIN; ?></td>
                    <td><?php echo $admin->emailADMIN; ?></td>
                    <td><?php echo $lastlog; ?></td>
                    <td>
                      <?php foreach ($multiple_menu as $val) { ?>
                      (<?php echo $val->namaMENU;?>) - <a href="#" onclick="UIkit.modal.confirm('Are you sure want to delete this data?', function(){ document.location.href='<?php echo base_url().'zigzagadmin/'.$controller."/delete_join_menu_user_admin/".urlencode(encode($val->idMENUSJOINADMIN)); ?>'; });">
                        <span><i class="fa fa-times">X</i></span>
                      </a>
                      <br>
                      <?php } ?>
                    </td>
                    <td><?php echo date('d F Y', strtotime($admin->createdateADMIN));?></td>
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
                <?php echo form_hidden('idADMIN',encode($getuser->idADMIN),'hidden'); ?>
                <?php echo form_hidden('oldEMAIL',$getuser->emailADMIN,'hidden'); ?>
                <div class="uk-grid" data-uk-grid-margin>
                  <?php if(!empty($getuser->emailADMIN)){ 
                    $width_form = "uk-width-medium-1-1";
                  } else {
                    $width_form = "uk-width-medium-1-2";
                  }
                  ?>
                  <div class="<?php echo $width_form; ?> uk-margin-top">
                    <label>Email Admin</label>
                    <br>
                    <input type="email" class="md-input label-fixed" name="emailADMIN" autocomplete value="<?php echo $getuser->emailADMIN;?>"/>
                    <p class="text-red"><?php echo form_error('emailADMIN'); ?></p>
                  </div>
                  <?php if(empty($getuser->emailADMIN)){ ?>
                  <div class="uk-width-medium-1-2 uk-margin-top">
                    <label>Password</label>
                    <br>
                    <input type="password" class="md-input" name="passwordADMIN" required="required"/>
                    <p class="text-red"><?php echo form_error('passwordADMIN'); ?></p>
                  </div>
                  <?php } ?>
                </div>
                <div class="uk-grid" data-uk-grid-margin>
                  <div class="uk-width-medium-1-1 uk-margin-top">
                    <label>Menu Management (Multiple)</label>
                    <br>
                    <select id="select_menu" name="idMENU[]" multiple required="required">
                      <?php
                      if(!empty($getuser->emailADMIN)){
                        $getmenus = select_all_multiple_menu_for_row($getuser->idADMIN);
                        $selected = "selected";
                      } else {
                        $getmenus = select_all_multiple_menu();
                        $selected = "";
                      }

                      if(!empty($getmenus)){
                        foreach ($getmenus as $key => $menus) {
                          ?>
                          <option value="<?php echo $menus->idMENU;?>" <?php echo $selected;?>><?php echo $menus->namaMENU;?></option>
                          <?php } ?>
                          <?php } ?>
                        </select>
                        <p class="text-red"><?php echo form_error('idMENU'); ?></p>
                      </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                      <div class="uk-width-medium-1-1 uk-margin-top">
                       <div class="uk-form-row">
                         <span class="uk-input-group-addon"><?php echo form_submit('submit', 'SAVE', 'class="md-btn md-btn-primary" id="show_preloader_md"'); ?></span>
                       </div>
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