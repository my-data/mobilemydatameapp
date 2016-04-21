<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About_us extends CI_Controller {

	public function index(){

		$this->load->view('header');
		$this->load->view('aboutus');
		$this->load->view('footer');
	}

}