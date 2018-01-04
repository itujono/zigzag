<?php defined('BASEPATH') OR exit('No direct script access allowed');?>



<?php
if ($plugins == 'home') { ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://npmcdn.com/headroom.js@0.9.4"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/wow.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/jquery.fancybox.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/jquery.themepunch.tools.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/jquery.themepunch.revolution.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.actions.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.carousel.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.kenburn.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.layeranimation.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.migration.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.navigation.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.parallax.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.slideanims.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider/revolution.extension.video.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/rev-slider-init.js"></script>

    <script>
        $('[data-fancybox]').fancybox({
            youtube : {
                controls : 0,
                showinfo : 0
            }
        });
    </script>

    <script>
        var form = document.querySelector(".form-aspirasi");
        var button = document.querySelector("button.is-submit");

        button.addEventListener("click", function(e) {
            e.preventDefault();
            console.log("Sempardak!!!");
        });
    </script>

    <script>
        new WOW().init();
    </script>
    <?php
        if(!empty($getflyer)){
            $image_flyer = $getflyer->imageFLYER;
            $image_flyer_alt = $getflyer->titleFLYER;
            $active = 'is-active';
        } else {
            $image_flyer = '';
            $image_flyer_alt = '';
            $active = '';
        }
    ?>
    <script>
        jQuery(document).ready(function($) {

            var advertOnce;

            if (sessionStorage.getItem('advertOnce') !== 'true') {
                $('body').append(
                    '<div class="modal <?php echo $active;?>"><div class="modal-background"></div><div class="modal-content"><p class="image"><img src="<?php echo $image_flyer;?>" alt="<?php echo $image_flyer_alt;?>"></p></div><button class="modal-close is-large" aria-label="close"></button></div>'
                )
                sessionStorage.setItem('advertOnce','true');
                console.log(advertOnce);
            }

            $(".modal-close").on("click", function() {
                $(this).closest(".modal").fadeOut(200);
            });

            jQuery(document).keypress(function(e) {
                if (e.keyCode == 27) {
                    $(".modal").fadeOut(500);
                }
            });
        });
    </script>

    <script>
        if ($('.five-item-carousel').length) {
            $('.five-item-carousel').owlCarousel({
                loop:true,
                margin:30,
                smartSpeed: 700,
                autoplay: 4000,
                responsive:{
                    0:{
                        items:1
                    },
                    580:{
                        items:1
                    },
                    640:{
                        items:2
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:3
                    },
                    1100:{
                        items:5
                    }
                }
            });
        }
    </script>

    <script>
        if ($('.four-item-carousel').length) {
            $('.four-item-carousel').owlCarousel({
                loop:true,
                margin:20,
                smartSpeed: 700,
                autoplay: 3000,
                responsive:{
                    0:{
                        items:1
                    },
                    580:{
                        items:1
                    },
                    640:{
                        items:2
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:3
                    },
                    1100:{
                        items:4,
                        nav: true
                    }
                }
            });
        }
    </script>

    <script>
        if ( $('.main-slider .tp-banner').length ) {

                var MainSlider = $('.main-slider');
                var strtHeight = MainSlider.attr('data-start-height');
                var slideOverlay =  "'"+ MainSlider.attr('data-slide-overlay') +"'";

                $('.main-slider .tp-banner').show().revolution( {
                //dottedOverlay: slideOverlay,
                delay:5000,
                startwidth:1200,
                startheight:strtHeight,
                hideThumbs:600,

                thumbWidth:80,
                thumbHeight:50,
                thumbAmount:5,

                navigationType:"bullet",
                navigationArrows:"1",
                navigationStyle:"preview3",

                touchenabled:"on",
                onHoverStop:"off",

                swipe_velocity: 0.7,
                swipe_min_touches: 1,
                swipe_max_touches: 1,
                drag_block_vertical: false,

                parallax:"mouse",
                parallaxBgFreeze:"on",
                parallaxLevels:[7,4,3,2,5,4,3,2,1,0],

                keyboardNavigation:"off",

                navigationHAlign:"center",
                navigationVAlign:"bottom",
                navigationHOffset:0,
                navigationVOffset:50,

                soloArrowLeftHalign:"left",
                soloArrowLeftValign:"bottom",
                soloArrowLeftHOffset:20,
                soloArrowLeftVOffset:0,

                soloArrowRightHalign:"right",
                soloArrowRightValign:"center",
                soloArrowRightHOffset:20,
                soloArrowRightVOffset:0,

                shadow:0,
                fullWidth:"on",
                fullScreen:"off",

                spinner:"spinner4",

                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,

                shuffle:"off",

                autoHeight:"off",
                forceFullWidth:"on",

                hideThumbsOnMobile:"on",
                hideNavDelayOnMobile:1500,
                hideBulletsOnMobile:"on",
                hideArrowsOnMobile:"on",
                hideThumbsUnderResolution:0,

                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                startWithSlide:0,
                videoJsPath:"",
                fullScreenOffsetContainer: ""
            });
        }
    </script>
    <?php if(!empty($getpolling)){
    $name_fb =  $getpolling->questionPOLLING;
    $desc_fb =  $getpolling->questionPOLLING;
}?>
<script type="text/javascript">
    function genericSocialShare(url){
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }

function createFBShareLink(FBVars) {
    // FBVars is app_id
    var url = 'http://www.facebook.com/dialog/feed?app_id='+FBVars+
    '&link=' + '<?php echo base_url(uri_string());?>' +
    '&picture=' + '<?php echo base_url().$this->data['asfront'];?>img/logo.png' +
    '&name=' + encodeURIComponent('<?php echo $name_fb; ?>') +
    '&description=' + encodeURIComponent('<?php echo $desc_fb; ?>') +
    '&redirect_uri=' + '<?php echo base_url(uri_string());?>' +
    '&display=popup';
    window.open(url,'feedDialog','toolbar=0,status=0,width=626,height=436');
}

$(".ShareFB").click(function(e) {
    e.preventDefault();
    createFBShareLink('328440447656043');
});
</script>

<?php
} elseif ($plugins == 'general_addon') {
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://npmcdn.com/headroom.js@0.9.4"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/wow.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/plugins.js"></script>

    <script>new WOW().init();</script>

    <script>
        if ($('.five-item-carousel').length) {
            $('.five-item-carousel').owlCarousel({
                loop:true,
                margin:30,
                smartSpeed: 700,
                autoplay: 4000,
                responsive:{
                    0:{
                        items:1
                    },
                    580:{
                        items:1
                    },
                    640:{
                        items:2
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:3
                    },
                    1100:{
                        items:5
                    }
                }
            });
        }
    </script>

    <script>
        if ($('.four-item-carousel').length) {
            $('.four-item-carousel').owlCarousel({
                loop:true,
                margin:10,
                smartSpeed: 700,
                autoplay: 3000,
                responsive:{
                    0:{
                        items:1
                    },
                    580:{
                        items:1
                    },
                    640:{
                        items:2
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:4,
                        nav: true,
                        dots: true
                    },
                    1100:{
                        items:4
                    }
                }
            });
        }
    </script>

    <script>
        if ($('.one-item-carousel').length) {
            $('.one-item-carousel').owlCarousel({
                loop:true,
                margin:10,
                smartSpeed: 700,
                autoplay: 3000,
                responsive:{
                    0:{
                        items:1
                    },
                    1024:{
                        items:1,
                        dots: true
                    }
                }
            });
        }
    </script>

    <script>
        if ($('.three-item-carousel').length) {
            $('.three-item-carousel').owlCarousel({
                loop:true,
                margin:20,
                smartSpeed: 700,
                autoplay: 3000,
                responsive:{
                    0:{
                        items:1
                    },
                    580:{
                        items:1
                    },
                    640:{
                        items:2
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:3
                    },
                    1100:{
                        items:3
                    }
                }
            });
        }
    </script>

    <script>
        $(".image-saved .delete").on("click", function() {
            $(this).closest(".image-saved").fadeOut(200);
        });
    </script>

    <script>
        var tabbed = function() {
            var tab = document.getElementsByClassName('tab-link');
            var tabContent = document.getElementsByClassName('tab-content');

                for (var i = 0; i < tab.length; i++) {
                    tab[i].addEventListener('click', function(e) {
                        e.preventDefault();

                        for (var i = 0; i < tab.length; i++) {
                            tab[i].classList.remove('is-active');
                        };
                        for (var i = 0; i < tabContent.length; i++) {
                            tabContent[i].classList.remove('is-active');
                        };
                        this.className += ' is-active';

                        var samainTabNya = this.getAttribute('data-tab');

                        document.getElementById(samainTabNya).className += ' is-active';
                    }, false);
                }
            }
        tabbed();
    </script>
<?php if(!empty($getnews)){
    $name_fb =  $getnews->titleNEWS;
    $desc_fb =  $getnews->descNEWS;
} else {
    $name_fb =  '';
    $desc_fb =  '';
}?>
<script type="text/javascript">
    function genericSocialShare(url){
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }

function createFBShareLink(FBVars) {
    // FBVars is app_id
    var url = 'http://www.facebook.com/dialog/feed?app_id='+FBVars+
    '&link=' + '<?php echo base_url(uri_string());?>' +
    '&picture=' + '<?php echo base_url().$this->data['asfront'];?>img/logo.png' +
    '&name=' + encodeURIComponent('<?php echo $name_fb;?>') +
    '&description=' + encodeURIComponent('<?php echo word_limiter($desc_fb,8);?>') +
    '&redirect_uri=' + '<?php echo base_url(uri_string());?>' +
    '&display=popup';
    window.open(url,'feedDialog','toolbar=0,status=0,width=626,height=436');
}

$(".ShareFB").click(function(e) {
    e.preventDefault();
    createFBShareLink('328440447656043');
});
</script>

<?php
} elseif ($plugins == 'gallery') {
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://npmcdn.com/headroom.js@0.9.4"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/wow.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/jquery.fancybox.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/accordion.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/tab.min.js"></script>

    <script>
        new WOW().init();
    </script>

    <script>
        $(".ui.accordion").accordion();

        $(".accordion .content li a").tab();

        $('[data-fancybox="image"]').fancybox({
            thumbs : {
                autoStart : true
            },
            buttons : [
                'thumbs',
                'close'
            ]
        });

        if ($('.four-item-carousel').length) {
            $('.four-item-carousel').owlCarousel({
                loop:true,
                margin:20,
                smartSpeed: 700,
                autoplay: 3000,
                responsive:{
                    0:{
                        items:1
                    },
                    580:{
                        items:1
                    },
                    640:{
                        items:2
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:3
                    },
                    1100:{
                        items:4
                    }
                }
            });
        }
    </script>

<?php
} elseif ($plugins == 'non_footer_page') {
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://npmcdn.com/headroom.js@0.9.4"></script>
<script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>

<script>
    var btnDelete = document.querySelectorAll(".delete");
    var message = document.querySelectorAll(".message");

    for (var i = 0; i < btnDelete.length; i++) {
        btnDelete[i].addEventListener("click", function(e) {
            e.preventDefault();
            for (var i = 0; i < message.length; i++) {
                message[i].classList += " none";
            }
        });
    }
</script>

<script>
    var login = document.querySelector('.login-wrapper');
    var register = document.querySelector('.register-wrapper');
    var forgot = document.querySelector('.forgot-wrapper');
    var stRegister = document.querySelector('#switch-to-register');
    var stLogin = document.querySelectorAll('#switch-to-login');
    var stForgot = document.querySelector('#switch-to-forgot');

    stRegister.addEventListener('click', function() {
        if (login.classList.contains('is-active')) {
            login.classList.remove('is-active');
            register.classList.add('is-active');
        }
    });

    for (var i = 0; i < stLogin.length; i++) {
        stLogin[i].addEventListener("click", function(e) {
            if (register.classList.contains("is-active")) {
                e.preventDefault();
                register.classList.remove("is-active");
                login.classList += " is-active";
                console.log("Switched to login nih!");
            }
            if (forgot.classList.contains("is-active")) {
                forgot.classList.remove("is-active");
                login.classList += " is-active";
            }
        });
    }

    stForgot.addEventListener('click', function() {
        if (forgot.classList.contains('is-active')) {
            forgot.classList.remove('is-active');
        } else {
            forgot.classList += " is-active";
            login.classList.remove("is-active");
        }
    });
</script>
<?php if(!empty($getpolling)){
    $name_fb =  $getpolling->questionPOLLING;
    $desc_fb =  $getpolling->questionPOLLING;
} else {
    $name_fb =  '';
    $desc_fb =  '';
}?>
<script type="text/javascript">
    function genericSocialShare(url){
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }

function createFBShareLink(FBVars) {
    // FBVars is app_id
    var url = 'http://www.facebook.com/dialog/feed?app_id='+FBVars+
    '&link=' + '<?php echo base_url(uri_string());?>' +
    '&picture=' + '<?php echo base_url().$this->data['asfront'];?>img/logo.png' +
    '&name=' + encodeURIComponent('<?php echo $name_fb; ?>') +
    '&description=' + encodeURIComponent('<?php echo $desc_fb; ?>') +
    '&redirect_uri=' + '<?php echo base_url(uri_string());?>' +
    '&display=popup';
    window.open(url,'feedDialog','toolbar=0,status=0,width=626,height=436');
}

$(".ShareFB").click(function(e) {
    e.preventDefault();
    createFBShareLink('328440447656043');
});
</script>
<?php
} elseif ($plugins == 'reset_password_user') {
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://npmcdn.com/headroom.js@0.9.4"></script>
<script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>
<?php } ?>

<script>
    var navbarBurgers = Array.prototype.slice.call(document.querySelectorAll(".navbar-burger"), 0);

    if (navbarBurgers.length > 0) {
        navbarBurgers.forEach(function(e) {
            e.addEventListener("click", function() {
                var target = e.dataset.target;
                var $target = document.getElementById(target);

                e.classList.toggle("is-active");
                $target.classList.toggle("is-active");

                console.log("Sempardak!");
            })
        });
    }
</script>
<script src="<?php echo base_url().$this->data['asfront'];?>js/script.js"></script>
