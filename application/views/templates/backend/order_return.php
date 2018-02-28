<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="uk-width-medium-1-1">
  <h4 class="heading_a uk-margin-bottom">Pengembalian Order / Return Barang</h4>

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
        <li class="uk-width-1-1 uk-active>"><a href="#">Daftar Return Barang</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Thumbnail</th>
                <th>Customer</th>
                <th>Kode Order</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Thumbnail</th>
                <th>Customer</th>
                <th>Kode Order</th>
                <th>Created</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
            <?php 
            if(!empty($list_return_barang)){
              foreach ($list_return_barang  as $key => $return) { 
                $id = encode($return->idRETURN);
                ?>
                <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><img class="img_thumb" src="<?php echo $return->imagereturnBARANG;?>" alt="<?php echo $return->nameCUSTOMER;?>"/></td>
                  <td><?php echo $return->nameCUSTOMER; ?></td>
                  <td><?php echo $return->kodeorderRETURN; ?></td>
                  <td><?php echo date('d F Y', strtotime($return->createdateRETURN));?></td>
                  <td><a href="<?php echo base_url();?>zigzagadmin/order/detail_return_barang/<?php echo $id;?>">Lihat detail</a></td>
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