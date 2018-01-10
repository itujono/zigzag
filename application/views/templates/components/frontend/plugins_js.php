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
                        	console.log(this);
                    	}, 2000);
                    });
	        <?php } else { ?>
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
	    <?php } ?>
        });
    });
	// $(".additional-actions .add-to-cart").each(function() {
 //        $(this).on("click", function(e) {
 //            e.preventDefault();
 //            $(".additional-actions .add-to-cart .shopping.icon").transition("jiggle");
 //            setTimeout(function() {
 //                $(".ui.message.added-to-cart").transition({
 //                    onComplete: setTimeout(function() {
 //                        $(".ui.message.added-to-cart").transition("slide");
 //                    }, 4000)
 //                });
 //            }, 1000);
 //        });
 //    });
	</script>
<?php } elseif ($plugins == 'product-detail') { ?>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
	<script src="<?php echo base_url().$this->data['asfront'];?>js/cloud-zoom.js"></script>
<?php } ?>
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
	$('#detail_cart').load("<?php echo base_url();?>product/load_cart");
	//Hapus Item Cart
	$(document).on('click','.hapus_cart',function(){
		var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
		$.ajax({
			url : "<?php echo base_url();?>product/hapus_cart",
			method : "POST",
			data : {row_id : row_id},
			success :function(data){
				$('#hide_info').show();
				$('#detail_cart').html(data);
			}
		});
	});
</script>
