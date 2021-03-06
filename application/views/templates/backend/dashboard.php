<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (!empty($message)){ ?>
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
