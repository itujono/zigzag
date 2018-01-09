<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<?php
if ($plugins == 'home') { ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/plugins.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>
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
	</script>
<?php } ?>