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
    });
    
    $(".ui.message.added-to-wishlist .close").on("click", function() {
        $(this).closest(".ui.message.added-to-wishlist").transition("scale", 200);
    });
    
    
    const $cartItem = $(".cart-item");
    const $arrCartItem = $.makeArray($cartItem);
    const $deleteButton = $(".cart-item .delete-item");
    const value = 1;
    const index = $.inArray(value, $arrCartItem);
    const searchDropdown = $("#shipping-address .search.dropdown");
	
	


    
    $deleteButton.on("click", function() {
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
        $("#dropshipper-field").transition("slide", 200);
    });
    
    $(".ui.checkbox").each(function() {
        $(this).on("click", function() {
            $(this).find(".checked").closest(".ui.segment").css("background-color", "#444");
        });
	});



	const defaultAddress = $("#default-address")
	
	if (defaultAddress.hasClass("checked")) {
		$(".fields.will-hidden").css("display", "none")
	}
    
    $("#shipping-address").form({
        // inline: true,
        // on: "submit",
        // fields: {
        //     name: {
        //         identifier: "nama",
        //         rules: [
        //             {
        //                 type: "empty",
        //                 prompt: "Jangan dikosongin namanya ya"
        //             },
        //             {
        //                 type: "minLength[5]",
        //                 prompt: "Kurang panjang tuh namanya"
        //             },
        //             {
        //                 type: "containsExactly[ ]",
        //                 prompt: "Nama belakangnya udah belum?"
        //             }
        //         ]
        //     },
        //     email: {
        //         identifier: "email",
        //         rules: [
        //             {
        //                 type: "empty",
        //                 prompt: "Jangan dikosongin emailnya ya"
        //             },
        //             {
        //                 type: "regExp[/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/]",
        //                 prompt: "Udah bener emangnya format emailnya tuh?"
        //             }
        //         ]
        //     },
        //     handphone: {
        //         identifier: "handphone",
        //         on: "submit",
        //         rules: [
        //             {
        //                 type: "empty",
        //                 prompt: "Hayooo, nomer handphone nya, mas!"
        //             },
        //             {
        //                 type: "integer",
        //                 prompt: "Nomer hape gak ada yang make huruf deh perasaan"
        //             },
        //             {
        //                 type: "minLength[8]",
        //                 prompt: "Nggak kurang tu nomernya? Dikit amat perasaan"
        //             }
        //         ]
        //     },
        //     telepon: {
        //         identifier: "telepon",
        //         optional: true,
        //         rules: [
        //             {
        //                 type: "empty",
        //                 prompt: "Hayooo, nomer telepon nya, mas!"
        //             }
        //         ]
        //     },
        //     kodepos: {
        //         identifier: "kodepos",
        //         rules: [
        //             {
        //                 type: "empty",
        //                 prompt: "jangan sampe lupa juga ya kode pos nya"
        //             },
        //             {
        //                 type: "maxLength[5]",
        //                 prompt: "Emang ada kode pos lebih dari 5 digit ya?"
        //             },
        //             {
        //                 type: "minLength[5]",
        //                 prompt: "Perasaan gak ada deh kodepos di bawah 5 digit"
        //             }
        //         ]
        //     },
        //     alamat: {
        //         identifier: "alamat",
        //         rules: [
        //             {
        //                 type: "empty",
        //                 prompt: "Yakali yang beginian juga kelupaan diisi"
        //             },
        //             {
        //                 type: "minLength[8]",
        //                 prompt: "Ni bener gak nih ngisi alamatnya? Pendek amat."
        //             }
        //         ]
        //     }
        // },
        onSuccess: function(e) {
            e.preventDefault();
            $(this).closest("#step-shipping").transition("fade", 150, function() {
                $("#step-billing").transition("fade", 150);
            });
        }
    });
    
    $(".back-to-previous").on("click", function(e) {
        e.preventDefault()
        $(this).parents("#step-billing").transition("fade", 150, function() {
            $(this).siblings("#step-shipping").transition("fade", 150)
        })
    })

    $("#payment-option").form({
        onSuccess: e => {
            e.preventDefault()
            $(this).find("#billing").addClass("loading")
            setTimeout(() => {
                $("#payment-option").find("#billing").removeClass("loading")
                $("#payment-option").parents("#step-billing").transition("fade", 150, () => {
                    $("#step-billing").siblings("#step-confirm").transition("fade", 150)
                })
            }, 1000)
        }
    })
    
    $("table .checkout.button").on("click", orderFinished)
    
    $("#cart-total .checkout.button").on("click", orderFinished)
	
	function orderFinished() {
		$(".ui.modal.confirm-order").modal({
            closable: false, blurring: true, duration: 200,
            transition: "fade up",
            onApprove: e => { window.location = "order-done.html" }
        }).modal("show")
	}

    
    $(".ui.sticky").sticky({
        offset: 50
    })
    
    $(".ui.accordion.payment-option").accordion()
    
    
    $("#confirmation-form").form({
        inline: true,
        on: "submit",
        fields: {
            nomor: {
                identifier: "nomorOrder",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin nomernya ya"
                    },
                    {
                        type: "minLength[5]",
                        prompt: "Kurang panjang tuh namanya"
                    }
                ]
            },
            namaRekeningPengirim: {
                identifier: "namaRekeningPengirim",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin namanya ya"
                    }
                ]
            },
            nomorRekeningPengirim: {
                identifier: "nomorRekeningPengirim",
                on: "submit",
                rules: [
                    {
                        type: "empty",
                        prompt: "Hayooo, nomer rekeningnya nya, mas!"
                    },
                    {
                        type: "integer",
                        prompt: "Nomer rekening gak ada yang make huruf deh perasaan"
                    },
                    {
                        type: "minLength[8]",
                        prompt: "Nggak kurang tu nomernya? Dikit amat perasaan"
                    }
                ]
            },
            dropdown: {
                identifier: "bankRekeningPengirim",
                rules: [
                    {
                        type: "empty",
                        prompt: "Pilih bank nya jangan lupa ya"
                    }
                ]
            },
            nominalTransfer: {
                identifier: "nominalTransfer",
                rules: [
                    {
                        type: "empty",
                        prompt: "Hayooo, berapa yang ditransfer tadi, sis? Kok gak diisi?"
                    }
                ]
            },
            persetujuan: {
                identifier: "persetujuan",
                rules: [
                    {
                        type: "checked",
                        prompt: "Kamu harus centang dulu ya"
                    }
                ]
            }
        },
        onSuccess: function(e) {
            e.preventDefault()
            $("#confirmation-form .zz.button").addClass("loading")
            setTimeout(function() {
                $(".ui.page.dimmer").dimmer("show").dimmer({
                    onHide: function() {
                        console.log(this)
                        window.location = "/"
                    }
                })
            }, 2000)
            $(this).form("clear")
        }
    })
    
    
    $("#retur-form").form({
        inline: true,
        on: "submit",
        fields: {
            nomor: {
                identifier: "nomorOrder",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin nomernya ya"
                    },
                    {
                        type: "minLength[5]",
                        prompt: "Kurang panjang tuh namanya"
                    }
                ]
            },
            merkBarang: {
                identifier: "merkBarang",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin merk nya ya"
                    }
                ]
            },
            kodeBarang: {
                identifier: "kodeBarang",
                rules: [
                    {
                        type: "empty",
                        prompt: "Kode barangnya juga penting nih, sis"
                    }
                ]
            },
            alasanRetur: {
                identifier: "alasanRetur",
                rules: [
                    {
                        type: "empty",
                        prompt: "Kami perlu alasan logisnya, jangan bikin marah ya!"
                    },
                    {
                        type: "minLength[10]",
                        prompt: "Kurang panjang alasannya. Yang deskriptif dikit ngapa?"
                    }
                ]
            },
            persetujuan: {
                identifier: "persetujuan",
                rules: [
                    {
                        type: "checked",
                        prompt: "Kamu harus centang dulu ya"
                    }
                ]
            }
        },
        onSuccess: function(e) {
            e.preventDefault();
            $("#retur-form .zz.button").addClass("loading");
            setTimeout(function() {
                $(".ui.page.dimmer").dimmer("show").dimmer({
                    onHide: function() {
                        window.location = "/";
                    }
                });
            }, 2000);
            $(this).form("clear");
        }
    });
    
    
    $(".profile-content .item").tab();


    $(".move-to-cart").on("click", function() {
        $(this).parents(".item").slideUp(150);
    });

    $(".remove-from-wishlist").on("click", function(e) {
        e.preventDefault();
        $(this).parents(".item").slideUp(150);
    });

    $(".move-all-to-cart").on("click", function() {
        $("#wishlist .items > .item").slideUp(150);
        $(".ui.message.moved-to-cart").slideDown(150);
    });


    $("#order-history .item-list .more").on("click", function(e) {
        const el = $(this);
        e.preventDefault();
        el.text() == el.data("text-swap") ? el.text("Selengkapnya") : el.text(el.data("text-swap"));
        el.parents("ul").siblings(".content-detail").transition("slide", 150);
    });

    $("#retur-history .item-list .more").on("click", function(e) {
        const el = $(this);
        e.preventDefault();
        el.text() == el.data("text-swap") ? el.text("Selengkapnya") : el.text(el.data("text-swap"));
        el.parents("ul").siblings(".content-detail").transition("slide", 150);
    });



    $(".change-password").form({
        inline: true,
        on: "submit",
        fields: {
            newPassword: {
                identifier: "newPassword",
                rules: [
                    {
                        type: "empty",
                        prompt: "Jangan dikosongin password nya ya"
                    },
                    {
                        type: "minLength[6]",
                        prompt: "Kurang panjang tuh password nya"
                    }
                ]
            },
            repeatNewPassword: {
                identifier: "repeatNewPassword",
                rules: [
                    {
                        type: "empty",
                        prompt: "Nah yang ini kok dikosongin juga?"
                    },
                    {
                        type: "match[newPassword]",
                        prompt: "Kayaknya nggak sama deh sama yang diketik di atas"
                    }
                ]
            },
            oldPassword: {
                identifier: "oldPassword",
                rules: [
                    {
                        type: "empty",
                        prompt: "Nah yang ini kok dikosongin juga? Duh!"
                    }
                ]
            },
        },
        onSuccess: function(e) {
            e.preventDefault();
            $(".confirmation-change-password").modal({
                closable: false,
                blurring: true,
                onApprove: function() {
                    $(".change-password").form("clear");
                    $(".change-password").transition("slide", 150);
                    $(".password-changed").css("display", "flex");
                    setTimeout(function() {
                        $(".change-password").transition("slide", 200)
                        $(".password-changed").css("display", "none");
                    }, 3000);
                }
            }).modal("show");
        }
    });




    const editable = $(".editable");

    editable.on("click", function(e) {
        e.preventDefault();
        $(this).addClass("disabled");
        $(this).siblings("ul").transition("fade", 100, function() {
            $(this).siblings("form").transition("fade", 100);
        });
        $(this).siblings(".will-edit").fadeOut(100, function() {
            $(this).siblings("form").transition("fade", 100);
        });
    });
    
    $(".button.cancel").on("click", function(e) {
        e.preventDefault();
        $(this).parents("form").form("clear").siblings(".editable").removeClass("disabled");
        $(this).parents("form").transition("fade", 100, function() {
            $(this).siblings("ul").transition("fade", 100);
        });
        $(this).parents("form").siblings(".will-edit").fadeIn(100);
    });

    $("form.inline-editable.general-info").form({
        inline: true,
        on: "submit",
        fields: {
            inlineName: {
                identifier: "inline-name",
                rules: [
                    { type: "empty", prompt: "Wajid diisi" }
                ]
            },
            inlineLocation: {
                identifier: "inline-location",
                rules: [
                    { type: "empty", prompt: "Ini juga jangan kosong ya" }
                ]
            }
        },
        onSuccess: function() {
            // Okay hajar di sini AJAX nya wak!
        }
    });

    $("form.inline-editable.contact").form({
        inline: true,
        on: "submit",
        fields: {
            inlineEmail: {
                identifier: "inline-email",
                rules: [
                    { type: "empty", prompt: "Wajid diisi" }
                ]
            },
            inlinePhone: {
                identifier: "inline-phone",
                rules: [
                    { type: "empty", prompt: "Ini juga jangan kosong ya" }
                ]
            }
        },
        onSuccess: function() {
            // Okay hajar di sini AJAX nya wak!
        }
    });
    
    $("form.inline-editable.alamat").form({
        inline: true,
        on: "submit",
        fields: {
            inlineAddress: {
                identifier: "inline-address",
                rules: [
                    { type: "empty", prompt: "Wajid diisi" },
                    { type: "minLength[8]", prompt: "Kependekan deh kayaknya" }
                ]
            }
        },
        onSuccess: function() {
            // Okay hajar di sini AJAX nya wak!
        }
    });
    
    $("form.inline-editable.social").form({
        inline: true,
        on: "submit",
        fields: {
            inlineFacebook: {
                identifier: "inline-facebook",
                rules: [
                    { type: "empty", prompt: "Wajid diisi" }
                ]
            },
            inlineInstagram: {
                identifier: "inline-instagram",
                rules: [
                    { type: "empty", prompt: "Ini juga jangan kosong ya" }
                ]
            }
        },
        onSuccess: function() {
            // Okay hajar di sini AJAX nya wak!
        }
    });
    
    
});
