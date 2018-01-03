<script src="<?php echo base_url().$this->data['asback'];?>js/common.min.js"></script>
<script src="<?php echo base_url().$this->data['asback'];?>js/uikit_custom.min.js"></script>
<script src="<?php echo base_url().$this->data['asback'];?>js/altair_admin_common.min.js"></script>

<?php 
$datatables = '
    <script src="'.base_url().$this->data['asbackbower'].'datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="'.base_url().$this->data['asback'].'js/custom/datatables/datatables.uikit.min.js"></script>
    <script src="'.base_url().$this->data['asback'].'js/pages/plugins_datatables.min.js"></script>
';
$forms_advanced='<script src="'.base_url().$this->data['asback'].'js/pages/forms_advanced.js"></script>';
$forms_validation='<script> altair_forms.parsley_validation_config();</script><script src="'.base_url().$this->data['asbackbower'].'parsleyjs/dist/parsley.min.js"></script>
    <script src="'.base_url().$this->data['asback'].'js/pages/forms_validation.min.js"></script>';

?>

<?php
if($plugins == 'plugins_datatables'){
?>
        
<?php echo $datatables;?>
<!--  preloaders functions -->
<script src="<?php echo base_url().$this->data['asback'];?>js/pages/components_preloaders.min.js"></script>

<?php echo $forms_advanced;?>

<?php echo $forms_validation;?>
<!-- tinymce -->
<script src="<?php echo base_url().$this->data['asbackbower']; ?>tinymce/tinymce.min.js"></script>
<script>
    $(function() {
    // tinymce
    altair_wysiwyg._tinymce();
    altair_wysiwyg._tinymces();
    altair_wysiwyg._tinymcess();
});

// wysiwyg editors
altair_wysiwyg = {
    _tinymce: function() {
        var $tinymce = '#wysiwyg_tinymce_codewell';
        if($($tinymce).length) {
            tinymce.init({
                skin_url: '<?php echo base_url().$this->data['asback']; ?>skins/tinymce/material_design',
                selector: "#wysiwyg_tinymce_codewell",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
            });
            
        }
    },
    _tinymces: function() {
        var $tinymce = '#wysiwyg_tinymce_codewell_second';
        if($($tinymce).length) {
            tinymce.init({
                skin_url: '<?php echo base_url().$this->data['asback']; ?>skins/tinymce/material_design',
                selector: "#wysiwyg_tinymce_codewell_second",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
            });
            
        }
    },
    _tinymcess: function() {
        var $tinymce = '#wysiwyg_tinymce_codewell_third';
        if($($tinymce).length) {
            tinymce.init({
                skin_url: '<?php echo base_url().$this->data['asback']; ?>skins/tinymce/material_design',
                selector: "#wysiwyg_tinymce_codewell_third",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
            });
            
        }
    }
};
</script>
<script type="text/javascript">
    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function(e) {
            $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
        });
        $('.multi-field .remove-field ', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parents('.multi-field').remove();
        });
    });
</script>
<?php
} elseif($plugins == 'plugins_dashboard') { 
?>

<script src="<?php echo base_url().$this->data['asbackbower']; ?>metrics-graphics/dist/metricsgraphics.min.js"></script>
<script src="<?php echo base_url().$this->data['asbackbower']; ?>chartist/dist/chartist.min.js"></script>
<script src="<?php echo base_url().$this->data['asbackbower']; ?>peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url().$this->data['asbackbower']; ?>jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url().$this->data['asbackbower']; ?>countUp.js/dist/countUp.min.js"></script>
<!-- chartist -->
<script src="<?php echo base_url().$this->data['asbackbower']; ?>chartist/dist/chartist.min.js"></script>
<!--  charts functions -->
<script src="<?php echo base_url().$this->data['asback']; ?>js/pages/plugins_charts.min.js"></script>
<?php
    $charings = chart_visitor_labels();
    $replacechartlabels = str_replace(['{',':','}','date','""'], ['','','','',''], $charings);
    
    $charing = chart_visitor_series();
    $replacechartseries = str_replace(['{','"',':','}','jumlah'], ['','','','',''], $charing);

    $numbered_voting_labels= getnumbervoting_for_chart_labels($listpolling->idPOLLING);
    $replace_name_choice = str_replace(['{','nameCHOICE',':','}','""'], ['','','','',''], $numbered_voting_labels);

    foreach ($number_voting as $key => $value) {
        $vote_value = $value->vote_value;
        $total = $value->total;
        $total_vote[$key] = round(100*($vote_value / $total),2);
        $total_json = json_encode($total_vote);
    }
    
?>
<script type="text/javascript">
$(function() {
    // chartist
    altair_charts.chartist_charts();
});
altair_charts = {
        chartist_charts: function() {
        // line chart with area
        var ch_line_area = new Chartist.Line('#chartist_line_area', {
            labels: <?php echo $replacechartlabels;?>,
            series: [
               <?php echo $replacechartseries;?>
            ]
        }, {
            low: 0,
            showArea: true
        });
        $window.on('resize',function() {
            ch_line_area.update();
        });

        // pie chart with custom labels
        var data = {
            labels: <?php echo $replace_name_choice;?>,
            series: <?php echo $total_json;?>
        };

        var options = {
            labelInterpolationFnc: function(value) {
                return value[0]
            }
        };

        var responsiveOptions = [
            ['screen and (max-width: 767px)', {
                chartPadding: 50,
                labelOffset: 50,
                labelDirection: 'explode',
                labelInterpolationFnc: function(value) {
                    return value;
                }
            }],
            ['screen and (min-width: 768px)', {
                chartPadding: 30,
                labelOffset: 60,
                labelDirection: 'explode',
                labelInterpolationFnc: function(value) {
                    return value;
                }
            }],
            ['screen and (min-width: 1024px)', {
                labelOffset: 80,
                chartPadding: 20
            }]
        ];

        var ch_pie_custom_labels = new Chartist.Pie('#chartist_pie_custom_labels', data, options, responsiveOptions);
        $window.on('resize',function() {
            ch_pie_custom_labels.update();
        });
    }
};
</script>
<script src="<?php echo base_url().$this->data['asback']; ?>js/pages/dashboard.min.js"></script>

<?php
} elseif($plugins == 'plugins') { 
?>
<?php echo $datatables;?>
<!--  preloaders functions -->
<script src="<?php echo base_url().$this->data['asback'];?>js/pages/components_preloaders.min.js"></script>

<?php echo $forms_advanced;?>
<!-- page specific plugins -->
<!-- tinymce -->
<script src="<?php echo base_url().$this->data['asbackbower']; ?>tinymce/tinymce.min.js"></script>


<script>
    $(function() {
    // tinymce
    altair_wysiwyg._tinymce();
    altair_wysiwyg._tinymces();
});

// wysiwyg editors
altair_wysiwyg = {
    _tinymce: function() {
        var $tinymce = '#wysiwyg_tinymce';
        if($($tinymce).length) {
            tinymce.init({
                skin_url: '<?php echo base_url().$this->data['asback']; ?>skins/tinymce/material_design',
                selector: "#wysiwyg_tinymce",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
            
        }
    },
    _tinymces: function() {
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
} elseif($plugins == 'plugins_polling') {
?>
<?php echo $datatables;?>
<?php echo $forms_advanced;?>
<!--  preloaders functions -->
<script src="<?php echo base_url().$this->data['asback'];?>js/pages/components_preloaders.min.js"></script>

<script type="text/javascript">
    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function(e) {
            $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
        });
        $('.multi-field .remove-field ', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parents('.multi-field').remove();
        });
    });
</script>
<!--  contact list functions -->
<script src="<?php echo base_url().$this->data['asback'];?>js/pages/page_contact_list.min.js"></script>

<?php
} elseif($plugins == 'plugins_aspirasi') {
?>
<?php echo $datatables;?>
<script type="text/javascript">
  function modalBOX(str){
      $.ajax({
           url:"<?php echo base_url();?>administrator/aspirasi/get_aspirasi/"+str+"",
           success: function(data){
              $('#subject').html('<h1>'+data.subjectASPIRASI+'</h1>');
              $('#name_user').html('<h4>'+data.nameASPIRASI+' ( '+ data.emailASPIRASI +' )</h4>');
              $('#timestamps').html('<span>'+data.createdateASPIRASI+'</span><br><br>');
              $('#description').html('<p>'+data.descASPIRASI+'</p>');
              var modal = UIkit.modal("#modal_header_footer");
              modal.show(); 
           },
           dataType:"json"
       });
       return false;
  }
</script>
<?php
} elseif($plugins == 'plugins_flyer') { 
?>
<?php echo $datatables;?>
<?php echo $forms_validation;?>
<script type="text/javascript">
$(function() {
    altair_form_adv.date_range()
}), altair_form_adv = {
    date_range: function() {
        var t = $("#uk_dp_start"),
            e = $("#uk_dp_end"),
            i = UIkit.datepicker(t, {
                format: "DD.MM.YYYY"
            }),
            n = UIkit.datepicker(e, {
                format: "DD.MM.YYYY"
            });
        t.on("change", function() {
            n.options.minDate = t.val(), setTimeout(function() {
                e.focus()
            }, 300)
        }), e.on("change", function() {
            i.options.maxDate = e.val()
        })
    }
};
</script>
<?php
} elseif($plugins == 'plugins_create_menu_admin_and_user') { 
?>

<?php echo $datatables;?>
<!--  preloaders functions -->
<script src="<?php echo base_url().$this->data['asback'];?>js/pages/components_preloaders.min.js"></script>

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
}
?>
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