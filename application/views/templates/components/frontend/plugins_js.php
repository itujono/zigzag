<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<?php
if ($plugins == 'home') { ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/owl.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/plugins.js"></script>
    <script src="<?php echo base_url().$this->data['asfront'];?>js/main.js"></script>

<?php
} elseif ($plugins == 'general_addon') {
?>

<?php } ?>
