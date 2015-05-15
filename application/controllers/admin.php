<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		if( ! $this->aauth->is_admin()) {
			redirect();
		}
	}
    public function index() {
        $this->load->view('admin/index');
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
    public function category() {
        $this->load->model('categories');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'required');
        $this->form_validation->set_rules('detail', 'required');
        $this->form_validation->set_rules('icon', 'required');
        if($this->input->post() && $this->form_validation->run()) {
            // modify category
            $cid = $this->uri->segment(3);
            $data = $this->input->post();
            $this->categories->modify_category($cid, $data);
            redirect('admin/category');
        } else {
            // show category
            // get qiniu token begin
            $conf = array('ak' => 'A2o1e1u2qqPQECn3VWxL5BcGGmSWX3n2KhXgK7Rx',
                            'sk' => 'EUkbMnHf2BNrqOx49-VGz7cUhiwd52Y82mne1zaL',
                            'bucket' => 'mysdnu',
                            'auth' => 'public');
            $this->load->library('qiniu', $conf);
            $this->qiniu->put_policy->init();
            $arr = array(
                Qiniu_put_policy::QINIU_PP_SCOPE => 'mysdnu',
                Qiniu_put_policy::QINIU_PP_DEADLINE => time()+7200,
                //Qiniu_put_policy::QINIU_PP_SAVE_KEY => 'mysdnutestbase64.jpg'
                );
            $this->qiniu->put_policy->set_policy_array($arr);
            $token = $this->qiniu->put_policy->get_token();
            // get qiniu token end
            $data['token'] = $token;
            $cats = $this->categories->get_categories();
            $data['categories'] = $cats;
            $this->load->view('admin/category', $data);
        }
    }
    public function setting() {
        // system setting
        $this->load->model('settings');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('img', 'required');
        if($this->input->post() && $this->form_validation->run()) {
            // process form
            $from = $this->uri->segment(3);
            if($from == 'head') {
                $imghead = $this->input->post('img');
                $this->settings->set_var('imghead', $imghead);
            } elseif($from = 'qrcode') {
                $imgqrcode = $this->input->post('img');
                $this->settings->set_var('imgqrcode', $imgqrcode);
            }
            redirect('admin/setting');
        } else {
            // show settings
            // get qiniu token begin
            $conf = array('ak' => 'A2o1e1u2qqPQECn3VWxL5BcGGmSWX3n2KhXgK7Rx',
                            'sk' => 'EUkbMnHf2BNrqOx49-VGz7cUhiwd52Y82mne1zaL',
                            'bucket' => 'mysdnu',
                            'auth' => 'public');
            $this->load->library('qiniu', $conf);
            $this->qiniu->put_policy->init();
            $arr = array(
                Qiniu_put_policy::QINIU_PP_SCOPE => 'mysdnu',
                Qiniu_put_policy::QINIU_PP_DEADLINE => time()+7200,
                //Qiniu_put_policy::QINIU_PP_SAVE_KEY => 'mysdnutestbase64.jpg'
                );
            $this->qiniu->put_policy->set_policy_array($arr);
            $token = $this->qiniu->put_policy->get_token();
            // get qiniu token end
            $data['token'] = $token;
            $data['imghead'] = $this->settings->get_var('imghead');
            $data['imgqrcode'] = $this->settings->get_var('imgqrcode');
            $settings = $this->settings->list_var();
            $data['settings'] = $settings;
            $this->load->view('admin/setting', $data);
        }
    }
    public function disclaimer() {
        $this->load->model('settings');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt', 'required');
        if($this->input->post() && $this->form_validation->run()) {
            $txtdisclaimer = $this->input->post('txt');
            $this->settings->set_var('txtdisclaimer', $txtdisclaimer);
            redirect('admin/disclaimer');
        } else {
            $data['txt'] = $this->settings->get_var('txtdisclaimer');
            $this->load->view('admin/disclaimer', $data);
        }
    }
    public function service() {
        $this->load->model('settings');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt', 'required');
        if($this->input->post() && $this->form_validation->run()) {
            $txtservice = $this->input->post('txt');
            $this->settings->set_var('txtservice', $txtservice);
            redirect('admin/service');
        } else {
            $data['txt'] = $this->settings->get_var('txtservice');
            $this->load->view('admin/service', $data);
        }
    }
    public function initpm() {
        $this->load->model('settings');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt', 'required');
        if($this->input->post() && $this->form_validation->run()) {
            $txtinitpm = $this->input->post('txt');
            $this->settings->set_var('txtinitpm', $txtinitpm);
            redirect('admin/initpm');
        } else {
            $data['txt'] = $this->settings->get_var('txtinitpm');
            $this->load->view('admin/initpm', $data);
        }
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
