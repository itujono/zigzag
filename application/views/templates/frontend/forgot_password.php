<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="main">
    <div class="ui grid">
        <div class="twelve wide column">
            <div class="header">
                <h3>Lupa password?</h3>
                Jangan takut. Semua orang pernah lupa. Silakan masukkan email kamu, dan kami akan mengirimkan email berisi instruksi untuk mereset password kamu.
            </div>
            <form class="ui form" method="POST" action="<?php echo base_url();?>customer/process_forgot_password">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="field">
                    <label for="emailForgot">Masukkan email kamu</label>
                    <input type="email" id="emailForgot" name="emailForgot" placeholder="Misal: joni@emailsaya.com" required="required">
                </div>
                <input type="submit" class="ui black forgot button" value="Reset password">
                <a href="<?php echo base_url();?>" class="ui direct button"><i class="angle left icon"></i> Kembali ke Home</a>
            </form>
        </div>
    </div>
    <div class="ui page dimmer">
        <div class="content">
            <div class="center">
                <h2 class="ui inverted icon header">
                    <i class="heart icon"></i>
                    Okay, silakan cek inbox email kamu ya. <br> Dan ikuti instruksi selanjutnya.
                </h2>
            </div>
        </div>
    </div>
</div> <!-- kelar Main -->