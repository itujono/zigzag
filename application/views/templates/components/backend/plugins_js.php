<script src="<?php echo base_url().$this->data['asback'];?>js/common.min.js"></script>
<script src="<?php echo base_url().$this->data['asback'];?>js/uikit_custom.min.js"></script>
<script src="<?php echo base_url().$this->data['asback'];?>js/altair_admin_common.min.js"></script>

<?php 
$datatables = '
    <script src="'.base_url().$this->data['asbackbower'].'datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="'.base_url().$this->data['asback'].'js/custom/datatables/datatables.uikit.min.js"></script>
    <script src="'.base_url().$this->data['asback'].'js/pages/plugins_datatables.min.js"></script>
';
$forms_advanced='<script src="'.base_url().$this->data['asback'].'js/pages/forms_advanced.min.js"></script>';
$forms_validation='<script> altair_forms.parsley_validation_config();</script><script src="'.base_url().$this->data['asbackbower'].'parsleyjs/dist/parsley.min.js"></script>
    <script src="'.base_url().$this->data['asback'].'js/pages/forms_validation.min.js"></script>';
$forms_mask='<script src="'.base_url().$this->data['asbackbower'].'jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>';
$forms_rangeslider='<script src="'.base_url().$this->data['asbackbower'].'ion.rangeslider/js/ion.rangeSlider.min.js"></script>';
?>

<?php
if($plugins == 'plugins_datatables'){
?>
<?php echo $datatables;?>
<?php echo $forms_advanced;?>
<?php echo $forms_validation;?>
<!-- tinymce -->
<script src="<?php echo base_url().$this->data['asbackbower']; ?>tinymce/tinymce.min.js"></script>
<script>
    $(function() {
    altair_wysiwyg._tinymce();
});

// wysiwyg editors
altair_wysiwyg = {
    _tinymce: function() {
        var $tinymce = '#wysiwyg_tinymces';
        if($($tinymce).length) {
            tinymce.init({
                skin_url: '<?php echo base_url().$this->data['asback']; ?>skins/tinymce/material_design',
                selector: "#wysiwyg_tinymces",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
            
        }
    }
};
</script>


<?php
} elseif($plugins == 'plugins_dashboard') { 
?>

<script src="<?php echo base_url().$this->data['asbackbower']; ?>metrics-graphics/dist/metricsgraphics.min.js"></script>
<script src="<?php echo base_url().$this->data['asbackbower']; ?>chartist/dist/chartist.min.js"></script>
<script src="<?php echo base_url().$this->data['asbackbower']; ?>peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url().$this->data['asbackbower']; ?>jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url().$this->data['asbackbower']; ?>countUp.js/dist/countUp.min.js"></script>

<script src="<?php echo base_url().$this->data['asback']; ?>js/pages/dashboard.min.js"></script>
<?php
} elseif($plugins == 'plugins_deposit') {
?>
<?php echo $datatables;?>

<?php
} elseif($plugins == 'plugins_user') {
?>
<!--  contact list functions -->
<script src="<?php echo base_url().$this->data['asback']; ?>js/pages/page_contact_list.min.js"></script>
<?php
} elseif($plugins == 'plugins_menu') {
?>
<!--  nestable component functions -->
<script src="<?php echo base_url().$this->data['asback']; ?>js/pages/components_nestable.min.js"></script>
<?php echo $forms_advanced;?>
<?php $user = selectall_user_active();?>
<script type="text/javascript">
$(function() {
    // advanced selects
    altair_form_adv.adv_selects();
});
altair_form_adv = {
    adv_selects: function() {
        $('#select_access').selectize({
            plugins: {
                'remove_button': {
                    label: ''
                }
            },
            options: [
            <?php foreach ($user as $usr) { ?>
                {class: 'userlist', id: <?php echo $usr->idADMIN;?>, title: '<?php echo $usr->nameADMIN;?>'},
            <?php } ?>
            ],
            optgroups: [
                {value: 'userlist', label: 'List User'}
            ],
            optgroupField: 'class',
            maxItems: null,
            valueField: 'id',
            labelField: 'title',
            searchField: 'title',
            create: false,
            render: {
                option: function(data, escape) {
                    return  '<div class="option">' +
                                '<span class="title">' + escape(data.title) + '</span>' +
                            '</div>';
                },
                item: function(data, escape) {
                    return '<div class="item"><a href="' + escape(data.url) + '" target="_blank">' + escape(data.title) + '</a></div>';
                },
                optgroup_header: function(data, escape) {
                    return '<div class="optgroup-header">' + escape(data.label) + '</div>';
                }
            },
            onDropdownOpen: function($dropdown) {
                $dropdown
                    .hide()
                    .velocity('slideDown', {
                        begin: function() {
                            $dropdown.css({'margin-top':'0'})
                        },
                        duration: 200,
                        easing: easing_swiftOut
                    })
            },
            onDropdownClose: function($dropdown) {
                $dropdown
                    .show()
                    .velocity('slideUp', {
                        complete: function() {
                            $dropdown.css({'margin-top':''})
                        },
                        duration: 200,
                        easing: easing_swiftOut
                    })
            }
        });
    }
};
</script>
<?php
} elseif($plugins == 'plugins_create_menu_admin_and_user') { 
?>

<?php echo $datatables;?>

<?php
$menus = select_all_multiple_menu();
?>
<script type="text/javascript">
$(function() {
    // advanced selects
    altair_form_adv.adv_selects();
});
altair_form_adv = {
    adv_selects: function() {
        $('#select_menu').selectize({
            plugins: {
                'remove_button': {
                    label: ''
                }
            },
            options: [
            <?php foreach ($menus as $menu) { ?>
                {class: 'menu_list', id: <?php echo $menu->idMENU;?>, title: '<?php echo $menu->namaMENU;?>'},
            <?php } ?>
            ],
            optgroups: [
                {value: 'menu_list', label: 'Daftar Menu'}
            ],
            optgroupField: 'class',
            maxItems: null,
            valueField: 'id',
            labelField: 'title',
            searchField: 'title',
            create: false,
            render: {
                option: function(data, escape) {
                    return  '<div class="option">' +
                                '<span class="title">' + escape(data.title) + '</span>' +
                            '</div>';
                },
                item: function(data, escape) {
                    return '<div class="item"><a href="' + escape(data.url) + '" target="_blank">' + escape(data.title) + '</a></div>';
                },
                optgroup_header: function(data, escape) {
                    return '<div class="optgroup-header">' + escape(data.label) + '</div>';
                }
            },
            onDropdownOpen: function($dropdown) {
                $dropdown
                    .hide()
                    .velocity('slideDown', {
                        begin: function() {
                            $dropdown.css({'margin-top':'0'})
                        },
                        duration: 200,
                        easing: easing_swiftOut
                    })
            },
            onDropdownClose: function($dropdown) {
                $dropdown
                    .show()
                    .velocity('slideUp', {
                        complete: function() {
                            $dropdown.css({'margin-top':''})
                        },
                        duration: 200,
                        easing: easing_swiftOut
                    })
            }
        });
    }
};
</script>
<?php
} elseif($plugins == 'plugins_order') { 
?>
<?php echo $datatables;?>

<!-- chartist (charts) -->
<script src="<?php echo base_url().$this->data['asbackbower']; ?>chartist/dist/chartist.min.js"></script>
<!-- peity (small charts) -->
<script src="<?php echo base_url().$this->data['asbackbower']; ?>peity/jquery.peity.min.js"></script>
<!-- easy-pie-chart (circular statistics) -->
<script src="<?php echo base_url().$this->data['asbackbower']; ?>jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<!-- countUp -->
<script src="<?php echo base_url().$this->data['asbackbower']; ?>countUp.js/countUp.js"></script>
<script src="<?php echo base_url().$this->data['asback'];?>js/pages/dashboard.min.js"></script>

<?php                   
}
?>
<!--  preloaders functions -->
<script src="<?php echo base_url().$this->data['asback'];?>js/pages/components_preloaders.min.js"></script>
<script>
    $(function() {
        if(isHighDensity()) {
            $.getScript( "<?php echo base_url().$this->data['asback']; ?>js/custom/dense.min.js", function(data) {
                // enable hires images
                altair_helpers.retina_images();
            });
        }
        if(Modernizr.touch) {
            // fastClick (touch devices)
            FastClick.attach(document.body);
        }
    });
    $window.load(function() {
        // ie fixes
        altair_helpers.ie_fix();
    });
</script>