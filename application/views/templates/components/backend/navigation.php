<!-- main header -->
<header id="header_main">
  <div class="header_main_content">
    <nav class="uk-navbar">

      <!-- main sidebar switch -->
      <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
        <span class="sSwitchIcon"></span>
      </a>
      <!-- secondary sidebar switch -->
      <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
        <span class="sSwitchIcon"></span>
      </a>

      <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav user_actions">
          <li><a href="#" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE192;</i>&nbsp; {elapsed_time} detik.</a></li>

          <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>

          <li><a href="#" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">toys</i>&nbsp;Hello <?php echo $this->session->userdata('Email');?>!</a></li>

          <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
            <a href="#" class="user_action_image"><img class="md-user-image" src="<?php echo base_url().$this->data['asback'];?>img/avatars/avatar_11_tn.png" alt=""/></a>
            <div class="uk-dropdown uk-dropdown-small">
              <ul class="uk-nav js-uk-prevent">
                <li><a href="<?php echo base_url();?>Administrator/changepassword">Rubah kata sandi</a></li>
                <li><a href="<?php echo base_url(); ?>login/logout">Keluar</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header><!-- main header end -->
<!-- main sidebar -->
<aside id="sidebar_main">

  <div class="sidebar_main_header">
    <div class="sidebar_logo">
      <a href="index.html" class="sSidebar_hide"><img src="<?php echo base_url().$this->data['asback'];?>img/logo.png" alt="Main logo"/></a>
      <a href="index.html" class="sSidebar_show"><img src="<?php echo base_url().$this->data['asback'];?>img/logo-small.png" alt="Small main logo"/></a>
    </div>
  </div>
  <?php
      $seg1 = strtolower($this->uri->segment(2));
      $seg2 = strtolower($this->uri->segment(3));

      $menus = selectall_menu_active(1,NULL,1);
      $menuschild = selectall_menu_active(NULL,1,1);
  ?>
  <div class="menu_section">
    <ul>
      <?php foreach ($menus as $key => $val1) { ?>
      <li title="<?php echo $val1->namaMENU;?>">
        <a href="<?php echo base_url();?>administrator/<?php echo $val1->functionMENU; ?>">
          <span class="menu_icon"><i class="material-icons"><?php echo $val1->iconMENU ?></i></span>
          <span class="menu_title"><?php echo $val1->namaMENU; ?></span>
        </a>
        <ul>
        <?php
          foreach ($menuschild as $key => $val2) {
            if($val1->idMENU == $val2->parentMENU){
              $class = '';
              if($seg2 == $val2->functionMENU){
                $class = 'act_item';
              }
        ?>
          <li class="<?php echo $class;?>">
            <a href="<?php echo base_url();?>administrator/<?php echo $val1->functionMENU; ?>/<?php echo $val2->functionMENU; ?>"><?php echo $val2->namaMENU; ?>
            </a>
          </li>
            <?php } ?>
          <?php } ?>
        </ul>
      </li>
      <?php } ?>
    </ul>
  </div>
</aside><!-- main sidebar end -->
