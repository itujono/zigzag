<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/main.css">
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/responsive.css">
<?php
if ($plugins == 'home') {
?>
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/owl.css">
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/owl.theme.default.min.css">  
<?php
} elseif ($plugins == 'product-detail') {
?>
	<link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/owl.css">
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/owl.theme.default.min.css">
<?php } ?>
