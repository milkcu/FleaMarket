<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	public function index() {
		$this->load->model('categories');
		$data['categories'] = $this->categories->get_categories();
		$this->load->view('page/index', $data);
	}
    public function phone() {
        $this->load->view('page/phone');
    }
}
