<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/backend/templates/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/backend/templates/img/favicon-32x32.png" sizes="32x32">

    <title>Login - NyatKadir.org</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/bower_components/uikit/css/uikit.almost-flat.min.css"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/backend/templates/css/login_page.min.css" />
</head>
<body class="login_page">

    <div class="login_page_wrapper">
        <div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>
                <?php if (!empty($message)){ ?>
                <div class="uk-alert uk-alert-<?php echo $message['type']; ?>" data-uk-alert>
                    <a href="#" class="uk-alert-close uk-close"></a>
                    <h4><?php echo $message['title']; ?></h4>
                    <?php echo $message['text']; ?>
                </div>
                <?php } ?>
                <form name="login" action="<?php echo base_url();?>login/processing" method="post">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                    <div class="uk-form-row">
                        <label for="login_email">Email</label>
                        <input class="md-input" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
                        <p class="text-red"><?php echo form_error('email'); ?></p>
                    </div>
                    <div class="uk-form-row uk-margin-bottom">
                        <label for="login_password">Kata sandi</label>
                        <input class="md-input" type="password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 8 Karakter' : '');" name="password" required />
                        <p class="text-red"><?php echo form_error('password'); ?></p>
                    </div>
                    <div class="uk-margin-medium-top">
                        <input type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large" value="SIGN IN">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- common functions -->
    <script src="<?php echo base_url();?>assets/backend/templates/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="<?php echo base_url();?>assets/backend/templates/js/uikit_custom.min.js"></script>
    <!-- altair core functions -->
    <script src="<?php echo base_url();?>assets/backend/templates/js/altair_admin_common.min.js"></script>
    <!-- altair login page functions -->
    <script src="<?php echo base_url();?>assets/backend/templates/js/pages/login.min.js"></script>

</body>
</html>
