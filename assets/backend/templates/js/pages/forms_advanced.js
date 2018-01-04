$(function() {
    // advanced selects
    altair_form_adv.adv_selects();
});

altair_form_adv = {

    // advanced selects (selectizejs)
    adv_selects: function() {
        $('#selec_adv_1').selectize({
            plugins: {
                'remove_button': {
                    label: ''
                }
            },
            options: [
                {class: 'planet', id: 1, title: 'Mercury', url: 'http://en.wikipedia.org/wiki/Mercury_(planet)'},
                {class: 'planet', id: 2, title: 'Venus', url: 'http://en.wikipedia.org/wiki/Venus'},
                {class: 'planet', id: 3, title: 'Earth', url: 'http://en.wikipedia.org/wiki/Earth'},
                {class: 'planet', id: 4, title: 'Mars', url: 'http://en.wikipedia.org/wiki/Mars'},
                {class: 'planet', id: 5, title: 'Jupiter', url: 'http://en.wikipedia.org/wiki/Jupiter'},
                {class: 'planet', id: 6, title: 'Saturn', url: 'http://en.wikipedia.org/wiki/Saturn'},
                {class: 'planet', id: 7, title: 'Uranus', url: 'http://en.wikipedia.org/wiki/Uranus'},
                {class: 'planet', id: 8, title: 'Neptune', url: 'http://en.wikipedia.org/wiki/Neptune'},
                {class: 'star', id: 9, title: 'UY Scuti', url: 'https://en.wikipedia.org/wiki/UY_Scuti'},
                {class: 'star', id: 10, title: 'WOH G64', url: 'https://en.wikipedia.org/wiki/WOH_G64'},
                {class: 'star', id: 11, title: 'RW Cephei', url: 'https://en.wikipedia.org/wiki/RW_Cephei'},
                {class: 'star', id: 12, title: 'Westerlund 1-26', url: 'https://en.wikipedia.org/wiki/Westerlund_1-26'}
            ],
            optgroups: [
                {value: 'planet', label: 'Planets'},
                {value: 'star', label: 'Stars'}
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