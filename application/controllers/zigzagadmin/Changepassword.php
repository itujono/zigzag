<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends Admin_Controller {

	public function __construct (){
		parent::__construct();
		$this->load->model('User_m');
	}

	public function index(){
		$data['addONS'] = '';
	    if(!empty($this->session->flashdata('message'))) {
            $data['message'] = $this->session->flashdata('message');
        }
        record_activity('Mengunjungi Halaman Rubah Password');
		$data['subview'] = $this->load->view($this->data['backendDIR'].'changepassword', $data, TRUE);
		$this->load->view('templates/_layout_base',$data);
	}

	public function processchangepassword(){
		$ids = decode($this->input->post('idADMIN'));

		if(empty($ids)){
			$this->User_m->logout();
			redirect('Login');
		}

		$rules = $this->User_m->rules_changepassword;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', 'Form %s tidak boleh dikosongkan');
        $this->form_validation->set_message('trim', 'Form %s adalah Trim');
        $this->form_validation->set_message('min_length', 'Minimal 8 karakter');

	    if($this->form_validation->run() == TRUE) {

			$oldpassword = $this->User_m->hash($this->input->post('oldpassword'));
			$password = $this->User_m->hash($this->input->post('password'));
			$renewpassword = $this->User_m->hash($this->input->post('repassword'));

			if($password != $renewpassword){
				record_activity('Error katasandi baru tidak sama dengan form konfirmasi katasandi');
				$data = array(
		            'title' => 'Maaf!',
		            'text' => 'password baru kamu tidak sama dengan form konfirmasi password baru, mohon ulangi',
		            'type' => 'danger'
		        	);
		        $this->session->set_flashdata('message',$data);
				$this->index();
			}

			$checkoldpassword = $this->User_m->checkoldpassword($ids)->row();

			if($oldpassword == $checkoldpassword->passwordADMIN){

				$data['passwordADMIN'] = $this->User_m->hash($this->input->post('password'));
				$this->User_m->save($data, $ids);
				if($this->sendemailnotifforgotpasswordadmin()){
					record_activity('Rubah password sukses');
					$data = array(
						'title' => 'Sukses',
						'text' => 'Perubahan kata sandi telah berhasil dilakukan, silakan masuk kembali untuk memulai',
						'type' => 'success'
						);
					$this->session->set_flashdata('message', $data);
					redirect('login/logout');
				}

			} else {
				record_activity('Rubah password error kata sandi lama tidak sama dengan yang di masukkan sebelumnya');
				$data = array(
					'title' => 'Terjadi Kesalahan',
					'text' => 'Maaf, kami tidak bisa merubah kata sandi anda, karena kata sandi lama anda tidak sama dengan yang anda masukkan sebelumnya, Mohon ulangi!.',
					'type' => 'warning'
					);
				$this->session->set_flashdata('message', $data);
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			record_activity('Rubah password format salah');
			$data = array(
	            'title' => 'Terjadi Kesalahan',
	            'text' => 'Maaf, mohon ulangi inputan form anda dibawah.',
	            'type' => 'error'
	        	);
	        $this->session->set_flashdata('message',$data);
	        $this->changepassword();
		}
	}

	public function sendemailnotifforgotpasswordadmin() {
		record_activity('Email rubah password berhasil dikirim');
		$emailADMIN = $this->data['emailadmin'];

		$from_email = 'no-reply@hooplarentalmainan.com';
        $subject = 'Pemberitahuan! kata sandi anda telah telah berhasil dirubah.';
        $message = '<!DOCTYPE html>
					<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
					<head>
					    <meta charset="utf-8">
					    <meta name="viewport" content="width=device-width">
					    <meta http-equiv="X-UA-Compatible" content="IE=edge">
					    <meta name="x-apple-disable-message-reformatting">
					    <title>'.$subject.'</title>
					    <!--[if mso]>
					        <style>
					            * {
					                font-family: sans-serif !important;
					            }
					        </style>
					    <![endif]-->

					    <!-- CSS Reset : BEGIN -->
					    <style>

					        html,
					        body {
					            margin: 0 auto !important;
					            padding: 0 !important;
					            height: 100% !important;
					            width: 100% !important;
					        }

					        * {
					            -ms-text-size-adjust: 100%;
					            -webkit-text-size-adjust: 100%;
					        }

					        div[style*="margin: 16px 0"] {
					            margin: 0 !important;
					        }

					        table,
					        td {
					            mso-table-lspace: 0pt !important;
					            mso-table-rspace: 0pt !important;
					        }

					        table {
					            border-spacing: 0 !important;
					            border-collapse: collapse !important;
					            table-layout: fixed !important;
					            margin: 0 auto !important;
					        }
					        table table table {
					            table-layout: auto;
					        }

					        img {
					            -ms-interpolation-mode:bicubic;
					        }

					        *[x-apple-data-detectors],  /* iOS */
					        .x-gmail-data-detectors,    /* Gmail */
					        .x-gmail-data-detectors *,
					        .aBn {
					            border-bottom: 0 !important;
					            cursor: default !important;
					            color: inherit !important;
					            text-decoration: none !important;
					            font-size: inherit !important;
					            font-family: inherit !important;
					            font-weight: inherit !important;
					            line-height: inherit !important;
					        }

					        .a6S {
					            display: none !important;
					            opacity: 0.01 !important;
					        }

					        img.g-img + div {
					            display: none !important;
					        }


					        .button-link {
					            text-decoration: none !important;
					        }

					        #order-masuk tr td {
					            border-bottom: transparent;
					        }

					        #contact-form dl dt {
					            font-weight: bold;
					        }

					        #contact-form dl dd {
					            margin: 0;
					            margin-bottom: 10px;
					        }

					        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) { /* iPhone 6 and 6+ */
					            .email-container {
					                min-width: 375px !important;
					            }
					        }

					    </style>
					    <!-- CSS Reset : END -->

					    <!-- Progressive Enhancements : BEGIN -->
					    <style>

					    .button-td,
					    .button-a {
					        transition: all 100ms ease-in;
					    }
					    .button-td:hover,
					    .button-a:hover {
					        background: #555555 !important;
					        border-color: #555555 !important;
					    }

					    /* Media Queries */
					    @media screen and (max-width: 600px) {

					        .email-container p {
					            font-size: 17px !important;
					            line-height: 22px !important;
					        }

					    }

					    </style>
					    <!-- Progressive Enhancements : END -->

					    <!--[if gte mso 9]>
					    <xml>
					        <o:OfficeDocumentSettings>
					            <o:AllowPNG/>
					            <o:PixelsPerInch>96</o:PixelsPerInch>
					        </o:OfficeDocumentSettings>
					    </xml>
					    <![endif]-->

					</head>
					<body width="100%" bgcolor="#222222" style="margin: 0; mso-line-height-rule: exactly;" id="password-reset">
					    <center style="width: 100%; background: #dff0f7; text-align: left;">

					        <!-- Visually Hidden Preheader Text : BEGIN -->
					        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
					            '.$subject.'
					        </div>
					        <!-- Visually Hidden Preheader Text : END -->
					        <div style="max-width: 600px; margin: auto;" class="email-container">
					            <!--[if mso]>
					            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" align="center">
					            <tr>
					            <td>
					            <![endif]-->

					            <!-- Email Header : BEGIN -->
					            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">
					                <tr>
					                     <td style="padding: 20px 0; text-align: center">
					                        <img src="'.base_url().$this->data["asfront"].'img/logo-web.png" width="300" height="" alt="alt_text" border="0" align="center" style="width: 100%; max-width: 300px; height: auto; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; margin: auto;" class="g-img" alt="Hoopla Toys Rental">
					                    </td>
					                </tr>
					            </table>
					            <!-- Email Header : END -->

					            <!-- Email Body : BEGIN -->
					            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 600px;">

					                <!-- 1 Column Text + Button : BEGIN -->
					                <tr style="padding-bottom: 2em; border-bottom: 2px solid rgba(0, 0, 0, 0.09);">
					                    <td bgcolor="#ffffff">
					                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
					                            <tr>
					                                <td style="padding: 40px; padding-bottom: 15px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
					                                    <h1 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #96d019; font-weight: normal;">Hi, Admin! Password berhasil diganti.</h1>
					                                    <p>Kamu telah berhasil mengubah password admin panel kamu pada <b>'.date("l, d F Y H:i:s").'</b>. Kalau kamu tidak merasa melakukan perubahan ini, silakan hubungi bagian tim kami untuk penindakan lebih lanjut.</p>
					                                </td>
					                            </tr>
					                            <tr>
					                                <td style="padding: 0 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
					                                    <!-- Button : BEGIN -->
					                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto; margin-bottom: 20px !important">
					                                        <tr>
					                                            <td style="border-radius: 50px; background: #96d019; text-align: center;" class="button-td">
					                                                <a href="mailto:magicwarms@gmail.com?Subject=Hallo%20dari%20Hoopla%20Team%20Kami%20Butuh%20Bantuan%20Anda%20Secepatnya" target="_top" style="background: #96d019; font-family: sans-serif; font-size: 13px; line-height: 2.6; text-align: center; text-decoration: none; display: block; border-radius: 50px; font-weight: bold;" class="button-a">
					                                                    <span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;Kirim Email&nbsp;&nbsp;&nbsp;&nbsp;</span>
					                                                </a>
					                                            </td>
					                                        </tr>
					                                    </table>
					                                    <!-- Button : END -->
					                                </td>
					                            </tr>
					                        </table>
					                    </td>
					                </tr>
					                <!-- 1 Column Text + Button : END -->

					                <!-- Clear Spacer : BEGIN -->
					                <tr>
					                    <td aria-hidden="true" height="40" style="font-size: 0; line-height: 0;">
					                        &nbsp;
					                    </td>
					                </tr>
					                <!-- Clear Spacer : END -->

					                <!-- 1 Column Text : BEGIN -->
					                <tr style="border-bottom: 2px solid rgba(0, 0, 0, 0.09);">
					                    <td bgcolor="#ffffff">
					                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
					                            <tr>
					                                <td style="padding: 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
					                                    <p style="margin: 0;">Email ini terkirim otomatis oleh sistem Codewell Indonesia. Tidak perlu reply atau mengirim email apapun ke alamat ini.</p>
					                                </td>
					                            </tr>
					                        </table>
					                    </td>
					                </tr>
					                <!-- 1 Column Text : END -->

					            </table>
					            <!-- Email Body : END -->

					            <!-- Email Footer : BEGIN -->
					            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; font-family: sans-serif; color: #888888; line-height:18px;">
					                <tr>
					                    <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors">
					                        <webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion>
					                        <br><br>
					                        Codewell Indonesia<br>
					                        <br><br>
					                    </td>
					                </tr>
					            </table>
					            <!-- Email Footer : END -->

					            <!--[if mso]>
					            </td>
					            </tr>
					            </table>
					            <![endif]-->
					        </div>

					    </center>
					</body>
					</html>';

        //configure email settings
        $config = $this->mail_config();
        $this->email->initialize($config);

        //send mail
        $this->email->from($from_email, 'Codewell Indonesia');
        $this->email->to($emailADMIN);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
	}
}
