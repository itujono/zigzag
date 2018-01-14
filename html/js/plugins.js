(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        if (!console[method]) {
            console[method] = noop;
        }
    }
}());


const loginForm = $(".login .ui.form");


$(document).ready(function() {

    $(".additional-actions button").popup({
        variation: "mini"
    });

    $(".view-style .button, .colors > div").popup({
        variation: "mini"
    });

    $(".ui.dropdown.category").popup({
        inline: true,
        hoverable: true,
        position: 'bottom right'
    });

    $(".ui.dropdown.cart").popup({
        inline: true,
        hoverable: true,
        position: 'bottom center'
    });

    $(".ui.dropdown.item").dropdown();

    $(".ui.dropdown").dropdown();

    $(".ui.radio.checkbox").checkbox();

    $(".ui.checkbox").checkbox();

    $(".main a.ui.card").on("click", function(e) {
        e.preventDefault();
        console.log("Clicked pulak!");
    });

    $(".additional-actions .add-to-wishlist").each(function() {
        $(this).on("click", function(e) {
            e.preventDefault();
            if ($(this).find(".empty.heart.icon").hasClass("empty")) {
                setTimeout(function() {
                    $(".ui.message.added-to-wishlist").transition("slide", function() {
                        setTimeout(function() {
                            $(".ui.message.added-to-wishlist").transition("slide");
                        }, 4000);
                    });
                }, 1000);
                $(this).find(".empty.heart.icon").transition("jiggle").removeClass("empty").css("color", "#f92626");
            } else {
                $(this).find(".heart.icon").transition("jiggle").addClass("empty").css("color", "#fff");
                setTimeout(function() {
                    $(".ui.message.removed-from-wishlist").transition("slide", function() {
                        setTimeout(function() {
                            $(".ui.message.removed-from-wishlist").transition("slide");
                            console.log(this);
                        }, 4000);
                    });
                }, 1000);
            }
        });
    });

    $(".additional-actions .add-to-cart").each(function() {
        $(this).on("click", function(e) {
            e.preventDefault();
            $(".additional-actions .add-to-cart .shopping.icon").transition("jiggle");
            setTimeout(function() {
                $(".ui.message.added-to-cart").transition({
                    onComplete: setTimeout(function() {
                        $(".ui.message.added-to-cart").transition("slide");
                    }, 4000)
                });
            }, 1000);
        });
    });

    // $(".ui.message .close").on("click", function() {
    //     $(this).closest(".ui.message").transition("slide", 200);
    // });

    if ($('.one-item-carousel').length) {
        $('.one-item-carousel').owlCarousel({
            loop: true,
            margin: 20,
            smartSpeed: 700,
            autoplay: false,
            autoplayHoverPause: true,
            responsive: {
                0: { items: 1 },
                580: { items: 1 },
                1024: { items: 1 }
            }
        });
    };

    if ( $(".loop").length ) {
        $('.loop').owlCarousel({
            center: true,
            stageOuterClass: "loopy",
            items:2,
            dots: false,
            loop:true,
            margin:20,
            responsive:{
                0: {
                    items: 1
                },
                600:{
                    items:4
                }
            }
        });
    };


    $(".ui.deposit .learn-more").popup({
        inline: true,
        hoverable: false
    });

    $(".login-trigger").on("click", function() {
        $(".ui.modal.login").modal({
            blurring: true,
            allowMultiple: false,
            autofocus: false,
            duration: 200,
            transition: "fade up",
            onHidden: function() { loginForm.form("clear"); }
        }).modal('show');

        $(".ui.modal.register").modal({
            duration: 200,
            transition: "fade up",
            blurring: true,
            onHidden: function() { $(this).form("clear"); }
        }).modal("attach events", ".signup-link a");

        $(".ui.modal.login").modal("attach events", ".login-link a");
    });




    // Default Settings

    $.fn.form.settings.defaults = {
        email: {
            identifier: "email",
            rules: [
                {
                    type: "regExp[/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/]",
                    prompt: "Emang udah bener tuh format emailnya?"
                },
                {
                    type: "empty",
                    prompt: "Jangan lupa diisi ya emailnya."
                }
            ]
        },
        password: {
            identifier: "password",
            rules: [
                {
                    type: "empty",
                    prompt: "Kok passwordnya nggak diisi?"
                },
                {
                    type: "minLength[8]",
                    prompt: "Sepertinya passwordnya kurang banyak deh"
                }
            ]
        },
        passwordRepeat: {
            identifier: "passwordRepeat",
            rules: [
                {
                    type: "empty",
                    prompt: "Kelupaan lagi passwordnya ya?"
                },
                {
                    type: "match[password]",
                    prompt: "Kayaknya nggak sama deh sama yang diketik di atas"
                }
            ]
        },
    };

    $(".login .ui.form").form({
        inline: true,
        on: "blur",
        fields: {
            emailLogin: {
                identifier: "emailLogin",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan lupa diisi ya emailnya."
                    },
                    {
                        type: "regExp[/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/]",
                        prompt: "Emang udah bener tuh format emailnya?"
                    }
                ]
            },
            passwordLogin: {
                identifier: "passwordLogin",
                rules: [
                    {
                        type: "empty",
                        prompt: "Kok passwordnya nggak diisi?"
                    },
                    {
                        type: "minLength[8]",
                        prompt: "Sepertinya passwordnya kurang banyak deh"
                    }
                ]
            }
        },
        onFailure: function() {
            $(this).form("clear");
        }
    });

    $(".register .ui.form").form({
        inline: true,
        on: "blur",
        fields: {
            name: {
                identifier: "nama",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin namanya ya"
                    },
                    {
                        type: "minLength[5]",
                        prompt: "Kurang panjang tuh namanya"
                    },
                    {
                        type: "containsExactly[ ]",
                        prompt: "Nama belakangnya udah belum?"
                    }
                ]
            },
            email: {
                identifier: "email",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin emailnya ya"
                    },
                    {
                        type: "regExp[/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/]",
                        prompt: "Udah bener emangnya format emailnya tuh?"
                    }
                ]
            },
            password: {
                identifier: "password",
                rules: [
                    {
                        type: "empty",
                        prompt: "Kelupaan passwordnya ya?"
                    },
                    {
                        type: "minLength[8]",
                        prompt: "Minimal 8 karakter ya, jangan lupa!"
                    }
                ]
            },
            passwordRepeat: {
                identifier: "passwordRepeat",
                rules: [
                    {
                        type: "empty",
                        prompt: "Kelupaan lagi passwordnya ya?"
                    },
                    {
                        type: "match[password]",
                        prompt: "Kayaknya nggak sama deh sama yang diketik di atas"
                    }
                ]
            },
            kodepos: {
                identifier: "kodepos",
                rules: [
                    {
                        type: "empty",
                        prompt: "jangan sampe lupa juga ya kode pos nya"
                    },
                    {
                        type: "maxLength[5]",
                        prompt: "Emang ada kode pos lebih dari 5 digit ya?"
                    },
                    {
                        type: "minLength[5]",
                        prompt: "Perasaan gak ada deh kodepos di bawah 5 digit"
                    }
                ]
            },
            alamat: {
                identifier: "alamat",
                rules: [
                    {
                        type: "empty",
                        prompt: "Yakali yang beginian juga kelupaan diisi"
                    },
                    {
                        type: "minLength[8]",
                        prompt: "Ni bener gak nih ngisi alamatnya? Pendek amat."
                    }
                ]
            },
            sk: {
                identifier: "sk",
                rules: [
                    {
                        type: "checked",
                        prompt: "Jangan lupa dicentang dong ah"
                    }
                ]
            }
        }
    });

    $("#forgot-password").form({
        inline: true,
        on: "blur",
        fields: {
            email: {
                identifier: "emailForgot",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan sampe kosong ya emailnya"
                    },
                    {
                        type: "email",
                        prompt: "Format emailnya kurang tepat deh kayaknya, tuh."
                    }
                ]
            }
        }
    });




    $("#forgot-password .forgot.button").on("click", function(e) {
        e.preventDefault();
        $(this).addClass("loading");
        $(".ui.dimmer").dimmer("show").dimmer({
            onChange: function() {
                $("#forgot-password .forgot.button").removeClass("loading");
            },
            onHide: function() {
                $("#emailForgot").slideUp(100);
                $("#forgot-password label").slideUp(100);
                $("#forgot-password .forgot.button").slideUp(100);
                $("#forgot-password .direct").slideDown(200);
                $(".ui.prompt").slideUp(100);
            }
        });
    });



    const toggleButton = document.querySelector(".add-to-cart.black.button");

    $(".add-to-cart.black.button").on("click", function() {
        $(this).addClass("loading");

        setTimeout(function() {
            toggleButton.classList += " active";
            toggleButton.innerHTML = "<i class='heart icon'></i> Berhasil ditambah ke Keranjang";
            toggleButton.classList.remove("loading");
            $(".ui.message.added-to-cart").transition("slide", 200);
        }, 3000);

    });

    $(".product-detail .add-to-wishlist").on("click", function() {
        $(".ui.message.added-to-wishlist").transition("slide", 200);
        $(this).addClass("disabled");
        $(this).text("Sudah berhasil ditambah");
    });

    $(".ui.message.added-to-cart .close").on("click", function() {
        $(this).closest(".ui.message.added-to-cart").transition("scale", 200);
        console.log(this);
    });

    $(".ui.message.added-to-wishlist .close").on("click", function() {
        $(this).closest(".ui.message.added-to-wishlist").transition("scale", 200);
        console.log(this);
    });


    const $cartItem = $(".cart-item");
    const $arrCartItem = $.makeArray($cartItem);
    const $deleteButton = $(".cart-item .delete-item");
    const value = 1;
    const index = $.inArray(value, $arrCartItem);
    // jQuery.isArray($arrCartItem);

    $deleteButton.on("click", function() {
        console.log("Popped!");
        console.log(index);
        $arrCartItem.splice(index, 1);
    });

    $(".delete-all").on("click", function() {

        $(".ui.modal.delete-cart").modal({
            closable: false,
            blurring: true,
            duration: 200,
            transition: "fade up",
            onApprove: function() {
                $(".cart-item").slideUp(200, function() {
                    $(".cart-empty").slideDown(400);
                    $(".cart-total").slideUp(200);
                });
                $(".delete-all").addClass("disabled");
                $(".checkout.button").addClass("disabled");
            }
        }).modal("show");

    });



    $(".ui.dropshipper").on("click", function() {
        console.log("Kok gak keluar?");
        $("#dropshipper-field").transition("slide", 200);
    });

    $(".ui.checkbox").each(function() {
        $(this).on("click", function() {
            $(this).find(".checked").closest(".ui.segment").css("background-color", "#444");
            console.log(this);
        });
    });

    $("#shipping-address").form({
        inline: true,
        on: "submit",
        fields: {
            name: {
                identifier: "nama",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin namanya ya"
                    },
                    {
                        type: "minLength[5]",
                        prompt: "Kurang panjang tuh namanya"
                    },
                    {
                        type: "containsExactly[ ]",
                        prompt: "Nama belakangnya udah belum?"
                    }
                ]
            },
            email: {
                identifier: "email",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin emailnya ya"
                    },
                    {
                        type: "regExp[/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/]",
                        prompt: "Udah bener emangnya format emailnya tuh?"
                    }
                ]
            },
            handphone: {
                identifier: "handphone",
                on: "submit",
                rules: [
                    {
                        type: "empty",
                        prompt: "Hayooo, nomer handphone nya, mas!"
                    },
                    {
                        type: "integer",
                        prompt: "Nomer hape gak ada yang make huruf deh perasaan"
                    },
                    {
                        type: "minLength[8]",
                        prompt: "Nggak kurang tu nomernya? Dikit amat perasaan"
                    }
                ]
            },
            telepon: {
                identifier: "telepon",
                optional: true,
                rules: [
                    {
                        type: "empty",
                        prompt: "Hayooo, nomer telepon nya, mas!"
                    }
                ]
            },
            kodepos: {
                identifier: "kodepos",
                rules: [
                    {
                        type: "empty",
                        prompt: "jangan sampe lupa juga ya kode pos nya"
                    },
                    {
                        type: "maxLength[5]",
                        prompt: "Emang ada kode pos lebih dari 5 digit ya?"
                    },
                    {
                        type: "minLength[5]",
                        prompt: "Perasaan gak ada deh kodepos di bawah 5 digit"
                    }
                ]
            },
            alamat: {
                identifier: "alamat",
                rules: [
                    {
                        type: "empty",
                        prompt: "Yakali yang beginian juga kelupaan diisi"
                    },
                    {
                        type: "minLength[8]",
                        prompt: "Ni bener gak nih ngisi alamatnya? Pendek amat."
                    }
                ]
            }
        },
        onSuccess: function(e) {
            e.preventDefault();
            $(this).closest("#step-shipping").transition("slide", 300);
            $("#step-billing").transition("slide", 200);
        }
    });

    // $("#shipping-address").on("submit", function(e) {
    //     // $("#shipping-address").closest("#step-shipping").transition("slide", 300);
    //     console.log(this);
    // });


    $(".ui.sticky").sticky({
        offset: 50
    });

    $(".ui.accordion.payment-option").accordion();



});
