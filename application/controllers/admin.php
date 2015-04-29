<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		if( ! $this->aauth->is_admin()) {
			redirect();
		}
	}
    public function product() {
		$this->load->model('products');
		$data['products_num'] = $this->products->get_num_all();

		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = site_url('admin/product/');
		$config['total_rows'] = $this->products->get_num_all();
		$config['per_page'] = 12;
		$this->pagination->initialize($config);

		$page = $this->uri->segment(3);
		$offset = $page ? ($page - 1) * 12 : 0;
		$data['products'] = $this->products->get_products_all($config['per_page'], $offset);

        $this->load->view('admin/product', $data);
    }
	public function delete() {
		$pid = $this->uri->segment(3);
		$this->load->model('products');
		$this->products->delete_product($pid);
		redirect('admin/product');
	}
	public function ban() {
		$uid = $this->uri->segment(3);
        $this->aauth->ban_user($uid);
		redirect('admin/product');
	}
	public function unban() {
		$uid = $this->uri->segment(3);
        $this->aauth->unban_user($uid);
		redirect('admin/product');
    }
}
