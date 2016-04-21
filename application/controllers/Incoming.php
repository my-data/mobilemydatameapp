<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Incoming extends CI_Controller {

	public function index(){

		$this->load->view('header');
		$this->load->view('wwlog');
		$this->load->view('footer');
	}

}