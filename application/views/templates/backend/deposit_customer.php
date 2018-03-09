<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="uk-grid uk-grid-width-large-1-3 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show uk-margin-bottom" data-uk-sortable data-uk-grid-margin>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-orange-500">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                <span style="color: white" class="uk-text-small">Total Deposit Customer</span>
                <h2 style="color: white" class="uk-margin-remove uk-text-italic">Rp. <?php echo number_format($total_deposit->total_deposit, 0,',','.'); ?></h2>
            </div>
        </div>
    </div>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-deep-purple-700">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                <span style="color: white" class=" uk-text-small ">Total Customer Deposit</span>
                <h2 style="color: white" class="uk-margin-remove "><?php echo $customer_deposit;?></h2>
            </div>
        </div>
    </div>
    <div>
        <div class="md-card">
            <div class="md-card-content md-bg-red-700">
                <div class="uk-float-right uk-margin-top uk-margin-small-right"></div>
                <span style="color: white" class=" uk-text-small ">Total Deposit Dibelanjakan</span>
                <h2 style="color: white" class="uk-margin-remove uk-text-italic">Rp. <?php echo number_format($customer_deposit_used->total_used_deposit, 0,',','.'); ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="uk-width-medium-1-1">
  <h4 class="heading_a uk-margin-bottom">Daftar Deposit Customer</h4>

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
        <li class="uk-width-1-1 uk-active>"><a href="#">Daftar Deposit</a></li>
      </ul>
      <ul id="tabs_4" class="uk-switcher uk-margin">
        <li>
          <table id="dt_individual_search" class="uk-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Customer</th>
                <th>Deposit</th>
                <th>Kode Deposit</th>
                <th>Kode Order</th>
                <th>Status</th>
                <th>Created</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No.</th>
                <th>Customer</th>
                <th>Deposit</th>
                <th>Kode Deposit</th>
                <th>Kode Order</th>
                <th>Status</th>
                <th>Created</th>
              </tr>
            </tfoot>
            <tbody>
              <?php 
              if(!empty($list_deposit_customer)){
                foreach ($list_deposit_customer  as $key => $depo) { 
                  $id = encode($depo->idDEPOSIT);
              ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $depo->nameCUSTOMER; ?></td>
                    <td><?php echo $depo->amount; ?></td>
                    <td><?php echo $depo->orderDEPOSIT; ?></td>
                    <td><?php echo $depo->kodeorderDEPOSIT; ?></td>
                    <td><?php echo $depo->status; ?></td>
                    <td><?php echo date('d F Y - H:i', strtotime($depo->createdateDEPOSIT));?> WIB</td>
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