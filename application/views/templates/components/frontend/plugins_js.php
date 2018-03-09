<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/plugins.js"></script>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>
	
<?php
if ($plugins == 'home') { ?>

    <script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>

	<script type="text/javascript">
		$(".add-to-wishlist").on("click", function(e) {

		<?php if(empty($this->session->userdata('idCUSTOMER'))){ ?>
			// todo: Bikin modal login aja kalo belum login!!!
			const notLoggedIn = $(".ui.message.not-login");
			
			$(".add-to-wishlist").transition("jiggle")
			$(".add-to-wishlist").find('.empty.heart').addClass('empty')
			$(".ui.message.not-login").transition("slide", displayTimedMessage(notLoggedIn))
			
			<?php } else { ?>
			const heartIcon = $(".add-to-wishlist").find(".heart.icon");

			if (heartIcon.hasClass("empty")) {
				const idBARANG = $(this).data("idbarang");
				const itemData = {
					'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
					idBARANG
				}

				$.ajax({
					url : "<?php echo base_url();?>product/wish",
					method : "POST",
					dataType: "json",
					data : itemData,
					success: data => {
						if(data.status == "success") {
							const addedToWishlist = $(".ui.message.added-to-wishlist");

							heartIcon.transition("jiggle").removeClass("empty").css("color", "#f92626");
							$(".ui.message.added-to-wishlist").transition("slide", displayTimedMessage(addedToWishlist))
						}
					}
				});
			} else {
				const removedFromWishlist = $(".ui.message.removed-from-wishlist");

				heartIcon.transition("jiggle").addClass("empty").css("color", "#fff");
				$(".ui.message.removed-from-wishlist").transition("slide", displayTimedMessage(removedFromWishlist))
			}
			e.preventDefault()

		<?php } ?>
		})

		
		$("form.deposit").form({
			inline: true,
			on: "submit",
			onSuccess: function(e) {
				const amount_deposit_option = $("#amount_deposit_option").val()
				
				if(amount_deposit_option != ''){
					amountDEPOSIT = $("#amount_deposit_option").val()
				} else {
					amountDEPOSIT = $("#amount_deposit_number").val()
				}

				const formData = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', amountDEPOSIT }
				console.log(formData);
				$(this).find("button.submit").addClass("loading")
				$.ajax({
					url: "<?php echo base_url();?>customer/process_deposit",
					type:'POST',
					dataType: "json",
					data: formData,
					success: response => {
						$(this).find("button.submit").removeClass("loading")
						$(this).siblings(".print-notlogin-msg-deposit").css("display", "none")
						$(this).siblings(".print-success-msg-deposit").css("display", "block")
						$(this).siblings(".print-error-msg-deposit").css('display','none')
						$(this).siblings(".print-notsave-msg-deposit").css('display','none')
	
						if (response.status == "error_validation") {
							$(this).find("button.submit").removeClass("loading")
							$(this).siblings(".print-notlogin-msg-deposit").css("display", "none")
							$(this).siblings(".print-notsave-msg-deposit").css('display','none')
							$(this).siblings(".print-success-msg-deposit").css('display','none')
							$(this).siblings(".print-error-msg-deposit").css('display','block')
							$(this).siblings(".print-error-msg-deposit").html(response.message)
							return false
						}
	
						if (response.status == "notsave") {
							$(this).find("button.submit").removeClass("loading")
							$(this).siblings(".print-notlogin-msg-deposit").css("display", "none")
							$(this).siblings(".print-success-msg-deposit").css("display", "none")
							$(this).siblings(".print-error-msg-deposit").css('display','none')
							$(this).siblings(".print-notsave-msg-deposit").css('display','block')
							return false
						}
						if (response.status == "not_login") {
							$(this).find("button.submit").removeClass("loading")
							console.log('kampret');
							$(this).siblings(".print-notlogin-msg-deposit").css("display", "block")
							$(this).siblings(".print-success-msg-deposit").css("display", "none")
							$(this).siblings(".print-error-msg-deposit").css('display','none')
							$(this).siblings(".print-notsave-msg-deposit").css('display','none')
							return false
						}
					}
				})
				e.preventDefault()				
			}
	    })

		$('.add_cart').on("click", function(e){
			const idBARANG    = $(this).data("barangid");
			const nameBARANG  = $(this).data("barangnama");
			const priceBARANG = $(this).data("barangharga");
			const weightBARANG = $(this).data("barangberat");
			const stockBARANG = $(this).data("stokbarang");
			const qtyBARANG     = $('#' + idBARANG).val();
			const itemBarang = {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				idBARANG, nameBARANG, priceBARANG, qtyBARANG, weightBARANG, stockBARANG
			}

			$.ajax({
				url : "<?php echo base_url();?>/product/add_to_cart",
				method : "POST",
				data : itemBarang,
				success: data => { $('#detail_cart').html(data) }
			});

			e.preventDefault();
		});
		
		$(".check-submit").click(function(e){
			const nameCUSTOMER = $("input[name='nameCUSTOMER']").val()
			const emailCUSTOMER = $("input[name='emailCUSTOMER']").val()
			const passwordCUSTOMER = $("input[name='passwordCUSTOMER']").val()
			const addressCUSTOMER = $("textarea[name='addressCUSTOMER']").val()
			const provinceCUSTOMER = $("select[name='provinceCUSTOMER']").val()
			const cityCUSTOMER = $("select[name='cityCUSTOMER']").val()
			const zipCUSTOMER = $("input[name='zipCUSTOMER']").val()
			const teleCUSTOMER = $("input[name='teleCUSTOMER']").val()
			const skCUSTOMER = $("input[name='skCUSTOMER']").val()
			const dataCustomer = {
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
				nameCUSTOMER, emailCUSTOMER, passwordCUSTOMER, addressCUSTOMER, provinceCUSTOMER, cityCUSTOMER, zipCUSTOMER, teleCUSTOMER, skCUSTOMER
			}

			$.ajax({
				url: "<?php echo base_url();?>customer/register",
				type:'POST',
				dataType: "json",
				data: dataCustomer,
				success: data => {
					if (data.status == "success") {
						window.location.href = data.redirect
						$(".print-error-msg").css('display','none')
						$(".ui.message.login-success").addClass("visible")
					} else {
						$(".print-error-msg").css('display','block')
						$(".print-error-msg").html(data.message)
					}
				}
			})
			e.preventDefault()
		});
		
		function displayTimedMessage(el) {
			setTimeout(function() { el.transition("slide"); }, 2000)
		}


	</script>




<?php } elseif ($plugins == 'product-detail') { ?>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/cloud-zoom.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(e){
			var idBARANG    = $(this).data("barangid");
			var nameBARANG  = $(this).data("barangnama");
			var priceBARANG = $(this).data("barangharga");
			var weightBARANG = $(this).data("barangberat");
			var stockBARANG = $(this).data("stokbarang");
			var qtyBARANG     = $('#' + idBARANG).val();
			$.ajax({
				url : "<?php echo base_url();?>product/add_to_cart",
				method : "POST",
				data : {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', idBARANG: idBARANG, nameBARANG: nameBARANG, priceBARANG: priceBARANG, qtyBARANG: qtyBARANG, weightBARANG: weightBARANG, stockBARANG: stockBARANG},
				success: function(data){
					$('#detail_cart').html(data);
				}
			});
			e.preventDefault();
		});
	});
	
	$(".add-to-wishlist").on("click", function(e) {
		const heartIcon = $(".add-to-wishlist").find(".heart.icon");
		e.preventDefault();

	<?php if(empty($this->session->userdata('idCUSTOMER'))){ ?>
		// todo: Bikin modal login aja kalo belum login!!!
		$(".add-to-wishlist").transition("jiggle");
		$(".add-to-wishlist").find('.empty.heart').addClass('empty');
		// Message belum login
		$(".ui.message.not-login").transition("slide", function() {
			setTimeout(function() {
				$(".ui.message.not-login").transition("slide");
			}, 2000);
		});
	<?php } else { ?>
		if (!heartIcon.hasClass("empty")) {
			var idBARANG = $(this).data("idbarang");
			console.log("Ketembak kok!");
			$.ajax({
				url : "<?php echo base_url();?>product/wish",
				method : "POST",
				dataType: "json",
				data : {idBARANG: idBARANG},
				success: function(data) {
					if(data.status == "success"){
						heartIcon.transition("jiggle").removeClass("empty").css("color", "#f92626");
						$(".ui.message.added-to-wishlist").transition("slide", function() {
							setTimeout(function() {
								$(".ui.message.added-to-wishlist").transition("slide");
							}, 2000);
						});
					} else {
						heartIcon.transition("jiggle").addClass("empty").css("color", "#fff");
						$(".ui.message.error-wishlist").transition("slide", function() {
							setTimeout(function() {
								$(".ui.message.error-wishlist").transition("slide");
								console.log(this);
							}, 2000);
						});
					}
				}
			});
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
<?php } ?>
});
	function genericSocialShare(url){
        window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
        return true;
    }
	function createFBShareLink(FBVars) {
	    // FBVars is app_id
	    var url = 'http://www.facebook.com/dialog/feed?app_id='+FBVars+
	    '&link=' + '<?php echo base_url(uri_string());?>' +
	    '&picture=' + '<?php echo $getbarang->imageBARANG;?>' +
	    '&name=' + encodeURIComponent('<?php echo $getbarang->nameBARANG;?>') +
	    '&description=' + encodeURIComponent('<?php echo word_limiter($getbarang->descBARANG,8);?>') +
	    '&redirect_uri=' + '<?php echo base_url(uri_string());?>' +
	    '&display=popup';
	    window.open(url,'feedDialog','toolbar=0,status=0,width=626,height=436');
	}
	$(".ShareFB").click(function(e) {
	    e.preventDefault();
	    createFBShareLink('539255253097727');
	});
	</script>
<?php
} elseif ($plugins == 'search-product') {
?>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(e){
			var idBARANG    = $(this).data("barangid");
			var nameBARANG  = $(this).data("barangnama");
			var priceBARANG = $(this).data("barangharga");
			var weightBARANG = $(this).data("barangberat");
			var stockBARANG = $(this).data("stokbarang");
			var qtyBARANG     = $('#' + idBARANG).val();
			$.ajax({
				url : "<?php echo base_url();?>product/add_to_cart",
				method : "POST",
				data : {idBARANG: idBARANG, nameBARANG: nameBARANG, priceBARANG: priceBARANG, qtyBARANG: qtyBARANG, weightBARANG: weightBARANG, stockBARANG: stockBARANG},
				success: function(data){
					$('#detail_cart').html(data);
				}
			});
			e.preventDefault();
		});
	});

	<?php
	if(!empty($searching)){
		foreach ($searching as $key => $val) {
			$checkwishlist[$key] = checkwishlist($val->idBARANG);
		}
	}
	if(!empty($checkwishlist)){ ?>
		$(".add-to-wishlist").transition("jiggle").removeClass("empty").css("color", "#f92626");
	<?php } else { ?>
		$(".add-to-wishlist").transition("jiggle").find(".heart.icon").addClass("empty").css("color", "#fff");
	<?php } ?>



	$(".add-to-wishlist").each(function() {
        $(this).on("click", function(e) {
        <?php if(empty($this->session->userdata('idCUSTOMER'))){ ?>
        		// todo: Bikin modal login aja kalo belum login!!!
            	$(".add-to-wishlist").transition("jiggle");
            	$(".add-to-wishlist").find('.empty.heart').addClass('empty');
            	// Message belum login
                $(".ui.message.not-login").transition("slide", function() {
                	setTimeout(function() {
                		$(".ui.message.not-login").transition("slide");
                	}, 2000);
                });
        <?php } else { ?>
            e.preventDefault();
            if ($(this).find(".heart.icon").hasClass("empty")) {
					var idBARANG    = $(this).data("idbarang");
					$.ajax({
						url : "<?php echo base_url();?>product/wish",
						method : "POST",
						dataType: "json",
						data : {idBARANG: idBARANG},
						success: function(data){
							if(data.status == "success"){
				                $(".add-to-wishlist").transition("jiggle").removeClass("empty").css("color", "#f92626");
								setTimeout(function() {
				                    $(".ui.message.added-to-wishlist").transition("slide", function() {
				                        setTimeout(function() {
				                            $(".ui.message.added-to-wishlist").transition("slide");
				                        }, 4000);
				                    });
				                }, 1000);
							} else {
								$(".add-to-wishlist").transition("jiggle").find(".heart.icon").addClass("empty").css("color", "#fff");
				                setTimeout(function() {
				                    $(".ui.message.error-wishlist").transition("slide", function() {
				                        setTimeout(function() {
				                            $(".ui.message.error-wishlist").transition("slide");
				                            console.log(this);
				                        }, 4000);
				                    });
				                }, 1000);
							}
						}
					});

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
	    <?php } ?>
        });
    });
	</script>



<?php } elseif ($plugins == 'account-customer') { ?>
<script src="<?php echo base_url().$this->data['asfront'];?>node_modules/feather-icons/dist/feather.min.js"></script>
<script type="text/javascript">

	feather.replace({
        "stroke-width": 1.5,
        "width": 24,
        "height": 24
	})

    $(document).ready(function() {

		function errorMessage(el, text) {
			return el.siblings(".print-error-msg-profile")
				.transition("fade", 150)
				.html(`<i class='close icon'></i> ${text}`)
		}

	    $("#upload_profile_picture_customer").on('submit', (function(e){
	        e.preventDefault();
	        $(this).find("button.submit").addClass("loading")
	        $.ajax({
	            url             : '<?php echo base_url();?>customer/save_profile_picture_customer',
	            type 			: 'POST',
	            data 			: new FormData(this),
	            mimeType		: "multipart/form-data",
	            contentType 	: false,  
                cache 			: false,  
                processData		: false,
	            success: response => {
					$(this).find("button.submit").removeClass("loading")				
					$(this).transition("fade", 100, () => {
						$(".profile-data").transition("fade", 100)
						$(".editable").removeClass("disabled")
					})
					$(this).siblings(".print-success-msg-profile").css("display", "block")
					$(this).siblings(".print-error-msg-profile").css('display','none')
					$(this).siblings(".print-notsave-msg-profile").css('display','none')

					if (response.status == "notuploaded") {
						$(".editable").removeClass("disabled")
						$(this).siblings(".print-error-msg-profile").css('display','block')
						$(this).siblings(".print-success-msg-profile").css('display','none')
						$(this).siblings(".print-error-msg-profile").html(response.message)
						return false
					}
				}
	        })
	        return false;
	    }))

	    $("form.inline-editable.general-info").form({
			inline: true,
			on: "submit",
			fields: {
				inlinename: {
					identifier: "inline-name",
					rules: [
						{ type: "empty", prompt: "Wajib diisi" }
					]
				},
				provinsi: {
					identifier: "provinsi",
					rules: [
						{ type: "empty", prompt: "Ini juga jangan kosong ya" }
					]
				},
				kota: {
					identifier: "kota",
					rules: [
						{ type: "empty", prompt: "Ini juga jangan kosong juga ya" }
					]
				}
			},
			onSuccess: function(e) {
				const name_customer = $("#name_customer").val()
				const inline_provinsi = $("#inline_provinsi").val()
				const inline_city = $("#inline_city").val()
				const formData = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', name_customer, inline_provinsi, inline_city }
				$(this).find("button.submit").addClass("loading")			

				if (name_customer == '') {
					errorMessage($('form.inline-editable.general-info'), "Nama tidak boleh kosong")
					return false
					$(this).find("button.submit").removeClass("loading")			
				}

				if (inline_provinsi == '') {
					errorMessage($('form.inline-editable.general-info'), "Provinsi tidak boleh kosong")
					return false
					$(this).find("button.submit").removeClass("loading")			
				}

				if (inline_city == '') {
					errorMessage($('form.inline-editable.general-info'), "Kota tidak boleh kosong")
					return false
					$(this).find("button.submit").removeClass("loading")			
				}

				$.ajax({
					url: "<?php echo base_url();?>customer/save_data_customer",
					type:'POST',
					dataType: "json",
					data: formData,
					success: response => {
						$(this).find("button.submit").removeClass("loading")						
						$(this).transition("fade", 100, () => {
							$(".customer-data").transition("fade", 100)
							$(".name_customer").text(response.name_customer)
							$(".province_customer").text(response.inline_provinsi)
							$(".city_customer").text(response.inline_city)
							$(".editable").removeClass("disabled")
						})
						$(this).siblings(".print-success-msg-profile").css("display", "block")
						$(this).siblings(".print-error-msg-profile").css('display','none')
						$(this).siblings(".print-notsave-msg-profile").css('display','none')

						if (response.status == "error_validation") {
							$(".editable").removeClass("disabled")
							$(this).siblings(".print-notsave-msg-profile").css('display','none')
							$(this).siblings(".print-error-msg-profile").css('display','block')
							$(this).siblings(".print-success-msg-profile").css('display','none')
							$(this).siblings(".print-error-msg-profile").html(response.message)
							return false
						}
					}
				})
				e.preventDefault()
			}
		})

		// $(".form.inline-editable.contact button.cancel").on("click", function() {
		// 	$(this).siblings(".print-error-msg-profile").css('display','none');
		// })
		
		$("form.inline-editable.contact").form({
			inline: true,
			on: "submit",
			fields: {
				inlineEmail: {
					identifier: "inline-email",
					rules: [
						{ type: "empty", prompt: "Wajib diisi" }
					]
				},
				inlinePhone: {
					identifier: "inline-phone",
					rules: [
						{ type: "empty", prompt: "Ini juga jangan kosong ya" }
					]
				}
			},
			onSuccess: function(e) {
				const emailCUSTOMER = $("#emailCUSTOMER").val()
				const teleCUSTOMER = $("#teleCUSTOMER").val()
				const formData = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', emailCUSTOMER, teleCUSTOMER }
				$(this).find("button.submit").addClass("loading")			

				if (emailCUSTOMER == '') {
					errorMessage($('form.inline-editable.contact'), "Email tidak boleh kosong")
					return false
					$(this).find("button.submit").removeClass("loading")			
				}

				if (teleCUSTOMER == '') {
					errorMessage($('form.inline-editable.alamat'), "Nomor telepon tidak boleh kosong")
					return false
					$(this).find("button.submit").removeClass("loading")			
				}

				$.ajax({
					url: "<?php echo base_url();?>customer/save_email_tele_customer",
					type:'POST',
					dataType: "json",
					data: formData,
					success: response => {
						$(this).find("button.submit").removeClass("loading")						
						$(this).transition("fade", 100, () => {
							$(".contact-data").transition("fade", 100)
							$(".email-data").text(response.dataEmail)
							$(".tele-data").text(response.dataTele)
							$(".editable").removeClass("disabled")
						})
						$(this).siblings(".print-success-msg-profile").css("display", "block")
						$(this).siblings(".print-error-msg-profile").css('display','none')
						$(this).siblings(".print-notsave-msg-profile").css('display','none')

						if (response.status == "error_validation") {
							$(".editable").removeClass("disabled")
							$(this).siblings(".print-notsave-msg-profile").css('display','none')
							$(this).siblings(".print-error-msg-profile").css('display','block')
							$(this).siblings(".print-success-msg-profile").css('display','none')
							$(this).siblings(".print-error-msg-profile").html(response.message)
							return false
						}

						if (response.status == "notsave") {
							$(".editable").removeClass("disabled")
							$(this).siblings(".print-notsave-msg-profile").css('display','block')
							$(this).siblings(".print-error-msg-profile").css('display','none')
							$(this).siblings(".print-success-msg-profile").css('display','none')
							return false
						}
					}
				})
				e.preventDefault()
			}
		})

		// $("form.inline-editable.alamat button.cancel").on("click", function() {
		// 	$(this).parents("form").siblings(".print-error-msg-profile").transition("fade", 100)
		// })

	    $("form.inline-editable.alamat").form({
			inline: true,
			on: "submit",
			onSuccess: function(e) {
				const addressCUSTOMER = $("#addressCUSTOMER").val()
				const zipCUSTOMER = $("#zipCUSTOMER").val()
				const formData = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', addressCUSTOMER, zipCUSTOMER }

				$(this).find("button.submit").addClass("loading")

				if (addressCUSTOMER == '') {
					$(this).find("button.submit").removeClass("loading")
					errorMessage($('form.inline-editable.alamat'), "Alamat tidak boleh kosong")
					return false
				}

				if (zipCUSTOMER == '') {
					$(this).find("button.submit").removeClass("loading")
					errorMessage($('form.inline-editable.alamat'), "Kode pos tidak boleh kosong")
					return false
				}
				
				$.ajax({
					url: "<?php echo base_url();?>customer/save_address_zip_customer",
					type:'POST',
					dataType: "json",
					data: formData,
					success: response => {
						$(this).find("button.submit").removeClass("loading")
						$(this).transition("fade", 100, () => {
							$(".address").transition("fade", 100)
							$(".alamat-data").text(response.dataAddress)
							$(".zip-data").text(response.dataZip)
							$(".editable").removeClass("disabled")
						})
						$(this).siblings(".print-success-msg-profile").css("display", "block")
						$(this).siblings(".print-error-msg-profile").css('display','none')
						$(this).siblings(".print-notsave-msg-profile").css('display','none')
	
						if (response.status == "error_validation") {
							$(".editable").removeClass("disabled")
							$(this).siblings(".print-notsave-msg-profile").css('display','none')
							$(this).siblings(".print-error-msg-profile").css('display','block')
							$(this).siblings(".print-success-msg-profile").css('display','none')
							$(this).siblings(".print-error-msg-profile").html(response.message)
							return false
						}
	
						if (response.status == "notsave") {
							$(".editable").removeClass("disabled")
							$("form.inline-editable.alamat").siblings(".print-notsave-msg-profile").css('display','block')
							$("form.inline-editable.alamat").siblings(".print-error-msg-profile").css('display','none')
							$("form.inline-editable.alamat").siblings(".print-success-msg-profile").css('display','none')
							return false
						}
					}
				})
				e.preventDefault()				
			}
	    })

		// $("form.inline-editable.alamat button.cancel").on("click", function() {
		// 	$(this).parents("form").siblings(".print-error-msg-profile").transition("fade", 100)
		// })

	    $("form.inline-editable.social").form({
			inline: true,
			on: "submit",
			onSuccess: function(e) {
				const facebooknameSOCIAL = $("#facebooknameSOCIAL").val()
				const instagramnameSOCIAL = $("#instagramnameSOCIAL").val()
				const formData = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', facebooknameSOCIAL, instagramnameSOCIAL }

				$(this).find("button.submit").addClass("loading")

				if (facebooknameSOCIAL == '') {
					$("form.inline-editable.social").siblings(".print-error-msg-profile").transition("fade", 150).text("Username Facebook kamu tidak boleh kosong")
					return false			
				}

				if (instagramnameSOCIAL == '') {
					$("form.inline-editable.social").siblings(".print-error-msg-profile").transition("fade", 150).text("Kode pos tidak boleh kosong")
					return false					
				}
				
				$.ajax({
					url: "<?php echo base_url();?>customer/save_social_customer",
					type:'POST',
					dataType: "json",
					data: formData,
					success: response => {
						$(this).find("button.submit").removeClass("loading")
						$(this).transition("fade", 100, () => {
							$(".social-media").transition("fade", 100)
							$(".facebook-social").text(response.dataFb)
							$(".instagram-social").text(response.dataIg)
							$(".editable").removeClass("disabled")
						})
						$(this).siblings(".print-success-msg-profile").css("display", "block")
						$(this).siblings(".print-error-msg-profile").css('display','none')
						$(this).siblings(".print-notsave-msg-profile").css('display','none')
	
						if (response.status == "error_validation") {
							$(".editable").removeClass("disabled")
							$(this).siblings(".print-notsave-msg-profile").css('display','none')
							$(this).siblings(".print-error-msg-profile").css('display','block')
							$(this).siblings(".print-success-msg-profile").css('display','none')
							$(this).siblings(".print-error-msg-profile").html(response.message)
							return false
						}
	
						if (response.status == "notsave") {
							$(".editable").removeClass("disabled")
							$("form.inline-editable.alamat").siblings(".print-notsave-msg-profile").css('display','block')
							$("form.inline-editable.alamat").siblings(".print-error-msg-profile").css('display','none')
							$("form.inline-editable.alamat").siblings(".print-success-msg-profile").css('display','none')
							return false
						}
					}
				})
				e.preventDefault()				
			}
		})
		
		$('.add_cart').click(function(e){
			var idBARANG    = $(this).data("barangid");
			var nameBARANG  = $(this).data("barangnama");
			var priceBARANG = $(this).data("barangharga");
			var weightBARANG = $(this).data("barangberat");
			var stockBARANG = $(this).data("stokbarang");
			var qtyBARANG     = $('#' + idBARANG).val();
			var idWISH     = $('#idWISH').val();
			$.ajax({
				url : "<?php echo base_url();?>product/add_to_cart",
				method : "POST",
				data : {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', idBARANG: idBARANG, nameBARANG: nameBARANG, priceBARANG: priceBARANG, qtyBARANG: qtyBARANG, weightBARANG: weightBARANG, stockBARANG: stockBARANG},
				success: function(data){
					$('#wishlist_item').load("<?php echo base_url();?>customer/move_wish_list_to_cart/"+idWISH);
					$('#detail_cart').html(data);
				}
			});
			e.preventDefault();
		});

		$('.remove-wishlist').click(function(){
			var idWISH    = $(this).data("wishid");
			$.ajax({
				url : "<?php echo base_url();?>customer/move_wish_list_to_cart/"+idWISH,
				success: function(data){
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
		})

		$(".form.change-password").form({
	        inline: true,
	        on: "submit",
	        fields: {
	            password: {
	                identifier: "password",
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
	            repassword: {
	                identifier: "repassword",
	                rules: [
	                    {
	                        type: "empty",
	                        prompt: "Nah yang ini kok dikosongin juga?"
	                    },
	                    {
	                        type: "match[password]",
	                        prompt: "Kayaknya nggak sama deh sama yang diketik di atas"
	                    }
	                ]
	            },
	            oldpassword: {
	                identifier: "oldpassword",
	                rules: [
	                    {
	                        type: "empty",
	                        prompt: "Nah yang ini kok dikosongin juga? Duh!"
	                    }
	                ]
	            },
	        },
	        onSuccess: function(e) {
	            const oldpassword = $("#oldpassword").val()
	            const password = $("#password").val()
	            const repassword = $("#repassword").val()
	            const formData = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', oldpassword, password, repassword }
	            $.ajax({
	                url: "<?php echo base_url();?>customer/change_password_customer",
	                type:'POST',
	                dataType: "json",
	                data: formData,
	                success: response => {
	                    $(".change-password").form("clear");
	                    $(".change-password").transition("slide", 150);
	                    $(".password-changed").css("display", "flex");
	                    $(".password-not-same").css("display", "none");
	                    $(".password-error-validation").css('display','none');
	                    setTimeout(function() {
	                        $(".change-password").transition("slide", 200);
	                        $(".password-changed").css("display", "none");
	                    }, 3000);
	                    if (response.status == "error_validation_not_same") {
	                        $(".password-not-same").css("display", "block");
	                        $(".password-changed").css("display", "none");
	                        $(".password-error-validation").css('display','none');
	                        return false
	                    }
	                    if (response.status == "error") {
	                    	$(".password-not-same").css("display", "none");
	                    	$(".password-error-validation").css('display','none');
	                        $(".password-error").css("display", "block");
	                        $(".password-changed").css("display", "none");
	                        return false
	                    }
	                    if (response.status == "error_validation") {
	                    	$(".password-changed").css("display", "none");
	                    	$(".password-error").css("display", "none");
	                        $(".password-error-validation").css('display','block')
	                        $(".password-error-validation").html(response.message)
	                        return false
	                    }
	                }
	            })
	            e.preventDefault()
	        }
    	})
	})

</script>




<?php } elseif ($plugins == 'checkout-customer') {

	if(!empty($this->cart->contents())){
		foreach ($this->cart->contents() as $key => $val) {
			$weight_barang[$key] = $val['weight']*$val['qty'];
		}
	}
	$sum_weight = array_sum($weight_barang);
?>
<script type="text/javascript">
$(document).ready(function () {
<?php 
if(!empty($checkshipping_active)){
	foreach ($checkshipping_active as $keys_ship => $val_ship) {
?>
	$('#ekspedisi-shipping-<?php echo $keys_ship;?>').change(function() {
		const city_id = $("[name='city-checkout']").val()
		const city_id_default = $("[name='city_checkout_default']").val()
		if (city_id == '') {
			city_ids = city_id_default
		} else {
			city_ids = city_id
		}
		const ekspedisi = $(".ekspedisi_class:checked").val();
		const weight = "<?php echo $sum_weight;?>"
		const formData = {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', city_ids, ekspedisi, weight}
		
		$.ajax({
        	type : "POST",
       		url : "<?php echo base_url();?>product/checking_ongkir",
        	data : formData,
				success: function (data) {
				$("#detail_ekspedisi<?php echo $keys_ship;?>").html(data);
			}
      	});
	});
	<?php } ?>
<?php } ?>
});
</script>
<?php } elseif ($plugins == 'confirmation_order') { ?>
<script type="text/javascript">
$("#kode_order").change(function (){
    var url = "<?php echo base_url().'order/load_price_total_order/';?>"+$(this).val();
    $('#show_total').load(url);
    return false;
});
</script>
<?php } elseif ($plugins == 'return_barang') { ?>
<script type="text/javascript">
$("#kode_order_return").change(function (){
    const url = "<?php echo base_url().'customer/load_product_by_kode_order/';?>"+$(this).val();
    // $('#kode_barang_return').load(url);
    // return false;
    $.ajax({
		success: function(){
			$('#kode_barang_return').load(url);

			const kode_bar = $(".kode_barang option:selected").val();
			const url_func = "<?php echo base_url().'customer/load_qty_product_by_kode_barang/';?>"+kode_bar;
		    $('#qty_barang_return').load(url_func);
		    return false;
		}
	});
});
$("#kode_barang_return").change(function (){
    var url = "<?php echo base_url().'customer/load_qty_product_by_kode_barang/';?>"+$(this).val();
    $('#qty_barang_return').load(url);
    return false;
});
</script>
<?php } ?>
<script type="text/javascript">
	$('#detail_cart').load("<?php echo base_url();?>product/load_cart");
	//Hapus Item Cart
	$(document).on('click','.hapus_cart',function(){
		var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
		$.ajax({
			url : "<?php echo base_url();?>product/hapus_cart",
			method : "POST",
			data : {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', row_id : row_id},
			success :function(data){
				$('#detail_cart').html(data);
				$('#hide_info').css('display','block')
			}
		});
	});
	$(".logout-trigger").on("click", function(e) {
		$.ajax({
			url: "<?php echo base_url();?>customer/logout",
			method: "GET",
			success: function() {
				console.log("Hooray!")
				window.location.href = "<?php echo base_url();?>home"
			}
		})
		e.preventDefault()
	})
</script>
