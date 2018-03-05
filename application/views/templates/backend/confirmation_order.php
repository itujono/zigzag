<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="uk-width-medium-1-1">
  <h4 class="heading_a uk-margin-bottom">Daftar Konfirmasi Order Customer</h4>

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
        <li class="uk-width-1-1 uk-active>"><a href="#">Daftar Payment</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kode Order</th>
                <th>Nominal Transfer</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kode Order</th>
                <th>Nominal Transfer</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php 
              if(!empty($list_confirmation_order)){
                foreach ($list_confirmation_order  as $key => $confirm) { 
                  $id = encode($confirm->idCONFIRM);
                  ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $confirm->nameCONFIRM; ?></td>
                    <td><?php echo $confirm->kodeCONFIRM; ?></td>
                    <td>Rp. <?php echo number_format($confirm->nominalCONFIRM, 0,',','.'); ?></td>
                    <td><?php echo $confirm->status; ?></td>
                    <td><?php echo date('d F Y', strtotime($confirm->createdateCONFIRM));?></td>
                    <td><a href="<?php echo base_url();?>zigzagadmin/order/detail_confirm/<?php echo $confirm->kodeCONFIRM;?>">Lihat detail</a></td>
                  </tr>
                  <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </li>
          </ul>
        </div>
    </div>
</div>