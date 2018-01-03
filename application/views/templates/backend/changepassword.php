<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 <?php if (!empty($message)){ ?>
  <div class="uk-alert uk-alert-<?php echo $message['type']; ?>" data-uk-alert>
    <a href="#" class="uk-alert-close uk-close"></a>
    <h4><?php echo $message['title']; ?></h4>
    <?php echo $message['text']; ?>
  </div>
 <?php } ?>
    <h4 class="heading_a uk-margin-bottom">Pengaturan Akun</h4>
    <?php
    $action = 'administrator/changepassword/';
    $naming = 'idADMIN';
    $value = encode($this->session->userdata('idADMIN'));
    ?>
    <form method="POST" action="<?php echo base_url().$action;?>processchangepassword" class="uk-form-stacked" id="form_validation">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <input type="hidden" name="<?php echo $naming;?>" value="<?php echo $value;?>">
        <div class="uk-grid" data-uk-grid-margin>
            <div class="uk-width-large-1-1">
                <div class="md-card">
                    <div class="md-card-content">
                        <div class="uk-form-row">
                            <label for="settings_site_name">Password Lama</label>
                            <br>
                            <input class="md-input label-fixed" required type="password" name="oldpassword" placeholder="Masukkan kata sandi lama anda" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 8 karakter' : '');"/>
                        </div>
                        <div class="uk-form-row">
                            <label for="settings_page_description">Password baru</label>
                            <br>
                            <input class="md-input label-fixed" type="password" name="password" placeholder="Masukkan kata sandi baru anda" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 8 karakter' : ''); if(this.checkValidity()) form.repassword.pattern = this.value;" id="password" required />
                        </div>
                        <div class="uk-form-row">
                            <label for="settings_admin_email">Masukan Password baru</label>
                            <br>
                            <input class="md-input label-fixed" type="password" name="repassword" placeholder="Masukkan kembali kata sandi baru anda"  pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Mohon masukkan kata sandi yang sama seperti diatas' : '');" id="repassword" required/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md-fab-wrapper">
            <input type="submit" class="md-fab md-fab-primary md-color-white" id="show_preloader_md" value="SIMPAN">
        </div>

    </form>