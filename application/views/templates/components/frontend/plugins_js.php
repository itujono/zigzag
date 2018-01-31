<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/plugins.js"></script>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>
<?php
if ($plugins == 'home') { ?>

    <script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
	<script type="text/javascript">
		$(".additional-actions .add-to-wishlist").each(function() {
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
	            console.log(this);
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
					                console.log(this);
									setTimeout(function() {
					                    $(".ui.message.added-to-wishlist").transition("slide", function() {
					                        setTimeout(function() {
					                            $(".ui.message.added-to-wishlist").transition("slide");
					                        }, 4000);
					                    });
					                }, 1000);
								} else {
									console.log(this);
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
 	$(document).ready(function(){
		$('.add_cart').click(function(){
			var idBARANG    = $(this).data("barangid");
			var nameBARANG  = $(this).data("barangnama");
			var priceBARANG = $(this).data("barangharga");
			var qtyBARANG     = $('#' + idBARANG).val();
			$.ajax({
				url : "<?php echo base_url();?>product/add_to_cart",
				method : "POST",
				data : {idBARANG: idBARANG, nameBARANG: nameBARANG, priceBARANG: priceBARANG, qtyBARANG: qtyBARANG},
				success: function(data){
					$('#hide_info').hide();
					$('#detail_cart').html(data);
				}
			});
		});
	});
	$(document).ready(function() {
	    $(".check-submit").click(function(e){
	    	e.preventDefault();
	    	var nameCUSTOMER = $("input[name='nameCUSTOMER']").val();
	    	var emailCUSTOMER = $("input[name='emailCUSTOMER']").val();
	    	var passwordCUSTOMER = $("input[name='passwordCUSTOMER']").val();
	    	var addressCUSTOMER = $("textarea[name='addressCUSTOMER']").val();
	    	var cityCUSTOMER = $("select[name='cityCUSTOMER']").val();
	    	var zipCUSTOMER = $("input[name='zipCUSTOMER']").val();
	    	var teleCUSTOMER = $("input[name='teleCUSTOMER']").val();
	    	var skCUSTOMER = $("input[name='skCUSTOMER']").val();
	        $.ajax({
	            url: "<?php echo base_url();?>customer/register",
	            type:'POST',
	            dataType: "json",
	            data: {nameCUSTOMER:nameCUSTOMER, emailCUSTOMER:emailCUSTOMER, passwordCUSTOMER:passwordCUSTOMER, addressCUSTOMER:addressCUSTOMER, cityCUSTOMER:cityCUSTOMER, zipCUSTOMER:zipCUSTOMER, teleCUSTOMER:teleCUSTOMER, skCUSTOMER:skCUSTOMER},
	            success: function(data) {
	            	if(data.status == "success"){
	                	$(".print-error-msg").css('display','none');
	                	window.location.href = data.redirect;
	                }else{
						$(".print-error-msg").css('display','block');
	                	$(".print-error-msg").html(data.message);
	                }
	            }
	        })
	    });
	});
	</script>
<?php } elseif ($plugins == 'product-detail') { ?>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/cloud-zoom.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(){
			var idBARANG    = $(this).data("barangid");
			var nameBARANG  = $(this).data("barangnama");
			var priceBARANG = $(this).data("barangharga");
			var qtyBARANG     = $('#' + idBARANG).val();
			$.ajax({
				url : "<?php echo base_url();?>product/add_to_cart",
				method : "POST",
				data : {idBARANG: idBARANG, nameBARANG: nameBARANG, priceBARANG: priceBARANG, qtyBARANG: qtyBARANG},
				success: function(data){
					$('#hide_info').hide();
					$('#detail_cart').html(data);
				}
			});
		});
	});
	<?php 
	$checkwishlist = checkwishlist($getbarang->idBARANG);
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
<?php
} elseif ($plugins == 'search-product') {
?>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.add_cart').click(function(){
			var idBARANG    = $(this).data("barangid");
			var nameBARANG  = $(this).data("barangnama");
			var priceBARANG = $(this).data("barangharga");
			var qtyBARANG     = $('#' + idBARANG).val();
			$.ajax({
				url : "<?php echo base_url();?>product/add_to_cart",
				method : "POST",
				data : {idBARANG: idBARANG, nameBARANG: nameBARANG, priceBARANG: priceBARANG, qtyBARANG: qtyBARANG},
				success: function(data){
					$('#hide_info').hide();
					$('#detail_cart').html(data);
				}
			});
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
			data : {row_id : row_id},
			success :function(data){
				$('#detail_cart').html(data);
				$('#hide_info').show();
			}
		});
	});
</script>
