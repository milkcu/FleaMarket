<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	public function index() {
        $this->load->model('settings');
        $data['imghead'] = $this->settings->get_var('imghead');
        $data['imgqrcode'] = $this->settings->get_var('imgqrcode');
		$this->load->model('categories');
		$data['categories'] = $this->categories->get_categories();
        $data['tab'] = 1;
		$this->load->view('page/index', $data);
	}
    public function phone() {
        $this->load->view('page/phone');
    }
    public function ban() {
        $this->load->view('page/ban');
    }
    public function disclaimer() {
        $this->load->model('settings');
        $data['txtdisclaimer'] = $this->settings->get_var('txtdisclaimer');
        $this->load->view('page/disclaimer', $data);
    }
    public function service() {
        $this->load->model('settings');
        $data['txtservice'] = $this->settings->get_var('txtservice');
        $this->load->view('page/service', $data);
    }
}
