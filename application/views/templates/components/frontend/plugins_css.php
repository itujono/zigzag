<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
if ($plugins == 'home') {
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/owl.css">
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/main.css">
    <link rel="stylesheet" href="<?php echo base_url().$this->data['asfront'];?>css/responsive.css">
    
<?php
} elseif ($plugins == 'general_addon') {
?>

<?php } ?>