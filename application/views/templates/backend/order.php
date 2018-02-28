<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (!empty($message)){ ?>
  <div class="uk-alert uk-alert-<?php echo $message['type']; ?>" data-uk-alert>
    <a href="#" class="uk-alert-close uk-close"></a>
    <h4><?php echo $message['title']; ?></h4>
    <?php echo $message['text']; ?>
  </div>
<?php } ?>
<div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-orange-500">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data"><?php echo $order_diterima;?>/1000</span></div>
                <span style="color: white" class="uk-text-small">Order Terima</span>
                <h2 style="color: white" class="uk-margin-remove"><span class="countUpMe">0<noscript><?php echo $order_diterima;?></noscript></span></h2>
            </div>
        </div>
    </div>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-deep-purple-700">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data"><?php echo $progress_gudang;?>/1000</span></div>
                <span style="color: white" class=" uk-text-small ">Progress Gudang</span>
                <h2 style="color: white" class="uk-margin-remove "><span class="countUpMe">0<noscript><?php echo $progress_gudang;?></noscript></span></h2>
            </div>
        </div>
    </div>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-blue-500">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data"><?php echo $order_dibatalkan;?>/1000</span></div>
                <span style="color: white" class=" uk-text-small ">Order Batal</span>
                <h2 style="color: white" class="uk-margin-remove "><span class="countUpMe">0<noscript><?php echo $order_dibatalkan;?></noscript></span></h2>
            </div>
        </div>
    </div>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-pink-400">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data"><?php echo $barang_terkirim;?>/1000</span></div>
                <span style="color: white" class="uk-text-small ">Barang Terkirim</span>
                <h2 style="color: white" class="uk-margin-remove "><span class="countUpMe">0<noscript><?php echo $barang_terkirim;?></noscript></span></h2>
            </div>
        </div>
    </div>
</div>

<h4 class="heading_a uk-margin-bottom">Daftar Order</h4>
<?php if (!empty($message)){ ?>
  <div class="uk-alert uk-alert-<?php echo $message['type']; ?>" data-uk-alert>
    <a href="#" class="uk-alert-close uk-close"></a>
    <h4><?php echo $message['title']; ?></h4>
    <?php echo $message['text']; ?>
  </div>
<?php } ?>
<div class="md-card uk-margin-medium-bottom">
    <div class="md-card-content">
        <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>No. Order</th>
                <th>Tanggal Order</th>
                <th>Status</th>
                <th>Lihat Order</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>No. Order</th>
                <th>Tanggal Order</th>
                <th>Status</th>
                <th>Lihat Order</th>
            </tr>
            </tfoot>
            <tbody>
            <?php foreach ($orderlist as $key => $order) {
                $id = encode($order->idORDER);
            ?>
            <tr>
                <td><?php echo $key+1;?></td>
                <td><?php echo $order->nameCUSTOMER;?></td>
                <td><?php echo $order->kodeORDER;?></td>
                <td><?php echo dF($order->createdateORDER, 'd F Y (H:i:s)');?></td>
                <td><?php echo $order->status;?></td>
                <td><a href="<?php echo base_url();?>zigzagadmin/order/detail/<?php echo $id;?>">Lihat detail</a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>