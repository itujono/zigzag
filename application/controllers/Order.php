<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Frontend_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('Customer_m');
		$this->load->model('Order_m');
		$this->load->model('Order_confirmation_m');
	}

	public function confirmation(){
		$data['addONS'] = 'confirmation_order';
		$data['class'] = 'confirmation';
		$data['title'] = 'Konfirmasi Pembayaran - '.$this->session->userdata('Name');
		$id = $this->session->userdata('idCUSTOMER');
		if(empty($id) ){
			redirect('customer/logout');
		}
		$data['listkodeorder'] = $this->Order_confirmation_m->listkodeorder()->result();
			
		if(!empty($this->session->flashdata('message_confirmation'))) {
            $data['message_confirmation'] = $this->session->flashdata('message_confirmation');
        }

		$data['subview'] = $this->load->view($this->data['frontendDIR'].'confirmation', $data, TRUE);
		$this->load->view($this->data['rootDIR'].'_layout_base_frontend',$data);
	}

	public function load_price_total_order($kode){
	  $total = $this->Order_confirmation_m->get_total_price_order($kode)->row();
	  $data = '';
	  if(!empty($total)){
	  	$total_price = $total->totalekspedisiORDER+$total->subtotal;
        $data = "
        <label for='total yang harus dibayar'>Total yang harus anda dibayar</label>
        <p>Rp. ".number_format($total_price, 0,',','.')." <i class='check square green icon'></i></p>
        ";
	    echo $data;
	  } else {
	  	  $data = "
        <label for='total yang harus dibayar'>Total yang harus dibayar</label>
        <input type='text' name='total_price' value='Tidak ada tagihan yang harus anda bayarkan'>
        ";
	     echo $data;
	  }
	}

	public function process_confirmation(){
		$rules = $this->Order_confirmation_m->rules_order_confirmation;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh kosong');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('is_numeric', 'Hanya masukkan angka saja');
        $this->form_validation->set_error_delimiters('<p class="help">', '</p>');
		if ($this->form_validation->run() == TRUE) {
				$data = $this->Order_confirmation_m->array_from_post(array('kodeCONFIRM','bankCONFIRM','nameCONFIRM','rekeningCONFIRM','nominalCONFIRM','setujuCONFIRM'));
				if($data['setujuCONFIRM'] == 'on')$data['setujuCONFIRM']=1;
				else $data['setujuCONFIRM'] = 0;

				$nominal = $data['nominalCONFIRM'];
				$kode_confirm = $data['kodeCONFIRM'];
				$check_nominal = $this->Order_confirmation_m->get_total_price_order($kode_confirm)->row();
				$total_nominal = $check_nominal->totalekspedisiORDER+$check_nominal->subtotal;

				if($nominal > $total_nominal){
					$data = array(
						'title' => 'Gagal,',
						'text' => 'Maaf, silakan ulangi pengisian form nominal transfer anda berlebih.',
						'type' => 'error'
						);
					$this->session->set_flashdata('message_confirmation',$data);
					redirect('order/confirmation');
				} elseif ($nominal < $total_nominal) {
					$data = array(
						'title' => 'Gagal,',
						'text' => 'Maaf, silakan ulangi pengisian form nominal transfer anda kurang.',
						'type' => 'error'
						);
					$this->session->set_flashdata('message_confirmation',$data);
					redirect('order/confirmation');
				}

	   			$data = $this->security->xss_clean($data);
				$saveid = $this->Order_confirmation_m->save($data);

				//update status order setelah konfirmasi
				$getid = $this->Order_confirmation_m->get_idorder_from_kodeorder($kode_confirm)->row();
				$data_update['statusORDER'] = 3;
				$this->Order_m->save($data_update, $getid->idORDER);
				
				$subject = $saveid;
				$filenamesubject = 'file-confirmation-'.folenc($subject);
				if(!empty($_FILES['uploadBukti']['name'][0])) {
					$path = 'assets/upload/confirmation-file/'.$filenamesubject;
					if (!file_exists($path)){
		            	mkdir($path, 0777, true);
		        	}

					$config['upload_path']		= $path;
		            $config['allowed_types']	= 'jpg|png|jpeg';
		            $config['file_name']        = $this->security->sanitize_filename($filenamesubject);
		            $config['overwrite'] 		= TRUE;

			        $this->upload->initialize($config);

			        if ($this->upload->do_upload('uploadBukti')){
			        	$data['uploads'] = $this->upload->data();
			        }
			    }
            	$data = array(
					'title' => 'Berhasil,',
					'text' => 'Okay, terima kasih udah luangin waktunya, ya. <br> Kami akan segera memberi kabar begitu payment kamu berhasil kami verifikasi.',
					'type' => 'success'
					);
				$this->session->set_flashdata('message_confirmation',$data);
				redirect('order/confirmation');

		} else {
			$data = array(
				'title' => 'Gagal,',
				'text' => 'Maaf, silakan ulangi pengisian form Konfirmasi anda kembali.',
				'type' => 'error'
				);
			$this->session->set_flashdata('message_confirmation',$data);
			$this->confirmation();
		}
	}

}
