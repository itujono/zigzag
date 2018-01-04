<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-large-1-1">
        <h3 class="heading_a uk-margin-bottom">Daftar Activity</h3>
        <div class="timeline timeline-center">
        <?php if(!empty($list_activity)){
            foreach ($list_activity as $key => $act) {
                if(strpos($act, 'Mengunjungi') == true){
                    $icon = 'visibility';
                    $style = 'timeline_icon_primary';
                } elseif (strpos($act, 'Penyimpanan') == true) {
                    $icon = 'save';
                    $style = 'timeline_icon_success';
                } elseif (strpos($act, 'Berhasil Keluar') == true) {
                    $icon = 'exit_to_app';
                    $style = 'timeline_icon_danger';
                } elseif (strpos($act, 'tidak berhasil') == true) {
                    $icon = 'error';
                    $style = 'timeline_icon_danger';
                } else {
                    $icon = 'error';
                    $style = 'timeline_icon_warning';
                }
                if($key % 2 == 0){
                    $cls = 'uk-animation-slide-right';
                } else {
                    $cls = 'uk-animation-slide-left';
                }
        ?>
            <div class="timeline_item">
                <div class="timeline_icon <?php echo $style;?> uk-invisible" data-uk-scrollspy="{cls:'uk-animation-scale-up uk-invisible', delay:300, repeat: true}"><i class="material-icons"><?php echo $icon;?></i></div>
                <div class="timeline_content uk-invisible" data-uk-scrollspy="{cls:'<?php echo $cls;?> uk-invisible', delay:300}">
                    <strong><?php echo $act;?></strong>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
        </div>
    </div>
</div>