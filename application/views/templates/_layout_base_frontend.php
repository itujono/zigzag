<?php $data['plugins']=$addONS; ?>
<?php $datas['addons'] = $this->load->view('templates/components/frontend/plugins_css', $data ,TRUE); ?>
<?php $this->load->view('templates/components/frontend/header', $datas); ?>

<?php echo $subview; ?>

<?php $datas['plugins'] = $this->load->view('templates/components/frontend/plugins_js', $data ,TRUE); ?>
<?php $this->load->view('templates/components/frontend/footer',$datas); ?>