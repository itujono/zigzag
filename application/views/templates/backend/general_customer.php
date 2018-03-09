<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<h3 class="heading_b uk-margin-bottom">Daftar Custoemr</h3>
<div class="md-card uk-margin-medium-bottom">
    <div class="md-card-content">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-medium-1-2">
                <label for="contact_list_search">Cari... (min. 3 karakter.)</label>
                <input class="md-input" type="text" id="contact_list_search"/>
            </div>
        </div>
    </div>
</div>

<h3 class="heading_b uk-text-center grid_no_results" style="display:none">Tidak ada data ditemukan.</h3>
<div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-width-xlarge-1-5 hierarchical_show" id="contact_list">
<?php 
if(!empty($list_customer)){
    foreach ($list_customer as $customer) {

?>
    <div data-uk-filter="<?php echo strtolower($customer->emailCUSTOMER);?>,<?php echo strtolower($customer->nameCUSTOMER);?>">
        <div class="md-card md-card-hover">
            <div class="md-card-head">
                <?php if($this->session->userdata('idADMIN') == 1){ ?>
                <div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-right'}">
                    <i class="md-icon material-icons">&#xE5D4;</i>
                    <div class="uk-dropdown uk-dropdown-small">
                        <ul class="uk-nav">
                            <!-- <li><a href="<?php //echo base_url();?>zigzagadmin/user/saveuser/<?php //echo encode($customer->idUSER);?>">Edit</a></li> -->
                            <li><a href="<?php echo base_url();?>zigzagadmin/users/actiondelete_users/<?php echo encode($customer->idCUSTOMER);?>">Hapus</a></li>
                        </ul>
                    </div>
                </div>
                <?php } ?>
                <div class="uk-text-center">
                    <img class="md-card-head-avatar" src="<?php echo $customer->imageCUSTOMER;?>" alt="<?php echo $customer->nameCUSTOMER;?>"/>
                </div>
                <h3 class="md-card-head-text uk-text-center">
                    <?php echo ucwords($customer->nameCUSTOMER);?>
                    <br>
                </h3>
            </div>
            <div class="md-card-content">
                <ul class="md-list">
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading">Deposit</span>
                            <span class="uk-text-small uk-text-muted uk-text-truncate">Rp. <?php echo number_format($customer->depositCUSTOMER, 0,',','.'); ?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading">Nama</span>
                            <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo $customer->nameCUSTOMER;?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading">Email</span>
                            <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo strtolower($customer->emailCUSTOMER);?></span>
                        </div>
                    </li>
                    <li>
                        <div class="md-list-content">
                            <span class="md-list-heading">Alamat</span>
                            <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo $customer->addressCUSTOMER;?></span>
                        </div>
                    </li>
                    <li>
                        <?php
                            $data_customer_province_city = selectall_city_by_province($customer->cityCUSTOMER, $customer->provinceCUSTOMER);
                        ?>
                        <div class="md-list-content">
                            <span class="md-list-heading">Kota</span>
                            <span class="uk-text-small uk-text-muted uk-text-truncate"><?php echo $data_customer_province_city['city_name'];?></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>
<?php } ?>
</div>