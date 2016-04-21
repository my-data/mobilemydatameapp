<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Explain extends CI_Controller {

	public function index(){

		$this->load->view('header');
		$this->load->view('explain');
		$this->load->view('footer');
	}

}