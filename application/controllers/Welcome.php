<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	public function index()
	{
		$this->load->view('front/meta');
		$this->load->view('front/header');
		$this->load->view('front/body');
		$this->load->view('front/footer');
	}

	function contactUs()
	{
		$save = $this->insert->message();

		if ($save == 1) {
			$this->session->set_flashdata('tipe', 'success');
			$this->session->set_flashdata('pesan', 'Pesan berhasil dikirim');
			redirect('');
		} else {
			$this->session->set_flashdata('tipe', 'error');
			$this->session->set_flashdata('pesan', 'Pesan gagal dikirim');
			redirect('');
		}
	}
}
