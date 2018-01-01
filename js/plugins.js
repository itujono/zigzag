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

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());


var loginForm = $(".login .ui.form");



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

    $(".ui.deposit .learn-more").popup({
        inline: true,
        hoverable: false,
        // position: 'center right'
    });

    $(".login-trigger").on("click", function() {
        $(".ui.modal.login").modal({
            blurring: true,
            allowMultiple: false,
            autofocus: false,
            duration: 200,
            transition: "fade up",
            onHidden: function() {
                loginForm.form("clear");
                console.log(loginForm);
            }
        }).modal('show');

        $(".ui.modal.register").modal({
            duration: 200,
            transition: "fade up",
            blurring: true
        }).modal("attach events", ".signup-link a");

        $(".ui.modal.login").modal("attach events", ".login-link a");
    });

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


    $("#forgot-password .button").on("click", function(e) {
        e.preventDefault();
        $(this).addClass("loading");
        setTimeout(function() {
            $(".ui.dimmer").dimmer("show").dimmer({
                // onHide: function() {
                //     alert("sempardak ugak!");
                // }
            });
            $("#forgot-password .button").removeClass("loading");
        }, 1500);
    });



    var toggleButton = document.querySelector(".add-to-cart.black.button");

    $(".add-to-cart.black.button").on("click", function() {
        $(this).addClass("loading");

        setTimeout(function() {
            toggleButton.classList += " active";
            toggleButton.innerHTML = "<i class='heart icon'></i> Berhasil ditambah ke Keranjang";
            toggleButton.classList.remove("loading");
            $(".ui.message.added-to-cart").transition("slide", 200);
        }, 3000);

    });

    $(".add-to-wishlist").on("click", function() {
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


    var $cartItem = $(".cart-item");
    var $arrCartItem = $.makeArray($cartItem);
    var $deleteButton = $(".cart-item .delete-item");
    var value = 1;
    var index = $.inArray(value, $arrCartItem);
    // jQuery.isArray($arrCartItem);

    $deleteButton.on("click", function() {
        console.log("Popped!");
        console.log(index);
        $arrCartItem.splice(index, 1);
    });

    // $(".cart-item .delete-item").on("click", function() {
    //     $(this).closest(".cart-item").splice(0,1);
    //     if (arrCartItem.length === -1) {
    //         console.log("True deh");
    //         $(".cart-empty").transition("slide", 200);
    //     }
    // });

    $(".delete-all").on("click", function() {

        $(".ui.modal.delete-cart").modal({
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


});
